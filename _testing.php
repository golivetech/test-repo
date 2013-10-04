<?php


session_start();
include_once("settings/dbase_login.php");


$resTz = mysql_query("SELECT * FROM hospitals WHERE HospitalID='19'");
$rowTz = mysql_fetch_array($resTz);


date_default_timezone_set($rowTz['TimeZone']);



/* ----------------------------------------------------------------
TIME FUNCTIONS
---------------------------------------------------------------- */

// Used to generate the time drop menus in the sign in forms
function getStartTime($TimeIncrement)
{
	$returnValue = '';
	
	$TimeNow = strtotime(date('H:i'));

	$TimeStart = strtotime('00:00');
	$TimeEnd = strtotime('23:59');										

	for($i = $TimeStart; $i <= $TimeEnd; $i += $TimeIncrement)
	{ 
		$TempTime = strtotime(date('H:i', $i));
		
		if($TempTime > $TimeNow)
		{
			$returnValue = date('H:i', $i);
			break;
		}
		
	}
	
	return $returnValue;	
}


$date = new DateTime();
$date = $date -> getTimestamp();

$date = $date * 1000;

$TimeZone = $rowTz['TimeZone'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>



</head>

<body>

	<div>PHP: <?php echo $date; ?></div>
	
	<div id="showtime"></div>

<script>


   function showTime()
   {
      if (!document.all && !document.getElementById)
		{
         return;
		}
      
		DivArea = document.getElementById ? document.getElementById("showtime"): document.all.showtime;
		
		var MyDate 		= new Date();
		var MyHours 	= MyDate.getHours();
		var MyMinutes	= MyDate.getMinutes();
		var MySeconds	= MyDate.getSeconds();
		var MyAmPm 		= " pm";
		
		if(MyHours < 12)
		{
			MyAmPm = " am";
		}
		
		if (MyHours > 12)
		{
			MyHours = MyHours - 12;
		}
		
		if (MyHours == 0)
		{
			MyHours = 12;
		}
		
		if (MyMinutes <= 9)
		{
			MyMinutes = "0" + MyMinutes;
		}
		
		if (MySeconds <= 9)
		{
			MySeconds = "0" + MySeconds;
		}			
		
		var TimeDisplay = MyHours + "<blink>:</blink>" + MyMinutes + ":" + MySeconds + MyAmPm;	

		DivArea.innerHTML = TimeDisplay;
		
		setTimeout("showTime()",1000)
	
   }
   window.onload = showTime
   //-->
   
</script>


</body>
</html>
