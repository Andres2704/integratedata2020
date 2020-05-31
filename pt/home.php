<?php require_once('Connection/hackaton.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) 
{   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

$resposta_usuario = mysqli_query($link, "SELECT * FROM tblresposta WHERE idUsuario=".$_SESSION['MM_idUsuario']."");
if($resposta_usuario === FALSE) { 
  die(mysqli_error($link));
}
$row_resposta_usuario = mysqli_fetch_assoc($resposta_usuario);
$num_resposta_usuario = mysqli_num_rows($resposta_usuario);

$idPergunta = $num_resposta_usuario+1;

$perguntas = mysqli_query($link, "SELECT * FROM tblperguntas");
if($perguntas === FALSE) { 
  die(mysqli_error($link));
}
$row_perguntas = mysqli_fetch_assoc($perguntas);
$num_perguntas = mysqli_num_rows($perguntas);


$peso_pergunta = mysqli_query($link, "SELECT * FROM tblperguntas WHERE idPergunta=".$idPergunta."");
if($peso_pergunta === FALSE) { 
  die(mysqli_error($link));
}
$row_peso_pergunta = mysqli_fetch_assoc($peso_pergunta);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "atualizapergunta")) {
		$query = "INSERT INTO tblresposta(idUsuario, idPergunta, intResposta) VALUES ('".$_SESSION['MM_idUsuario']."', '".$idPergunta."','".GetSQLValueString($_POST['intResposta'], "int")."')";
		mysqli_query($link, $query);
		
	

  $insertGoTo = "home.php?i1=".$_POST['intResposta']."";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));

}
?>
<?php if(isset($_GET['i1'])){ 

$pt1 = $_GET['i1'];

 } ?>
<!doctype html>
<html lang="pt">
 <head>
     <meta http-equiv= "Content-Type" content= "text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>IntegrateData</title>

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <style>
	@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	  html body {
		 	background: url('images/background.jpg') no-repeat center fixed;     
    		background-size: cover;
		
		}
	.titulo{
		 	font-family: 'PT Sans', sans-serif;
			font-style: normal;
			font-weight: normal;
			font-size: 55px;
			line-height: 71px;
			text-align: center;
			color:#05071A;
		 }
		.boxi{
			background-color: rgba(196, 196, 196, 0.8);
			border-radius: 22px;
			height: 714px;
			left: 598px;
			top: 60px;

		}
		.botao{
			background: #05071A;
			border-radius: 5px;
			border-color: #05071A;
			width: 154px;
			height: 57px;
			font-family: 'Overpass', sans-serif;
			font-style: normal;
			font-weight: normal;
			font-size: 24px;
			line-height: 37px;
			text-align: center;
		}
		.botao1{
			background: #05071A;
			border-radius: 5px;
			border-color: #05071A;
			width: 220px;
			height: 57px;
			font-family: 'Overpass', sans-serif;
			font-style: normal;
			font-weight: normal;
			font-size: 24px;
			line-height: 37px;
			text-align: center;
		}
		.popup{
			border-color:#57606F;
		}
    </style>
  </head>
<body>
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
        O projeto IntegrateData  tem o objetivo de integrar dados socioeconômicos e dados espaciais a fim de compreender como o COVID-19 afeta essas relações.  Utilizamos dados abertos disponibilizados por agências espaciais e instituições socioeconômicas. Com isso, queremos facilitar o acesso à informação para diversos fins, como pesquisa e conhecimento.
<br><br>
        
        <p align="center" style="font-weight:bold; font-size:24px;">Quem somos</p><br>
       Nossa equipe é formada por seis integrantes que buscam descomplicar o acesso a dados científicos:<br>
        <li style="text-align:center;">Andres Machado da Silva Benoit <br>  <span style=" font-weight:500;">andres.benoit7@gmail.com</span></li>
        <li style="text-align:center;">Bruno Leonardo Schuster <br> <span style=" font-weight:500;">brunoleonardoschuster@hotmail.com</span></li>
        <li style="text-align:center;">Gabrieli Silveira Pavlack <br>  <span style=" font-weight:500;"> gabrielipavlack@hotmail.com</span></li>
        <li style="text-align:center;">Izabeli Ferrari Libraga <br>  <span style=" font-weight:500;"> izzabelilibraga@gmail.com</span></li>
        <li style="text-align:center;">Luca Sauer de Araujo <br>   <span style=" font-weight:500;">lucasauerr@gmail.com</span></li>

      </div>
      <div class="modal-footer"><
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
        Até o momento, os dados presentes nesta plataforma estão disponíveis em:
      </div>
       <p  align="center"><img src="../creditos/2.png" width="200" height="66"></p>
        <p  align="center"><img src="../creditos/3.png" width="200" height="146"></p>
        <p  align="center"><img src="../creditos/4.png" width="86" height="70"></p>
        <p  align="center"><img src="../creditos/1.png" width="180" height="90"></p>
        
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   --><!--   POP-UP CREDITOS   -->
<nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style=" background-color:#05071A">
  <div class="container">
  <a href="index.php"><img src="images/logo2.png" width="294" height="55"></a>
  <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
      	 <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php" style="color:#FFF; text-decoration:none;">Inicio</a></li>
         <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#oprojeto" href="#" style="color:#FFF; text-decoration:none;">O projeto</a></li>
         <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#creditos" href="#" style="color:#FFF; text-decoration:none;">Créditos</a></li>
         <li class="nav-item mx-0 mx-lg-1">
         <li class="nav-item dropdown"><a class="dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" style="text-decoration:none; color:#FFF;" aria-expanded="false">Idioma</a>
             <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Português <img src="images/brazil.png" width="20" height="20"></a>
                <a class="dropdown-item" href="../">English <img src="images/usa.png" width="20" height="20"></a>
             </div>
             </li>
             </li>
       </ul>
   </div>
