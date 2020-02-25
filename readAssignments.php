<?php 
	require '../database/database.php';
        $id = $_GET['id'];

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
                    <h3>Read an Event</h3>
            </div>

            <div class="form-horizontal" >
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
                    <a class="btn" href="assignments.php">Back</a>
                </div>
            </div>
        </div>
				
    </div> <!-- /container -->
  </body>
</html>