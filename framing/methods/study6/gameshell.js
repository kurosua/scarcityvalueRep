//Game shell.  For standard use, there is no need to edit this file.

//variables set by program (do not change)
var totaltime;							// total number of seconds for task
var init_trial_time;						// stores alloted trial time passed from iframe (remains constant)
var trialnum = 1;							// trial user is currently on
var cdtimer;								// count down timer
var cond;									// user condition passed from iframe php
var timeborrowed = 0;						// keeps track of amount of time borrowed in a given trial
var trialtimes = [];						// array of alloted time per trial
var pauser=true;							// indicates when the timer should pause
var timetillnext				// time until the "next button" becomes active.
var timeused=0;
var trialtime;
var practice=1;				//practice=1: first half of practice, practice=2: second half, practice=3: game time.
var maxtime;
var repeated=0;

window.onload = setFrame;

function setFrame() {
	maindiv = document.getElementById("main");
		var newIframe = document.createElement('iframe');
	
		newIframe.setAttribute('src',iframe + "?trialnum=0");
		newIframe.id = "gameframe";
		newIframe.name="gameframe";
		newIframe.nodeValue = "If you are reading this, your browser does not support IFrames.  Please upgrade to a newer version of your browser.";
	maindiv.appendChild(newIframe);
}

function setCond(php_cond) {
	cond = php_cond;
	
	

	
	
	
	
	var sidebar = document.getElementById("sidebar");
	sidebar.appendChild(document.createTextNode("Score:"));
	sidebar.appendChild(scorediv = document.createElement("div"));
	scorediv.id = "scorediv";

	sidebar.appendChild(document.createTextNode("Round time left:"));
	sidebar.appendChild(trialtimediv = document.createElement("div"));
	trialtimediv.id = "trialtimediv";
	
	var borrowtimediv = document.createElement("div");
	borrowtimediv.appendChild(borrowform = document.createElement("form"));
	borrowform.onsubmit = function() { newTrial(); return false; }
	borrowform.appendChild(document.createElement("br"));
	var input2 = document.createElement("input");
		input2.type="submit";
		input2.id="nextbutton";
		input2.value = "Next Round";
		input2.disabled=true;
	borrowform.appendChild(input2);
	sidebar.appendChild(errorsdiv = document.createElement("div"));
		errorsdiv.id = "errors";


	borrowtimediv.id = "borrowtimediv";
	sidebar.appendChild(borrowtimediv);
	borrowtimediv.appendChild(document.createElement("br"));
	borrowtimediv.appendChild(document.createElement("br"));
	borrowtimediv.appendChild(document.createElement("br"));
	borrowtimediv.appendChild(document.createTextNode("Total time:"));
	borrowtimediv.appendChild(totaltimediv = document.createElement("div"));
		totaltimediv.id="totaltimediv";
	

	setPracticeTime();	
	
		

}

function donePractice(){
	trialnum=1;
	
	if (cond==0 || cond==2)
		totaltime=150;
	else
		totaltime=500;	

	trialtime=totaltime/10;
	timetillnext=trialtime*.4;
	
if (document.getElementById("trialtimediv")) {
				document.getElementById("trialtimediv").style.color = "white";
			}
			if (document.getElementById("totaltimediv")) {
				document.getElementById("totaltimediv").style.color = "white";
			}	

	setTime();
}

function setTime() {

	if (cond>1){
		for (var x=1; x<=4;x++){
			trialtimes[x]=trialtime;
		}
		for (var x=5;x<=numtrials;x++){
			trialtimes[x]=1000;
		}

			
	}
	else{
		for (var x = 1; x <= numtrials; x++) {		// fill array of trial times
			trialtimes[x] = trialtime;
		}
	}
	
	trialtime=trialtimes[1];
	showTime(totaltime,'totaltimediv');
	showTime(trialtime,'trialtimediv');
	showTrial();
	
	
	
	cdtimer = setTimeout("countDown()",1000);
}



