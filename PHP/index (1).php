<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php include "connection.php" ?>
<?php foreach($result as $link):?>
<div><li class='nav-item active'>
    <a href=<?php echo $link['Item']; ?>" class="nav-link text-light"><?php echo $link['Item']; ?></a>
</li>
<li class='nav-item active'>
    <a href='scp.php' class='nav-lnik text-light'>Create an SCP</a>
</li></div>
    <body class=container>
        <h1>SCP CRUD Application</h1>
    <?php 
    if (isset($_GET['link'])) {
        $model =$_GET['link'];
        $stmt=$connection->prepare("SELECT * FROM SCP WHERE Item=?");
        if(!$stmt):{
            echo"<p>Error in preparing SQL statement.</p>";}
        $stmt->bind_param("s",$model);
        if ($stmt->execute()):{
            $result=$stmt->get_result();

        if ($result->num_rows > 0) {
            $array= array_map('htmlspecialchars',$result->fetch_assoc());
            $update="update.php?update=" . $array['id'];
            $delete="index.php?delete=" . $array['id'];
            echo "
            <div>
            <h2>{$array['Item']}</h2>
            <h3>{$array['Name']}</h3>
            <p>{$array['Description']}</p>
            <h3>{$array['Class']}</h3>
            <img src={$array['Image']} alt='Image of the SCP'>
            <p>{$array['Containment']}</p>
            <p>
                <a href={$update}>Update SCP</a>
                <a href={$delete}>Delete SCP</a>
            </p>
            </div>";
            
        } else {
        echo"<p>No record for SCP: {$array=['Item']}</p>"
    }}
else
{echo"<p>Error executing the statement</p>";}}
else{echo"<p>Welcome to this CRUD Application</p>
    <p></p>";}

if(isset($_GET['delete']){
    $delID=$_GET['delete'];
    $delete= $connection->prepare("delete from SCP where id=?")
    $delete->bind_param("i",$delID)
    if($delete->execute){
        echo"<div class='alert alert-warning'>Record of SCP has been removed...</div>"
    }
    else{
        echo"<div class='alert alert-danger'>Error deleting record {$delete->error}.</div>"
    }
}

        ?>
    
    <a href="scp.php">Bring in a new SCP File<a>
        <button clicked="index.html">Go Back</button>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>