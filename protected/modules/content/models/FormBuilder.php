<?php 
namespace app\modules\content\models; 
use app\modules\content\models\NodeActiveRecord;
use app\modules\content\models\Node;
/**
* 
* @author Sun < mincms@outlook.com >
*/
class FormBuilder extends \yii\base\Widget
{ 
 	 public $model;
	 public $file; //file 
	 public $data; //file data araay
	 public $name; //content type name 
	 public $attrs;//fileds
	 public $nid; //node id
	 public $script;
	 public $message;
 	 /**
 	 * $params $file yaml文件，文件在forms目录下。且文件不能有.连接
 	 * 如在froms目录下的目录如 admin/post.php  该值为admin.post
 	 * @params $nid node id,如有值说明是更新操作
 	 */
	 function __construct($file=null,$nid=null){  
	 	$this->message = __('save success');
	 	$model = new NodeActiveRecord;
	 	$this->file  = $file; 
	 	$this->nid  = $nid; 
	 	if(!is_array($this->file)){
	 		\Yii::import('@app/vendor/Spyc');
	 		$file = str_replace('.','/',$file);
	 		$file = base_path()."/../formbuiler/{$file}.yaml";
			if(!file_exists($file)){
				return ;
			}
			$this->data = \Spyc::YAMLLoad($file);
			$this->name = $this->data['content_type']; 
			unset($this->data['content_type']); 
	 	}
	 	else{
	 		$this->data = $file;
	 		$this->name = $this->data['content_type']; 
			unset($this->data['content_type']); 
	 	}
	 	
		$model::$table = $this->name;
		$this->model = $model;
		
	 }

	 function run(){
	  
	 	if($this->nid>0){
	 		/**
	 		* 如果有nid,说明是更新
	 		* 需要先取出NODE的内容并赋值给model
	 		*/
	 		$row = Node::load($this->name,$this->nid);
	 		foreach($row as $k=>$v){
	 			$this->model->$k=$v;
	 		} 
	 	} 
	 	$data['model'] = $this->model;
	 	//设置字段验证规则
	 	$this->set_rules();
	 	 
	 	if($_POST && \Yii::$app->request->isAjaxRequest){
	 		//保存数据到数据库  
	 		$attrs_data = array();
	 		foreach($this->attrs as $get){
	 			$attrs_data[$get] = $_POST['NodeActiveRecord'][$get];
	 		}

	 	 	Node::save($this->name,$this->model,$attrs_data,$this->nid);
	 	}  
	 	$data['nid'] = $this->nid; 
	 	$data['data'] = $this->data; 
	 	$data['message'] = $this->message; 
	 	$data['script'] = $this->script; 
	 	
	 	echo $this->render('@app/modules/content/models/FormBuilderView',$data);
	 }
	 /**
	 * 设置验证规则
	 */
	 function set_rules(){
	  	$data = Node::set_rules($this->data);
		//加载插件
		if($plugins) {
			foreach($plugins as $pk=>$plugin)
			widget($pk,$plugin);
		}
		$this->attrs = $data['attrs']; 
	 	/**
	 	* 验证规则赋值给Model中的ruels属性
	 	*/
		$this->model->rules = $data['rules']; 

	 }
	 static function widget(){
	 	
	 }

}