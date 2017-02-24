<?php
try //login mysql
{
	$pdo = new PDO('mysql:host=localhost;dbname=fredaspd_fredagslisten', 'fredaspd_site','jelihKHJFLEDnl378278o7hxnkjKLNKJN489824');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "latin1"');
}catch (PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
/*catch (PDOException $e)
{ 
	$error = 'Unable to connect to the database server. - </br>' . $e->getMessage();
	include 'error.html.php';
	exit();
}
*/