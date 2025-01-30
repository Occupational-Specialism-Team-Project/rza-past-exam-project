<?php
require_once "include/utils.php";
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
     $insertdata = "INSERT INTO users (username,password)
     VALUES(:username,:password)";
      $stmt=$pdo->prepare($insertdata);
      $stmt->execute(array(
       ':username'=>$username,
       ':password'=>$password,
      ));
      if($insertdata){
          echo("inserted");
       }else{
          echo'<script> alert ("Data Not Updated")</script>';
       }
 
    }
const PAGE_TITLE = "Sign-up Page";
include_once "include/base.php";
?>
<div class="container">
        <form method = "post" >
            <h1 class="text-center">Riget Zoo Adventures</h1>
            <h1 class="text-center">sign up</h1>
            <input name ="username" type="text" class="form-control"  placeholder="Enter your username">
            <input name="password" type="password" class="form-control" placeholder="Enter your password">
            <button type="submit" name="login">submit</button>
            <button><a href=''>back</a></button>
        </form>
    </div>
<?php include_once "include/footer.php";