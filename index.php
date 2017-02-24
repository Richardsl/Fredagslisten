
<?php 
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
//CONFIG
session_start();

//Version 0.2 alpha


$arr = array(
		'title' => 'Fredagslisten',
		'heading' => 'Fredagslisten',
		'activePage' => 'index',
		'id' => '',
		'error' => '',
		'metaRefresh' => '0',
		'loginError' => '',
		'redirect' => ''
	);

define('ROOTS', getcwd() . '/');
include ROOTS . 'includes/functions.inc.php';
include ROOTS . 'includes/access.inc.php';
include ROOTS . 'includes/magicquotes.inc.php';
include ROOTS . 'includes/inputvalidation.inc.php';

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit();
*/

//------------------------------------------
//-------------------Linka------------------


if ($page == 'update')
{
	
	if (!userIsLoggedIn())
	{
		$arr['title'] = 'login';
		$arr['heading'] = 'login';
		$arr['activePage'] = 'update';
		$arr['redirect'] = 'update';
		
		if(isset($loginError))
		{ $arr['loginError'] = $loginError; }
		
		render('login.html.php',$arr);
		exit();
	}
	$arr['title'] = 'Oppdater listen';
	$arr['heading'] = 'Oppdater listen';
	$arr['activePage'] = 'update';
	
	include ROOTS . 'includes/db.inc.php';
	
	//----------------------------shift 1-----------------------------------------------------------------------------

		//-------Finn alle positionane å navna til en spessifikk båt til shift1 ----------------
		
			try 
			{
				$sql = 'SELECT positionname, crew.name, crew.id 
						FROM crew 
						INNER JOIN boat ON boat.id = boatId 
						WHERE boatId = :boatId AND shift = 1 
						ORDER BY id ASC';

				$s = $pdo->prepare($sql);
				$s->bindValue(':boatId',  $_SESSION['boatId']);
					
				$s->execute();
				
			} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			$crewNameA = $s->fetchAll();
		/*
			echo '<pre>';
			print_r($crewNameA);
			echo '</pre>';			
			echo '</ br>';
			echo '</ br>';
		*/
			
		//-------------------------------------------------------------------------------------
			$elementcount = count($crewNameA) -1;
			for($i = 0; $i <= $elementcount; $i++){
			
				if(strlen($crewNameA[$i]['positionname']) > 17){
					$crewNameA[$i]['positionname'] = substr($crewNameA[$i]['positionname'], 0, 16) . '.';
				}
				if(strlen($crewNameA[$i]['name']) > 24){
					$crewNameA[$i]['name'] = substr($crewNameA[$i]['name'], 0, 23) . '.';
				}
			}
			
		/*
			echo '<pre>';
			print_r($crewNameA);
			echo '</pre>';
			exit();
		*/
			
			
		
		
		//--------------------------------------------------------------------------
		
    //--------------------------------------------------------------------------------------------------------------------
	
	//--------------------------------shift 2-------------------------------------------------------------------
	
		//-------Finn alle positionane å navna til en spessefikk båt til shift1 ----------------
		
			try 
			{
				$sql = 'SELECT positionname, crew.name, crew.id 
						FROM crew 
						INNER JOIN boat ON boat.id = boatId 
						WHERE boatId = :boatId AND shift = 2 
						ORDER BY id ASC';

				$s = $pdo->prepare($sql);
				$s->bindValue(':boatId',  $_SESSION['boatId']);
					
				$s->execute();
				
			} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			$crewNameB = $s->fetchAll();
		/*
			echo '<pre>';
			print_r($crewNameB);
			echo '</pre>';			
			exit();
		*/
		
		//-------------------------------------------------------------------------------------
			$elementcount = count($crewNameB) -1;
			for($i = 0; $i <= $elementcount; $i++){
			
				if(strlen($crewNameB[$i]['positionname']) > 17){
					$crewNameB[$i]['positionname'] = substr($crewNameB[$i]['positionname'], 0, 16) . '.';
				}
				if(strlen($crewNameB[$i]['name']) > 24){
					$crewNameB[$i]['name'] = substr($crewNameB[$i]['name'], 0, 23) . '.';
				}
			}
	
	
			
		/*
			echo '<pre>';
			print_r($posNameB);
			echo '</pre>';
			exit();
		*/
		
		//--------------------------------------------------------------------------
		
	
    //-----------------INFO----------------------------------------------------------------------------------------
	try 
	{
		$sql = 'SELECT 
				name,
				year,
				fromwhere,
				identifier,
				imo,
				mmsi,
				loa,
				bt,
				kw,
				fax,
				tlf1,
				tlf2,
				tlf3,
				tlf4,
				email1,
				image1,
				image2,
				changedate,
				rotation
				FROM boat
				WHERE id = :id'; 
		$s = $pdo->prepare($sql);
		$s->bindValue(':id',  $_SESSION['boatId']);
			
		$s->execute();
		
	} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
	
	$arr['info'] = $s->fetchAll();
	
	/*
			echo '<pre>';
			print_r($arr['info']);
			echo '</pre>';
			exit();
	*/
	//--------------------------------------------------------------------------------------------------------------
	
	try 
	{
		$sql = 'SELECT seacrew
				FROM boat 
				WHERE id = :boatId';
		$s = $pdo->prepare($sql);
		$s->bindValue(':boatId',  $_SESSION['boatId']);	
		$s->execute();
		
	} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}

	$s = $s->fetchAll();
	
	if($s[0][0] == 1){
		$arr['posNameA'] = $crewNameA;
		$arr['posNameB'] = $crewNameB;
		$arr['idA'] = '1';
		$arr['idB'] = '2';
	}
	else
	{
		$arr['posNameA'] = $crewNameB;
		$arr['posNameB'] = $crewNameA;
		$arr['idA'] = '2';
		$arr['idB'] = '1';
	}
	
	render('update.html.php',$arr);
	exit();
	
	
	
}

