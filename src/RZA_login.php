<?php include_once "utils.php" ?>
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



    }



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <?php include "header.php" ?>
        <main>
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
        <?php include "footer.php" ?>
    