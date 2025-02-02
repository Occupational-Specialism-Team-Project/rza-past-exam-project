<?php
require_once "include/utils.php";
function insertpdo($insertdataquery , $bind_parameter){
    try{
        global $pdo; 
    
        $stmt = $pdo->prepare($insertdataquery);
        $stmt->execute($bind_parameter);
        return $stmt ;
    
      }catch(PDOException $e){
    
        echo "insert error" .  $e->getMessage();
       
      }

}
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(!empty($password)){
        $passwordhash= password_hash($password, PASSWORD_DEFAULT);
        if(!empty($username)){
            $insertdata = "INSERT INTO users (username,password,role_name) VALUES(:username ,:password ,'customer')";
            $bind_parameter= array(
                ':username' => $username ,
                ':password' => $passwordhash
            );
             $result = insertpdo($insertdata, $bind_parameter);


             if($result){
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
