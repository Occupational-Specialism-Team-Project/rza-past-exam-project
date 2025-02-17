<?php
require_once "include/utils.php";?>
<?php
    if(isset($_POST['login'])){
        $username =($_POST['username']);
        $password =($_POST['password']);
        if(!empty($username) && !empty($password)){
            $select_user = "SELECT username , password , role_name FROM users WHERE username = :username";
            $prepare_select_statement = $pdo->prepare($select_user);
            $prepare_select_statement -> execute(array(":username" => $username));
            $fetch_record = $prepare_select_statement->fetch();
            if($fetch_record && password_verify($password, $fetch_record['password'])){
                $_SESSION['user'] = $fetch_record['username'];
                $_SESSION['role'] = $fetch_record['role_name'];
              redirect("index.php");
              


            }else{
                echo "<script>
                alert('invalid login')
              </script>";
            }
        }else{
            echo "<script>
                alert('invalid login')
              </script>";
        }
    }?>
<?php
const PAGE_TITLE = "Login Page";
include_once "include/base.php";
?>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card" style="width: 100%">
                <form method = "post" >
                    <div class="card-header">
                        <h1  class="text-center card-title">Riget Zoo Adventures</h1>
                        <h1 class="text-center card-title">Login</h1>
                    </div>
                    <div class="card-body">
                        <input name ="username" type="text" class=" form-control mt-5 p-3 account-input card-input "  placeholder="Enter your username" required>
                        <input name="password" type="password" class=" form-control mt-5 p-3 account-input card-input " placeholder="Enter your password" required>
                        <button type="submit" name="login" class="mt-3 mx-auto  btn btn-success submit-button">Submit</button>
                        <a href='sign_up.php'><button type="button" class="mt-3 mx-auto login-signup-button btn btn-primary">Sign-up</button></a>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "include/footer.php";
    




