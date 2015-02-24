<?php

	session_start();
	$_SESSION = array();					// reset session variables
	session_destroy();	
	session_start();
	session_regenerate_id();

function init ($numconds) {

	$subjFile = "data/subj.txt";
	$condFile = "data/rand.txt";
	
	// $numconds is the REAL number of conditions.

	$numconds = $numconds - 1; 			// Don't change this.

	$fh = fopen($subjFile,'r');			// process subject number (max 999)
	$subj = fread($fh,3);
	fclose($fh);

	$strData = $subj + 1;

	$fh = fopen($subjFile,'w');
	fwrite($fh,$strData);
	fclose($fh);

	$fh = fopen($condFile,'r');			// process condition number (max 99)
	$num = fread($fh,2);
	fclose($fh);
	
	$strData = $num + 1;
	
	if ($num == $numconds) {
		$strData = "0";
	}
	
	$fh = fopen($condFile,'w');
	fwrite($fh,$strData);
	fclose($fh);
	
	$_SESSION['cond'] = $num;			// set condition and subject variables
	$_SESSION['subj'] = $subj;

}

function ipCheck() {
	$ipFile = "data/ip.txt";				// checks ips.  bypass using ?skip=1

	$ip = $_SERVER['REMOTE_ADDR'];

	$file = file_get_contents($ipFile);
		if(strpos($file, $ip)) {
			if ($_GET['skip'] != 1) {
				echo "Our records indicate you have already completed this survey.  You may only participate once. <br /><br /> Please do not submit this error message as a result to MTurk, it will be rejected.";
				break;
			}
		}

	if ($_GET['skip'] != 1) {
		$fh = fopen($ipFile,'a');
		$strData = "ip" . $ip . "\n";
		fwrite($fh,$strData);
		fclose($fh);
	}
}

?>
