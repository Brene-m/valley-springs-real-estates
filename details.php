<?php
require 'header.php';
require 'config.php';
$id=$location=$price=$description=$condition=$image='';
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT `id`, `location`, `price`, `description`, `image`, `condition` FROM `houses` WHERE id='$id'";

    $user = mysqli_query($connection, $sql);

//loop through data from db
    while($row = mysqli_fetch_array($user)){
        $location = $row['location'];
        $price = $row['price'];
        $image = $row['image'];
        $description = $row['description'];
        $condition = $row['condition'];
    }
}
if(isset($_POST['update_btn']) and isset($_GET['id']) or isset($_FILES['uploadedFile'])){
    $id = $_GET['id'];
    echo "$id";

    if(isset($_POST['location'])){
        $location = $_POST['location'];
    }
    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }

    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $image = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $image);
    $fileExtension = strtolower(end($fileNameCmps));

    $extensions= array("jpeg","jpg","png");

    if(in_array($fileExtension,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if(empty($errors)==true) {
        move_uploaded_file($fileTmpPath,"images/".$image);
    }else{
        print_r($errors);
    }
//    echo $name;
//    $sql = "UPDATE `products` SET `name`='$name',`price`='$price',`description`='$description'],`product_condition`='$condition' WHERE id='$id'";
//    if(mysqli_query($conn,$sql)){
//        header('location:products.php?id= $_GET["id"]');
//    }
}
?>

<div class="container">
    <div class="jumbotron">
        <h2 class="content-title" style="text-align: center"><?php echo "My House"?></h2>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <?php
                    echo "<img src=images/$image class='card-img' style='width: 100%;height: 250px;border-bottom: 1px solid blue'>";
                ?>
            </div>
            <br>
            <div class="card">
              <p class="card-text" style="padding: 6px">
                <div class="card">
                    <form action="update_handler.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" class="form-control" name="location" value="<?php echo $location?>">
                                <input type="number" hidden name="id" value="<?php echo $id?>">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" name="price"  value="<?php echo $price?>">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" style="background-color:rgba(40, 61, 177, 0.13);" >
                                <?php echo $description ?>;
                            </textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="uploadedFile" class="form-control">
                            </div>
                            <div class="form-group">
                                <?php if ($condition == 'fair') {
                                    echo "<input type='radio' name='condition' value='good' checked ><span class='bg-info' style='padding: 6px;margin-left: 5px'>Fair</span>";
                                }elseif(($condition == 'good')){
                                    echo "<input type='radio' name='condition' value='good' checked ><span class='bg-success' style='padding: 6px;margin-left: 5px'>Good</span>";
                                }elseif (($condition == 'bad')){
                                    echo "<input type='radio' name='condition' value='good' checked ><span class='bg-danger' style='padding: 6px;margin-left: 5px'>Bad</span>";
                                }
                                ?>
                            </div>
                            <button type="submit" class="btn btn-dark" name="update_btn" >Update House</button>
                        </fieldset>
                    </form>
                </div>

                </p>
            </div>
        </div></div>
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
</div>



<?php
require 'footer.php';
?>