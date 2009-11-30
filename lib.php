<?php
require_once "disposable.php";

function parseText($input) {
  $email = array();
  $invalid_email = array(); 
  $input = ereg_replace("[^-A-Za-z._0-9@ ]"," ",$input);
 
  $token = trim(strtok($input, " "));
 
  while($token !== "") {
 
    if(strpos($token, "@") !== false) {    
 
      $token = ereg_replace("[^-A-Za-z._0-9@]","", $token);
 
      if(is_valid_email($email) !== true) {
        $email[] = strtolower($token);
      }
      else {
        $invalid_email[] = strtolower($token);
      }
    }
 
    $token = trim(strtok(" "));
  } 
  $email = array_unique($email);
  $invalid_email = array_unique($invalid_email); 
//  return array("valid_email"=>$email, "invalid_email" => $invalid_email);
	return array("valid_email"=>$email);
}

function is_valid_email($email) {
	if (preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', "$email")) return true;
	else return false;
}

function csv($input){
$emailuser = parseText($input);
$validuser = $emailuser['valid_email'];
echo "email,\n";
foreach ($validuser as $value) {
echo $value.",\n";}
}

function listall($input){
$emailuser = parseText($input);
$validuser = $emailuser['valid_email'];
foreach ($validuser as $value) {
echo $value."\n";}
}

function csv_to_export($input){
$emailuser = parseText($input);
$validuser = $emailuser['valid_email'];
$handle = fopen("export/valid_emails.csv", "w");
foreach ($validuser as $value) {
$content .= "$value,\n";
}
fwrite($handle, $content);
fclose($handle);
}

function text_to_export($input){
$emailuser = parseText($input);
$validuser = $emailuser['valid_email'];
$handle = fopen("export/valid_emails.txt", "w");
foreach ($validuser as $value) {
$content .= "$value\n";
}
fwrite($handle, $content);
fclose($handle);
}
?>