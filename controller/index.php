<?php
include '../config/database.php';
$db = new Database();
$db->setTable("Users");


//get url
if(isset($_GET['action']))
{
    if($_GET['action']=="register"){
        registerUser($db);
    }
}



//function
function registerUser($db){
    $res = $db->insertUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], 0);
    echo $res;
}