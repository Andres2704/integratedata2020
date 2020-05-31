<?php require_once('Connection/hackaton.php'); ?>
<?php 
$id = $_GET['id'];
$loginUsername = $_GET['key'];
$MM_fldUserAuthorization = "";
$MM_redirectLoginSuccess = "home.php";
$MM_redirectLoginFailed = "index.php?error";
$MM_redirecttoReferrer = false;

$LoginRS = mysqli_query($link, "SELECT idUsuario FROM tblusuarios WHERE idUsuario=".$id."");

if($LoginRS === FALSE) { 
  die(mysqli_error($link));
}

$row_LoginRS = mysqli_fetch_assoc($LoginRS);
$loginFoundUser = mysqli_num_rows($LoginRS);
$user = mysqli_fetch_array($LoginRS);
if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	 
	$_SESSION['MM_idUsuario'] = $row_LoginRS["idUsuario"]; 
	    
	if($user) {		
			if(!empty($_POST["ck"])) {
				setcookie ("MM_idUsuario",$id,time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["MM_Username"])) {
					setcookie ("MM_idUsuario","");
				}
			}
	} else {
		$message = "Invalid Login";
	}
	
	
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
?>
