<?php
mysql_connect(HOST, USERNAME, PASSWORD) or die("Cannot connect. Check your settings.php file.");
mysql_select_db(DB_NAME)or die("The database you're trying to access is unavailable right now.");

