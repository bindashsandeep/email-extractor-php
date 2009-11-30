<?php
require_once "lib.php";
// paste your emails in folder import/import.txt 
$file = fopen("import/import.txt", "r");

while (!feof($file)) {
$line_of_text = fgets($file);
$input .= $line_of_text;
}

fclose($file);

// export to csv file
csv_to_export($input);

// export to text file
text_to_export($input);
?>