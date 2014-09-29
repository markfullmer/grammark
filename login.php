<?php
session_start();
if (isset($_POST['password'])) { $password=$_POST['password']; 
	if($password == 'iching') { 
		$_SESSION['logged'] = '1'; 
		header('Location: /');
	}
	else {
		header('Location: /login.php?wrong=wrong');
	}
}
$loginform = <<<LOGIN
<form action="login.php" method="post">
<p><input type="password" name="password" value="" />
<input type="submit" value="Login" /></p></form>
LOGIN;
		echo "<div id=\"login\">";
		if (empty($_SESSION['logged'])) 
		{ 
			if (isset($_GET['wrong'])) {
			$wrong = $_GET['wrong']; 
			if ($wrong == 'wrong') 
			{echo 'You entered a wrong password. Try again. ';}
			}
			echo $loginform; 
			echo $_SESSION['logged'];
		}
		else {
		echo "<a href=\"logout.php\">Logout</a>"; 
			}
		echo "</div>";
?>	