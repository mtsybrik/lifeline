<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
session_start(); // Starting Session
if(empty($_SESSION['login_user'])){
    header("Location: ../login.php");
    exit;}
require_once('connect.php');
$username = $_SESSION['login_user'];
$category_id=$_POST['category_id'];
$page = $_SESSION['page'];

        if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != ''){
            $uploaddir = 'img/';
            $uploadfile = '../' . $uploaddir . basename($_FILES["file"]["name"]);
            $uploadurl = $uploaddir . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile);
            echo "File is valid, and was successfully uploaded.";
            $picture_select = "SELECT * FROM pictures WHERE url = '$uploadurl'";
            $picture_select = $link->query($picture_select);
            if ($picture_select && $picture_select->num_rows > 0) {
                $pic_select_obj = $picture_select->fetch_object();
                $uploadurl = $pic_select_obj->id;
            } else {
                $query = "INSERT INTO pictures(url) VALUES ('$uploadurl')";
                mysqli_query($link, $query);
                $uploadurl = mysqli_insert_id($link);
            }
            $userId = "SELECT id FROM user WHERE login = '$username'";
            $userId = mysqli_query($link, $userId);
            $userId = mysqli_fetch_assoc($userId);
            $userId = $userId["id"];
            $achiev_type_id = "SELECT id FROM achiv_type WHERE name = '$page'";
            var_dump($achiev_type_id);
            $achiev_type_id = mysqli_query($link, $achiev_type_id);
            $achiev_type_id = mysqli_fetch_assoc($achiev_type_id);
            $achiev_type_id = $achiev_type_id["id"];
            $achiev_select1 = "SELECT * FROM achivements WHERE categories_id = '$category_id' AND achiv_type_id = '$achiev_type_id' AND user_id = '$userId'";
            $achiev_select = $link->query($achiev_select1);
            if ($achiev_select && $achiev_select->num_rows > 0) {
                $achiev_select_obj = $achiev_select->fetch_object();
                $achiev_select_id = $achiev_select_obj->id;
                $achiev_update = "UPDATE achivements SET pictures_id = '$uploadurl' WHERE id = '$achiev_select_id'";
                $achiev_update = mysqli_query($link, $achiev_update);
            } else {
                $achiev_insert = "INSERT INTO achivements (pictures_id, categories_id, achiv_type_id, user_id) VALUES ('$uploadurl','$category_id','$achiev_type_id', '$userId')";
                $achiev_insert = mysqli_query($link, $achiev_insert);
            }
            mysqli_close($link);
           }
        elseif(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] == ''){
            echo "Ooops. It looks like smth went wrong";

        }
?>