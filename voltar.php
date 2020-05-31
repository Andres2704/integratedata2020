<?php require_once('Connection/hackaton.php'); ?>
<?php 

$sql = mysqli_query($link, "select * from tblresposta  where idUsuario=".$_SESSION['MM_idUsuario']." ORDER BY idPergunta DESC LIMIT 1");
if($sql === FALSE) { 
  die(mysqli_error($link));
}
$row_perguntas = mysqli_fetch_assoc($sql);
$num_perguntas = mysqli_num_rows($sql);

$query = mysqli_query($link, "DELETE FROM tblresposta WHERE idResposta=".$row_perguntas['idResposta']."");
if($query === FALSE) { 
  die(mysqli_error($link));
}else{
	header("Location: home.php");
	die();
}
?>
