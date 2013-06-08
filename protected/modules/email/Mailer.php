<?php 
namespace app\modules\email; 
use app\modules\email\models\Config;
use app\modules\email\models\Send;
use app\core\Arr;
/*
*
\app\modules\email\Mailer::send($title,$body,$to_array,$attachment=null); 

use \app\modules\email\Mailer;
Mailer::send($title,$body,$to_array,$attachment=null); 
* @author Sun < mincms@outlook.com >
*/
class Mailer
{
	static function send($title,$body,$to_array,$attachment=null,$log=true){
		$model = Config::find()->one();
		// Create the message
		$message = \Swift_Message::newInstance()
		  // Give the message a subject
		  ->setSubject($title)
		  // Set the From address with an associative array
		  ->setFrom(array($model->from_email => $model->from_name))
		  // Set the To addresses with an associative array
		  ->setTo($to_array)
		  // Give it a body
		  ->setBody($body) ;
		  // Optionally add any attachments
		  if($attachment){
		  	 if(is_array($attachment)) {
			 	foreach($attachment as $file){
			 		$message = $message->attach(Swift_Attachment::fromPath($file)); 
			 	}
			 }else{
			 	 $message = $message->attach(Swift_Attachment::fromPath($attachment));  
			 } 
 		 }
		// Create the Transport   
		switch($model->type){
			case 1: 
				$transport = \Swift_SmtpTransport::newInstance($model->smtp, $model->port>0?:25)
						  ->setUsername($model->from_email)
						  ->setPassword($model->pass);
				break;
			case 2:
				$transport = \Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
				break;
			case 3:
				$transport = \Swift_MailTransport::newInstance();
				break;
		} 
		$mailer = \Swift_Mailer::newInstance($transport);
		$result = $mailer->send($message);
		//log send mail
		if(true === $log)
			static::log($to_array,$title,$body,$attachment);
		
	}
	static function log($to_array,$title,$body,$attach){ 
		foreach($to_array as $to=>$name){
			$model = new Send;
			$model->to_email = $to;
			$model->to_name = $name;
			$model->title = $title;
			$model->body = $body;
			$model->attach = $attach;
			$model->save();
		} 
	}
}