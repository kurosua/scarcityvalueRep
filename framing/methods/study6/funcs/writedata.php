<?php
//writes all demographic (post) and session variables to a file
	global $stringData;

	function writeSess($data) {
		global $stringData;

		foreach ($data as $temp) {
			if (is_array($temp)) {
				writeSess($temp);
			} else {
				$stringData = $stringData . $temp . ",";
			}
		}
	}			

	$outFile = "data/results.txt";
	$fh = fopen($outFile,'a');

	$stringData = $_SESSION[subj] . "," . $_SESSION[cond] . ",";	// write subject and condition numbers
	unset($_SESSION[subj],$_SESSION[cond]);

	foreach ($_POST[dem] as $temp) {					// write demographics from POST
		$stringData = $stringData . $temp . ",";
	}

	writeSess($_SESSION);						// write all SESSION variables
	
	fwrite($fh, $stringData . "\n");
	fclose($fh);

?>
