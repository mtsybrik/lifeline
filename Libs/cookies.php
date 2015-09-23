<?php
$visitCount=0;
$lastVisit='';

if(isset($_COOKIE['visitCount'])){
    $visitCount=$_COOKIE['visitCount'];
}
if(isset($_COOKIE['lastVisit'])){
    $lastVisit=date('M d Y', $_COOKIE['lastVisit']);
}
if(date('M d Y', ($_COOKIE['lastVisit']))!==date('M d Y')){
    setcookie('visitCount', $visitCount, 0x7FFFFFFF);
    setcookie('lastVisit', time(), 0x7FFFFFFF);
    $visitCount++;
}
?>