<?php
require_once "include/utils.php";
function insertpdo($insertdataquery , $bind_parameter){
    $operation = [
        "result" => "",
        "error" => ""
    ];

    try{
        global $pdo; 
        $stmt = $pdo->prepare($insertdataquery);
        $operation["result"] = $stmt->execute($bind_parameter);
    } catch(PDOException $e){
        $operation["error"] = $e->getMessage();
    }

    return $operation;
}
if(!empty($_SESSION['role'])){
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
            $insertpdo = insertpdo($insert_file, $bind_parameter);
            
        }else{
            $insertpdo["error"]="failed to move file";
        }
    }
}

}

$select_files ="SELECT * FROM materials";
function selectAll($selectAllQuery){
    $operation = [
        "result" => "",
        "error" => ""
    ];

    try{
      global $pdo; // Use the global $conn from config.php
  
      $stmt = $pdo->prepare($selectAllQuery);
      $stmt->execute();
      $operation["result"] = $stmt->fetchAll(); //return all the rows fetched
    }catch(PDOException $e){
  
      $operation["error"] = $e->getMessage();
    }

    return $operation;
}  
$selectAll=selectAll($select_files);

const PAGE_TITLE = "Learning Materials";
include_once "include/base.php";

?>


<article>
    <?php if(!empty($_SESSION['role'])):?>
     <?php if($_SESSION['role']=="admin"): ?>
    <section class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card" style="width: 100%">
                        <div class="card-header">
                            <h1  class="text-center card-title">Upload Files</h1>
                        </div>
                        <div class="card-body">    
                            <form action=""  enctype="multipart/form-data" method="POST">
                                <input class="form-control" type="file" name="file" required> <br>
                                <button name="upload" type="submit" class="btn btn-success mb-3">UPLOAD</button>
                                <?php
                                    $insertpdo_error = isset($insertpdo["error"]) ? $insertpdo["error"] : FALSE;
                                    $insertpdo_error = $insertpdo["error"] ?? FALSE;
                                    $insertpdo["error"] ??= FALSE;
                                ?>
                                <?php if(isset($insertpdo)):?>
                                    <?php if($insertpdo["error"]):?>
                                        <div class="alert alert-danger" role="alert"><?php echo($insertpdo["error"]) ?></div>
                                    <?php elseif(isset($insertpdo["result"])):  ?>
                                        <div class="alert alert-success" role="alert">File uploaded successfully!</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endif; ?>
    <section class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card" style="width: 100%">
                        <div class="card-header">
                            <h1  class="text-center card-title">File Download</h1>
                        </div>
                        <div class="card-body">
                            <?php if(isset($selectAll)):?>
                                <?php if($selectAll["error"]):?>
                                    <div class="alert alert-danger" role="alert"><?php echo($selectAll["error"]) ?></div>
                                <?php elseif($selectAll["result"]):  ?>
                                    <?php foreach ($selectAll["result"] as $file): ?>
                                        <?php $file_path = 'uploads/' . $file['files'];?>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?php echo $file_path; ?>" download="<?php echo $file['files']; ?>"><?php echo $file['files']; ?></a></li>
                                        </ul>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">No files found!</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                </div>
            </div>
        </div>
    </section>
</article>




<?php include_once "include/footer.php"; ?>