function setPracticeTime(){
	
	if (cond==0 || cond==2){
		totaltime=75;
		maxtime=15;
	}
	else{
		totaltime=250;
		maxtime=50;
	}
	
	timetillnext=maxtime*.4;
	
	for (var i=1;i<=numpracticetrials;i++){
			trialtimes[i]=maxtime;
	}

	

		
	trialtime=trialtimes[1];

	
	showTime(totaltime,'totaltimediv');
	showTime(trialtime,'trialtimediv');
	showTrial();
	
	cdtimer = setTimeout("countDown()",1000);
	

}

function showScore(score){
if (score==1)
	document.getElementById("scorediv").innerHTML = score+"<span style=\"font-size: 12pt;\"> point so far!</span>";
else if (score>1)
	document.getElementById("scorediv").innerHTML = score+"<span style=\"font-size: 12pt;\"> points so far!</span>";
else
	document.getElementById("scorediv").innerHTML = score;

}

function showTime(timevar, idvar) {
	var min = Math.floor(timevar / 60);			
	var sec = timevar - (min * 60);
	
	if (min < 10) {
		min = "0" + min;
	}
	if (sec < 10) {
		sec = "0" + sec;
	}
	
	var newtime = min + ":" + sec;
	
	if (idvar = document.getElementById(idvar)) {
		if ((idvar.id=="trialtimediv") && (trialtime <= trialredtime)) {
			idvar.style.color = "red";
		}
		if ((idvar.id=="totaltimediv") && (totaltime <= totalredtime)) {
			idvar.style.color = "red";
		}
		idvar.innerHTML = newtime;
	}
}

function showBorrowTime() {
	var borrowtime = totaltime - trialtime;
	document.getElementById("availablediv").innerHTML = borrowtime;
}

function showTrial() {
	//document.getElementById("trialnumdiv").innerHTML = trialnum + " of " + numtrials;
	document.getElementById("trialnumdiv").innerHTML = trialnum;
}

function eraseErrors() {
	document.getElementById("errors").innerHTML = "";
}

function assignTimes(){
	trialsleft=numtrials-trialnum+1;
	newtime=Math.floor(totaltime/trialsleft);
	remainder=totaltime%trialsleft;
	
	if (newtime>=maxtime){
		newtime=maxtime;
		remainder=0;
	}
	
	for (i=trialnum;i<=numtrials;i++){
		trialtimes[i]=newtime;
		if (remainder>0){
			trialtimes[i]++;
			remainder--;
		}
		
	}

}

function assignPracticeTimes(){
	trialsleft=numpracticetrials-trialnum+1;
	newtime=Math.floor(totaltime/trialsleft);
	remainder=totaltime%trialsleft;
	
	if (newtime>=maxtime){
		newtime=maxtime;
		remainder=0;
	}
	
	for (i=trialnum;i<=numpracticetrials;i++){
		trialtimes[i]=newtime;
		if (remainder>0){
			trialtimes[i]++;
			remainder--;
		}
		
	}

}

