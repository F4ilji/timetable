<?php

include 'connection.php';

class Schedule
{
    public string $title = "";
    public int $faculty = 0;
    public string $path = "";

    public function __construct(string $title = "", int $faculty = 0, string $path = "")
    {
        $this->title = $title;
        $this->faculty = $faculty;
        $this->path = $path;
    }

    public function save()
    {
        $mysqli = new mysqli("localhost", "root", "root", "database");
        move_uploaded_file($this->path, "uploads/$this->title");
        $mysqli->query("INSERT INTO `" . get_class($this) . "`(`title`, `faculty`, `pathfile`) VALUES ('" . $this->title . "','" . $this->faculty . "','uploads/" . $this->title . "')");
    }

    public function all()
    {
        $mysqli = new mysqli("localhost", "root", "root", "database");
        return $mysqli->query("SELECT * FROM `" . get_class($this) . "`")->fetch_all(MYSQLI_ASSOC);
    }

    
}
