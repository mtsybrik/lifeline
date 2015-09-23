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
    $link = ArrowUp(basename(__FILE__));
    Menu($leftMenu, 1);
    echo "<a href='$link'>"."<img src=$arrow></a>";
    echo "$slogan";?>
</div>
<!-- Конец заголовка сайта -->
<!-- Меню-->
<div>

</div>
<!-- Меню-->
<!-- Основной раздел сайта -->
<div id="content">

</div>
<!-- Конец основного раздела сайта -->
<!-- Футер сайта -->
<div id="footer">
    &copy;<?= COPYRIGHT2 ?>
</div>
<!-- Конец футера -->
</body>
</html>