if ($page == 'login')
{
	if (!userIsLoggedIn())
	{
		$arr['title'] = 'login';
		$arr['heading'] = 'login';
		$arr['activePage'] = 'login';
		
		
		if(isset($loginError))
		{ $arr['loginError'] = $loginError; }
		
		render('login.html.php',$arr);
		exit();
	}
	header('location: .');
	exit();
}

if ($page == 'logout')
{
	if (userIsLoggedIn())
	{
		$arr['title'] = 'Logg ut';
		$arr['heading'] = 'Logg ut';
		$arr['activePage'] = 'logout';
		
		
		render('logout.html.php',$arr);
		exit();
	}
	header('location: .');
	exit();
}

if ($page == 'receivers')
{
	

	$arr['title'] = 'Mottakere av listen';
	$arr['heading'] = 'Mottakere av listen';
	$arr['activePage'] = 'receivers';

	include ROOTS . 'includes/db.inc.php';
	
	try
	{				
		$sql = 'SELECT receivers
				FROM boat
				WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id',  $_SESSION['boatId']);
			
		$s->execute();
	} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
	
	$receivers = $s->fetch();
	$arr['receivers'] = $receivers;
	
	
	echo '<pre>';
	print_r($receivers);
	echo '</pre>';
	exit();
	
	render('receivers.html.php',$arr); 
	
	exit();
	
/*
if ($page == 'listen')
{
	if (!userIsLoggedIn())
	{
		$arr['title'] = 'login';
		$arr['heading'] = 'login';
		$arr['activePage'] = 'listen';
		$arr['redirect'] = 'listen';
		
		if(isset($loginError))
		{ $arr['loginError'] = $loginError; }
		
		render('login.html.php',$arr);
		exit();
	}
	
	
	
	$arr['title'] = 'Fredagslisten';
	$arr['heading'] = 'Fredagslisten';
	$arr['activePage'] = 'list';
	
	
	
	//-------------finn alle crew som he navn innslått å lag en array ej kan bruke i templaten--------------------------------------------------
	
	include ROOTS . 'includes/db.inc.php';
	
		//----------------------------shift 1-----------------------------------------------------------------------------

			//----få alle navna å positionane på båten---
				try{
				
					$sql = 'SELECT positionname, crew.name 
							FROM crew 
							INNER JOIN boat ON boat.id = boatId 
							WHERE crew.boatId = :boatId AND shift = 1 
							ORDER BY crew.id ASC';

					$s = $pdo->prepare($sql);
					$s->bindValue(':boatId',  $_SESSION['boatId']);
						
					$s->execute();
					
				} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
				
				$crewNameA = $s->fetchAll();
		*/	
					
			//------------

			
		
			$posNameA = array();
			
			$counter = 0;
			$checkIfZero = 0;
			foreach($crewNameA as $row){
				
				if($row['name'] != ''){
					$posNameA[$counter]['name'] = $row['name'];
					$posNameA[$counter]['position'] = $row['positionname'];
					$checkIfZero = 1;
				}
				
				$counter++;
			}
			if($checkIfZero == 0){
				$arr['posNameA']['0']['name'] = 'gå til "Oppdater Listen"';
				$arr['posNameA']['0']['position'] = 'ingen navn innlagt  -';
			}
			else{
				$arr['posNameA'] = $posNameA;
			}
				/*
					echo '<pre>';
					print_r($arr['posNameA']);
					echo '</pre>';
					exit();
				*/
			
		//--------------------------------------------------------------------------------------------------------------------
		
		//------------------------------------------shift 2-------------------------------------------------------------------
			//----få alle navna å positionane på båten---
				try{
				
					$sql = 'SELECT positionname, crew.name 
							FROM crew 
							INNER JOIN boat ON boat.id = boatId 
							WHERE crew.boatId = :boatId AND shift = 2 
							ORDER BY crew.id ASC';

					$s = $pdo->prepare($sql);
					$s->bindValue(':boatId',  $_SESSION['boatId']);
						
					$s->execute();
					
				} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
				
				$crewNameB = $s->fetchAll();
				/*
					echo '<pre>';
					print_r($crewNameB);
					echo '</pre>';
					exit();
				*/
			//------------
			
			$posNameB = array(); // sett arrayen som skal brukast til å sette template arrayen arr
			$counter = 0; // kun til foreach loopen so ej kan bruke et tall som stige frå 0 å oppåver til arrayen
			$checkIfZero = 0; // om den blir satt til en betyr det at foreach loopen fann brukera
			
			foreach($crewNameB as $row){
				
				if($row['name'] != ''){
					$posNameB[$counter]['name'] = $row['name'];
					$posNameB[$counter]['position'] = $row['positionname'];
					$checkIfZero = 1;
				}
				
				$counter++;
			}
			if($checkIfZero == 0){
				$arr['posNameB']['0']['name'] = 'Gå til "Oppdater Listen"';
				$arr['posNameB']['0']['position'] = 'ingen navn innlagt  -';
			}
			else{
				$arr['posNameB'] = $posNameB;
			}
			/*
				echo '<pre>';
				print_r($arr['posNameB']);
				echo '</pre>';
				exit();
			*/	
		//------------------------------------------------------------------------------------------------------------------------------------
	
	render('list.html.php',$arr); 
	
	exit();
}

