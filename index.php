<?php
include 'QueryBuilder.php';
include 'Timetable.php';
include 'Schedule.php';
include 'func.php';
include 'connection.php';

$qb = new QueryBuilder();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container">
    <form action="add.php" method="post" enctype="multipart/form-data">



        <div>
            <h2>Расписание</h2>
            <br>
            <input type="file" id="file" name="file[]" multiple>
            <br>
        </div>
        
        <select name="fa" class="form-select mt-3 w-25" aria-label="Default select example">
            <option value="1">СГФ</option>
            <option value="2">ФППО</option>
            <option value="3">ФФМК</option>
            <option value="4">ФЕМИ</option>
            <option value="5">ФХО</option>
            <option value="6">ФСБЖ</option>
        </select>
        <br>
        <div>
            <input name="go" value="Добавить" type="submit">
        </div>
    </form>

    <div class="row">
        <table class="table col-12 mx-auto table-borderless">

            <tbody class="d-flex justify-content-around">

                <?php

                $sql = $qb->select(['*'])->from(['faculties'])->get();

                $result = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);

                foreach ($result as $facult) {
                    $id = $facult['id']; ?>

                    <tr>
                        <th>
                            <form method="POST" action="delete.php">
                                <input value="<?= $id ?>" name="fac" type="hidden">
                                <input name="go" class="btn btn-outline-danger" value="Очистить" type="submit">
                            </form>
                        </th>

                        <th scope="row"><?= $facult['title'] ?></th>
                        <?php

                        $sql = $qb->select(['*'])->from(['schedule'])->where(["faculty = '$id'"])->groupBy(['title'])->get();

                        $result = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $file) { ?>
                            <td><a href="<?= $file['pathfile'] ?>"><?= stristr($file['title'], ".", true) ?></a></td>
                        <?php } ?>
                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>
    <style>
        form {
            margin-bottom: 0;
        }

        td,
        th {
            align-self: center;
        }



        tbody {
            display: flex;
        }

        th {
            display: flex;
            width: 100%;
            justify-content: center;

        }

        tr {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            width: 100%;
        }
    </style>


</div>