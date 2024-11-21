<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
    <body class="container">
    <h1>SCP File Creation</h1>
    <?php
     ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include "connection.php";
    if ($connection->connect_error) {
        echo "<div class='alert alert-danger'>Connection failed: " . $connection->connect_error . "</div>";
        exit; } else {
            echo "<div class='alert alert-success'>Connected to the database successfully.</div>"; }
            $result = $connection->query("SELECT * FROM SCP");
            if (!$result) {
                echo "<div class='alert alert-danger'>Error fetching models: " . $connection->error . "</div>";
                exit; 
                
            } else {
                    echo "<div class='alert alert-success'>Models fetched successfully.</div>"; }
                    
        if(isset($_POST['submit']))
            {
                
                $insert = $connection->prepare("INSERT * INTO SCP (Item, Name, Description, Class, Image, Containment)values(?,?,?,?,?,?)");
                $insert->bind_param('ssssss',$_POST['Item'],$_POST['Name'],$_POST['Description'],$_POST['Class'],$_POST['Image'],$_POST['Containment']);
                        
                if($insert->execute())
                {
                    echo "
                        <div class='alert alert-success p-3 m-3'>SCP File successfully created</div>
                    ";                        }
                else
                {
                    echo "
                    <div class='alert alert-danger p-3 m-3'>Error on SCP File: {$insert->error}</div>
                    ";
                }                    }
    ?>
    <a href="index.php" class="btn btn-dark">Back to Index</a>
    <div p-3 bg-light border shadow>
    <form action="create.php" method="post" class="form_group">
    <!--On this area contains the create file.-->
    <label>Please Insert the SCP Item Number:</label>
    <textarea name="item" value="<?php echo $row['Item'];?>"class="form_control">Item Number...</textarea>
    <br>
    <label>Please Insert the known name:</label>
    <textarea name="Name" value="<?php echo $row['Name'];?>"class="form_control">Name...</textarea>
    <br>
    <label>Please Insert info about it:</label>
    <textarea name="Description" value="<?php echo $row['Description'];?>"class="form_control">Give Description about it...</textarea>
    <br>
    <label>Please Insert what class it is:</label>
    <textarea name="Class" value="<?php echo $row['Class'];?>"class="form_control">Class...</textarea>
    <br>
    <!-- This code below asks for the image address. Give Image Address Here.-->
    <label>Please Insert what the SCP looks like:</label>
    <input type="text" name="Image" value="<?php echo $row['Image'];?>"class="form_control">
    <br>
    <label>Please insert how to contain it:</label>
    <textarea name="Containment" value="<?php echo $row['Containment'];?>"class="form_control">Containment...</textarea>
    <br>
    <input type="submit" name='submit' value='Create SCP File'class="btn btn-primary">
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>