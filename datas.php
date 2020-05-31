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
        <title>IntegrateData</title>
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

        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style="background-color:#05071A; padding:8px;" >
            <div class="container">
            <a href="index.php"><img src="images/logo2.png" width="294" height="55"></a>
              <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold text-white rounded" style=" background-color:#05071A;" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php"style="color:#FFF; text-decoration:none;  font-weight:normal;">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#oprojeto" href="#" style="color:#FFF; text-decoration:none;  font-weight:normal;">The project</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="modal" data-target="#creditos" href="#" style="color:#FFF; text-decoration:none;  font-weight:normal;">Credits</a></li>
                        <li class="nav-item mx-0 mx-lg-1">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" style="text-decoration:none; color:#FFF;  font-weight:normal;" aria-expanded="false">Language</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <a class="dropdown-item" href="pt/">Português <img src="images/brazil.png" width="20" height="20"></a>
                              <a class="dropdown-item" href="#">English <img src="images/usa.png" width="20" height="20"></a>
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
							echo "Poverty ";
							break;
						case 1:
							echo "Unemployment";
							break;
						case 2:
							echo "Agriculture";
							break;
						case 3:
							echo "Hunger";
							break;
						case 4:
							echo "Health";
							break;
						case 5:
							echo "Error, index not found<br><br><br>";
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
							echo "Deforestation";
							break;
						case 1:
							echo "Luminosity";
							break;
						case 2:
							echo "Temperature";
							break;
						case 3:
							echo "Water quality";
							break;
						case 4:
							echo "Air quality";
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
                <h2 class="page-section-heading text-center text-uppercase" style="color: #000; font-size:20px;">Health and air quality are related to each other and to the impacts of COVID-19.<br>
See how!</h2>
                <div class="divider-custom divider-dark">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-satellite"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                
                    <p align="center" style="color:#000; font-size:20px;">According to <a href="https://www.who.int/">the World Health Organization (WHO)</a>, nearly 9 out of 10 people live in places where the levels of air pollution exceed the limits imposed by the organization and, therefore, end up consuming toxic particles daily. Because of this excess, air pollution is accounted responsible for the death of approximately 4.2 million of people each year due to heart attacks, heart diseases, lung cancer and chronical respiratory diseases. Besides that, even if this problem affects people from various countries, the biggest impact is definitely in poorest regions, like South Asia and Western Pacific. The WHO data can be <a href="https://www.who.int/health-topics/air-pollution#tab=tab_2">accessed here</a>.</p>
               
            </div>
        </section>
        
        
        <section class="page-section bg-secondary text-white mb-0" id="about">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;"><p class="lead">
                                        
                    Both the Nitrogen Dioxide (NO<sub>2</sub>) and the Sulfur Dioxide are atmospheric pollutants originated from activities that consume fossil fuels, such as the use of automobiles and generation of electricity. Because of that these substances became a kind of indicator of some human activities. In the last months, with the implementation of social isolation measures around the world because of the COVID-19, it was possible to see a notable difference in the emission of these pollutants to the atmosphere. Studies made based on data from NASA's satellite <a href="https://aura.gsfc.nasa.gov/">Aura</a> showed significant reductions in NO2 rates in Northern United States and Southern Asia. Furthermore, using the same satellite, reductions in SO<sub>2</sub> rates were also registered in Southern Asia. The NO<sub>2</sub> emission monitoring data in various cities around the world, collected by the instrument <a href="https://aura.gsfc.nasa.gov/omi.html">OMI</a> of the satellite Aura, can be explored trough this tool is available <a href="https://so2.gsfc.nasa.gov/no2/no2_index.html">here</a>.
                    </p></div>
                    <div class="col-lg-6 mr-auto" style="text-align:justify;">
                      <p class="lead" style=" width:459px;">
                    <img src="https://www.nasa.gov/sites/default/files/thumbnails/image/avg2015-2019_no2_print_w_colorbar_date_print.jpg" width="459" height="255"><br><br>
                    <img src="https://www.nasa.gov/sites/default/files/thumbnails/image/2020_no2_w_colorbar_date_print.jpg" width="459" height="255"><br> 
                    <span style=" font-size:14px;">
                    Satellite data from NASA show 30% decrease in air pollution in the northwest of the United States in march 2020 compared to previous years. Credits: <a href="https://www.nasa.gov/">NASA</a>
                    </span></p>
                    </div>
                </div>
            </div>
        </section>
        
<section class="page-section text-white mb-0" id="about">
            <div class="container" style=" color:#000;">
               
