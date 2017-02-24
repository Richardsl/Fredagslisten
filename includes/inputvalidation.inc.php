<?php
/*CONFIG

INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, or INPUT_ENV.
 
filter_input();
 
 FILTER_VALIDATE_BOOLEAN 	"boolean" 	  	FILTER_NULL_ON_FAILURE 	 Returns TRUE for "1", "true", "on" and "yes". Returns FALSE otherwise.

If FILTER_NULL_ON_FAILURE is set, FALSE is returned only for "0", "false", "off", "no", and "", and NULL is returned for all non-boolean values.
FILTER_VALIDATE_EMAIL 	"validate_email" 	  	  	Validates value as e-mail.
FILTER_VALIDATE_FLOAT 	"float" 					Validates value as float.     decimal 	FILTER_FLAG_ALLOW_THOUSAND 	
FILTER_VALIDATE_INT 	"int" 						Validates value as integer, optionally from the specified range.     	min_range, max_range 	FILTER_FLAG_ALLOW_OCTAL, FILTER_FLAG_ALLOW_HEX 
FILTER_VALIDATE_IP 	"validate_ip" 	  				Validates value as IP address, optionally only IPv4 or IPv6 or not from private or reserved ranges.             FILTER_FLAG_IPV4, FILTER_FLAG_IPV6, FILTER_FLAG_NO_PRIV_RANGE, FILTER_FLAG_NO_RES_RANGE 	
FILTER_VALIDATE_REGEXP 	"validate_regexp" 	        Validates value against regexp, a Perl-compatible regular expression.        	regexp 	  
FILTER_VALIDATE_URL 	"validate_url" 	  			Validates value as URL 	FILTER_FLAG_PATH_REQUIRED, FILTER_FLAG_QUERY_REQUIRED 
 
echo $_GET['page'] . '</br>';

*/
//------------------------------------------
//----INPUT VALIDATION----------------------


$validateError = '';

// -----------------------PAGE VARABLANE TIL GET SIDENE---------------------
$page = '';
if (isset($_GET['page']) AND preg_match('/\w/', $_GET['page'])){
    $page = $_GET['page'];
}
//--------------------------------------------------------------------------

// -----------------------PAGE VARABLANE TIL POST actionane---------------------
$action = '';
if (isset($_POST['action']) AND preg_match('/\w/', $_POST['action'])){
    $action = $_POST['action'];
}
//--------------------------------------------------------------------------
/*
$_POST['name']

$_POST['password']
*/

//--------------REGISTRER SIDEN--------------------------------------------------
$POSTemail = ''; 
if(isset($_POST['email']) AND filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
{
	$POSTemail = $_POST['email'];
}else{ $validateError .= 'Email not valid!';}

//--------------------------------------------------------------
$inputval_pdf = 0;
if (isset($_POST['pdf']) AND $_POST['pdf'] == TRUE){
    $inputval_pdf = 1;
}


















