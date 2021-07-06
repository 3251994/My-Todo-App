<?php 

include 'db.php';

if(isset($_POST['send'])){

$name = $_POST['task'];

echo $name;



$sql = "insert into tasks (name) values ('$name')";

$val = $db->query($sql);

if($val){

	header('location: index.php');
}

}

?>