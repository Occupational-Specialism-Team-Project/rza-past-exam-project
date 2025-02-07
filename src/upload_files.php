
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
function selectAll($selectAllQuery){
    try{
      global $pdo; // Use the global $conn from config.php
  
      $stmt = $pdo->prepare($selectAllQuery);
      $stmt->execute();
      return $stmt->fetchAll(); //return all the rows fetched
  
    }catch(PDOException $e){
  
      echo "Select error" .  $e->getMessage();
     
    }
}  
$result=selectAll($select_files);



?>
<?php
const PAGE_TITLE = "materials download Page";
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
            <th>File download</th>
        </tr>
        <?php foreach ($result as $file): ?>
            <?php 
                $file_path = 'uploads/' . $file['files'];
            ?>
            <tr>
                <td>
                    <a href="<?php echo $file_path; ?>" download="<?php echo $file['files']; ?>">
                        <?php echo $file['files']; ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>