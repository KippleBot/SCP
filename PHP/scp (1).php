<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
    <h1>SCP File Creation</h1>
    <?php
    include "connection.php";
    
    if(isset($_POST['submit']))
    {
        $insert=$connection->prepare("select * from SCP where Item = ?,Name = ?,Description = ?,Class = ?,Image = ?,Containment = ?");
        $insert->bind_param('ssssss',$_POST['Item'],$_POST['Name'],$_POST['Description'],$_POST['Class'],$_POST['Image'],$_POST['Containment']);
        if($insert->execute()){
            echo"<div class='alert alert-success'>Record has successfully been created</div>";
        }
        else{
            echo"<div class='alert alert-danger'>Error {$insert->error}</div>";
      }  }
    ?>
    <a href="index.php">Back to Index</a>
    <form method="post" class='btn btn-dark'>
    <!--On this area contains the create file.-->
    <label>Please Insert the SCP Item Number:</label>
    <textarea name="Item" value=<?php echo $row['Item'];?>>Item Number...</textarea>
    <br>
    <label>Please Insert the known name:</label>
    <textarea name="Name" value=<?php echo $row['Name'];?>>Name...</textarea>
    <br>
    <label>Please Insert info about it:</label>
    <textarea name="Description" value=<?php echo $row['Description'];?>>Give Description about it...</textarea>
    <br>
    <label>Please Insert what class it is:</label>
    <textarea name="Class" value=<?php echo $row['Class'];?>>Class...</textarea>
    <br>
    <!-- This code below asks for the image address. Give Image Address Here.-->
    <label>Please Insert what the SCP looks like:</label>
    <input type="text" name="Image" class=form-control value=<?php echo $row['Image'];?>>
    <br>
    <label>Please insert how to contain it:</label>
    <textarea name="Containment" value=<?php echo $row['Containment'];?>>Containment...</textarea>
    <br>
    <input type="submit" name="submit" class='btn-primary'>
</form>
</body>
</html>