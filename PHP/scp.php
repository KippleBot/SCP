<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
    <h1>SCP File Creation</h1>
    <?php
    include "connection.php"
    if	(isset($_GET['submit'])){
        $id=$_GET["update"]
        $insert=$connection->prepare("select * from scp where scp = ?,name = ?,description = ?,class = ?,image = ?,containment = ?");
        $insert->bind_param('ssss',$_POST['scp'],$_POST['name'],$_POST['description'],$_POST['class'],$_POST['image'],$_POST['containment']);
        if($insert->execute()){
            echo"<div>Record has successfully been created</div>"
        }
        else{
            echo"<div>Error {$insert->error}</div>"
        }
    ?>
    <a href="index.php">Back to Index</a>
    <form>
    <!--On this area contains the create file.-->
    <label>Please Insert the SCP Item Number:</label>
    <textarea name="scp" value=<?php echo $row['scp'];?>>Item Number...</textarea>
    <br>
    <label>Please Insert the known name:</label>
    <textarea name="name" value=<?php echo $row['name'];?>>Name...</textarea>
    <br>
    <label>Please Insert info about it:</label>
    <textarea name="description" value=<?php echo $row['description'];?>>Give Description about it...</textarea>
    <br>
    <label>Please Insert what class it is:</label>
    <textarea name="class" value=<?php echo $row['class'];?>>Class...</textarea>
    <br>
    <!-- This code below asks for the image address. Give Image Address Here.-->
    <label>Please Insert what the SCP looks like:</label>
    <input type="text" name="image" value=<?php echo $row['image'];?>>
    <br>
    <label>Please insert how to contain it:</label>
    <textarea name="containment" value=<?php echo $row['containment'];?>>Containment...</textarea>
    <br>
    <input type="Submit">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>