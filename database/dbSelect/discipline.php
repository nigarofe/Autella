<?php

function selectDisciplines()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT * FROM discipline;";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Disciplinas selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar disciplinas!");
    }

    $connection->close();

    return $array;
}

function selectDisciplineNames($action)
{
    $array = selectDisciplines();

    for ($i = 0; $i < count($array); $i++) {
        if ($action == 0) {
            if ($array[$i][0] == $_SESSION["userData"]["id_discipline"]) {
                echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item" selected="selected">' . $array[$i][2] . '</option>';
            } else {
                echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][2] . '</option>';
            }
        } else if ($action == 1) {
            if (($i - 1) == -1) {
                echo '<option name="null" id="null" value="null" class="dropdown-item" selected="selected">Escolha...</option>';
            }

            echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][2] . '</option>';
        } else {
            echo '<option name="' . $array[$i][0] . '" id="' . $array[$i][0] . '" value="' . $array[$i][0] . '" class="dropdown-item">' . $array[$i][2] . '</option>';
        }
    }
}
