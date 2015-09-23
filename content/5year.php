<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>RR
</head>
<body>
<!-- Заголовок сайта -->
<div id="header">
    <? include ("header.php");
    Menu($leftMenu, 1);
    echo "$slogan";?>
</div>
<!-- Конец заголовка сайта -->
<!-- Меню-->
<div>

</div>
<!-- Меню-->
<!-- Основной раздел сайта -->
<div id="content">
    <?
    include("main.php");
    drawTable($userPictures5Year);
    ?>
</div>
<!-- Конец основного раздела сайта -->
<!-- Футер сайта -->
<div id="footer">
    <?  $link= ArrowDown(basename(__FILE__));
        echo "<a href='$link'>"."<img src=$arrowdown></a>"; ?>
        &copy;<?= COPYRIGHT2 ?>
</div>
<!-- Конец футера -->
</body>
</html>