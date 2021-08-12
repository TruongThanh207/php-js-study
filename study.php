<?php
//session
session_start();

echo '<hr>Form<br>';

include 'config/database.php';
$db = new Database();
$db->checkConnection();

//post
if(!empty($_POST['username'])&&!empty($_POST['password']))
{
    echo 'username: '.$_POST['username'].'<br>';
    echo 'password: '.$_POST['password'].'<br>';
    //session
    $_SESSION['user'] = $_POST['username'];
    //cookie
    setcookie("new-cookie", "user", time()+1800, "/");
}

//session
if(isset($_SESSION['user'])){
    echo 'Session: '.$_SESSION['user'].'<br>';
}
//cookie
if (!isset($_COOKIE['new-cookie'])) {
    echo 'Cookie not set!' . '<br>';

} else {
    echo 'Cookie user is set <br>';
    echo 'Value: ' . $_COOKIE['new-cookie'] . '<br>';
}
//Variable Variables
echo '<hr>';
$a = 'Hello';
echo '$a = '.$a.'<br>';
$$a = " World"; //$Hello
echo '$$a = World <br>';
echo "$a ${$a} <br>";

//Data type
var_dump($a);
$x = 5;
$y = 10;
$bool = true;

//echo
echo '$bool = '.$bool.'<br>';
var_dump($bool);
echo '$x = '.$x.'</br>';
echo 'var y outside function $y = '.$y.'<br>';

//function
function myFunction(){
    global $x;
    $x++;
    echo "call function using global x++ </br>";
    echo '$x = '.$x.'</br>';
    echo "var y inside function = " . $y .'<br>';
}
myFunction();

define("name", "Truong Thanh", true);
define("country",
    ['Viet Nam', 'Thai Lan', 'Lao'],
    true
);
echo '<br>const name = '.name;
echo '<br>const country[] <br>';
print_r(country);

//operation

echo "<br>Operation<br>";
$z = $x+$y;
echo '$x+$y = '.$z;
echo '<br> $x == $y => ';

//if else
if($x==$y){
    echo 'true';
}
else echo 'false';
echo "<br>";
if($bool){
    echo '$bool la true';
} else echo '$bool la false';


//array
echo '<hr> Array <br>';
$arr = array('key1'=>'data1', 'key2'=>'data2','key3'=>'data3');
print_r($arr);
echo '<br>';
foreach ($arr as $key=>$value){
    echo $key.' = '.$value.'<br>';
}

//continue
echo '<hr> Continue <br>';
echo count($arr);
echo '<br>';
for($i=1; $i<=count($arr); $i++){
    if($i==2)
        continue;
    echo $arr['key'.$i].'<br>';
}

//break
echo '<hr> Break <br>';
for($i=1; $i<=count($arr); $i++){
    if($i==2)
        break;
    echo $arr['key'.$i].'<br>';
}

//function parameter
echo '<hr> Function <br>';
function multi($a, $b){
    return $a*$b;
}
$multi = multi($x, $y);
echo 'multi(a, b) = '.$multi;

echo '<hr> Predefined Variables<br>';

echo $_SERVER['SCRIPT_NAME'].'<br>';
echo $_SERVER['SERVER_NAME'].'<br>';

// file

//only write
echo '<hr>Write file <br>';
$myFile = fopen('file.txt', 'w') or die('unable open file!');
$txt = "new line 1\n";
fwrite($myFile, $txt);
fclose($myFile);
//remove data and write
echo '<hr>Write file <br>';
$myFile = fopen('file.txt', 'a') or die('unable open file!');
$txt = "new line 2\n";
fwrite($myFile, $txt);
fclose($myFile);
///only read
echo '<hr>Read file <br>';
$myFile = fopen('file.txt', 'r') or die('unable open file!');
while(!feof($myFile)) {
    echo fgets($myFile) . '<br>';
}
fclose($myFile);







//
//
//OOP
//
//
// interface
interface Sound{
    function makeSound();
}
// class cha
abstract class Animal{
    private $name;
    private $color;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }
    abstract function speak();
    function display(){
        return $this->getName()." + ".$this->getColor()." + ".$this->speak()."<br>";
    }

}
// class con

class Tiger extends Animal implements Sound {

    function speak()
    {
        return "Gam";
    }

    function makeSound()
    {
        return "Sound";
    }
}
class Dog extends Animal{

