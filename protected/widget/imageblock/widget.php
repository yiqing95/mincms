<?php namespace app\widget\imageblock;  
/**
* 
* @author Sun < taichiquan@outlook.com >
*/
class Widget extends \yii\base\Widget
{  
 	public $rows; 
 	public $blue = true;
	function run(){  
		 $posts = $this->rows;
		 js("$('ul.hover-block li').hover(function(){
        $(this).find('.hover-content').animate({top:'-3px'},{queue:false,duration:500});
      }, function(){
        $(this).find('.hover-content').animate({top:'125px'},{queue:false,duration:500});
      });");
      if($this->blue===true){
      	css(".b-lblue:hover {
background: #1789c1;
-webkit-transition: background 1s ease;
-moz-transition: background 1s ease;
-o-transition: background 1s ease;
transition: background 1s ease;
}
.b-lblue {
background: #1ba1e2;
color: #fff;
margin: 3px 0px;
display: inline-block;
-webkit-transition: background 1s ease;
-moz-transition: background 1s ease;
-o-transition: background 1s ease;
transition: background 1s ease;
cursor: default;
}");
      }
css("/* Image blocks */

ul.hover-block li{
	list-style:none;
	float:left;
	width:225px; 
	height: 170px;
	position: relative;
	margin: 5px 4px;
}

ul.hover-block li a {
	display: block;
	position: relative;
	overflow: hidden;
	width: 225px;
	height: 170px;
	color: #000;
}

ul.hover-block li a { 
	text-decoration: none; 
}

ul.hover-block li .hover-content{
	width: 100%;
	position: absolute;
	z-index: 1000;
	height: 170px;
	top: 125px;
	color: #fff;
	padding: 5px 10px;
	cursor: pointer;
}
ul.hover-block{margin:0;}
ul.hover-block li .hover-content h6{
	color: #fff;
}

ul.hover-block li img {
	position: absolute;
	top: 0;
	left: 0;
	border: 0;
	z-index: 500;
}
");
echo $this->render('@app/widget/imageblock/views/index',array(
	'posts'=>$posts
));
	}
}