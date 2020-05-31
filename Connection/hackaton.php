<?php 
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
$link = mysqli_connect("localhost", "root", "", "hackaton_en");

if (!$link) {
    echo "Error: Não foi possível conectar com o MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//echo "Ótimo: A conexão com o MySQL foi realizada! O banco de dados hackaton está sendo utilizado." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

?>