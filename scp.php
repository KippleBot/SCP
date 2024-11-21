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
    if	($_GET[""]){
        $id=$_GET["update"]
        $recordID=$connection->prepare();
        if(!$recordID){
            echo"<div>Error: Preparing record for updating</div>"
            exit;
        }
        $recordID=bind_param('');

        if ($recordID->execute()){
           echo"<div>Record Ready for updating</div>"
           $temp=$recordID->get_result();
        }
        else{
            echo"
            <div>Error:{$recordID->error}</div>";
        }
    }
    if (!isset($_POST["update"])){
        $update=$connection->prepare("select * from scp where scp = ?,name = ?,description = ?,class = ?,image = ?,containment = ?");
        $update=bind_param('ssssi',$_POST['scp'],$_POST['name'],$_POST['description'],$_POST['class'],$_POST['image'],$_POST['containment']);

        if ($update->execute()){
           echo"<div>Record Update Executed successfully.</div>"
        }
        else{
            echo"
            <div>Error:{$update->error}</div>";
        }
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
</body>
</html>