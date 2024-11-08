<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCP File Creation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head> 
<body class='container'>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";

$row = [];
if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $recordID = $connection->prepare('SELECT * FROM SCP WHERE id=?');

    if (!$recordID) {
        echo '<div>Error preparing record for updating.</div>';
        exit;
    }

    $recordID->bind_param('i', $id);

    if ($recordID->execute()) {
        echo "<div>Record Ready for updating.</div>";
        $temp = $recordID->get_result();
        $row = $temp->fetch_assoc(); // Fetch the data
    } else {
        echo "<div>Error: {$recordID->error}</div>";
    }
}

if (isset($_POST['update'])) {
    $update = $connection->prepare("UPDATE SCP SET Item = ?, Name = ?, Description = ?, Class = ?, Image = ?, Containment = ? WHERE id = ?");
    $update->bind_param('ssssssi', $_POST['Item'], $_POST['Name'], $_POST['Description'], $_POST['Class'], $_POST['Image'], $_POST['Containment'], $id);

    if ($update->execute()) {
        echo '<div class="alert alert-success p-3 m-2">Record Update Executed successfully.</div>';
    } else {
        echo "<div class='alert alert-danger p-3 m-2'>Error: {$update->error}</div>";
    }
}
?>

<h1>Update the Record</h1>
<p><a href='index.php' class='btn btn-dark'>Go back to the index Page.</a></p>
<form method="post" action='update.php' class='btn btn-dark'>
    <!-- This area contains the create file -->
    <label>Please Insert the SCP Item Number:</label>
    <textarea name="scp"><?php echo isset($row['Item']) ? $row['Item'] : 'Item Number...'; ?></textarea>
    <br>
    <label>Please Insert the known name:</label>
    <textarea name="name"><?php echo isset($row['Name']) ? $row['Name'] : 'Name...'; ?></textarea>
    <br>
    <label>Please Insert info about it:</label>
    <textarea name="description"><?php echo isset($row['Description']) ? $row['Description'] : 'Give Description about it...'; ?></textarea>
    <br>
    <label>Please Insert what class it is:</label>
    <textarea name="class"><?php echo isset($row['Class']) ? $row['Class'] : 'Class...'; ?></textarea>
    <br>
    <!-- This code below asks for the image address. Give Image Address Here -->
    <label>Please Insert what the SCP looks like:</label>
    <input type="text" name="image" value="<?php echo isset($row['Image']) ? $row['Image'] : ''; ?>">
    <br>
    <label>Please insert how to contain it:</label>
    <textarea name="containment"><?php echo isset($row['Containment']) ? $row['Containment'] : 'Containment...'; ?></textarea>
    <br><br>
    <input type="submit" name='update' value='Update SCP'>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
