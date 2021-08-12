<?php
include "../config/database.php";
$db = new Database();
$db->setTable("Users");


if(isset($_POST['action'])){
    $user = $db->getById($_POST['ID']);
    if($_POST['old-password']!=''&&$_POST['new-password']!=''){
        if($user->num_rows>0){
            while ($row = $user->fetch_assoc()){
                if(password_verify($_POST['old-password'], $row['password'])){
                    $res = $db->updateUser($_POST['ID'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['new-password']);
                    echo $res;
                }
            }
        }
    }
    else{
        $res = $db->updateUser($_POST['ID'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], '');
        echo $res;
    }
    if($_POST['username']!=$_COOKIE['username'])
    {
        unset($_COOKIE['username']);
    }
}

if(isset($_COOKIE['username']))
{
    $result = $db->getByUsername($_COOKIE['username']);
    while ($row = $result->fetch_assoc()){
        $id = $row['id'];
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
    }
}
else{
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User</title>
    <style>
        .info_user{
            width: 30%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            margin-left: 35%;
        }
        input{
            margin-left: 20px;
            margin-right:20px;
        }
    </style>

</head>
<body>

<div class="info_user">
    <h2>User</h2>
    <form action="/user/user.php" method="post">
        <input type="hidden" class="hidden" name="action" value="edit">
        <input type="hidden" class="hidden" name="ID" value="<?php echo $id;?>">
        <div>

            <label for="firstname"> First Name </label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $firstname;?>">
        </div>
        <br>
        <div>
            <label for="lastname"> Last Name </label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $lastname;?>">
        </div>
        <br>
        <div>
            <label for="email"> Email </label>
            <input type="email" name="email" id="email" style="margin-left: 50px" value="<?php echo $email;?>">
        </div>
        <br>
        <div>
            <label for="username"> Username </label>
            <input type="text" name="username" id="username" value="<?php echo $username;?>">
        </div>
        <br>
        <div style="margin-left: -25px">
            <label for="old-password"> Old - Password </label>
            <input type="password" name="old-password" id="old-password">
        </div>
        <br>
        <div style="margin-left: -25px">
            <label for="new-password"> New- Password </label>
            <input type="password" name="new-password" id="new-password">
        </div>
        <br>
        <button type="submit" name="Edit">Edit</button>
    </form>
</div>

</body>
</html>