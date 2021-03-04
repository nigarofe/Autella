<?php

function selectTestQuestions($limit, $start, $end, $filter, $id_test)
{   
    //Pegando todas as questões que estão no id da prova
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    $sql = "SELECT id_question from autella.question_test where id_tests = $id_test ;";
    $resultIdTest = mysqli_query($connection, $sql);
    $arrayIdTest = [];

    if (mysqli_num_rows($resultIdTest) != 0) {
        while ($row = mysqli_fetch_array($resultIdTest)) {
            array_push($arrayIdTest, $row);
        }
    }

    $sql_limit = "";

    if ($limit) {
        $sql_limit = " LIMIT $start, $end;";
    }

    if (empty($filter)) {
        $id_discipline = "null";
        $id_subject = "question.id_subject";
        $dificulty = "";
        $creation_date = "";
        $status = " AND question.status = 1";
    } else {
        $id_discipline = $filter[0] == null ? "null" : $filter[0];
        $id_subject = $filter[1] == null ? "question.id_subject" : $filter[1];
        $dificulty = $filter[2] == null ? "" : " AND question.dificulty = $filter[2]";
        $creation_date = $filter[3] == null ? "" : " AND question.creation_date = '$filter[3]'";
        $status = $filter[4] == null ? " AND question.status = 1" : " AND question.status = $filter[4]";
    }
    
    if ($id_discipline == "null") {
        $array = [];
        for($i = 0; $i != count($arrayIdTest); $i ++){
        $idQuestion = $arrayIdTest[$i][0];
        $sql = "SELECT question.id, question.status, question.creation_date, question.dificulty, question.enunciate, question.correctAnswer, 
            user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
            JOIN user ON user.id = question.id_user 
            JOIN discipline 
            JOIN subject ON subject.id = question.id_subject 
            WHERE question.id = $idQuestion AND user.id_institution = " . $_SESSION["userData"]["id_institution"] . "
            AND discipline.id = subject.id_discipline" . $status .
            $dificulty . $creation_date . "
            ORDER BY discipline.name, subject.name " . $sql_limit;
            //echo $sql;
            $result = mysqli_query($connection, $sql);
            
        
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    array_push($array, $row);
                }
                // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
            } else {
                array_push($_SESSION['debug'], "Erro ao selecionar questões!");
            }
        
        }
    } else {
        $array = [];
        for($i = 0; $i != count($arrayIdTest); $i ++){
            $idQuestion = $arrayIdTest[$i][0];
        $sql = "SELECT question.id, question.status, question.creation_date, question.dificulty, question.enunciate, question.correctAnswer, 
            user.id_institution, question.id_user, discipline.id, discipline.name, subject.name FROM question 
            JOIN user ON user.id = question.id_user 
            JOIN discipline ON discipline.id = " . $id_discipline .
            " JOIN subject ON subject.id = " . $id_subject .
            " WHERE question.id = $idQuestion AND user.id_institution = " . $_SESSION["userData"]["id_institution"] .
            " AND discipline.id = subject.id_discipline AND subject.id = question.id_subject"
            . $status .
            $dificulty . $creation_date .
            " ORDER BY discipline.name, subject.name " . $sql_limit;
            //echo $sql;
            $result = mysqli_query($connection, $sql);
            
        
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    array_push($array, $row);
                   
                }
                // array_push($_SESSION['debug'], "Questões selecionadas com sucesso!");
            } else {
                array_push($_SESSION['debug'], "Erro ao selecionar questões!");
            }
        }
        
    }
    
   
    $connection->close();
    return $array;
}

function selectTestNames($question_id)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT tests.id, tests.name FROM question_test
            JOIN tests ON tests.id = question_test.id_tests
            WHERE question_test.id_question = " . $question_id;
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
        //array_push($_SESSION['debug'], "Nome das provas selecionados com sucesso!");
    } 
    
    $connection->close();

    return $array;
}

function selectAllFromQuestionTest() {
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT * FROM question_test";
    $result = mysqli_query($connection, $sql);
    $array = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($array, $row);
        }
    }

    $connection->close();

    return $array;
}
