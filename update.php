<!DOCTYPE html>

<?php include 'db.php'; 

$id = (int)$_GET['id'];

$sql = "select * from tasks where id = '$id'";

$result = $db->query($sql);

$res = $result->fetch_assoc();

if(isset($_POST['send'])){
	
	$task = htmlspecialchars($_POST['task']);
	$sql2 = "update tasks set name='$task' where id = '$id'";

	$db->query($sql2);

	header('location: index.php');
}
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<title>My ToDo App</title>
</head>
<body style="background-color: blue;">

	<div class="container bg-primary text-white">
		<center><h1>Update Todo List</h1></center>

		<div class="row" style="margin-top: 70px;">

		<div class="col-md-10 col-md-offset-1">
			<table class="table">
			<hr><br>		
        		<form method="post"> 
        				<div class="form-group">
        					<label>Task Name</label>
        					<input type="text" required name="task" value="<?php echo $res['name']; ?>" class="form-control"></input>
        				</div>
        				<input type="submit" name="send" value="Add Task" class="btn btn-success">&nbsp;
        				<a href="index.php" class="btn btn-warning">Back</a>
        		</form>
			</div>
		</div>
	</div>
</body>
</html>