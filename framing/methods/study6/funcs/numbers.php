<?php
//writes random numbers to a file
	$numFile = "data/numbers.txt";

	$num = rand(1,5000);

	$fh = fopen($numFile,'a');
	$stringData = $_SESSION['subj'] . "," . $num . "\n";
	fwrite($fh, $stringData);
	fclose($fh);

?>