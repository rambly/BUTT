<?php
// Fatal Tragedy -- the error message!
// Lyrics off of the song from Dream Theater's "Scenes From A Memory"
$tragedy = "<b>Nicholas:</b><br><br>Alone at night<br>I need to find<br>All the answers to my dreams<br><br>When I sleep at night<br>I hear the cries<br>What does this mean?<br><br>I shut the door and traveled to another home<br>I met an older man, he seemed to be alone<br>I felt that I could trust him<br>He talked to me that night:<br><br>\"Lad did you know a girl was murdered here\"<br>\"This fatal tragedy was talked about for years\"<br>Victoria's gone forever<br>She passed away&mdash;<br>She was so young!<br>";

// Some internal settings.
$butt_ver = "1.61.10"; // The version number; will be displayed at the bottom of the page.
$butt_iplog = 0; // Allow IP logging in Butt; default 0.  Set to 1 to enable IP logging of users who play Butt to a text file.  Useless because access.log exists.
$butt_ipfile = "logs.txt"; // Log to which file?  You must make sure this file exists on your server already; see n.b. at the end of the IP logging routine below.

// Generate a location
// Also allows user to specify a location in the url using ?lnum=#
// ^ e: wait, no, never mind.
if (!$lnum) {
	$lnum = rand(1,6);
}
if($lnum == 1) {
	$loc = "The Fields";
} elseif($lnum == 2) {
	$loc = "The Sewers";
} elseif($lnum == 3) {
	$loc = "Dong Mountain";
} elseif($lnum == 4) {
	$loc = "Boring City";
} elseif($lnum == 5) {
	$loc = "Cave of the Wangs";
} elseif($lnum > 5) {
	$loc = "fgsfds Castle";
}

// Check for cookie
if($_COOKIE['wins'] != NULL) {
	$wins = $_COOKIE['wins'];
} else {
	$wins = 0;
	setcookie("wins", 0, time()+157680000, "/");
}

// Check game status
if($_GET['clear'] == 1) {
	$wins = 0;
	setcookie("wins", 0, time()+157680000, "/");
	$msg = "Cookies cleared.";
} elseif($_GET['dead'] == 1) {
	$msg = "I'm sorry, but you didn't win.  Please try again.";
} elseif($_GET['win'] == 1) {
	$wins++;
	setcookie("wins", $wins, time()+157680000, "/");
	$msg = "You win.  Play again?";
} else {
	setcookie("wins", $wins, time()+157680000, "/");
	$msg = "Click on the Q to win.";
}

// Check game mode
if($_GET['hard'] == 1) {
	$mode = '<a href="index.php?win=0&amp;dead=1&amp;hard=1">J</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">U</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">Y</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">L</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">^</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">X</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">)</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">7</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">W</a> | <a href="index.php?win=1&amp;dead=0&amp;hard=1">Q</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">G</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">#|</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">S</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">DONG</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">%</a> | <a href="index.php?win=0&amp;dead=1&amp;hard=1">=</a>';
	$chgmode = 'Mode: <a href="index.php?hard=0">Easy</a> | Hard';
	$clear = ' <a href="index.php?clear=1&amp;dead=0&amp;win=0&amp;hard=1">(clear)</a>';
} else {
	$mode = '<a href="index.php?win=0&amp;dead=1">X</a> | <a href="index.php?win=1&amp;dead=0">Q</a> | <a href="index.php?win=0&amp;dead=1">Z</a>';
	$chgmode = 'Mode: Easy | <a href="index.php?hard=1">Hard</a>';
	$clear = ' <a href="index.php?clear=1&amp;dead=0&amp;win=0&amp;hard=0">(clear)</a>';
}

// Get IP of user and log it
if($butt_iplog > 0) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$log = fopen($butt_ipfile, 'a') or die($tragedy);
	flock($log, LOCK_EX);
	fputs($log, $ip . " s: " . $wins . "\n");
	flock($log, LOCK_UN);
	fclose($log);
}
// n.b. If you really want the IP log file to be private, you should change $butt_ipfile to a file name that only you know, and rename "logs.txt" in this folder to match (see internal options).
// Otherwise, anyone who knows what the default file name is can just type in "logs.txt" as specified above and see everyone who's visited your page!
// Butt will NOT create the file specified above for you, so you have to upload the blank text file yourself.  This'll be corrected in a future version.


// HTML code below.  Could probably be better, y'know,  fully CSS-ized and made standards-compliant, and the code could stand to be a little less messy (<br> tags omfg), but I'm also pretty lazy.  Eat a dong.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Butt</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"> 
<style type="text/css">
a:link,a:visited,a:hover {
color: #555;
background-color: #FFFFFF;
}
body { 
background-color: #FFFFFF;
color: #000;
font-family: Georgia, "Times New Roman", serif;
}
</style>
</head><body style="background: url('butt.png') top left no-repeat">
<div align="right">HP: 42/42 | <?php echo($loc); ?></div>
<br>
<br>
<br>
<br>
<br>
<div align="center"><?php echo($msg); ?><br>
<br>
<?php echo($mode); ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<hr width="40%">
<font size="2"><?php require('rupdates.php') ?></font>
<br>
<hr width="40%">
<font size="1">Wins: <?php echo($wins . $clear); ?>
<br>
<?php echo($chgmode); ?><br>
<!-- <a href="Walkthrough.txt">FAQ (Sembregall)</a> | <a href="buttinfo.html">Info...</a> -->
<br><br><a href="https://saltedfork.org/BUTT/">Butt</a> Version <?php echo($butt_ver); ?>
<br>Copyright &copy; 2005&ndash;2010 Kyargu</font></div>
</body></html>
