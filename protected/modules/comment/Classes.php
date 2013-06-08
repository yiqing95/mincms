<?php 
namespace app\modules\comment; 
use app\core\DB;
use app\modules\member\Auth;
/**
 *  
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class Classes
{
	/**
	* 发布评论
	*/
	static function comment($slug,$body,$display=1){
		$minute = 3;//几分钟内不能重复评论
		if(!$body || !$slug) return __('comment body required');
		if(!Auth::id()) return __('please login first');
		$sid = static::slug($slug);
		$body_id = static::body($body);
		$one = DB::one('comment',array(
			'where'=>array('mid'=>Auth::id()),
			'orderBy'=>'id desc'
		));
		if($one && $one['created']+60*$minute>=time()){
			return __('comment have a rest');
		}
		$array = array(
			'body_id'=>$body_id,
			'mid'=>Auth::id(),
			'slug_id'=>$sid,
			'display'=>$display,
			'created'=>time()
		);  
		DB::insert('comment',$array);  
	} 
	/**
	* 缓存单条评论
	* $name 是名字不是ID
	*/
	static function one($name){
		$one = static::get_slug($name);
		return $one['id'];
	}
 	static function get_slug($name){
 		$id = 'database#comment_slug';
 		$one = cache($id);
 		if(!$one){
	 		$one = DB::one('comment_slug',array(
				'where'=>array('name'=>$name)
			));
			cache($id,$one);
		}
		
		return $one;
 	}
 	static function get_body($id){
 		$cacheId = 'database#comment_body_'.$id;
 		$one = cache($cacheId);
 		if(!$one){
	 		$one = DB::one('comment_body',array(
				'where'=>array('id'=>$id)
			)); 
			cache($cacheId,$one);
		} 
		return $one['body'];
 	}
	/**
	* 保存 slug
	*/
	static function slug($name){ 
		$one = static::get_slug($name);
		if($one) return $one['id'];
		DB::insert('comment_slug',array(
			'name'=>$name
		)); 
		return DB::id();
	}
	/**
	* 保存 body
	*/
	static function body($body){ 
		$slug = md5(trim($body));
		$cacheId = 'database#comment_body_slug_'.$slug;
 		$one = cache($cacheId);
 		if(!$one){
			$one = DB::one('comment_body',array(
				'where'=>array('slug'=>$slug)
			));
			cache($cacheId,$one);
		}
		if($one) return $one['id'];
		DB::insert('comment_body',array(
			'slug'=>$slug,
			'body'=>$body
		)); 
		return DB::id();
	}
	/**
	* 过滤字段
	*/
	static function filter(){
		$all = DB::all('comment_filter');
		if(!$all) return array();
		foreach($all as $v){
			$row[$v['name']] = $v['replace']?:'*';
		}
		return $row;
	}
}