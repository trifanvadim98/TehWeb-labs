var intervalId;

function startClock(){
	intervalId = setTimeout(getCurrentDateTime,1000);
}

function stopClock()
{
	clearInterval(intervalId);
}

function getCurrentDateTime()
{
	document.getElementById("time").innerHTML = new Date();
}
getCurrentDateTime();