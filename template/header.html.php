<?php include_once ROOTS . 'includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Version 0.1 beta -->
<?php if($metaRefresh > 0)
	{echo '<meta http-equiv="refresh" content="' . $metaRefresh . ', url=./?' . html($redirect) . '" />';}
?>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="http://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
	<h1 style="text-align: center;"><a href="./" id="logo">Fredagslisten.no</a></h1>
	<?php if(isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] === TRUE): ?>
		<p id="username">Logget inn som: <i><?php echo $_SESSION['name']; ?></i></p>
	<?php endif; ?>
</div> <!--id="header" -->

<div id="wrapper">
	<div id="navbar">
		
		<div id="text">
			------------------------------------------------------------------------------------------------------------------
		</div><!--text-->
		
		<div id="nav">
			<div id="navcenter">
				<ul>
					<li><a <?php if ($activePage == 'index') echo 'class="current"';?> href="./">Hjem</a></li>
					
					
					
					
					<?php if(isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] === TRUE): ?>
					<li><a <?php if ($activePage == 'list') echo 'class="current"';?>href="?page=receivers">Legg til mottakere</a></li>
					<li><a <?php if ($activePage == 'update') echo 'class="current"';?>href="?page=update">Oppdater Listen</a></li>
					<li class="last"><a <?php if ($activePage == 'logout') echo 'class="current"';?>href="?page=logout">Logg ut</a></li>
					<?php else: ?>
					<li class="last"><a <?php if ($activePage == 'login') echo 'class="current"';?>href="?page=login">Logg inn</a></li>					
					<?php endif; ?>
				</ul>
			</div><!--navcenter-->
		</div><!--nav-->
	</div>
	<div id="content">
