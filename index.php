<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
    <body class="container">
        
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
                    
        ?>
        <div>
            <ul class="nav navbar-dark bg-dark">
                
                <?php foreach($result as $link): ?>
                <li class="nav-item active">
                   <a href="index.php?link=<?php echo $link['Item']; ?>" class="nav-link text-light"><?php echo $link['Item']; ?></a>
                    </li
                    <?php endforeach; ?>
                   
                <li class="nav-item active">
                    <a href="scp.php" class="nav-link text-light">Bring in a new SCP File</a>
                </li>
            </ul>
        </div>
    <h1>SCP CRUD Application</h1>

    <div>
        <?php 
        
            if (isset($_GET['link']))
            {
                $scp =$_GET['link'];
                
                //This is a prepared statement
                $stmt=$connection->prepare("SELECT * FROM SCP WHERE Item=?");
                if(!$stmt){
                    echo"<p>Error in preparing SQL statement.</p>";
                    exit;
                }
                    $stmt->bind_param("s", $scp);
                    
                    if ($stmt->execute())
                    {
                        $result=$stmt->get_result();
                    
                        if ($result->num_rows > 0)
                        {
                            $array= array_map('htmlspecialchars', $result->fetch_assoc());
                            $update= "update.php?update=" . $array['id'];
                            $delete= "index.php?delete=" . $array['id'];
                            
                            echo"
                            <div class='card card-body shadow mb-3'>
                                <h2 class='card-title'>{$array['Item']}</h2>
                                <h3>{$array['Name']}<h3>
                                <p >{$array['Description']}</p>
                                <h3>{$array['Class']}</h3>
                                <p class='text-center'><img src='{$array['Image']}' alt='Image of SCP'></p>
                                <p>{$array['Containment']}</p>
                                <p>
                                    <a href={$update}>Update SCP</a>
                                    <a href={$delete}>Delete SCP</a>
                                </p>
                            </div>
                            ";
                        } else {
                            echo "<p>No record for SCP: {$array['item']}</p>";
                        }
                
                    } else {
                        echo "<p>Error executing the statement, {$stmt->error}</p>";
                    }
                }
            else { 
                echo"<p>Welcome to this CRUD Application</p>";
                }
                
            //Deletion Record
            if(isset($_GET['delete']))
            {
                $delID=$_GET['delete'];
                $delete= $connection->prepare("DELETE FROM SCP WHERE id=?");
                $delete->bind_param("i",$delID);
                
                if($delete->execute())
                {
                    echo"<div class='alert alert-warning'>Record of SCP has been removed...</div>";
                }
                else{
                    echo"<div class='alert alert-danger'>Error deleting record {$delete->error}.</div>";
                }
            }
            
        ?>
    </div>
    <button onclick="location.href='https://30089073.2024.labnet.nz/SCP/index.html'">Go Back</button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>