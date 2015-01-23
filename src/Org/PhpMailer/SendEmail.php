<?php
namespace Org\PhpMailer;
require_once (__DIR__ .'/class.phpmailer.php');
class SendEmail{
	/*
	 * 发送邮件
	 */
	public function send($email,$e_id,$choice=NULL){
		
		$mail = new \PHPMailer();
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->CharSet = 'UTF-8';
		$mail->Host = 'smtp.exmail.qq.com:465';  // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'service@123youhuo.com';                            // SMTP username
		$mail->Password = 'youhuo123';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
		
		$mail->From = 'service@123youhuo.com';
		$mail->FromName = '有活网';
		$mail->AddAddress($email, null);  // Add a recipient
// 		$mail->AddAddress('1219417912@qq.com', 'liuhui');  // Add a recipient
// 		$mail->AddAddress('ellen@example.com');               // Name is optional
// 		$mail->AddReplyTo('info@example.com', 'Information');
// 		$mail->AddCC('cc@example.com');
// 		$mail->AddBCC('bcc@example.com');
		
// 		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
// 		$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
// 		$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->IsHTML(true);                                  // Set email format to HTML
		
		
		$body = '我们已经收到您的有活账户<font style="font-size:16px">'.$email.'</font>发出的密码变更申请<p>如果确定是本人提出申请，请
				点击以下链接：</p><p><a href="http://www.123youhuo.com/index.php?module=user&controller=index&action=password&step=update&id='.$e_id.'">
				www.123youhuo.com/index.php?module=user&controller=index&action=password&step=update&eid='.$e_id.'</a></p>';
		$body2 = '此邮件确认您最近在有活网的密码做了修改<p>密码已经修改成功，请
				点击以下链接重新登陆：</p><p><a href="http://www.123youhuo.com/index.php">www.123youhuo.com</a></p><p style="margin-top:50px">有活网</p>';
		if($choice =='changePasswordSuccess'){
			$mail->Subject = '有活网密码修改成功';
			$mail->Body    = $body2;
		}else {
			$mail->Subject = '有活网找回密码';
			$mail->Body    = $body;
		}
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		if(!$mail->Send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		}else{
			return true;	//发送成功
		}
	}
}