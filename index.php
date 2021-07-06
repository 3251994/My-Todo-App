<!DOCTYPE html>

<?php include 'db.php'; 


$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && ((int)$_GET['per-page']) <= 50 ? (int)$_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;


$sql = "select * from tasks limit ".$start." , ".$perPage." ";
$total = $db->query("select * from tasks")->num_rows;
$pages = ceil($total / $perPage);

$result = $db->query($sql);
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
		<center><h1>Todo List Creator</h1></center>

		<div class="row" style="margin-top: 70px;">

			<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
				<button type="button" class="btn btn-success" data-target="#todoModal" data-toggle="modal">Add Task</button>
				<button type="button" class="btn btn-default pull-right" onclick="print()">Print</button>
				<hr><br>
						<!-- Modal -->
					<div id="todoModal" class="modal fade" role="dialog">
  						<div class="modal-dialog">

    					<!-- Modal content-->
    					<div class="modal-content">
      						<div class="modal-header">
        						<button type="button" class="close" data-dismiss="modal">&times;</button>
        						<h4 class="modal-title">Add Task</h4>
      						</div>
      					<div class="modal-body">
        					<form method="post" action="add.php"> 
        						<div class="form-group">
        						<label>Task Name</label>
        						<input type="text" required name="task" class="form-control"></input>
        					</div>
        					<input type="submit" name="send" value="Add Task" class="btn btn-success">
        					</form>
      					</div>
      					<div class="modal-footer">
        					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      					</div>
    				</div>

  				</div>
			</div>
			<div class="col-md-12-text-center">
				<form action="search.php" method="post" class="form-group">
					<input type="text" placeholder="search" name="search" class="form-control">

				</form>


			</div>

					<thead>
						<tr>
							<th>No.</th>
							<th>Task</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php while($row = mysqli_fetch_assoc( $result )): ?>
							<th><?php echo $row['id'] ?></th>
							<td class="col-md-10"><?php echo $row['name'] ?></td>
							<td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a></td>
							<td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
						</tr>
							<?php endwhile; ?>	  
					</tbody>
			    </table>
			    <center>
				<ul class="pagination">
				<?php for($i = 1 ; $i <= $pages; $i++): ?>
				<li><a href="?page=<?php echo $i;?>&per-page=<?php echo $perPage;?>"><?php echo $i; ?></a></li>

			<?php endfor; ?>
				</ul>
			</center>
			</div>
		</div>
	</div>
</body>
</html>