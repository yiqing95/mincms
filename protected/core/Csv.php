<?php namespace app\core;  
/** 
$file = Csv::write($table,$insert);
Csv::insert($table,'value',$file);
* @author Sun < taichiquan@outlook.com >
* @date 2013
*/
class Csv{
	static $count=0;
	static $cut = "--||;||;--";
	
	/**
	* 写csv文件
	*/
	static function write($name,$data=null,$path="csv"){ 
		$name = $name.'-'.uniqid();
		self::$count = self::$count+count($data); 
		$path = \Yii::$app->runtimePath.'/'.$path; 
		if(!is_dir($path)) mkdir($path);
		$file = $path."/{$name}.csv"; 
		$fp = fopen($file, 'w');    
		foreach($data as $d){
		 	self::fputcsv($fp,$d,static::$cut);    
		} 
   		fclose($fp);  
   		return $file; 
	}
	/**
	* 向mysql里面写文件
	*/
	function insert($file,$table,$fields,$ignore=1){    
		global $mysqldb;  
		 $sql = "LOAD DATA LOCAL INFILE '" . $file . "'
		  REPLACE INTO Table " . $table . "   FIELDS TERMINATED BY '".static::$cut."' 
		    LINES ";
		 
		 $sql .= " TERMINATED BY '\\n'  " ;
		 if($ignore)
			$sql .=" IGNORE $ignore LINES ";
		 $sql .=" ($fields); ";  
	     echo $sql;exit;
		\Yii::$app->db->createCommand($sql)->execute(); 
		//@unlink($file);
	}
	
	
	static function detectUTF8($string)
	{
	        return preg_match('%(?:
	        [\xC2-\xDF][\x80-\xBF]        # non-overlong 2-byte
	        |\xE0[\xA0-\xBF][\x80-\xBF]               # excluding overlongs
	        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}      # straight 3-byte
	        |\xED[\x80-\x9F][\x80-\xBF]               # excluding surrogates
	        |\xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
	        |[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
	        |\xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
	        )+%xs', $string);
	}
	static function fputcsv($handle, $row, $fd=',', $quot='"') 
	{ 
	   $str='';  
	   $nums = count($row);
	   $i = 1;
	   foreach ($row as $cell) { 
	   	   $cell = trim($cell);
	   	   if(!self::detectUTF8($cell))
	   	   	$cell = @iconv('gb2312','utf-8',$cell);
	   	   //
	   	   if(empty($cell)) continue;
	       $cell=str_replace(Array($quot,        "\n"), 
	                         Array($quot.$quot,  ''), 
	                         $cell); 
	       if($i<$nums){
	       	   if ($fd && strchr($cell, $fd)!==FALSE || strchr($cell, $quot)!==FALSE) { 
	           	  $str.=$quot.$cell.$quot.$fd; 
		       } else { 
		           $str.=$cell.$fd; 
	       	   }  
	       }
	       else{
	       		$str.= $cell.$quot; 
	       } 
	       $i++;
	   }  
	   fputs($handle, substr($str, 0, -1)."\n");  
	   return strlen($str); 
	} 
	
}