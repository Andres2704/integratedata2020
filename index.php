<?php require('Connection/hackaton.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  $isValid = False; 
  if (!empty($UserName)) { 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}


	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "cadastro_id")) {
		if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) 
		{ 
		
		$login = $_POST['strKey'];
		
		//Cadastro do id do usuário
		$query = "INSERT INTO tblusuarios(strKey) VALUES ('".$login."')";
		mysqli_query($link, $query);
		
		$sql = mysqli_query($link, "SELECT idUsuario FROM tblusuarios WHERE strKey='".$login."'");
			
			if($sql === FALSE) { 
			   die(mysqli_error($link));
			}
			$row = mysqli_fetch_assoc($sql);
		
		
		$insertGoTo = "load.php?id=".$row['idUsuario']."&key=".$login."&ck=1";
		if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $insertGoTo));
		}else{
			header("Location: home.php");
			die();	
		}
	
	
	}

?>


<!doctype html>
<html lang="pt"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome to IntegrateData</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-bottom/">
    <link href="https://fonts.googleapis.com/css2?family=Mogra&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rasa:wght@500&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
 <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer/">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">

        <!-- Core theme CSS (includes Bootstrap)-->
    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
	  @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
      .bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			background-image:url(background.jpg);
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          	font-size: 3.5rem;
		  	background-image:url(background.jpg);
        }
      	}
	  	html body {
		 	background: url('images/background.jpg') no-repeat center fixed;     
    		background-size: cover;
			
		
		}
		.titulo{
		 	font-family: 'Mogra', cursive;
			font-style: normal;
			font-weight: normal;
			font-size: 55px;
			line-height: 71px;
			text-align: center;
			color:#05071A;
		 }
		.slogan{
			font-family: 'Overpass', sans-serif;
			font-style: normal;
			font-weight: normal;
			font-size: 22px;
			line-height: 26px;
			text-align: center;
			color: #05071A;
			width:100%;
		}
		.boxi{
			background-color: rgba(196, 196, 196, 0.8);
			border-radius: 22px;
			height: 709px;
			left: 598px;
			top: 60px;
		}
		.botao{
			font-family: 'Overpass', sans-serif;
			background: #05071A;
			border-radius: 132px;
			border-color: #05071A;
			width: 308px;
			height: 114px;
			font-style: normal;
			font-weight: normal;
			font-size: 36px;
		}
		.popup{
			border-color:#57606F;
		}
		.container2{
		  width: auto;
		  max-width: 680px;
		  padding: 0 15px;
		}
    </style>
  </head>
 <body id="page-top">
  
<!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO-->
<div class="modal fade" id="oprojeto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content popup">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">About the project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:justify;">
        The Project IntegrateData aims to integrate socioeconomic and spatial data in order to comprehend how the COVID-19 affects these relations. We utilize open data made available by space agencies and socioeconomic institutions.<br>
By doing this, we want to facilitate the access to information for various purposes, such as research and knowledge.
<br><br>
        
        <p align="center" style="font-weight:bold; font-size:24px; font-style:italic;">Who we are</p><br>
        Our team is formed by five members who want to simplify the access to scientific data:<br>
        <li style="text-align:center;">Andres Machado da Silva Benoit <br>  <span style=" font-weight:500;">andres.benoit7@gmail.com</span></li>
        <li style="text-align:center;">Bruno Leonardo Schuster <br> <span style=" font-weight:500;">brunoleonardoschuster@hotmail.com</span></li>
        <li style="text-align:center;">Gabrieli Silveira Pavlack <br>  <span style=" font-weight:500;"> gabrielipavlack@hotmail.com</span></li>
        <li style="text-align:center;">Izabeli Ferrari Libraga <br>  <span style=" font-weight:500;"> izzabelilibraga@gmail.com</span></li>
        <li style="text-align:center;">Luca Sauer de Araujo <br>   <span style=" font-weight:500;">lucasauerr@gmail.com</span></li>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO--><!--POP-UP PARA O PROJETO-->
<!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   -->
<div class="modal fade" id="creditos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content popup">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Credits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Until the present moment, the data in the platform were made available by:
      </div>
        <p  align="center"><img src="creditos/2.png" width="200" height="66"></p>
        <p  align="center"><img src="creditos/3.png" width="200" height="146"></p>
		<p  align="center"><img src="creditos/4.png" width="86" height="70"></p>
    <p  align="center"><img src="creditos/1.png" width="180" height="90"></p>
        
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   -->
<!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     -->
<div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content popup">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><span><i class="fas fa-satellite"></i> Click on <span style="color:#06C">Start</span> to combine the socioeconomic subject with a subject monitored through spatial data.</span><br>
       <span><i class="fas fa-satellite"></i> Click on <span style="color:#06C">Combine data</span> to verify the information about each subject and to know if they are related to each other and to the impacts of COVID-19.</span>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     --><!--    POP-UP AJUDA     -->
<nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style=" background-color:#05071A; padding:23.5px;" >
            <div class="container">
              <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold text-white rounded" style=" background-color:#05071A;"  type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#oprojeto" href="#" style="color:#FFF; text-decoration:none;">The project</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#creditos" href="#" style="color:#FFF; text-decoration:none;">Credits</a></li>
                        <li class="nav-item mx-0 mx-lg-1">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" style="text-decoration:none; color:#FFF;" aria-expanded="false">Language</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <a class="dropdown-item" href="pt/">Portugu&ecirc;s <img src="images/brazil.png" width="20" height="20"></a>
                              <a class="dropdown-item" href="#">English <img src="images/usa.png" width="20" height="20"></a>
                            </div>
                          </li></li>
                    </ul>
                </div>
  </div>
  </nav>
 
<div class="container" style=" padding-top:120px; width: 665px;">
  <div class="jumbotron mt-3 boxi">
    <p align="center"><img src="images/logo.png" width="578" height="105"></p>
    <br>
    <p class="slogan" style="padding-bottom: 10px; width:540px; padding-left:35px;">Find out how socioeconomic and spatial data are related to each other and to the impacts of COVID-19.</p>
    <p align="right">
    <br>
    <form name="cadastro_id" action="<?php echo $editFormAction; ?>" method="POST">
    <?php 
		$a = microtime(true);
		$sup = $a;
		$sup = base64_encode($sup);
	?>
    	<input type="hidden" name="strKey" value="<?php echo $sup ?>">
 
    	<p align="center"><input type="submit" class="btn btn-lg btn-primary botao" value="Start"></p>
        <br>
        <p align="center"><input type="button" class="btn btn-lg btn-primary botao" value="Help" data-toggle="modal" data-target="#ajuda"></p>
        <input type="hidden" name="MM_insert" value="cadastro_id" >
        
    </form>
    </p>
  </div>
</div>
<!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white" style="background-color:#05071A;">
            <div class="container"><small>IntegrateData - Copyright © all rights reserved </small></div>
        </div>
        
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/assets/dist/js/bootstrap.bundle.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script src="assets/mail/contact_me.js"></script>
<script src="js/scripts.js"></script>
      </body>
</html>
