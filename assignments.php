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
                            <span>
                            <a href="createAssignment.php" class="btn btn-success">Create Assignment</a>
                            <a href="events.php" class="btn btn-success">Events</a>
                            <a href="customers.php" class="btn btn-success">Customers</a>
                            </span>
                        </p>
                        <br>
                        
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Event</th>
                          <th>Customer</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                           require '../database/database.php';
                           $pdo = Database::connect();
                           $sql =    'SELECT events.name AS events_name, events.date, customers.name AS customers_name, assignments.id AS id'
                                   . ' FROM assignments, events, customers '
                                   . ' WHERE events.id = assignments.event_id AND customers.id = assignments.customer_id';
                           foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['events_name'] . '</td>';
                                echo '<td>'. $row['customers_name'] . '</td>';
                                echo '<td>'. $row['date'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readAssignments.php?id='.$row['id'].'">Read</a>';
                                echo '&nbsp;';
                                echo '<a class="btn btn-success" href="updateAssignments.php?id='.$row['id'].'">Update</a>';
                                echo '&nbsp;';
                                echo '<a class="btn btn-danger" href="deleteAssignments.php?id='.$row['id'].'">Delete</a>';
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