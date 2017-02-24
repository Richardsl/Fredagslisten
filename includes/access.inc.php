<?php
function userIsLoggedIn()
{
	if (isset($_POST['action']) and $_POST['action'] == 'login')
	{
		global $loginError;
		
		if (!isset($_POST['email']) or $_POST['email'] == '' or
		!isset($_POST['password']) or $_POST['password'] == '')
		{
			$loginError = 'Vennligst fyll inn begge feltene';
			return FALSE;
		}
		
		$password = md5($_POST['password'] . 'ijdb');
		
		if (databaseContainsAuthor($_POST['email'], $password))
		{
			
			include ROOTS . 'includes/db.inc.php';
			
			try
			{
				
				$s = $pdo->prepare("SELECT name, id, companyId FROM boat WHERE email1 = ? AND password = ?");
				$s->bindValue(1, $_POST['email']);
				$s->bindValue(2, $password);
				$s->execute();
			
			} catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			$s = $s->fetchAll();
			$name = $s[0][0];
			$boatId = $s[0]['id'];
			
			$_SESSION['loggedIn'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['password'] = $password;
			$_SESSION['name'] = $name;
			$_SESSION['boatId'] = $boatId;
			$_SESSION['companyId'] = $s[0]['companyId'];
			return TRUE;
		}
		else
		{
			
			unset($_SESSION['loggedIn']);
			unset($_SESSION['email']);
			unset($_SESSION['password']);
			$loginError = 'Epost eller passord var feil';
			return FALSE;
		}
	}
	
	if (isset($_POST['action']) and $_POST['action'] == 'logout')
	{
		
		unset($_SESSION['loggedIn']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		header('Location: ' . $_POST['goto']);
		exit();
	}
	
	if (isset($_SESSION['loggedIn']))
	{
		
		return databaseContainsAuthor($_SESSION['email'],
		$_SESSION['password']);
	}else{
	unset($_SESSION['loggedIn']);
	unset($_SESSION['email']);
	unset($_SESSION['password']);
	}
}


//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------

function databaseContainsAuthor($email, $password)
{
	include ROOTS . 'includes/db.inc.php';
	try
	{
		$sql = 'SELECT COUNT(*) FROM boat
		WHERE email1 = :email1 AND password = :password';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email1', $email);
		$s->bindValue(':password', $password);
		$s->execute();

	}
	catch (PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}	
	
	$row = $s->fetch();
	
	if ($row[0] > 0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
		
	}
}

//----------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------

/*
function userHasRole($role)
{
	include 'db.inc.php';
	try
	{
		$sql = "SELECT COUNT(*) FROM user
		INNER JOIN userrole ON user.id = userid
		INNER JOIN role ON roleid = role.id
		WHERE email = :email AND role.id = :roleId";
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $_SESSION['email']);
		$s->bindValue(':roleId', $role);
		$s->execute();
	}
	catch (PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}	
	
	$row = $s->fetch();
	if ($row[0] > 0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}*/