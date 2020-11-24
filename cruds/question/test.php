<?php

function selectQuestionsT($limit, $start, $end, $filter)
{
    require $_SERVER["DOCUMENT_ROOT"] . "/utilities/dbConnect.php";

    $sql_final = "";

    if ($limit) {
        $sql_final = " ORDER BY subject.name LIMIT $start, $end;";
    } else {
        $sql_final = " ORDER BY subject.name;";
    }

    if (empty($filter)) {
        $id_discipline = $_SESSION["userData"]["id_discipline"];
        $id_subject = "question.id_subject";
        $dificulty = "";
        $date = "";
    } else {
        $id_discipline = $filter[0] == null ? $_SESSION["userData"]["id_discipline"] : $filter[0];
        $id_subject = $filter[1] == null ? "question.id_subject" : $filter[1];
        $dificulty = $filter[2] == null ? "" : " AND question.dificulty = $filter[2]";
        $date = $filter[3] == null ? "" : " AND question.date = $filter[3]";
    }

    $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON user.id = question.id_user" . "
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON subject.id = " . $id_subject . " AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] 
           . $dificulty . $date . $sql_final;
            echo $sql;
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
    } else {
        array_push($_SESSION['debug'], "Erro ao selecionar questões!");
    }

    $connection->close();
    return $array;
}

//question.id_user
//" AND subject.id_discipline = " . $id_discipline .
$filter = [];

$filter[0] = null;
$filter[1] = 9;
$filter[2] = null;
$filter[3] = null;

//$array = selectQuestionsT(true, 0, 5, $filter);
//var_dump($array);

/*
 $sql = "SELECT question.id, question.date, question.dificulty, question.enunciate, question.correctAnswer, question.id_user,
            user.id_institution, discipline.id, discipline.name, subject.name FROM question
            JOIN user ON user.id = question.id_user
            JOIN discipline ON discipline.id = " . $id_discipline . "
            JOIN subject ON subject.id = " . $id_subject . " AND subject.id_discipline = " . $id_discipline . "
            WHERE user.id_institution = " . $_SESSION["userData"]["id_institution"] . " 
            AND subject.id_discipline = " . $id_discipline . $dificulty . $date . $sql_final;
*/
