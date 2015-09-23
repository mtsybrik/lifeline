<?php
require 'Libs/cookies.php';
$page='';
if(isset($_GET['page'])){
    $page=trim(strip_tags($_GET['page']));
}
else{
    $page='now';
}
require 'Libs/functions.php';

if(empty($_SESSION['login_user'])){
        header("Location: login.php");
        exit;}
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="css/dropzone.css" type="text/css" rel="stylesheet" />
    <link href="css/cropimg.css" type="text/css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/cropimg.jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <script src="js/dropzone.js"></script>
</head>
<body>
    <!-- Заголовок сайта -->
    <div id="header">
        <? include 'header.php'; ?>
    </div>
    <!-- Конец заголовка сайта -->
    <!-- Меню-->
        <div>
        </div>
    <!-- Меню-->
    <!-- Основной раздел сайта -->
    <div id="content">
    <?
    switch($page){
        case"year":
            $_SESSION['page'] = 'year';
            drawTable($userPictures);
            break;
        case"5year":
            $_SESSION['page'] = '5year';
            drawTable($userPictures);
            break;
        case"life":
            $_SESSION['page'] = 'life';
            drawTable($userPictures);
            break;
        case"history":
            $_SESSION['page'] = 'history';
            break;
        default:
            $_SESSION['page'] = 'now';
            drawTable($userPictures);
            break;
    }

    ?>
    </div>
    <!-- Конец основного раздела сайта -->
    <!-- Футер сайта -->
    <div id="footer">
        <? include 'footer.php';?>
    </div>
    <!-- Конец футера -->
</body>
</html>