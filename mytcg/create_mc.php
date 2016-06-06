<?php include("settings.php");
include("header.php");

$connect = mysql_connect("$db_server", "$db_user", "$db_password");
mysql_select_db("$db_database", $connect);

$create_mcs = "CREATE TABLE `$table_mcs` (
	`id` int(20) NOT NULL auto_increment,
	`member` varchar(255) NOT NULL,
	`memberid` INT(8) NOT NULL,
	`image` varchar(500) NOT NULL,
	`color` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
)";
if (mysql_query($create_mcs, $connect)) {
   echo "<p>The table $table_mcs was successfully created. <strong>Delete this file from your server.</strong></p>\n";
}
else {
   die("Error: ". mysql_error());
}
mysql_close();
include("footer.php");
?>
