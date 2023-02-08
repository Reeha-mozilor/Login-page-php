<?php

session_start();

if ($_SERVER["REQUEST_METHOD"]=="POST"){
$host_name="localhost";
$user_name="test";
$db_name="test";
$pass="test1234";

$conn=mysqli_connect($host_name,$user_name,$pass,$db_name);

if(mysqli_connect_error()){
    echo mysqli_connect_error();
    exit;
}


if(isset($_POST['uname'])&& isset($_POST['pass'])){

    function validate($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
}

$uname=validate($_POST['uname']);
$pass=validate($_POST['pass']);

if(empty($uname)){
    echo "Username is required"; 
}
elseif(empty($pass)){
    echo "Password is required"; 
}
else{

$sql="select * from user where user='$uname' and password='$pass'";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)===1){

    $row=mysqli_fetch_assoc($result);


    if($row['user']===$uname && $row['password']===$pass){
    echo $uname." logged in";
    $_SESSION['user_name']=$row['user'];

    }
}
else{
    echo "Incorrect credentials";
}
    

    
    
} }
?>


<html>
<head>
    <title>LOGIN</title>
    <meta charset="utf-8">
</head>
<body>

    <header>
    </header>

    <main>
    <div class="sec">
        <h1>Login Here</h1>
        <form method="post">
            <label>User</label>
            <input type="text" name="uname" placeholder="username/email" value="<?= $uname?>"><br>
            <label>Password</label>   
            <input type="password" name="pass" placeholder="Password" value="<?= $pass?>"><br>
            <button>Enter</button>
</div>
        </form>
    </main>
</body>
</html>