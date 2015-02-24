<?php
//moves all post variables to the session
if (isset($_POST)) {
	foreach($_POST as $key=>$value){
		$_SESSION[$key]=$value;
	}
}

?>