//----------------------------------------------
//---------------------Prossesser----------------


if ($action == 'register')
{

	if ($_POST['name'] != '' AND $POSTemail != '' AND $_POST['password'] != '' 
		AND $_POST['passwordAgain'] != '' AND $_POST['identifier'] != '')
	{	
		if ($_POST['password'] == $_POST['passwordAgain'])
		{
			include ROOTS . 'includes/db.inc.php';
			
			$password = md5($_POST['password'] . 'ijdb');
			$identifier = strtoupper($_POST['identifier']);
			//--------------------------------------------------------------------------------------
			try // INSERT boat med brukerdata
			{
				$sql = 'INSERT INTO boat SET
					name = :name,
					email1 = :email,
					password = :password,
					identifier = :identifier,							
					joindate = CURDATE()';
					
/*					fromwhere = :fromwhere,
					imo = :imo,
					mmsi = :mmsi,
					loa = :loa,
					bt = :bt,
					kw = :kw,
					tlf1 = :tlf1,
					tlf2 = :tlf2,
					tlf3 = :tlf3,
					tlf4 = :tlf4,	
*/
				$s = $pdo->prepare($sql);
				$s->bindValue(':name', $_POST['name']);
				$s->bindValue(':email', $POSTemail);
				$s->bindValue(':password', $password);
				$s->bindValue(':identifier', $identifier);
/*				$s->bindValue(':fromwhere', $_POST['fromwhere']);
				$s->bindValue(':imo', $_POST['imo']);
				$s->bindValue(':mmsi', $_POST['mmsi']);
				$s->bindValue(':loa', $_POST['loa']);
				$s->bindValue(':bt', $_POST['bt']);
				$s->bindValue(':kw', $_POST['kw']);
				$s->bindValue(':tlf1', $_POST['tlf1']);
				$s->bindValue(':tlf2', $_POST['tlf2']);
				$s->bindValue(':tlf3', $_POST['tlf3']);
				$s->bindValue(':tlf4', $_POST['tlf4']);
*/				
			
						
				$s->execute();
			} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
		
			

			//--------------------------------------------------------------------------------------
			try // få id'en til siste insette
			{
				$result = $pdo->query('SELECT id FROM boat ORDER BY id DESC LIMIT 1');
			} catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			$lastId = $result->fetchAll();
			$lastId = $lastId[0][0];
			/*
			echo $lastId;
			exit();
			*/
			try // alle positiona
			{
				$result = $pdo->query('SELECT position, sort, amount FROM position ORDER BY sort ASC');
			} catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
		
			$positions = $result->fetchAll();
			//-------------repeter positionane som he en amaount slik at man registrera feks ab monge gonga----
			
				$forCounter = 0;
				$repeatedPosition = array();
				
				foreach($positions as $row){ // for kvar position som eksistera men ikke 5gonga ab feks
				
					if($row['amount'] != 1){ // visst den ska repeterast
						
						$repeatedPosition[$forCounter]['position'] = $row['position']; // lag en ny array som ej kan bruke til å sette inn i gamle arrayen
						$repeatedPosition[$forCounter]['sort'] = $row['sort'];
						$repeatedPosition[$forCounter]['amount'] = $row['amount'];
						
						for($i = 2; $i <= $row['amount']; $i++){  //for kvar gong den ska repeterast so sett ny position inn i gamle
							
							array_splice($positions, $forCounter, 0, $repeatedPosition); //dinne injecta ny positionen mitt inni gamle arrayen uten å slette gamle
							$forCounter++ ;
						}//for	
						$repeatedPosition = array(); // empty array
					}//if
					
					$forCounter++ ;
				}//foreach
				
				/*
					echo '<pre>';
					print_r($positions);
					echo '</pre>';
					exit();
				*/
				
			//------------------------------------------------------------------------------------
			foreach($positions as $position){
				try 
				{
					$sql = 'INSERT INTO crew SET
						boatId = :boatId,
						shift = :shift,
						positionname = :positionname,
						age = :age,
						joindate = CURDATE()';					
				
					$s = $pdo->prepare($sql);
					$s->bindValue(':boatId', $lastId);
					$s->bindValue(':shift', '1');
					$s->bindValue(':age', '1');
					$s->bindValue(':positionname', $position['position']);
					$s->execute();
					$s->bindValue(':shift', '2');
					$s->execute();
					
				}catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			}
		
	
			//--------------------------------------------------------------------------------------

			$arr['heading'] = 'Suksess! Bruker Registrert';
			$arr['metaRefresh'] = '2';
			$arr['class'] = 'green';
			$arr['message'] = 'Suksess! Bruker Registrert';
			$arr['redirect'] = 'update';
			render('message.html.php',$arr);
			exit();

		}
		else // Dei to passorda matcha ikkje
		{
		loginpage('passord matcher ikke');			
		}
	}
	
	else //tome felt eller valideringsfeil
	{
	
		$arr['title'] = 'Logg inn';
		$arr['heading'] = 'Logg inn';
		$arr['activePage'] = 'login';
		$arr['error'] = 'Tomt felt';
		if($validateError != ''){ 
		$arr['error'] = $validateError;}
		
		
		render('login.html.php',$arr);
		exit();
	}
/*	
	$arr['heading'] = 'Suksess! Ny bruker registrert';
	$arr['metaRefresh'] = '2';
	$arr['class'] = 'green';
	$arr['message'] = 'Suksess! Ny bruker registrert';
	
	render('message.html.php',$arr);
	exit();
*/
}
//-----------------------------------------------
if ($action == 'update' )
{
	include ROOTS . 'includes/db.inc.php';
	
	
	//shift1
	$number = count($_POST['id1']) -1;
	
	for ($i = 0; $i <= $number; $i++) {
	
	
		
		try // 
		{
			$sql = 'SELECT COUNT(id) FROM crew WHERE id = :id AND boatId = :boatId'; //
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id1'][$i]);
			$s->bindValue(':boatId', $_SESSION['boatId']);
			$s->execute();
		}catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
		$result[] = $s->fetchAll();
		
		
		
		if($result[$i][0][0] > 0)
		{
			
		
			try // 
			{
				$sql = 'UPDATE crew
						SET 
						name = :name,
						positionname = :positionname
						WHERE id = :id';
				$s = $pdo->prepare($sql);
				
				$s->bindValue(':id', $_POST['id1'][$i]);
				$s->bindValue(':name', $_POST['name1'][$i]);
				$s->bindValue(':positionname', $_POST['positionname1'][$i]);
				$s->execute();
			}catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}			
		}
	}//for
	
	
	//----------------------------------------------------------
		//shift2
	$number = count($_POST['id2']) -1;
	
	for ($i = 0; $i <= $number; $i++) {		
		
		
		try // 
		{
			$sql = 'SELECT COUNT(id) FROM crew WHERE id = :id AND boatId = :boatId';    
			$s = $pdo->prepare($sql);
			$s->bindValue(':id', $_POST['id2'][$i]);
			$s->bindValue(':boatId', $_SESSION['boatId']);
			$s->execute();
		}catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
		$result[] = $s->fetchAll();
		
		if($result[$i][0][0] > 0)
		{
			
			try // 
			{
				$sql = 'UPDATE crew
						SET name = :name,
						positionname = :positionname
						WHERE id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $_POST['id2'][$i]);
				$s->bindValue(':name', $_POST['name2'][$i]);
				$s->bindValue(':positionname', $_POST['positionname2'][$i]);
				$s->execute();
			}catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}			
		}
	}//FOR
	
	//---------Bilde----------------------------------------------------------------------
	
	if(isset($_FILES["file"])){
	
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 4096000)
		&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				$arr['error'] = "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				$imageoriginal = strtoupper($_FILES["file"]["name"]);
				$image = md5($_SESSION['boatId'] . $imageoriginal . 'ijdb') . '.' . $extension;
				$imagesmall = 'small' . $image;
				
				if (!file_exists("images/" . $image))
				{
					move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $image);
					resize_image('max','images/' . $image, 'images/small/' . $imagesmall, 245, 200);
					try // 
					{
						$sql = 'UPDATE boat
								SET
								image1 = :image1,
								image2 = :image2
								WHERE id = :id';
						
						$s = $pdo->prepare($sql);
						$s->bindValue(':id', $_SESSION['boatId']);
						$s->bindValue(':image1', $image);
						$s->bindValue(':image2', $imagesmall); 

						$s->execute();
					}catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}					
				}
			}
		}
		else
		{
			$arr['error'] = 'Feil fil';
		}
	}	
	//-----------------------------------------------------------------------------------
	
	// SETT INN RESTEN AV DATAEN PÅ MANNSKAPSSIDA!
	
	try // 
	{
		$sql = 'UPDATE boat
				SET name = :name,
				year = :year,
				fromwhere = :fromwhere,
				identifier = :identifier,
				imo = :imo,
				mmsi = :mmsi,
				loa = :loa,
				bt = :bt,
				kw = :kw,
				fax = :fax,
				tlf1 = :tlf1,
				tlf2 = :tlf2,
				tlf3 = :tlf3,
				tlf4 = :tlf4,
				email1 = :email1,
				changedate = :changedate,
				rotation = :rotation
				WHERE id = :id';
		
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_SESSION['boatId']);
		$s->bindValue(':name', $_POST['boatname']);
		$s->bindValue(':year', $_POST['year']);
		$s->bindValue(':fromwhere', $_POST['fromwhere']);
		$s->bindValue(':identifier', $_POST['identifier']);
		$s->bindValue(':imo', $_POST['imo']);
		$s->bindValue(':mmsi', $_POST['mmsi']);
		$s->bindValue(':loa', $_POST['loa']);
		$s->bindValue(':bt', $_POST['bt']);
		$s->bindValue(':kw', $_POST['kw']);
		$s->bindValue(':fax', $_POST['fax']);
		$s->bindValue(':tlf1', $_POST['tlf1']);
		$s->bindValue(':tlf2', $_POST['tlf2']);
		$s->bindValue(':tlf3', $_POST['tlf3']);
		$s->bindValue(':tlf4', $_POST['tlf4']);
		$s->bindValue(':email1', $_POST['email1']);
		$s->bindValue(':changedate', $_POST['changedate']);
		$s->bindValue(':rotation', $_POST['rotation']);
		
		$s->execute();
	}catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}		
	

	
	
	
	
	
	$arr['heading'] = 'Suksess! Båt oppdatert';
	$arr['metaRefresh'] = '2';
	$arr['class'] = 'green';
	$arr['message'] = $arr['heading'];
	$arr['redirect'] = 'page=update';
	render('message.html.php',$arr);
	exit();

		
}

	/*
	if ($action == 'fiveextra1' ) //mannskapsiden
	{
		include ROOTS . 'includes/db.inc.php';

			try 
			{
				$sql = 'INSERT INTO crew SET
					boatId = :boatId,
					shift = :shift,
					positionname = :positionname,
					joindate = CURDATE()';					
			
				$s = $pdo->prepare($sql);
				$s->bindValue(':boatId', $_SESSION['boatId']);
				$s->bindValue(':shift', '1');
				$s->bindValue(':positionname', 'Extra');
				
				for($i = 0; $i <= 4; $i++){
					$s->execute();				
				}	
			}
			catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			header('location: ./?page=mannskap#fiveextra1');
			exit();
			
	}

	if ($action == 'fiveextra2' ) //mannskapsiden
	{
		include ROOTS . 'includes/db.inc.php';

			try 
			{
				$sql = 'INSERT INTO crew SET
					boatId = :boatId,
					shift = :shift,
					positionname = :positionname,
					joindate = CURDATE()';					
			
				$s = $pdo->prepare($sql);
				$s->bindValue(':boatId', $_SESSION['boatId']);
				$s->bindValue(':shift', '2');
				$s->bindValue(':positionname', 'Extra');
				
				for($i = 0; $i <= 4; $i++){
					$s->execute();				
				}	
			}
			catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			header('location: ./?page=mannskap#fiveextra2');
			exit();
	}

	if ($action == 'fiveless1' ) //mannskapsiden
	{
		include ROOTS . 'includes/db.inc.php';

		try 
			{
				$sql = 'SELECT COUNT(id) 
						FROM crew 
						WHERE boatId = :boatId
						AND shift = :shift';					
			
				$s = $pdo->prepare($sql);
				$s->bindValue(':boatId', $_SESSION['boatId']);
				$s->bindValue(':shift', '1');
				$s->execute();						
			}
			catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			$result = $s->fetchAll();
			
			
			if($result[0][0] <= 31) // kan ikke slette flere enn de han har lagt på
			{
				header('location: ./?page=mannskap#fiveless1');
				exit();
			}
			else
			{
				try 
				{
					$sql = 'SELECT id
						FROM crew 
						WHERE boatId = :boatId
						AND shift = :shift
						ORDER BY id desc
						LIMIT 5';					
				
					$s = $pdo->prepare($sql);
					$s->bindValue(':boatId', $_SESSION['boatId']);
					$s->bindValue(':shift', '1');
					$s->execute();
								
						
				}
				catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
				
				$result = $s->fetchAll();
						
				
				//	echo '<pre>';
				//	print_r($result);
				//	echo '</pre>';
				//	exit();
				
			
				foreach($result as $row){
				
					try 
					{
						$sql = 'DELETE FROM crew 
							WHERE boatId = :boatId
							AND shift = :shift
							AND id = :id';					
					
						$s = $pdo->prepare($sql);
						$s->bindValue(':boatId', $_SESSION['boatId']);
						$s->bindValue(':shift', '1');
						$s->bindValue(':id', $row['id']);
						$s->execute();	
					}
					catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
				}
					
				header('location: ./?page=mannskap#fiveless1');
				exit();
				
			}
	}

	if ($action == 'fiveless2' ) //mannskapsiden
	{
		include ROOTS . 'includes/db.inc.php';

		try 
			{
				$sql = 'SELECT COUNT(id) 
						FROM crew 
						WHERE boatId = :boatId
						AND shift = :shift';					
			
				$s = $pdo->prepare($sql);
				$s->bindValue(':boatId', $_SESSION['boatId']);
				$s->bindValue(':shift', '2');
				$s->execute();						
			}
			catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
			$result = $s->fetchAll();
			
			
			if($result[0][0] <= 31) // kan ikke slette flere enn de han har lagt på
			{
				header('location: ./?page=mannskap#fiveless2');
				exit();
			}
			else
			{
				try 
				{
					$sql = 'SELECT id
						FROM crew 
						WHERE boatId = :boatId
						AND shift = :shift
						ORDER BY id desc
						LIMIT 5';					
				
					$s = $pdo->prepare($sql);
					$s->bindValue(':boatId', $_SESSION['boatId']);
					$s->bindValue(':shift', '2');
					$s->execute();
								
						
				}
				catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
				
				$result = $s->fetchAll();
						
				
				//	echo '<pre>';
				//	print_r($result);
				//	echo '</pre>';
				//	exit();
				
			
				foreach($result as $row){
				
					try 
					{
						$sql = 'DELETE FROM crew 
							WHERE boatId = :boatId
							AND shift = :shift
							AND id = :id';					
					
						$s = $pdo->prepare($sql);
						$s->bindValue(':boatId', $_SESSION['boatId']);
						$s->bindValue(':shift', '2');
						$s->bindValue(':id', $row['id']);
						$s->execute();	
					}
					catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
				}
					
				header('location: ./?page=mannskap#fiveless2');
				exit();
				
			}
	}
	*/
