<?php
include('settings.php');
mysql_connect("$host", "$username", "$password")or die("Cannot connect. Check your settings.php file.");
mysql_select_db("$db_name")or die("The database you're trying to access is unavailable right now.");

