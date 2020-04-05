<?php 

$connection = mysqli_connect("localhost","user","pass","arduino");

if(isset($_GET['q'])) {

  switch($_GET['q']) {

    case 'y':
    $sql = "SELECT * FROM tcs230 ORDER BY id DESC LIMIT 10";
    break;

    case 'r':
    $sql = "SELECT id,rojo FROM tcs230 ORDER BY id DESC LIMIT 10";
    break;

    case 'v':
    $sql = "SELECT id,verde FROM tcs230 ORDER BY id DESC LIMIT 10";
    break;

    case 'a':
    $sql = "SELECT id,azul FROM tcs230 ORDER BY id DESC LIMIT 10";
    break;


    default:
    $sql = "SELECT * FROM tcs230 ORDER BY id DESC LIMIT 20";

  }

  $result = mysqli_query($connection, $sql);

  $emparray = array();
  while($row =mysqli_fetch_assoc($result)) {
    $emparray[] = $row;
  }

  echo json_encode($emparray);

}

mysqli_close($connection);

?>
