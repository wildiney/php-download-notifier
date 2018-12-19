<?php
date_default_timezone_set('America/Sao_Paulo');

use SendEmail\Hostgator;

require 'Classes/SendEmail.class.php';

$search = array('./','../','/');
$file = (isset($_REQUEST['file']))? $_REQUEST['file']:null;
$file = str_replace($search, '', $file);

$email_from='';
$email_to='';
$email_subject='';

$message = "<table cellpadding='0' cellspacing='5' border='0'>";
$message.= "    <tr><th style='text-align:right'>FILE</th><td>"                 . $file                                     . "</td>";
$message.= "    <tr><th style='text-align:right'>TIME</th><td>"                 . date("Y-m-d H:i:s")                       . "</td>";
$message.= "    <tr><th style='text-align:right'>REFERER</th><td>"              . @$_SERVER['HTTP_REFERER']                 . "</td>";
$message.= "    <tr><th style='text-align:right'>HTTP_X_FORWARDED_FOR</th><td>" . @$_SERVER['HTTP_X_FORWARDED_FOR']         . "</td>";
$message.= "    <tr><th style='text-align:right'>USER AGENT</th><td>"           . @$_SERVER['HTTP_USER_AGENT']              . "</td>";
$message.= "    <tr><th style='text-align:right'>IP CLIENT</th><td>"            . @$_SERVER['HTTP_CLIENT_IP']               . "</td>";
$message.= "    <tr><th style='text-align:right'>IP ADDRESS</th><td>"           . @$_SERVER['REMOTE_ADDR']                  . "</td>";
$message.= "    <tr><th style='text-align:right'>IP VALUE</th><td>"             . gethostbyaddr($_SERVER['REMOTE_ADDR'])    . "</td>";
$message.= "</table>";

$email = new Hostgator;
$email->from($email_from);
$email->to($email_to);

if (!is_null($file) && $file!='' && $file!="index.php") {
    if (is_file("./" . $file)) {
        $email->subject($email_subject);
        $email->message($message);
        $email->send();
        
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
    } else {
        $email->subject($email_subject);
        $email->message($message);
        $email->send();
        die("Erro 404 - File not found");
    }
} else {
    die("Access not allowed");
}
