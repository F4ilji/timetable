<?php

include 'Model.php';

class Timetable extends Model
{
    public string $faculty;
    public array $files;

    function __construct($faculty = "", $files = [])
    {
        $this->faculty = $faculty;
        $this->files = $files;
    }

    public function normalizeArray()
    {
        foreach ($this->files as $key_name => $value) {

            foreach ($value as $key => $item) {

                $normalizeArray[$key][$key_name] = $item;
            }
        }
        return $normalizeArray;
    }

    public function sortingArray($files)
    {
        function sarting($a, $b)
        {
            return $a['name'] <=> $b['name'];
        }
        usort($files, 'sarting');

        return $files;
    }

    public function all(): Timetable
    {
        $mysqli = new mysqli("localhost", "root", "", "database");
        $this->files = $mysqli->query("SELECT * FROM `Schedule`")->fetch_all(MYSQLI_ASSOC);
        return $this;     
    }




}