<div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;"><p class="lead">Besides these analysis with satellite Aura, NASA and the <a href="https://www.esa.int/">European Space Agency (ESA)</a> divulged data about air pollution for Asian and European countries that showed significant change in air quality. According to the data, the variation of NO<sub>2</sub> levels collected with the <a href="http://www.esa.int/Applications/Observing_the_Earth/Copernicus/Sentinel-5P">Sentinel-5P</a> satellite indicated a meaningful decrease in NO<sub>2</sub> emission in Asian and European countries due to the social blockages caused by the COVID-19 pandemic. As stated by ESA (2020), the NO<sub>2</sub> rate reduced from 20 to 30% on European countries (Spain, Italy and France).</p>
                    </div>
                    
                    <div class="col-lg-6 mr-auto" style="text-align:justify;"><p class="lead">Considering the Asian countries, there was a reduction of approximately 70% and 30% in the NO<sub>2</sub>  emission in India and China, respectively. As maintained by the general evaluation of the NO<sub>2</sub>  diminution during de social blockages caused due to the COVID-19 pandemic in Asia and Europe. Therefore, it can be observed that the social isolation, in regards of the improvement in air quality, was more efficient in Asian countries than in European countries. The image bellow pictures the nitrogen dioxide reduction over China before and after the quarantine. 
                    
                    
                    </p>
                    </div>
                </div>
                <p align="center" style="color:#000; font-size:20px;"><img src="https://eoimages.gsfc.nasa.gov/images/imagerecords/146000/146362/china_trop_2020056.png" width="866" height="702"> <br> 
                <span style=" font-size:14px;">Nitrogen Dioxide over China on 1-20 January 2020 and on 10-25 February 2020.<br>
 Credits: <a href="https://earthobservatory.nasa.gov/">NASA Earth Observatory</a></span></p>
            </div>
        </section>

<section class="page-section bg-secondary text-white mb-0" id="about">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;">
                      <p class="lead">                     
                      However, as was expected by scientists, three months after the intense decrease in NO<sub>2</sub> rates, there was a significant increase. According to information from NASA Earth Observatory (<a href="https://earthobservatory.nasa.gov/images/146741/nitrogen-dioxide-levels-rebound-in-china">access here</a>), this increase can be explained by two factors: most of the COVID-19 originated blockages are ending in China and, besides that, the levels of NO2 in the atmosphere reduce naturally every ear, from winter to spring and to summer. The image beside shows the recovery of the NO2 rates over China. 
                      </p></div>
                    <div class="col-lg-6 mr-auto" style="text-align:justify;">
                    <p class="lead" style="width:432px;">
                    <img src="https://eoimages.gsfc.nasa.gov/images/imagerecords/146000/146741/china_trop_2020056-2020133.png" width="432" height="323"><br>
                    <span style=" font-size:14px;">
                    Nitrogen Dioxide rates in China on 10-12 May 2020. Credits: <a href="https://earthobservatory.nasa.gov/">NASA Earth Observatory</a>
                    </span>
                    </p>
                    </div>
                </div>
            </div>
</section>



<section class="page-section text-white mb-0" id="about">
            <div class="container" style=" color:#000;">
               
<div class="row">
                    <div class="col-lg-6 ml-auto" style="text-align:justify;">   <p class="lead">                   
                      As stated by <a href="https://www.healthandenvironment.org/">Collaborative on Health and the Environment's (CHE's)</a>, both the external air quality and the internal air quality have long-reach impacts on health, including heart diseases, stroke, chronic obstructive pulmonary disease, minor respiratory infections, asthma exacerbations, lung cancer, bladder tract, premature birth and many more. The nitrogen dioxide, one of the atmospheric pollutants that suffered more alterations with COVID-19, can cause numerous problems, such as: immune suppression, pneumonia, asthma and rhinitis. The detailed study about air quality related to health from Collaborative on Health and the Environment can be <a href="https://www.healthandenvironment.org/environmental-health/environmental-risks/global-environment/air-quality">accessed here </a>.
                      </p></div>
                      
                    <div class="col-lg-6 mr-auto" style="text-align:justify;"><p class="lead">                   
                    Thus, the relation between air quality and population health is notable. During the COVID-19 pandemic, caused by a virus that attacks aggressively the respiratory system, the reductions on atmospheric pollutants are extremely positive. Even tough the actual status of air quality may be temporary, there is a great opportunity to understand how the social blockage measures in various sectors, mainly industrial, minimize the concentration of atmospheric pollutants over an extended period. This reduction of pollutants, besides being positive for the environment, has the consequence of minimizing people's chronic respiratory problems and other respiratory problems caused by the polluted air and, mainly, by COVID-19.
                     </p>
                    </div>
                </div>
            </div>
        </section>
		<?php } else{?>
        <section class="page-section text-white mb-0" id="about">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase" style="color: #000; font-size:20px;">There is currently no report relating both topics.</h2><br>
                <div class="divider-custom divider-dark">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-wrench"></i></div>
                    <div class="divider-custom-line"></div>
                </div>               
            </div>
        </section>
        
        <?php }?>
<div class="copyright py-4 text-center text-white" style="background-color:#05071A;">
   <div class="container"><small>IntegrateData - Copyright &copy; All rights reserved </small></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script src="assets/mail/contact_me.js"></script>
<script src="js/scripts.js"></script>

</body>
        
</html>
<?php } else{
	header("Location: index.php");
	die();
	
}?>



