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
}
include('footer.php'); ?>