    function speak()
    {
        return 'Gau gau';
    }
}

$dog = new Dog();
$dog->setName('lulu');
$dog->setColor('vang');
echo 'Dog: '.$dog->display();

$tiger = new Tiger();
$tiger->setName('Bach');
$tiger->setColor('Trang');
echo 'Tiger: '.$tiger->display();
echo $tiger->makeSound();
echo '<br>';



// database
class Guest{
    private $table;
    private $db;

    public function __construct()
    {
        $this->table = 'Guests';
        $this->db = new Database();

    }
    function insertTable($firstname, $lastname, $email){
        $sql = "INSERT INTO ".$this->table." VALUES (null, '$firstname', '$lastname', '$email')";
        if($this->db->getConn()->query($sql)){
            echo "<p style='color: #328ba8'>Insert data success<p>";
        }
        else{
            echo 'Error: '. $this->db->getConn()->error;
        }
        $this->db->closeConnection();
    }
    function selectTable(){
        $sql = "SELECT * From ".$this->table;
        return $this->db->getConn()->query($sql);
    }
    function findById($id){
        $sql = "SELECT * From ".$this->table." WHERE id = '$id'";
        $result = $this->db->getConn()->query($sql);
        if($result->num_rows==0){
            return false;
        }
        else return true;
    }
    function updateTable($id, $firstname, $lastname, $email){
        $sql = "UPDATE ".$this->table ." SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = '$id'";
        if($this->db->getConn()->query($sql)){
            echo "<p style='color: #328ba8'>Update data success<p>";
        }
        else{
            echo 'Error: '. $this->db->getConn()->error;
        }
        $this->db->closeConnection();
    }
    function deleteById($id){
        $sql = "Delete from ".$this->table." WHERE id = '$id'";
        if($this->db->getConn()->query($sql)){
            echo "<p style='color: #328ba8'>Delete data success<p>";
        }
        else{
            echo 'Error: '. $this->db->getConn()->error;
        }
        $this->db->closeConnection();
    }
    function selectByName($name){
        $sql = "Select * from ".$this->table." WHERE firstname Like '%$name%'";
        return $this->db->getConn()->query($sql);
    }
}
$guest = new Guest();
$result = $guest->selectTable();


//post
if(isset($_POST['action'])){

    switch ($_POST['action']){
        case "remove":
            $guest = new Guest();
            if(isset($_POST['removeId'])){
                $guest->deleteById($_POST['removeId']);
            }
            else{
                echo "<p style='color:red'>Id not null!</p>";
            }
            break;
        case "update-add":
            $guest = new Guest();
            if(isset($_POST['id'])){
                if($guest->findById($_POST['id'])){
                    $guest->updateTable($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['email']);
                }
                else {
                    $guest->insertTable($_POST['firstname'], $_POST['lastname'], $_POST['email']);
                }
            }
            else{
                $guest->insertTable($_POST['firstname'], $_POST['lastname'], $_POST['email']);
            }
            break;
        case "search":
            if($_POST['search']!=''){
                $guest = new Guest();
                $result = $guest->selectByName($_POST['search']);
            }
            break;
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="study.php" method="post">
    <h3>Add/Update Data</h3>

    <label for="id">Id</label>
    <input type="text" name="id">

    <label for="firstname">First Name</label>
    <input type="text" name="firstname" required>

    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>
    <input type="hidden" name="action" value="update-add">


    <input type="submit" value="Save">
</form>
<hr>
<form action="study.php" method="post">
    <div><h3>Delete</h3></div>
    <label for="remove">Delete By Id</label>
    <input type="text" name="removeId">
    <input type="hidden" name="action" value="remove">
    <input type="submit" value="Delete">
</form>

<hr>
<div><h3>Search By First Name</h3></div>
<form action="study.php" method="post">
    <label for="search">Search </label>
    <input type="text" name="search">
    <input type="hidden" name="action" value="search">
    <input type="submit" name="Search">
</form>
<hr>

<?php
echo $result->num_rows;
if($result->num_rows>0){

    while($row = $result->fetch_assoc()){
        echo '<ul>';
        echo '<li>'.$row['id'].'</li>';
        echo '<li>'.$row['firstname'].'</li>';
        echo '<li>'.$row['lastname'].'</li>';
        echo '<li>'.$row['email'].'</li>';
        echo '</ul>';
    }
}
?>
</body>
</html>
