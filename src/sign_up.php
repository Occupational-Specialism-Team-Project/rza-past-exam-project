<?php
require_once "include/utils.php";
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(!empty($password)){
        $passwordhash= password_hash($password, PASSWORD_DEFAULT);
        if(!empty($username)){
            $insertdata = "INSERT INTO users (username,password,role_name) VALUES(:username,:password,'customer')";
             $stmt=$pdo->prepare($insertdata);
             $stmt->execute(array(
              ':username'=>$username,
              ':password'=>$passwordhash,
             ));
             if($insertdata){
                 echo("inserted");
              }else{
                 echo'<script> alert ("Data Not Updated")</script>';
              }
           }
        }
    }
const PAGE_TITLE = "Sign-up Page";
include_once "include/base.php";
?>
<div class="container">
        <form method = "post" >
            <h1  class="text-center">Riget Zoo Adventures</h1>
            <h1 class="text-center">Sign Up</h1>
            <input name ="username" type="text" class=" form-control mt-5 p-3 account-input "  placeholder="Enter your username">
            <input name="password" type="password" class=" form-control mt-5 p-3 account-input " placeholder="Enter your password">
            <button type="submit" name="login" class="mt-3 mx-auto col-2 rounded btn btn-success">submit</button>
            <a href='login.php'><button type="button" class="mt-3 mx-auto col-2 rounded login-signup-button">login</button></a>
            
        </form>
    </div>
<?php include_once "include/footer.php";