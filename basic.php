<?php
date_default_timezone_set('America/Sao_Paulo');

$file = (isset($_REQUEST['file']))? $_REQUEST['file']:null;
$now = date("Y-m-d H:i:s");
$head = "From: contato@slicedpixel.com\r\n";
$message = "<table>";
$message.= "<tr><th>FILE</th><td>" . $file . "</td>";
$message.= "<tr><th>TIME</th><td>" . $now . "</td>";
$message.= "<tr><th>REFERER</th><td>" .@$_SERVER['HTTP_REFERER'] . "</td>";
$message.= "<tr><th>HTTP_X_FORWARDED_FOR</th><td>" . @$_SERVER['HTTP_X_FORWARDED_FOR'] . "</td>";
$message.= "<tr><th>USER AGENT</th><td>" . @$_SERVER['HTTP_USER_AGENT'] . "</td>";
$message.= "<tr><th>IP CLIENT</th><td>" . @$_SERVER['HTTP_CLIENT_IP'] . "</td>";
$message.= "<tr><th>IP ADDRESS</th><td>" . @$_SERVER['REMOTE_ADDR'] . "</td>";
$message.= "<tr><th>IP VALUE</th><td>" . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "</td>";
$message.= "</table>";

if(!is_null($file) && $file!='' && $file!="index.php"){
    if(is_file("./" . $file)){
        mail('wildiney@gmail.com',"[Indra] File downloaded ",$message, $head);
        
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
        
    } else {
        mail('wildiney@gmail.com',"[Indra] Attempt to get a file",$message, $head);
        die("Erro 404 - File not found");
    }
} else {
    die("Access not allowed");
}