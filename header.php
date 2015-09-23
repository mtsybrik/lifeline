<?
//Menu($leftMenu);
if($page!="life"){
    echo "<a style='position:absolute; margin-top:10px' href='".ArrowUp($page)."'><img src='{$arrow}'></a>";
}
if($visitCount == 1){
    echo '<span style="float:right">Поздравляем с решением завести новый дневник!</span>';
    }
else{
    echo "<span style='float:right'>Молодец, ты открывал дневник $visitCount раз(а)!<br>
            Последний раз ты был здесь $lastVisit</span>";
    }
?>