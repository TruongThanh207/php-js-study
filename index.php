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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body{
            display: flex;
        }
        .login{
            margin-left: 10%;
        }
        .register{
            margin-right: 10%;
        }
        .login, .register{
            width: 20%;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .register input, .login input{
            float:right;
            line-height: 2;
        }
        .login h2, .register h2{
            text-align: center;
        }

        /*.login label{*/
        /*    float:left;*/
        /*}*/
        button {
            display: block;
            float: right;
            line-height: 2;
        }
        #success{
            display: none;
            position: absolute;
            bottom: 50px;
            left: 50px;
            background-color: #69d293;
            color: white;
            width: 300px;
            height: 50px;
            text-align: center;
            padding-top: 25px;
            border-radius: 10px;
        }
        #error{
            display: none;
            position: absolute;
            bottom: 50px;
            left: 50px;
            background-color: #e32f2f;
            color: white;
            width: 300px;
            height: 50px;
            text-align: center;
            padding-top: 25px;
            border-radius: 10px;
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
            <input type="text" name="username" id="username1">
        </div>
        <br>
        <div>
            <label for="password"> Password </label>
            <input type="password" name="password" id="password1">
        </div>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
</div>


<hr>

<div class="register">
    <h2>Form Register</h2>
<!--    <form action="/" method="post">-->
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
        <button type="button" id="register" name="register">Register</button>
<!--    </form>-->
</div>

<div id="success">Alert</div>
<div id="error">Alert</div>
<script>

    $(document).ready(function (){
        $('#register').click(function (){
            var valid = validateRegister()
            if(valid){
                $.ajax({
                    url: "/controller/index.php?action=register",
                    type: "post",
                    data: {
                        firstname: $('#firstname').val(),
                        lastname: $('#lastname').val(),
                        username: $('#username').val(),
                        password: $('#password').val(),
                        email: $('#email').val()
                    },
                    success: function (result){
                        $('#success').html(result)
                        $('#success').slideDown();
                        $('#success').slideUp(1000);
                    }
                })
                resetRegister()
            }
            else{
                $('#error').html("Please fill out information")
                $('#error').slideDown();
                $('#error').slideUp(2000);
            }

        })

        function validateRegister(){
            if($('#firstname').val() === "" || $('#lastname').val() === ""
                || $('#email').val() === "" || $('#username').val() === "" || $('#password').val() === "")
                return false
            return true;
        }

        function resetRegister(){
            $('#firstname').val("")
            $('#lastname').val("")
            $('#username').val("")
            $('#password').val("")
            $('#email').val("")
        }

    })


</script>
</body>
</html>


