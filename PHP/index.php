<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include "connection.php"?>
    <body>
        <h1>SCP CRUD Application</h1>
    <nav></nav>
    <?php 
    if (isset($_GET('link'))){
        $model =$_GET['link'];
        $stmt=$connection->prepare("select * from scp where scp=?");
        if(!$stmt):{
            echo"<p>Error in preparing SQL statement.</p>"
        }
        $stmt->bind_param("s",$model);
        if $stmt->execute():{

        $result=$stmt->get_result()

        if $result->num_rows>0:
            $array= array_map('htmlspecialchars',$result->fetch_assoc());
            $update="update.php?update=" . $array['id'];
            $delete="index.php?delete=" . $array['id'];
            echo"
            <div>
            <h2>{$array['scp']}</h2>
            <h3>{$array['name']}<h3>
            <p>{$array['description']}</p>
            <h3>{$array['class']}</h3>
            <img src={$array['image']}>
            <p>{$array['containment']}</p>
            <p>
                <a href={$update}>Update SCP</a>
                <a href={$delete}>Delete SCP</a>
            </p>
            </div>";
        else
        echo"<p>No record for model: {$array=['model']}</p>"
    }
else
{echo"<p>Error executing the statement</p>";}}
else{echo"<p>Welcome to this CRUD Application</p>
    <p></p>";}

if(isset($_GET['delete']){
    $delID=$_GET['delete'];
    $delete= $connection->prepare("delete from scp where id=?")
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