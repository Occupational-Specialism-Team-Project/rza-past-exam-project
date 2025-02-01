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
                 echo'<script> alert ("Data is updated")</script>';
              }else{
                 echo'<script> alert ("Data Not Updated")</script>';
              }
           }else{
            echo'<script> alert ("Data Not Updated")</script>';
           }
        }else{
            echo'<script> alert ("Data Not Updated")</script>';
            
        }
    }
const PAGE_TITLE = "Sign-up Page";
include_once "include/base.php";
?>



<div class="card" style="width: 100%">
    <form method = "post" >
        <div class="card-body">
            <h1  class="text-center card-title">Riget Zoo Adventures</h1>
            <h1 class="text-center card-title">Sign Up</h1>
            <input name ="username" type="text" class=" form-control mt-5 p-3 account-input card-input "  placeholder="Enter your username" require>
            <input name="password" type="password" class=" form-control mt-5 p-3 account-input card-input " placeholder="Enter your password" require>
            <button type="submit" name="login" class="mt-3 mx-auto col-2 rounded btn btn-success card-button">submit</button>
            <a href='login.php'><button type="button" class="mt-3 mx-auto col-2 rounded login-signup-button btn btn-primary card-button">login</button></a>
        </div>
    </form>
</div>

<?php include_once "include/footer.php";?>
<!-- 
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div> -->

<!-- 
<div class="container">
    
        <form method = "post" >
            <h1  class="text-center">Riget Zoo Adventures</h1>
            <h1 class="text-center">Sign Up</h1>
            <input name ="username" type="text" class=" form-control mt-5 p-3 account-input "  placeholder="Enter your username" require>
            <input name="password" type="password" class=" form-control mt-5 p-3 account-input " placeholder="Enter your password" require>
            <button type="submit" name="login" class="mt-3 mx-auto col-2 rounded btn btn-success">submit</button>
            <a href='login.php'><button type="button" class="mt-3 mx-auto col-2 rounded login-signup-button btn btn-primary">login</button></a>
            
        </form>
    </div> -->