</div>
</nav>

<div class="container" style="padding-top:140px; width: 665px;">
  <div class="jumbotron mt-3" style="left: 521px;background-color: rgba(196, 196, 196, 0.8);border-radius: 22px;">
        <?php   
      
      $i = 0;
      while ($i == 0) {
        if ($idPergunta > 2){
          header("Location: datas.php");
          die();  
        }
        else{
        $sql = mysqli_query($link, "SELECT * FROM tblperguntas WHERE idPergunta=".$idPergunta."");
        if($sql === FALSE) { 
          die(mysqli_error($link));
        }
        $row_perguntas = mysqli_fetch_assoc($sql);
      ?>
            <?php if ($idPergunta==2){ ?>
              <form method="post" action="datas.php?pt1=<?php echo $pt1;?>">
            <?php } else{
        ?>
            <form method="post" action="<?php echo $editFormAction; ?>">
            <?php }?>
            <h3><p><?php echo $row_perguntas['strPergunta'] ?></p></h3>
            <div class="p-3 mb-2 text-white"  style=" background-color:#05071A; font-size:18px;">
                <div class="custom-control custom-radio">
                   <input type="radio" id="opA" name="intResposta" class="custom-control-input" value="<?php echo $row_perguntas['intPesoA']; ?>" required>
                   <label class="custom-control-label"  for="opA"><?php echo $row_perguntas['strA']; ?></label>
                </div>
            </div>
            <br>
            <div class="p-3 mb-2 text-white"  style=" background-color:#05071A; font-size:18px;">
                <div class="custom-control custom-radio">
                   <input type="radio" id="opB" name="intResposta"class="custom-control-input"  value="<?php echo $row_perguntas['intPesoB']; ?>" required>
                   <label class="custom-control-label" for="opB"><?php echo $row_perguntas['strB'] ?></label>
                </div>
            </div>
            <br>
            <div class="p-3 mb-2 text-white"  style=" background-color:#05071A; font-size:18px;">
                <div class="custom-control custom-radio">
                   <input type="radio" id="opC" name="intResposta" class="custom-control-input" value="<?php echo $row_perguntas['intPesoC']; ?>" required>
                   <label class="custom-control-label" for="opC"><?php echo $row_perguntas['strC'] ?></label>
                </div>
            </div>
            <br>
            <div class="p-3 mb-2 text-white"  style=" background-color:#05071A; font-size:18px;">
                <div class="custom-control custom-radio">
                   <input type="radio" id="opD" name="intResposta" class="custom-control-input" value="<?php echo $row_perguntas['intPesoD']; ?>" required>
                   <label class="custom-control-label" for="opD"><?php echo $row_perguntas['strD'] ?></label>
                </div>
            </div>
            <br>
            <div class="p-3 mb-2 text-white"  style=" background-color:#05071A; font-size:18px;">
                <div class="custom-control custom-radio">
                   <input type="radio" id="opE" name="intResposta" class="custom-control-input" value="<?php echo $row_perguntas['intPesoE']; ?>" required>
                   <label class="custom-control-label" for="opE"><?php echo $row_perguntas['strE'] ?></label>
                </div>
            </div>
            <br>
            <input type="hidden" name="MM_insert" value="atualizapergunta">
            <?php if ($idPergunta==2){ ?>
              <input type="hidden" name="pt1" value="<?php echo $pt1; ?>">
            <?php } ?>
           <table width="100%" border="0">
                  <tr>
                    <td align="left">
                     <?php if ($num_resposta_usuario!=0){ ?>
                      <input type="button" class="btn btn-lg btn-primary botao" value="Voltar " onClick="window.location.href='voltar.php'"></td>
                     <?php } ?>
                     <?php if ($num_resposta_usuario==0){ ?>
                      <input type="button" class="btn btn-lg btn-primary botao" value="Voltar " onClick="window.location.href='index.php'"></td>
                     <?php } ?>
                    <td align="right">
                    <?php if ($num_perguntas==$num_resposta_usuario+1){?> 
                      <input type="submit" class="btn btn-lg btn-primary botao1" value="Relacionar dados">
                    <?php }else{?>
                        <input type="submit" class="btn btn-lg btn-primary botao" value="Próxima">
                    <?php }?>
                    </td>
                  </tr>
                </table>
            </form>
      <?php
        $i = 1;   
       }
       }
         ?>
  </div>
</div>

<div class="copyright py-4 text-center text-white" style="background-color:#05071A;">
   <div class="container"><small>IntegrateData - Copyright &copy; Todos os direitos reservados 2020</small></div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/assets/dist/js/bootstrap.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
<script src="js/scripts.js"></script>


</body>
</html>
