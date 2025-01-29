<?php include_once "utils.php" ?>
<?php

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
        <?php include "footer.php" ?>
    