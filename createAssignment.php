<?php 
	
	require '../database/database.php';

	if ( !empty($_POST)) {		
            
            // keep track post values
            $event_id = $_POST['event'];
            $customer_id = $_POST['customer'];
                
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO assignments (event_id, customer_id) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($event_id,$customer_id));
            Database::disconnect();
            header("Location: assignments.php");
		
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
        <div class="span10 offset1">
                <div class="row">
                        <h3>Create a Customer</h3>
                </div>

            <form class="form-horizontal" action="createAssignment.php" method="post">
                    <div class="control-group">
                        <label class="control-label">Event</label>
                        <div class="controls">
                            <?php
                                $pdo = Database::connect();
                                $sql = 'SELECT name, id as e_id FROM events ORDER BY name ASC';
                                echo "<select class='form-control' name='event' id='event_id'>";
                                foreach ($pdo->query($sql) as $row) {
                                        echo "<option value='" . $row['e_id'] . " '> " . $row['name'] . "</option>";
                                }
                                echo "</select>";
                                Database::disconnect();
                            ?>
                        </div>	<!-- end div: class="controls" -->
                        <label class="control-label">Customer</label>
                        <div class="controls">
                            <?php
                                $pdo = Database::connect();
                                $sql = 'SELECT name, id as c_id FROM customers ORDER BY name ASC';
                                echo "<select class='form-control' name='customer' id='customer_id'>";
                                foreach ($pdo->query($sql) as $row) {
                                        echo "<option value='" . $row['c_id'] . " '> " . $row['name'] . "</option>";
                                }
                                echo "</select>";
                                Database::disconnect();
                            ?>
                        </div>	<!-- end div: class="controls" -->
                    </div> <!-- end div class="control-group" -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Assign</button>
                        <a class="btn" href="assignments.php">Back</a>
                    </div>
                </form>
        </div>
				
    </div> <!-- /container -->
  </body>
</html>