<?php
$host="localhost";
$username="[USER NAME HERE]";
$password="[PASSWORD HERE]";
$db_name="[DATABASE NAME HERE";
$table="user"; // Table name
mysql_connect("$host", "$username", "$password")or die("Cannot connect");
mysql_select_db("$db_name")or die("The database you're trying to access is unavailable right now.");
?>