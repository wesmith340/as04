<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>PHP CRUD Grid</h3>
    		</div>
                    <div class="row">
                        <p>
                                <a href="assignments.php" class="btn btn-success">Assignments</a>
                                <a href="createEvent.php" class="btn btn-success">Create Event</a>
                        </p>
				
                        <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Location</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                           require '../database/database.php';
                           $pdo = Database::connect();
                           $sql = 'SELECT * FROM events ORDER BY id DESC';
                           foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['location'] . '</td>';
                                echo '<td>'. $row['date'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readEvent.php?id='.$row['id'].'">Read</a>';
                                echo '&nbsp;';
                                echo '<a class="btn btn-success" href="updateEvent.php?id='.$row['id'].'">Update</a>';
                                echo '&nbsp;';
                                echo '<a class="btn btn-danger" href="deleteEvent.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                           }
                           Database::disconnect();
                          ?>
                      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>