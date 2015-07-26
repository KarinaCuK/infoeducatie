<?php session_start();?>
<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="utf-8">
<title>Trimitere email...</title>
<style type="text/css">
body { background-color: #daecee;}
.mijloc {padding: 60px 15px; text-align: center;}
h2 { color: green; padding:15px; font-size: 20px; line-height: 1.4em;}
h3 { color: darkgreen; padding:10px; Font-family: Georgia; font-size: 18px; line-height: 1.4em;}
.error { color: red; Font-family: Georgia; text-align: center; font-size : 20px !important ; padding: 5px; line-height: 1.7em;}
</style>
</head>
<body>
<?php
if (isset($_POST['submit'])) {
if (!empty($_POST['name'])) {
	$name = $_POST['name'];
	} else { $error .= "Nu ți-ai introdus numele! <br />"; }
if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  if (!preg_match("/^[_a-z0-9]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email)){ 
  $error .= "Adresa de email introdusă nu este validă! <br/>";
  }
  } else {
  $error .= "Nu ți-ai introdus adresa de email! <br />";
}
if (!empty($_POST['message'])) {
  $message = $_POST['message'];
  } else {
  $error .= "Nu ai introdus mesajul! <br />";
}

if(($_POST['code']) == $_SESSION['code']) { 
  $code = $_POST['code'];
  } else { 
  $error .= "Codul de verificare a fost introdus greșit!<br />";    
}
if (empty($error)) {
$success = "<h2>Verifică-ți căsuța de email!<br/><br/>Dacă ai primit un mail de confirmare,<br/> atunci mesajul tău a fost trimis cu succes!</h2>";
$ip = $_SERVER['REMOTE_ADDR'];
$from = 'From: alin01x@giraffe.arvixe.com';
$to = 'alinhucea@gmail.com';
$subject = "CONTACT - CumSaFaciUnSiteWeb.com";
$content = "        Nume: " . $name . "\n        Email: " . $email . "\n        IP: " . $ip . "\n\n ------------------------- MESAJ ------------------------- \n\n". $message;

$confirmare = "   Mesajul completat de tine în formularul de contact de pe
site-ul www.CumSaFaciUnSiteWeb.com a fost trimis cu succes.

Îți voi răspunde cât de repede pot, o zi frumoasă în continuare!";

mail($to,$subject,$content,$from);
mail($email,$subject,$confirmare,$from);
}

}
?>
<div class="mijloc">
<?php
if (!empty($error)) {
echo '<p class="error">Mesajul tău nu a fost trimis pentru că:<br/><strong>' . $error . '</strong></p><br/>
<h3>Apasă tasta <a href="javascript:javascript:history.go(-1)">BACKSPACE</a> ca să mergi la pagina anterioară,<br /> astfel încât formularul să conțină  informațiile introduse.</h3>. ';
} elseif (!empty($success)) { echo $success; }
?>
<br />
<h3><a href="http://cumsafaciunsiteweb.com">www.CumSaFaciUnSiteWeb.com</a></h3>	             
</div>
</body>
</html>