if ($action == 'removepic' ) //mannskapsiden
{
	include ROOTS . 'includes/db.inc.php';
		
	try 
	{
		$sql = 'SELECT 
				image1,
				image2
				FROM boat 
				WHERE id = :boatId';					
	
		$s = $pdo->prepare($sql);
		$s->bindValue(':boatId', $_SESSION['boatId']);
		$s->execute();						
	}
	catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
	
	$result = $s->fetchAll();
		
		/*
		echo '<pre>';
		print_r($result);
		echo '</pre>';
		exit();
		*/	
				
	unlink('images/' . $result[0][0]);
	unlink('images/small/' . $result[0][1]);
		
		
	try 
	{
		$sql = 'UPDATE boat 
			SET 
			image1 = :image1,
			image2 = :image2
			WHERE id = :id';					
	
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_SESSION['boatId']);
		$s->bindValue(':image1', '');
		$s->bindValue(':image2', '');
		$s->execute();	
	}
	catch(PDOException $e){ catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
	
	
	header('location: ./?page=update');
	exit();
			
		
}

if ($action == 'receivers')
{

	include ROOTS . 'includes/db.inc.php';
	

	try // INSERT boat med brukerdata
	{
		$sql = 'UPDATE boat 
			SET receivers = :receivers
			WHERE id = :id';
						
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_SESSION['boatId']);
		$s->bindValue(':receivers', $_POST['textarea']);
				
		$s->execute();
	} catch(PDOException $e){catchE( 'FEIL' . __LINE__ , $e->getMessage()); exit();}
			
}


if ($action == 'login')
{
	if (!userIsLoggedIn())
	{	
		$arr['title'] = 'login';
		$arr['heading'] = 'login';
		$arr['activePage'] = 'login';
		
		if(isset($loginError))
		{ $arr['loginError'] = $loginError; }
		
		render('login.html.php',$arr);
		exit();
	}		
	
	header('location: .');
	exit();
}

if ($action == 'logout')
{
	
	unset($_SESSION['loggedIn']);
	unset($_SESSION['email']);
	unset($_SESSION['password']);
		
	$arr['heading'] = 'Suksess! Logget ut';
	$arr['metaRefresh'] = '2';
	$arr['class'] = 'green';
	$arr['message'] = 'Suksess! Logget ut';
	
	render('message.html.php',$arr);
	exit();
}



//-------------------------------------------------
//---------------Hjemmeside------------------------


$arr['title'] = 'Fredagslisten.no';
$arr['heading'] = 'Fredagslisten.no';
$arr['activePage'] = 'index';

render('homepage.html.php',$arr);
ob_flush();
exit();
