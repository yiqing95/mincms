<?php namespace app\modules\content\models; 
use app\modules\content\models\Field;
use app\modules\content\models\NodeActiveRecord;
use \app\core\Csv;
/**
* 
* @author Sun < mincms@outlook.com >
*/
class Node{
	static $array_deep = 0;
	/**
	* 直接保存数据，无需FORM
	*/
	static function save_data($name,$data,$nid=null){
		$model = new NodeActiveRecord;
		$data = (object)$data;
		if(!$nid)
			$nid = $data->id;

		if($nid){
			$row = Node::load($name,$nid);
	 		foreach($row as $k=>$v){
	 			$model->$k=$v;
	 		} 
		}
		$st = static::tree($name); 
		$rt = Node::set_rules($st);
		$model->rules = $rt['rules'];
		return Node::save($name,$model,$data,$nid,true);  
	}
	/**
	 * 设置验证规则
	 */
	 function set_rules($data){
	 	//set validate rules && plugins
	 	$i=0;  
		foreach($data as $field=>$value){
			/**
			* 对设置中的插件参数进行加载
			*
			*/
			$plugins = $value['plugins'];
			if($plugins){  
				foreach($plugins as $pk=>$plugin){
					/**
					* TAG参数是常规参数，
					* 如对应的是ID，则可以tag:id 或tag:#
					* 如对应的是NAME,则可以tag:name 
					*/
					if($plugin['tag']){
						if(in_array(strtolower($plugin['tag']),array('#','id'))){
							$plugin['tag'] = '#'.$field;
						}elseif(in_array(strtolower($plugin['tag']),array('name'))){
							$plugin['tag'] = $field;
						}
					}
					$out_plugins[$pk] = $plugin;
					//加载插件
					$this->controller->plugin($pk,$plugin);
				}
			}
			/**
			* 设置字段对应的验证规则，
			* 至少有一个验证规则。
			* 如果都没有验证规则，则无法显示表单。
			* 因为数据库不需要保留全为空的值
			*/
			$attrs[] = $field;
			$validates = $value['validates'];
			if(!$validates) continue;
			foreach($validates as $k=>$v){  
				if(is_bool($v) || is_numeric($v) ){
					$rules[$i] = array($field,$k);
				}else if(is_array($v)){ 
					$rules[$i][] = $field; 
					$rules[$i][] = $k; 
					foreach($v as $_k=>$_v){  
						$rules[$i][$_k] = $_v;
					} 
				} 
				$i++;
			}
		} 
		/**
		* 无规则直接报错
		*/
	 	if(!$rules){
	 		exit(t('admin','No Validate Rules'));
	 	} 
		return array(
			'rules'=>$rules,
			'attrs'=>$attrs,
			'plugins'=>$out_plugins,
		);

	 }
	static function find_all($name,$condition=null){
	 	//使用mysql 分页
	 	return DataBase::find_all($name,$condition);	 
	 }
	/**
	* 分页
	调用方法
	$condition = array(
		'where'=>array(
			'or'=>array('created','like','%标题%'),
			//'and_1'=>array('title','like','%标题%'),
			//'or_2'=>array('title','like','%标题%'),
		), 
		'order'=>array('id'=>'desc'),
	);
	$rows = Node::pager($name,$condition);
	$this->render('admin',array( 
	     'posts'=>$rows['posts'], 
	     'pages'=>$rows['pages'], 
	     'name'=>$name
	));
	//输出数据
	foreach($posts as $row){
	$post = Node::find($name,$row['id']);
	显示分页
	<div class="pagination"> 
	<?php 
	$this->widget('LinkPager',array('pages'=>$pages));
	?>
	</div>
	*/ 
	static function pager($name,$condition=null,$pagesize=20){
	 	//使用mysql 分页
	 	return DataBase::pager($name,$condition,$pagesize);	 
	 }
	static function delete_cache($name,$nid){
		$cache_id = "node_{$name}_{$nid}"; 
		\Yii::$app->cache->delete($cache_id);
	}
	/**
	* 显示完整一条node的内容
	*/
	static function load($name,$nid){  
 		$cache_id = "node_{$name}"; 
		$data=\Yii::$app->cache->get($cache_id);
		echo $cache_id;exit;
		if($data===false)
		{
		    //取得 content_type 指定name的所有信息
			$structs = Field::tree($name);
			$master = self::table_master($name);
			//取得主node信息，_nid表
			$row = DataBase::select($master." as node",array( 
				'where'=>array(
					'node.id=:id'=>array(':id'=>$nid)
				)
			)); 		
			foreach($structs as $field=>$options){  
				$fid = (int)$options['fid'];//字段ID
				$mysql = $options['mysql'];
				$table = self::table_name($name,$mysql);
				$tables[$table][] = $fid;
				$fs[$fid] = $field;//字段
				$i++;
			}  		 
			$rows = DataBase::find_no_nid($tables,$nid,$fs);
			$data = (object)array_merge($row,$rows);
		    \Yii::$app->cache->set($cache_id,$data);
		} 
 	 	return $data; 		
	}
	static function find($name,$condition,$all=false){
		//取得 content_type 指定name的所有信息
		$structs = static::tree($name);
 		$master = 'node_'.$name;
		if(is_numeric($condition)){  
			return self::load($name,$condition); 
		} else{
			$rt = DataBase::find_all($name,$condition); 
			if(true===$all){
				if($rt){
			 		foreach($rt as $n){
			 			$node[] = find($name,$n['id']);  
			 		}
			 	}
			 	$rt = $node;
			}
			if($condition['limit']==1){
				 return $rt[0];
			}
			return $rt;
		}
	}
	static function update($name,$array=array(),$nid){
		$master = self::table_master($name);
		DataBase::update($master,$array,array(
 			'id=:id',
 			array( ':id'=>$nid)
 		));  
	}

