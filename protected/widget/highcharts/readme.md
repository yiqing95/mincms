```
$opts = array(
	'chart'=>array('type'=>'area'), 
	'series'=>array(
		array(
			'name'=>'Asia',
			'data'=>array(1,2,3,5), 
		)
	),
);
//渐变
$opts['plotOptions']['area']['fillColor'] = array(
	'linearGradient'=>array(
		'x1'=>0,
		'y1'=>0,
		'x2'=>0,
		'y2'=>1,
	),
	'stops'=>array(
		array(0,"js:Highcharts.getOptions().colors[0]"),
		array(1, '#2f7ed8'), //渐变色
	),
);  
	
widget('highcharts',array('tag'=>'#chart','options'=>$opts));
```