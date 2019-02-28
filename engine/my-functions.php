<?php
function fileLog ($pagePath = '') {
	$fileLog = "../log/log{$pagePath}.txt";
	$file = fopen($fileLog, 'a');
	fwrite($file,date('H:i:s d-m-Y') . PHP_EOL);
	//$str = file_get_contents($fileLog);

	if (file_exists($fileLog)) {
		$file_arr = file($fileLog);
		if (count($file_arr) >= 10) {
			for ($i = 1;file_exists("../log/log{$pagePath}{$i}.txt");$i++) {}
			fopen("../log/log{$pagePath}{$i}.txt", 'a');
			copy($fileLog, "../log/log{$pagePath}{$i}.txt");
			file_put_contents($fileLog, '');
		}
	}

	fclose($file);
}