function newTrial() {
	
	clearTimeout(cdtimer);
	document.getElementById("errors").innerHTML="";
	if (nextbutton=document.getElementById("nextbutton")){
		nextbutton.disabled=true;
	}	

	if (document.getElementById("trialtimediv")) {
		document.getElementById("trialtimediv").style.color = "white";
	}
	if (document.getElementById("totaltimediv")) {
		document.getElementById("totaltimediv").style.color = "white";
	}
	
	var prevtrial = trialnum;
	
	
	trialnum = trialnum + 1;
	
	if (practice<2){
		
			
		if ((trialnum <= numpracticetrials) && (totaltime>0)) {
			assignPracticeTimes();
			if (trialtimes[trialnum]>totaltime)
				trialtimes[trialnum]=totaltime;
			trialtime = trialtimes[trialnum];
			
		
			if (document.getElementById("totaltimediv")) {
				showTime(totaltime,'totaltimediv');
			}
				
			if (document.getElementById("trialtimediv")) {
				showTime(trialtime,'trialtimediv');
			}
			showTrial();
	
		
			
			document.getElementById("gameframe").src = iframe + "?trialnum=" + trialnum + "&prevtrial=" + prevtrial + "&timeborrowed=" + timeborrowed + "&timegiven=" + trialtimes[prevtrial] + "&timeused=" + timeused;
			timeborrowed = 0;
			timeused=0;
	
			cdtimer = setTimeout("countDown()",1000); 
		}
		else {
			practice++;
			if (document.getElementById("trialtimediv")) {
				document.getElementById("trialtimediv").style.color = "white";
			}
			if (document.getElementById("totaltimediv")) {
				document.getElementById("totaltimediv").style.color = "white";
			}
			//document.getElementById("gameframe").src = iframe + "?trialnum=" + trialnum + "&prevtrial=" + prevtrial + "&timeborrowed=" + timeborrowed + "&timegiven=" + trialtimes[prevtrial] + "&timeused=" + timeused + "&endpractice=true";
			timeborrowed = 0;
			timeused=0;
			endGame(prevtrial);		
		}
		
	
	}
	else{
		if ((trialnum <= numtrials) && (totaltime>0)) {
			assignTimes();
			if (trialtimes[trialnum]>totaltime)
				trialtimes[trialnum]=totaltime;
			trialtime = trialtimes[trialnum];
		
			if (document.getElementById("totaltimediv")) {
				showTime(totaltime,'totaltimediv');
			}
				
			if (document.getElementById("trialtimediv")) {
				showTime(trialtime,'trialtimediv');
			}
			
			showTrial();
	
			document.getElementById("gameframe").src = iframe + "?trialnum=" + trialnum + "&prevtrial=" + prevtrial + "&timeborrowed=" + timeborrowed + "&timegiven=" + trialtimes[prevtrial] + "&timeused=" + timeused;
			
			timeborrowed = 0;
			timeused=0;
	
			cdtimer = setTimeout("countDown()",1000); 
		}
		else if (repeated<repeats){
			repeated++;
			document.getElementById("gameframe").src = iframe + "?trialnum=" + trialnum + "&prevtrial=" + prevtrial + "&timeborrowed=" + timeborrowed + "&timegiven=" + trialtimes[prevtrial] + "&timeused=" + timeused + "&endphase=true";
			timeborrowed = 0;
			timeused=0;
		
		}
		else{
			endGame(prevtrial);
		}
		
		
		
	}
}

function endGame(prevtrial) {
		
		document.getElementById("gameframe").src = iframe + "?trialnum=" + trialnum + "&prevtrial=" + prevtrial + "&timeborrowed=" + timeborrowed + "&timegiven=" + trialtimes[prevtrial] + "&timeused=" + timeused + "&endgame=true";
		
		totaltime = 0; trialtime = 0;
		
		showTime(totaltime,'totaltimediv');
		showTime(trialtime,'trialtimediv');
}

function clearOut(){
	showScore('---');
	trialnum=0;
	showTrial();

}

function setPause(p){
	pauser=p;
	clearTimeout(cdtimer);
	cdtimer = setTimeout("countDown()",1000);
}

function countDown() {
	if (!pauser){
		if (window.frames["gameframe"].document.f.timestamp)
			window.frames["gameframe"].document.f.timestamp.value=timeused;

		if (trialtime==1)
			nominus=true;
		else
			nominus=false;
		if (trialtime > 0) {
			trialtime = trialtime-1;
		}
		timeused++;
		if (timeused>=timetillnext){
			if (nextbutton = document.getElementById("nextbutton"))
				nextbutton.disabled=false;
		}


		

		if (totaltime > 0) { totaltime = totaltime-1; }		
		
		
		


		if (trialtime<= 0) {
			if (totaltime>0){
				if (cond<-2)
					newTrial();
				else{
					if (!nominus){
						timeborrowed++;
						document.getElementById("errors").innerHTML="<span style=\"color:red;\">You're<br>borrowing<br>time!</span>";
						totaltime--;
						
					}
				
				}
			
			}
			else
				newTrial();
				
		}
		showTime(totaltime,'totaltimediv');

		showTime(trialtime,'trialtimediv');
		cdtimer = setTimeout("countDown()",1000);
	}
}