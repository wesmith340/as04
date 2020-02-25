<?php 
	require '../database/database.php';
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
                
                $pdo = Database::connect();
                # get assignment details
                $sql = "SELECT * FROM assignments where id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $data = $q->fetch(PDO::FETCH_ASSOC);

                # get volunteer details
                $sql = "SELECT * FROM customers where id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($data['customer_id']));
                $custdata = $q->fetch(PDO::FETCH_ASSOC);

                # get event details
                $sql = "SELECT * FROM events where id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($data['event_id']));
                $eventdata = $q->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM assignments  WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
		
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
                        <h3>Delete an Event</h3>
                </div>

                <form class="form-horizontal" action="deleteAssignments.php" method="post">
                   <input type="hidden" name="id" value="<?php echo $id;?>"/>
                   <p class="alert alert-error">Would you like to delete this entry?</p>
                   <div class="control-group">
                        <label class="control-label">Customer</label>
                        <div class="controls">
                            <label class="checkbox">
                                    <?php echo $custdata['name'];?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Event</label>
                        <div class="controls">
                            <label class="checkbox">
                                    <?php echo $eventdata['name'];?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                    <?php echo $eventdata['date'];?>
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="assignments.php">No</a>
                    </div>
                </form>
        </div>
				
    </div> <!-- /container -->
  </body>
</html>