<?php namespace app\core;  
/**
*   
* 
* @author Sun < mincms@outlook.com >
*/
class Dir 
{ 
    //保存数组在路径的静态变量中
	static $kep_list_file; 
	/**
	* 使用 
	* Dir::listFile($dir,$contain);
	* $dir 为完整的物理路径
	* $search 为要搜索的关键字，允许为空。如要多个并的关系
	* 请加,英文下的豆号分隔
	* $uncontain 为必定不包含的字符,与$contain传参是一样的。
	* 支持无限目录遍历
	* 允许在目录中搜索关键字，对所有的目录
	* $id 2012年2月8日
	*/ 
	static	function listFile($dir,$contain=null,$uncontain=null)
	{    
		$tag = true;
		if(substr($dir,-1)!='/'){
			$dir.='/';
		} 
		$list = scandir($dir);
		foreach($list as $vo){  

			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$k = md5($dir.$vo);
				if($contain){  
					//并且的搜索,以,英文下豆号分隔 
					$douSearch = explode(',',$contain);
					$cnum = count($douSearch);
					if($cnum>1){
						foreach($douSearch as $dou){ 
							$s = strstr($dir.$vo, $dou);
							$tag = $tag && $s; 
						} 
						if($uncontain){ 
							$t = self::_listFile($dir.$vo,$uncontain);
							$tag = $tag && $t;
						} 
					}
					else{
						if (strpos($dir.$vo, $contain) === false)
							$tag = false;
						if($uncontain){ 
							$t = self::_listFile($dir.$vo,$uncontain);
							$tag = $tag && $t;
						}  
					}
					if (!$tag)
					{
						if(is_dir($dir.$vo) && $vo !="Thumbs.db" && $vo !="."&& $vo !=".." && $vo !=".svn" ){
							 self::listFile($dir.$vo.'/'.$vo2,$contain,$uncontain);
						} 	
					}
				}
				self::$kep_list_file['file'][$k] = $vo;
				self::$kep_list_file['dir'][$k] = $dir.$vo;  
			}

			if(is_dir($dir.$vo) && $vo !="Thumbs.db" && $vo !="."&& $vo !=".." && $vo !=".svn" ){
				 self::listFile($dir.$vo.'/'.$vo2,$contain,$uncontain);
			} 
		}
		return self::$kep_list_file;
	}
	/**
	* 该函数为搜索目录所用
	*/
	static function _listFile($value,$string){
		$tag = true;
		$array = explode(',',$string);
		$num = count($array);
		if($num>1){
			foreach($array as $item){ 
				$s = strstr($value, $item);
				$tag = $tag && $s; 
			} 
		}
		else{ 
			$t = !strstr($value, $string);
			$tag = $tag && $t; 
		}
		return $tag;
	}	
	// 以上为遍历目录功能
	/*------------------------------------------------*/

	/**
	 * 创建一个目录树  
	 */
	static function mkdir($dir, $mode = 0755)
	{
		if (is_dir($dir) || @mkdir($dir,$mode)) return true;
		if (!self::mkdir(dirname($dir),$mode)) return false;
		return @mkdir($dir,$mode);
	}
	/**
	* return dir 
	*/
	static function dir($file_name){ 
		return substr($file_name,0, strrpos($file_name,'/'));
	}
 	/**
	* return file_name 
	*/
	static function file_name($file_name){
		return substr($file_name,strrpos($file_name,'/')+1);
	}
 		 
}