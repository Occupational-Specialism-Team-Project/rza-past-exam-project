
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
$_SESSION['role']="admin";
$username=$_SESSION['role'];
if($_SESSION['role']=="admin"){
    if(isset($_POST['upload'])){
        $file_name= $_FILES['file']['name'];
        $tmp_location_name = $_FILES['file']['tmp_name'];
        $move_file=move_uploaded_file($tmp_location_name, 'uploads/'. $file_name);
        if($move_file){
            $insert_file = "INSERT INTO materials (username, files) VALUES (:username, :my_file)";
            $bind_parameter= array(
                ':my_file' => $file_name,
                ':username'=> $username
            );
            $result = insertpdo($insert_file, $bind_parameter);
            
        }else{
            echo"Error in moving the file";
        }
    }
}
$select_files ="SELECT * FROM materials";
$stmt = $pdo->prepare($select_files);
$stmt->execute();
$stmt->fetchAll();
var_dump($stmt);

?>
<?php
const PAGE_TITLE = "materialsdow Page";
include_once "include/base.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($_SESSION['role']=="admin"): ?>
    <form action=""  enctype="multipart/form-data" method="POST">
        <input type="file" name="file">
        <button name="upload" type="submit">UPLOAD</button>
    </form>
    <?php endif; ?>
    <div>

        <table>
            <tr>
                <th>ID</th>
                <th>File download</th>
            </tr><?php
         foreach ($stmt as $file):?>
         <?php
         $file_path = 'uploads/'. $file['files'];?>
            <tr>
                <td><?php echo $file['files'] ?></td>
                <td><?php echo'<a href="'.$file_path.'" download="' .$file['files'] . '">' .$file['files'].'</a> <br>';?></td>

            </tr>
        </table>
            <?php endforeach;?>
</body>
</html>