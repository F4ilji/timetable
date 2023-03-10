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
        $mysqli = new mysqli("localhost", "root", "", "database");
        move_uploaded_file($this->path, "uploads/$this->title");
        $mysqli->query("INSERT INTO `" . get_class($this) . "`(`title`, `faculty`, `pathfile`) VALUES ('" . $this->title . "','" . $this->faculty . "','uploads/" . $this->title . "')");
    }

    public function all()
    {
        $mysqli = new mysqli("localhost", "root", "", "database");
        return $mysqli->query("SELECT * FROM `" . get_class($this) . "`")->fetch_all(MYSQLI_ASSOC);
    }

    public function destroy($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "database");
        $qb = new QueryBuilder();
        $sql = $qb->select(['*'])->from(['schedule'])->where(["id = $id"])->get();
        $result = $mysqli->query($sql)->fetch_assoc();
        unlink($result['pathfile']);
        $mysqli->query("DELETE FROM `" . get_class($this) . "` WHERE `" . get_class($this) . "`.`id` = $id");
        
    }

    
}
