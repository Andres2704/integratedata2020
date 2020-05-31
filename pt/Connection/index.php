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
    <title>Bem vindo ao IntegrateData</title>

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
        <h5 class="modal-title" id="exampleModalLongTitle">Sobre o projeto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:justify;">
        O projeto IntegrateData  tem o objetivo de integrar dados socioeconômicos e dados espaciais a fim de compreender como o COVID-19 afeta essas relações.  Utilizamos dados abertos disponibilizados por agências espaciais e instituições socioeconômicas.Com isso, queremos facilitar o acesso à informação para diversos fins, como pesquisa e conhecimento.<br><br>
        
        <p align="center" style="font-weight:bold; font-size:24px;">Quem somos</p><br>
        Nossa equipe é formada por cinco integrantes que buscam descomplicar o acesso a dados científicos:<br>
        <li style="text-align:center;">Andres Machado da Silva Benoit <br>  <span style=" font-weight:500;">andres.benoit7@gmail.com</span></li>
        <li style="text-align:center;">Bruno Leonardo Schuster <br> <span style=" font-weight:500;">brunoleonardoschuster@hotmail.com</span></li>
        <li style="text-align:center;">Gabrieli Silveira Pavlack <br>  <span style=" font-weight:500;"> gabrielipavlack@hotmail.com</span></li>
        <li style="text-align:center;">Izabeli Ferrari Libraga <br>  <span style=" font-weight:500;"> izzabelilibraga@gmail.com</span></li>
        <li style="text-align:center;">Luca Sauer de Araujo <br>   <span style=" font-weight:500;">lucasauerr@gmail.com</span></li>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Créditos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Ajuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><span><i class="fas fa-satellite"></i> Clique em <span style="color:#06C">Começar</span> para combinar um assunto socioeconômico com um assunto monitorado através de dados espaciais. </span><br>
       <span><i class="fas fa-satellite"></i> Clique em  <span style="color:#06C">Relacionar Dados</span> para verificar informações sobre cada e se os assuntos estão relacionados entre si e ao impacto do COVID-19.</span>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#oprojeto" href="#" style="color:#FFF; text-decoration:none;">O projeto</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#creditos" href="#" style="color:#FFF; text-decoration:none;">Créditos</a></li>
                        <li class="nav-item mx-0 mx-lg-1">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" style="text-decoration:none; color:#FFF;" aria-expanded="false">Idioma</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <a class="dropdown-item" href="#">Português <img src="images/brazil.png" width="20" height="20"></a>
                              <a class="dropdown-item" href="en/">English <img src="images/usa.png" width="20" height="20"></a>
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
    <p class="slogan" style="padding-bottom: 10px; width:540px; padding-left:35px;">Descubra como dados socioeconômicos e espaciais estão relacionados entre si e com os impactos do COVID-19</p>
    <p align="right">
    <br>
    <form name="cadastro_id" action="<?php echo $editFormAction; ?>" method="POST">
    <?php 
		$a = microtime(true);
		$sup = $a;
		$sup = base64_encode($sup);
	?>
    	<input type="hidden" name="strKey" value="<?php echo $sup ?>">
 
    	<p align="center"><input type="submit" class="btn btn-lg btn-primary botao" value="Começar"></p>
        <br>
        <p align="center"><input type="button" class="btn btn-lg btn-primary botao" value="Ajuda" data-toggle="modal" data-target="#ajuda"></p>
        <input type="hidden" name="MM_insert" value="cadastro_id" >
        
    </form>
    </p>
  </div>
</div>
<!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white" style="background-color:#05071A;">
            <div class="container"><small>IntegrateData - Copyright © Todos os direitos reservados 2020</small></div>
        </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/assets/dist/js/bootstrap.bundle.js"></script></body>
</html>
