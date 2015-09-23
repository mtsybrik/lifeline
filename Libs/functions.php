<?php

session_start(); // Starting Session
if(empty($_SESSION['login_user'])){
    header("Location: login.php");
    exit;}
require('connect.php');

$username = $_SESSION['login_user'];
$userPictures = array();
$userId = "SELECT id FROM user WHERE login = '$username'";
$userId = mysqli_query($link, $userId);
$userId = mysqli_fetch_assoc($userId);
$userId = $userId["id"];
$achiev_type_id = "SELECT id FROM achiv_type WHERE name = '$page'";
$achiev_type_id = mysqli_query($link, $achiev_type_id);
$achiev_type_id = mysqli_fetch_assoc($achiev_type_id);
$achiev_type_id = $achiev_type_id["id"];

$default_userId = "SELECT id FROM user WHERE login = 'default'";
$default_userId = mysqli_query($link, $default_userId);
$default_userId = mysqli_fetch_assoc($default_userId);
$default_userId = $default_userId["id"];

$i=1;
do {
    $achiev_select1 = "SELECT * FROM achivements WHERE categories_id = '$i' AND achiv_type_id = '$achiev_type_id' AND user_id = '$userId'";
    $achiev_select = $link->query($achiev_select1);

    if ($achiev_select && $achiev_select->num_rows > 0){
        $achiev_select_obj = $achiev_select->fetch_object();
        $achiev_select_pic_id = $achiev_select_obj->pictures_id;

        $picurl= $link->query("SELECT url FROM pictures WHERE id='$achiev_select_pic_id'");
        if ($picurl && $picurl->num_rows > 0) {
        $picurl_obj = $picurl->fetch_object();
        $picurl = $picurl_obj->url;
        $userPictures[$i]= $picurl;
        }
    }
    else {
        $achiev_select1 = "SELECT * FROM achivements WHERE categories_id = '$i' AND achiv_type_id = '$achiev_type_id' AND user_id = '$default_userId'";
        $achiev_select = $link->query($achiev_select1);
        if ($achiev_select && $achiev_select->num_rows > 0)
            {
            $achiev_select_obj = $achiev_select->fetch_object();
            $achiev_select_pic_id = $achiev_select_obj->pictures_id;
            $picurl= $link->query("SELECT url FROM pictures WHERE id='$achiev_select_pic_id'");
            $picurl_obj = $picurl->fetch_object();
            $picurl = $picurl_obj->url;
                $userPictures[$i]= $picurl;
        }
        else{
            $userPictures[$i]= 'img/fail.png';
        }
    }
    $i++;
}
while ($i < 10);

function drawTable($pictures){
    echo '<script>
            $(document).ready(function() {
              $("img.cropimg").cropimg({
                resultWidth:600,
                resultHeight:300,
                /*onChange: function() {
                  $("#preview-container").show();
                }*/
              });
            });
            </script><table align="center" style="width: 96%">';
    $i = 0;
    $category_id = 1;
    foreach ($pictures as $category => $filepath) {
        if($i % 3 == 0){
            echo "<tr>";
        }
        echo "<td>";
        echo '<form action="Libs/upload.php" method="POST" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone" style="margin:0 auto">
        <input type="hidden" name="category_id" value="'.$category_id.'"/>
        <img src = "'.$filepath.'" alt="crop img" class="cropimg" >
        </form>
                </td>';
        if($i % 3 == 2) {
            echo "</tr>";
        }
        if($i==9){
            return;
        }
        $i++;
        $category_id++;
        }
    echo '</table>';
}
$leftMenu= array(
    array(
        'link'=>'index.php?page=now',
        'label'=>'Настоящее'),
    array(
        'link'=>'index.php?page=history',
        'label'=>'История'),
    array(
        'link'=>'index.php?page=year',
        'label'=>'Планы на год'),
    array(
        'link'=>'index.php?page=5year',
        'label'=>'Планы на 5 лет'),
    array(
        'link'=>'index.php?page=life',
        'label'=>'Планы на жизнь')
);
$horizontal=true;
?>
<?
function Menu($buttons,$alignment=false)
{
    echo '<ul>';
    foreach ($buttons as $item) {
        echo "<li><a href='{$item['link']}'>" . "{$item['label']}</a></li>";
    };
    echo "</ul> </nav>";
}
function ArrowUp($filename){
    $result='';
    if($filename == NULL || $filename == 'now'){
        $result='index.php?page=year';
    }
    elseif($filename =='year'){
        $result ='index.php?page=5year';
    }
    elseif($filename =='5year'){
        $result= 'index.php?page=life';
    }
    elseif($filename =='history'){
        $result ='index.php?page=now';
    }
    return $result;
}
function ArrowDown($filename){
    $result='';
    if($filename == NULL || $filename == 'now'){
        $result='index.php?page=history';
    }
    elseif($filename=='year'){
        $result='index.php?page=now';
    }
    elseif($filename=='5year'){
        $result='index.php?page=year';
    }
    elseif($filename=='life'){
        $result='index.php?page=5year';
    }
    return $result;

}
$arrow='img/arrow.png';
$arrowDown='img/ArrowDown.png';
$slogan = 'Playhard, work smart.';

//    const COPYRIGHT2 = "APPLIS 2015";
mysqli_close($link);
?>