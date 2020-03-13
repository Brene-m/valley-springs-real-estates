<?php
require "config.php";

if (isset($_POST['update_btn'])){
    //if button is clicked
    //grab id first
    //grab from data
    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $location = $_POST['location'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $sql = "UPDATE `houses` SET `id`=NULL,`location`='$location',`price`='$price',`description`='$description',`image`='$image',`condition`='$condition' WHERE id = $id";
        //execute update instruction
        if (mysqli_query($connection,$sql)){
            header("location:index.php?id=$id");
            exit();
        }else{
            echo "ERROR".mysqli_error($connection);
        }









    }
}



















?>
