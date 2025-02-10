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
                 redirect("login.php");
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



<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card" style="width: 100%">
                <form method = "post" >
                    <div class="card-header">
                        <h1  class="text-center card-title">Riget Zoo Adventures</h1>
                        <h1 class="text-center card-title">Sign Up</h1>
                    </div>
                    <div class="card-body">    
                        <input name ="username" type="text" class=" form-control mt-5 p-3 border-black"  placeholder="Enter your username" required>
                        <input name="password" type="password" class=" form-control mt-5 p-3 border-black" placeholder="Enter your password" required>
                        <a href='login.php'><button type="button" class="mt-3 mx-auto btn btn-primary border-black">Login</button></a>
                        <button type="submit" name="login" class="mt-3 mx-auto btn btn-success border-black float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "include/footer.php";?>
