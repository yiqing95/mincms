```
\app\modules\email\Mailer::send($title,$body,$to_array,$attachment=null,$log=true); 
```
```
use \app\modules\email\Mailer;
Mailer::send($title,$body,$to_array,$attachment=null,$log=true); 
```

$to_array 收件人 
```
$to_array = array('test@your.com'=>'test')
```

$attachment 附件 支持以下两种形式
```
$attachment = array('1.jpg','2.jpg')
$attachment = '1.jpg'
```