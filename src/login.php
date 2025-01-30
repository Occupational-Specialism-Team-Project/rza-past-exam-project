


<?php
require_once "include/utils.php";?>
<?php
    if(isset($_POST['login'])){
        $username =($_POST['username']);
        $password =($_POST['password']);

        if(!empty($username) && !empty($password)){
            $select_user = "SELECT * FROM users WHERE username = :username";
            $prepare_select_statement = $pdo->prepare($select_user);
            $prepare_select_statement -> execute(array(":username" => $username));
            $fetch_record = $prepare_select_statement->fetch();


            if($fetch_record && password_verify($password, $fetch_record['password'])){
                $_SESSION['username'] = $fetch_record['username'];
                echo $_SESSION['username'];
                echo "<script>
                alert('valid login')
              </script>";
            // we can then change the window when the home page is done
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

<div class="container">
 <h1 class="text-center">Riget Zoo Adventures</h1>
 <h1 class="text-center">Log-in</h1>
    <form method = "post" >
        <input name ="username" type="text" class="form-control "  placeholder="Enter your username">
        <input name="password" type="password" class="form-control" placeholder="Enter your password">
        <button type="submit" name="login">submit</button>
        <a href='RZA_sign_up.php?'><button>Sign-up</a></button>
    </form>
</div>
<?php include_once "include/footer.php";
    