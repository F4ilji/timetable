<?php

include 'QueryBuilder.php';
include 'Timetable.php';
include 'Schedule.php';
include 'func.php';
include 'connection.php';

if (isset($_POST['go'])) {
    if (count($_FILES['file']) == 1) {
        $schedule = new Schedule(implode("", $_FILES['file']['name']), $_POST['fa'], $_FILES['tmp_name']);
        $schedule->save();
    } else {
        $timetable = new Timetable($_POST['fa'], $_FILES['file']);
        $files = $timetable->normalizeArray();
        foreach ($files as $file) {
            $schedule = new Schedule($file['name'], $_POST['fa'], $file['tmp_name']);
            $schedule->save();
        }
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