 	/**
 	* 数据保存
 	* @params $name content_type_name
 	* @params $model Model
 	* @params $attrs 属性
 	* @params $return 为true时返回nid
 	*/
 	static function save($name,$model,$attrs,$node_id=null,$return=false){  
 		foreach($attrs as $key=>$value){
 			$model->$key = $value; 
 		} 
 		$out = "##ajax-form-alert##:";
 		if(!$model->validate()){
 			$errors = $model->getErrors(); 
 			$out.= "<ul class='alert alert-error'>";
 			foreach($errors as $key=>$e){
 				foreach($e as $r)
 					$out.= '<li>'.$r.'</li>';
 			}
 			$out.="</ul>"; 
 			if(true === $return){
 				return $out;
 			}
 			exit($out);
 		} 
 	 
 		//保存数据到数据库
 		$structs = static::tree($name);
 		$master = "node_".$name;//主表 
 		//主表 _nid 表，生成node 信息。向mysql中写源数据,返回主键值
 		if($node_id>0){ //如果node_id > 0说明是更新
 			$nid =  $node_id;
 		 	$display = 1;
 		 	if($model->display)
 				$display = $model->display; 
 			\Yii::$app->db->createCommand()->update($master,array( 
	 			'updated'=>time(),
	 			'display'=>$display, 
		 		),array(
		 			'id=:id',
		 			array( ':id'=>$node_id)
		 		));  
 		 
 		}else{ 
	 		\Yii::$app->db->createCommand()
	 			->insert('node_posts',array(
		 			'created'=>time(),
		 			'updated'=>time(),
		 			'uid'=>uid()
		 		))->execute(); 
	 		$nid = \Yii::$app->db->getLastInsertID();
 		}   
 		foreach($structs as $field=>$options){
 			if($value = $model->$field){ //属性有值时 才会查寻数据库
 				$fid = $options['fid'];//字段ID
 				$table = "content_".$options['mysql'];  
 				$batchs[$table][$fid][] = $value; 
 				$wherein[$table][] = $value;  
 			}
 		} 
 		 
 		foreach($batchs as $table=>$value){ 
 			/*$data = $wherein[$key];
 			$query = new \yii\db\Query;
			$query->from($table)
				->where(array('value'=>$data)); 
			$command = $query->createCommand(); 
			$row = $command->queryAll(); 
			if($row) {
				foreach($row as $r){
					$j[] = $r['value'];
				} 
				foreach($value as $k=>$vo){
				 
					if(vo==$j){
						echo 11;
						unset($value[$k]);
					}
				}
			 
			} */
		  
 		}
 		 
 		if($batchs){
 			foreach($batchs as $table=>$insert){   
 			  	$file = Csv::write($table,$insert);
 			  	Csv::insert($table,'`value`',$file);
		 		//\Yii::$app->db->createCommand()
			 	//		->batchInsert($table,array('value'),$insert)->execute(); 
			 			
		 	}
	 	}
 		dump(1);exit;
 		$out.= 1; 
		self::delete_cache($name,$nid);
		if(true === $return){
			return $nid;
		}
		exit($out);  
 	}
 	 
 	static function array_first($arr){
 		foreach($arr as $v){
 			return $v;
 		}
 	}
 	/**
 	* 内容类型 下的字段信息
 	*/
 	static function tree($name){
 		$model = Field::find(array('slug'=>$name));
 		if(!$model) exit(__('form builder error')); 
 		$models = Field::find()->where(array('pid'=>$model->id))->all();
 		foreach($models as $m){
 			$n = $m->slug;
 			$out[$n]['slug'] = $m->slug;
 			$out[$n]['name'] = $m->name;
 			$out[$n]['fid'] = $m->id;
 			$out[$n]['widget'] = $m->widget;
 			$out[$n]['mysql'] = \app\modules\content\Hook::run($m->widget,'mysql');
 		} 
 		return $out;
 	}
 	
 	/**
	* 条件中判断是否是主分的
	*/
	static function table_nid($key){
		$k = array(
			'id'=>1,
			'display'=>1,
			'sort'=>1,
			'created'=>1,
			'updated'=>1,
			'admin'=>1,
			'uid'=>1
		);
		if($k[$key])
			return "n.$key";
	}
	//判断数组深度
	static function array_deep($array=array()){
	 	foreach($array as $k=>$v){
	 		self::$array_deep++;
	 		if(is_array($v))
	 			self::array_deep($v);
	 	}
	 	return self::$array_deep;
	}
	/**
	* 对分页调用方法的判断
	返回统一结构的where
	where=>array(
		array(k,'=',v)
	)
	*/
	static function where($name,$where){ 
		$deep = static::array_deep($where); 
 		//如果是1维
 		if($deep==1){
 			foreach($where as $k=>$v){
 				if(is_numeric($k)){
 					$field = $where[0];
 					$condition = $where[1];
 					$value = $where[2];
 					$wheres[] = array(array($field,$condition,$value));
 				}else{
 					$wheres[] = array(array($k,'=',$v));
 				}
 			} 
 		}else{
 			$wheres[] = $where;
 		}
 		
 		return $wheres;
	}
 	
}