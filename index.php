<?php
require_once "lib.php";
// files to import email, add them to folder import

if ($handle = opendir('import/')) {
echo "Processed:\n";
	while (false !== ($file = readdir($handle))) {
		if (preg_match("/(txt)|(htm)|(html)|(csv)|(xls)|(doc){1}$/", $file)) echo "$file\n";
		$file = fopen('import/'.$file.'', "r");
		while (!feof($file)) {
		$line_of_text = fgets($file);
		$input .= addslashes($line_of_text)." ";
}
fclose($file);
    }
}

closedir($handle);

// export to csv file
csv_to_export($input);

// export to text file
text_to_export($input);
?>