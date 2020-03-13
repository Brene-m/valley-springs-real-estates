<?php
require "header.php";
require "config.php";

$location = $price=$description=$image =$condition=$house_type='';
$location_err = $price_err=$description_err=$image_err=$house_type_err='';

if(isset($_POST['create_btn']) and isset($_FILES['uploadedFile'])) {
    $location = $_POST['location'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $condition = $_POST['condition'];
    $house_type = $_POST['house_type'];
//    echo "$name, $price, $description, $condition";
//    $image = $_POST['product_img'];


    if(!isset($location)){
        $location_err = "Fill in the field";
    }else{
        $location = cleaner($location);
    }

    if(!isset($price)){
        $price_err = "Fill in the field";
    }else{
        $price = cleaner($price);
    }

    if(!isset($condition)){
        $condition_err = "Fill in the field";
    }else{
        $condition = cleaner($condition);
    }
    if(!isset($house_type)){
        $condition_err = "Fill in the field";
    }else{
        $house_type = cleaner($house_type);
    }
    echo $location."<br>";
    echo $price."<br>";
    echo $description."<br>";
    echo $condition."<br>";
    echo $house_type."<br>";


//    process image image

    // get details of the uploaded file
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
    $sql = "INSERT INTO `houses`(`id`, `location`, `price`, `description`, `image`, `condition`, `house_type`) VALUES(NULL,'$location','$price','$description','$image','$condition','$house_type')";
    if(mysqli_query($connection,$sql)){
        $msg= "Product added successfuly";
        header('location:index.php');
        exit();
    }else{
//        $msg= "Product not added successfuly";
//        header('location:products.php?message');
//        exit();
        echo "Data not inserted ".mysqli_error($connection);
    }
}

function cleaner($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="container">
    <div class="jumbotron">
        <h2 class="content-title">Please add your House's details below</h2>
        <div class="message">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8">
            <table class="table table-stripped">
                <thead class="thead-dark">
                <tr>

                    <th scope="col">location</th>
                    <th scope="col">Price</th>
                    <th scope="col">Condition</th>
                    <th scope="col">House Type</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM `houses`";
                $houses = mysqli_query($connection,$sql);


                while($row = mysqli_fetch_array($houses)){
                    echo "<tr>";
                    $id = $row['id'];
                    $location = $row['location'];
                    $price = $row['price'];
                    $condition = $row['condition'];
                    $house_type = $row['house_type'];
                    $description = $row['description'];

                    echo "<td hidden> $id</td>";
                    echo "<td> $location</td>";
                    echo "<td> $price</td>";
                    echo "<td> $condition</td>";
                    echo "<td> $house_type</td>";
                    echo "<td> $description</td>";
                    echo "<td style='text-align: center'>";
                    echo "<a>";
                    echo "<a href='delete.php?id=$id' class='btn btn-danger' style='margin-right: 10px'>Delete</a>";
                    echo "<a href='details.php?id=$id' class='btn btn-primary'>View</a>";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" name="location">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" style="background-color:rgba(40, 61, 177, 0.13);" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="uploadedFile" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="house_type" value="bedsitter">bedsitter
                        <input type="radio" name="house_type" value="bungalow">Bungalow
                        <input type="radio" name="house_type" value="mansion">Mansion<br>
                        <input type="radio" name="house_type" value="Bungalow">Two Bedroom
                        <input type="radio" name="house_type" value="Bungalow">BBungalow

                    </div>
                    <div class="form-group">
                        <input type="radio" name="condition" value="good">Good
                        <input type="radio" name="condition" value="fair">Fair
                        <input type="radio" name="condition" value="bad">Bad <br>
                    </div>
                    <button type="submit" class="btn btn-dark" name="create_btn">Post House</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php
        $sql = "SELECT * FROM `products`";
        $products = mysqli_query($connection,$sql);
        while($row = mysqli_fetch_array($houses)){
            $id = $row['id'];
            $location = $row['location'];
            $price = $row['price'];
            $image = $row['image'];
            $description = $row['description'];
            $condition = $row['product_condition'];
            echo "<div class='col-md-3 col-lg-3 col-xl-3'>";
            echo "<div class='card' style='500px;width=200px'>";
            echo "<img src=images/$image class='card-img' style='width: 100%;height: 250px;border-bottom: 1px solid blue'>";

            echo "<div class='card-body'>";
            echo "<p>$location <br> $price <br></p>";
            echo "</div>";
            echo "<div></div>";
            echo "</div>";
            echo "</div>";
        }
        ?>

    </div>
</div>
<?php
require 'footer.php';
?>


