<?php
session_start();
include '../config/database.php';
$db = new Database();
$db->setTable("Users");
if(isset($_SESSION['username'])){
    $result = $db->getAllUser();
}
else{
    header("Location: /");
}


//post edit/remove
if(isset($_POST['action'])){
    switch ($_POST['action']){
        case "remove";
            if(!empty($_POST['username'])){
                $remove = $db->deleteByUsername($_POST['username']);
                echo $remove;
                $result = $db->getAllUser();
            }
            break;

        case "edit":
            if(!empty($_POST['Id'])){
               $update = $db->updateUser($_POST['Id'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password']);
               echo $update;
               $result = $db->getAllUser();
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        #form{
            display: flex;
        }
        .form-edit input{
            float: right;
        }
    </style>
</head>
<body>
<table style="width: 100%">
    <tr>
        <th>Id</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Username</th>
    </tr>
    <?php
    while($row = $result->fetch_assoc()){
        echo '<tr>';
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['firstname']."</td>";
            echo "<td>".$row['lastname']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['username']."</td>";
        echo '<tr>';
    }
    ?>
</table>
<div id="form">
    <div style="margin-top: 30px; width: 30%" >
        <form action="/admin/admin.php" method="post">
            <input type="hidden" class="hidden" value="remove" name="action">
            <label for="remove">Delete</label>
            <input type="text" placeholder="Enter username" name="username">
            <input type="submit" value="Remove">
        </form>
    </div>

    <div class="form-edit" style="margin-top: 30px; width: 20%">
        <form action="/admin/admin.php" method="post">
            <input type="hidden" class="hidden" value="edit" name="action">
            <div>
                <label for="Id"> Id </label>
                <input type="text" name="Id" id="Id">
            </div>
            <br>
            <div>
                <label for="firstname"> First Name </label>
                <input type="text" name="firstname" id="firstname">
            </div>
            <br>
            <div>
                <label for="lastname"> Last Name </label>
                <input type="text" name="lastname" id="lastname">
            </div>
            <br>
            <div>
                <label for="email"> Email </label>
                <input type="email" name="email" id="email">
            </div>
            <br>
            <div>
                <label for="username"> Username </label>
                <input type="text" name="username" id="username">
            </div>
            <br>
            <div>
                <label for="password"> Password </label>
                <input type="password" name="password" id="password">
            </div>
            <br>
            <input type="submit" value="Edit">
        </form>
    </div>

</div>

</body>
</html>