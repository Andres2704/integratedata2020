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

if(isset($_POST['pt1'])){
$pt1 = $_POST['pt1'];
$pt2 = $_POST['intResposta'];
}else{
$pt1 = 5;
$pt2 = 5;	
}

$sql = mysqli_query($link, "select * from tblresposta  where idUsuario=".$_SESSION['MM_idUsuario']." ORDER BY idPergunta DESC LIMIT 1");
if($sql === FALSE) { 
  die(mysqli_error($link));
}
$row_perguntas = mysqli_fetch_assoc($sql);
$num_perguntas = mysqli_num_rows($sql);

if($num_perguntas>0){
$query = mysqli_query($link, "DELETE FROM tblresposta WHERE idResposta=".$row_perguntas['idResposta']."");
if($query === FALSE) { 
  die(mysqli_error($link));
}else{
}
}
?>
<?php if(isset($pt1) & isset($pt2)){ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>IntegrateData - Relatório</title>
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">

        <link href="css/styles.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
    body,td,th {
	font-family: Lato, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	font-size: 14px;
}
    </style>
    </head>
<body id="page-top">
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

        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style="background-color:#05071A; padding:8px;" >
            <div class="container">
            <a href="index.php"><img src="images/logo2.png" width="294" height="55"></a>
              <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold text-white rounded" style=" background-color:#05071A;" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php"style="color:#FFF; text-decoration:none;  font-weight:normal;">Início</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#oprojeto" href="#" style="color:#FFF; text-decoration:none;  font-weight:normal;">O projeto</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#creditos" href="#" style="color:#FFF; text-decoration:none;  font-weight:normal;">Créditos</a></li>
                        <li class="nav-item mx-0 mx-lg-1">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" style="text-decoration:none; color:#FFF;  font-weight:normal;" aria-expanded="false">Idioma</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <a class="dropdown-item" href="#">Português <img src="images/brazil.png" width="20" height="20"></a>
                              <a class="dropdown-item" href="en">English <img src="images/usa.png" width="20" height="20"></a>
                            </div>
                          </li></li>
                    </ul>
                </div>
  </div>
  </nav>
        
        
        <header class="masthead text-white text-center"  style=" background-image:url(images/background5.jpg)">
            <div class="container d-flex align-items-center flex-column"><br>
              <h2 class="page-section-heading text-center text-uppercase" style="color: #FFF; font-size:30px; font-weight: bolder;">
                <p class="masthead-subheading font-weight-light mb-0">
                <?php 
				switch ($pt1) {
						case 0:
							echo "Pobreza";
							break;
						case 1:
							echo "Desemprego";
							break;
						case 2:
							echo "Agricultura";
							break;
						case 3:
							echo "Fome";
							break;
						case 4:
							echo "Saúde";
							break;
						case 5:
							echo "Erro, índice não encontrado<br><br><br>";
							break;
					}
				?>
                </p>
                </h2>
  <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-globe-europe"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <h2 class="page-section-heading text-center text-uppercase" style="color: #FFF; font-size:30px; font-weight: bolder;">
                <p class="masthead-subheading font-weight-light mb-0"><?php 
				switch ($pt2) {
						case 0:
							echo "Desmatamento";
							break;
						case 1:
							echo "Luminosidade";
							break;
						case 2:
							echo "Temperatura";
							break;
						case 3:
							echo "Qualidade da água";
							break;
						case 4:
							echo "Qualidade do ar";
							break;
					}
				?>  
                </p>
                </h2>
                <br><br>
                <p class="masthead-subheading font-weight-light mb-0"></p>
                <br><br>
            
            </div>
        </header>
        <?php if ($pt1 == 4 & $pt2==4){ ?>
        <section class="page-section text-white mb-0" id="about">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase" style="color: #000; font-size:20px;">Saúde e a qualidade do ar estão relacionados entre si e aos impactos do COVID-19.<br>
Veja como!</h2>
                <div class="divider-custom divider-dark">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-satellite"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                
                    <p align="center" style="color:#000; font-size:20px;">De acordo com a Organização Mundial da Saúde (OMS<a https://www.who.int/>), cerca de 9 em cada 10 pessoas vivem em locais onde os níveis de poluição do ar excedem os limites impostos pela Organização e, portanto, acabam consumindo partículas tóxicas diariamente. Em razão desse excesso, a poluição do ar acaba sendo a responsável pela morte de aproximadamente 4.2 milhões de pessoas anualmente devido à ataques cardíacos, doenças do coração, câncer de pulmão e doenças respiratórias crônicas. Além disso, por mais que esse problema atinja pessoas dos mais diversos países, o maior impacto é definitivamente em regiões mais pobres, como o sul da Ásia e o oeste do Pacífico. Os dados da OMS podem ser <a href="https://www.who.int/health-topics/air-pollution#tab=tab_2">acessados aqui </a>.</p>
               
            </div>
        </section>
        
        
        <section class="page-section bg-secondary text-white mb-0" id="about">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;"><p class="lead">Tanto o Dióxido de Nitrogênio (NO<sub>2</sub>) quanto o Dióxido de Enxofre (SO<sub>2</sub>) são poluentes atmosféricos derivados de atividades que consomem combustíveis fósseis, como o uso de automóveis e geração de eletricidade. Tal fato faz com que essas substâncias sejam um tipo de indicador de algumas das atividades humanas. Nos últimos meses, com a implementação das medidas de isolamento social por conta do COVID-19 ao redor do mundo, foi possível observar uma notável diferença na emissão desses poluentes na atmosfera. Estudos realizados a partir de dados do satélite <a href="https://aura.gsfc.nasa.gov/">Aura</a> da NASA mostraram reduções significativas nas taxas de NO<sub>2</sub> no norte dos Estados Unidos e no sul da Ásia. Além disso, utilizando o mesmo satélite, reduções na taxa de SO<sub>2</sub> também foram registradas no sul da Ásia. Os dados de monitoramento da emissão de  NO<sub>2</sub> em diversas cidades de todo o mundo, coletados pelo instrumento <a href="https://aura.gsfc.nasa.gov/omi.html">OMI</a> do satélite Aura, podem ser explorados através de uma ferramenta disponibilizada <a href="https://so2.gsfc.nasa.gov/no2/no2_index.html">aqui</a>.</p></div>
                    <div class="col-lg-6 mr-auto" style="text-align:justify;">
                      <p class="lead">
                    <img src="https://www.nasa.gov/sites/default/files/thumbnails/image/avg2015-2019_no2_print_w_colorbar_date_print.jpg" width="459" height="242"><br><br>
                    <img src="https://www.nasa.gov/sites/default/files/thumbnails/image/2020_no2_w_colorbar_date_print.jpg" width="457" height="255"><br> 
                    <span style=" font-size:14px;">Dados de satélite da NASA mostram queda de 30% na poluição do ar no nordeste dos EUA em março de 2020 comparado aos anos anteriores. Créditos: < NASA   www.nasa.gov > </span></p>
                    </div>
                </div>
            </div>
        </section>
        
<section class="page-section text-white mb-0" id="about">
            <div class="container" style=" color:#000;">
               
<div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;"><p class="lead">Além dessas análises com o satélite Aura, a NASA e a <a href="https://www.esa.int/">Agência Espacial Europeia (ESA)</a> divulgaram dados sobre a poluição do ar para países asiáticos e europeus que mostram as mudanças significativas na qualidade do ar. De acordo com os dados, a variação do nível de NO<sub>2</sub> coletada através do satélite <a href="http://www.esa.int/Applications/Observing_the_Earth/Copernicus/Sentinel-5P">Sentinel - 5P</a> indicou uma diminuição significativa na emissão de NO<sub>2</sub> nos países asiáticos e europeus devido aos bloqueios sociais por conta do COVID-19. De acordo com a ESA (2020), o NO<sub>2</sub> reduziu de 20 a 30% nos países europeus (Espanha, Itália e França).</p></div>
                    <div class="col-lg-6 mr-auto" style="text-align:justify;"><p class="lead"> Em relação aos países asiáticos, houve uma redução de aproximadamente 70% e 30% na emissão de NO<sub>2</sub> na Índia e na China, respectivamente. De acordo com a avaliação geral da redução de NO<sub>2</sub> durante os bloqueios sociais devido ao COVID-19 na Ásia e na Europa, pode-se observar que o impacto do isolamento social, em relação à melhora da qualidade do ar, foi mais eficaz nos países asiáticos em comparação aos países europeus. A imagem abaixo ilustra a redução de dióxido de nitrogênio sobre a China antes e após a quarentena. </p>
                    </div>
                </div>
                <p align="center" style="color:#000; font-size:20px;"><img src="https://eoimages.gsfc.nasa.gov/images/imagerecords/146000/146362/china_trop_2020056.png" width="866" height="702"> <br> 
                <span style=" font-size:14px;">Dióxido de Nitrogênio sobre a China em 1 a 20 de Janeiro de 2020 e em 10 a 25 de fevereiro de 2020. <br>
Créditos: < NASA Earth Observatory > </span></p>
            </div>
        </section>

<section class="page-section bg-secondary text-white mb-0" id="about">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;">
                      <p class="lead">Entretanto, como esperado pelos cientistas, três meses após a intensa redução no poluente atmosférico NO<sub>2</sub>, houve um significativo aumento.  Segundo informações da NASA Earth Observatory (<a href="https://earthobservatory.nasa.gov/images/146741/nitrogen-dioxide-levels-rebound-in-china">acesse aqui</a>), esse aumento é explicado por dois fatores: a maioria dos bloqueios por causa do COVID-19 estão acabando na China e, além disso, os níveis de NO<sub>2</sub> na atmosfera diminuem natural a cada ano, do inverno à primavera e ao verão. A imagem ao lado ilustra a recuperação dos níveis de dióxido de nitrogênio sobre a China.</p></div>
                    <div class="col-lg-6 mr-auto" style="text-align:justify;"><p class="lead">
                    <img src="https://eoimages.gsfc.nasa.gov/images/imagerecords/146000/146741/china_trop_2020056-2020133.png" width="432" height="323"><br>
                    <span style=" font-size:14px;">Níveis de dióxido de nitrogênio na China de 10 de fevereiro a 12 de maio de 2020. Créditos: &lt;NASA Earth Observatory&gt;</span></p>
                    </div>
                </div>
            </div>
</section>



<section class="page-section text-white mb-0" id="about">
            <div class="container" style=" color:#000;">
               
<div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;">
                      <p class="lead">Segundo a  <a href="https://www.healthandenvironment.org/">Collaborative on Health and the Environment's (CHE's)</a>, tanto a qualidade do ar externo quanto a qualidade do ar interno têm impactos de longo alcance na saúde, incluindo doenças cardíacas, derrame, doença pulmonar obstrutiva crônica, infecções respiratórias inferiores, exacerbações da asma, câncer de pulmão e trato urinário / bexiga, parto prematuro e muito mais. O dióxido de nitrogênio, um dos poluentes atmosféricos que mais sobre alterações devido ao COVID-19, pode trazer diversos problemas, como: supressão imunológica, pneumonia, asma e rinite. O estudo mais detalhado sobre a qualidade do ar com a saúde pode ser acessado da Collaborative on Health and the Environment pode ser <a href="https://www.healthandenvironment.org/environmental-health/environmental-risks/global-environment/air-quality">acessado aqui</a>.</p></div>
                      
                    <div class="col-lg-6 mr-auto" style="text-align:justify;"><p class="lead">Contudo, é notável a relação entre a qualidade do ar e a saúde populacional. Durante a pandemia do COVID-19, um vírus que ataca agressivamente o sistema respiratório, as reduções de poluentes atmosféricos são extremamente positivas. Mesmo sabendo que o status atual da qualidade do ar pode ser temporário,  há uma oportunidade muito boa para entender como as ações de bloqueio social minimizam o nível de concentração de poluentes do ar em um período prolongado.  Essa redução de poluentes atmosféricos, além de ser positiva para o meio ambiente, tem como consequência a minimização dos problemas respiratórios crônicos da população, além de outros problemas respiratórios causados pela poluição do ar e, principalemente, pelo COVID-19. </p>
                    </div>
                </div>
            </div>
        </section>
		<?php } else{?>
        <section class="page-section text-white mb-0" id="about">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase" style="color: #000; font-size:20px;">No momento não há relatório relacionando ambos tópicos.<br>
                <div class="divider-custom divider-dark">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-wrench"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                
                    <p align="center" style="color:#000; font-size:20px;">
                    </p>
               
            </div>
        </section>
        
        <?php }?>

        <!-- Bootstrap core JS-->
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
 <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white" style="background-color:#05071A;">
            <div class="container"><small>IntegrateData - Copyright © Todos os direitos reservados 2020</small></div>
        </div>
</html>
<?php } else{
	header("Location: index.php");
	die();
	
}?>



