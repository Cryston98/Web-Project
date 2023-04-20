<?php
  use PHPMailer\PHPMailer\PHPMailer;
  require_once '../PHPMailer/PHPMailer.php';
  require_once '../PHPMailer/Exception.php';

 if ($_SERVER['REQUEST_METHOD']!='POST') {
   header('Location:../index.php');
   exit();
 }

 $ch=curl_init();
 curl_setopt($ch, CURLOPT_URL,'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "cmd=_notify-validate&" . http_build_query($_POST));
 $response=curl_exec($ch);
 curl_close($ch);

 file_put_contents("text.txt", $response);

if ($response=="VERIFIED" && $_POST['receiver_email']=="seller@paypalsandbox.com") {
    $handle=fopen("POST_PAYNENT.ini","w");
    foreach ($_POST as $key => $value) {
      fwrite($handle, "$key => $value \r\n");
    }
    fclose($handle);

  // code...
  $cEmail=$_POST['payer_email'];
  $name=$_POST['first_name']." ".$_POST['last_name'];

  $priece=$_POST['mc_gross'];
  $currency=$_POST['mc_currency'];
  $item=$_POST['item_number'];
  $paymentStatus=$_POST['payment_status'];

  if ($item=="wordpressPlugin" && $currency=="USD" && $paymentStatus="Completed" && $priece=4.99) {
    // code...
    $mail=new PHPMailer();
    $mail->setFrom("sales@gmail.com","CPI Sales");
    $mail->addAttachment("attachment/wordpress-plugin.zip");
    $mail->addAddress($cEmail,$name);
    $mail->isHTML(true);
    $mail->Subject="Your Purchase Details";
    $mail->Body="
      HI,<br><br>
      Thank you for purchase.In the attachment you will find my
      Amazing wordpress plugin.<br><br>

      Adrian Deaconu";
      $mail->send();
  }

}else{

}


?>
