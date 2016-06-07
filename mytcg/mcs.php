<?php require('check.php'); 
require_once('settings.php');
include('header.php'); ?>
<h1>Member card requests</h1>
<?php $select2 = mysql_query("SELECT * FROM `$table_mcs` ORDER BY `id` ASC");
$count = mysql_num_rows($select2);

if($count==0) {}
else {
	echo "<table class=\"margin0auto zest w100\">\n";
	echo "<tr><th class=\"w15\">Member</th><th class=\"w42\">Image</th><th class=\"w33\">Color</th><th class=\"w5\">Action</th></tr>\n";
	while($row2=mysql_fetch_assoc($select2)) {
		echo "<tr><td>$row2[member]</td><td><a href=\"$row2[image]\">www</a></td><td>$row2[color]</td>";
		echo "<td><a href=\"delete_mcs.php?id=$row2[id]\">delete</a></td>";
	}
	echo "</table>\n";
} ?><br /><br /><?php
if (ini_get('allow_url_fopen') == 'v1.0.0') {
	$installed32 = file_get_contents('j_mcs.txt');
	$version3 = file_get_contents('http://static.janepedia.com/versions/mytcg/mc-requests.txt');
	if ($version3 !== false) {
		if ($installed3 == $version3) { //version numbers are the same
			echo "Your MC hack version is up to date.";
		}
		else if ($installed3 != $version3) { //version numbers are not the same
			echo "<p>You are using MC requent hack version ".$installed3.". Please update to <a href=\"https://github.com/gotjane/mc-requests/releases/\">".$version3."</a>.";
		}
	}
	else {
		// an error happened
		echo "Could not check for updates. Please make sure you use the latest version of <a href=\"https://github.com/gotjane/mc-requests/releases/\">the MC request hack</a>.";
	}
}
else {
   echo "Could not check for updates. Please make sure you use the latest version of <a href=\"https://github.com/gotjane/mc-requests/releases\">the MC request hack</a>.";
}
include('footer.php'); ?>
