<?php
session_start();
include 'config/database.php';

if(isset($_POST['action'])){
    $db = new Database();
    $db->setTable("Users");
    switch ($_POST['action'])
    {
        case "login":
            $log = $db->getByUsername($_POST['username']);
            if($log->num_rows>0){
                while ($row = $log->fetch_assoc()){
                    if(password_verify($_POST['password'], $row['password'])){
                        if($row['roles']==1) {
                            header("Location: admin/admin.php");
                            $_SESSION['username'] = $_POST['username'];
                        }
                        else {
                            header("Location: user/user.php");
                            setcookie("username", $_POST['username'], time()+1800, "/user/user.php");
                        }
                    }
                    echo 'Username or password incorrect!';
                    break;
                }
            }
            else{
                echo "Username or password incorrect!";
            }
            break;
        case "register":
            $res = $db->insertUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], 0);
            echo $res;
            break;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login/Register</title>
    <style>
        body{
            display: flex;
        }
        .login, .register{
            width: 30%;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            margin: 20px;
        }
        input{
            margin-left: 20px;
            margin-right:20px;
        }
    </style>
</head>
<body>

<div class="login">
    <h2>Form Login</h2>
    <form action="/" method="post">
        <input type="hidden" class="hidden" name="action" value="login">
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
        <button type="submit" name="login">Login</button>
    </form>
</div>


<hr>

<div class="register">
    <h2>Form Register</h2>
    <form action="/" method="post">
        <input type="hidden" class="hidden" name="action" value="register">
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
            <input type="email" name="email" id="email" style="margin-left: 50px">
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
        <button type="submit" name="register">Register</button>
    </form>
</div>


</body>
</html>


