<?php

include 'QueryBuilder.php';
include 'Timetable.php';
include 'Schedule.php';
include 'func.php';
include 'connection.php';


if (isset($_POST['once'])) {
    $Schedule = new Schedule();
    $Schedule->destroy($_POST['once']);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}


if (isset($_POST['go'])) {

    $fac =  $_POST['fac'];

    $qb = new QueryBuilder();
    $sql = $qb->select(['*'])->from(['schedule'])->where(["faculty = $fac"])->get();

    $result = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $file) {
        unlink($file['pathfile']);
    }
    $mysqli->query("DELETE FROM `schedule` WHERE faculty = " . $fac . "");
}
