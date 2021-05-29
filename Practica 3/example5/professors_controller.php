<?php
    header("Content-Type: application/json");

    require 'professor_dao.php';
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    $professorDAO = new ProfessorDAO();

    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET['id'])) {
                echo json_encode($professorDAO->findProfessors());
            } else {
                echo json_encode($professorDAO->findProfessorsById($_GET['id']));
            }
            break;
        case 'POST':
            $jsonProfessor = json_decode(file_get_contents("php://input"), true);
            $professor = new Professor(
                $jsonProfessor['firstName'],
                $jsonProfessor['lastName'],
                $jsonProfessor['city'],
                $jsonProfessor['yearsExperience'],
                $jsonProfessor['salary']
            );
            echo json_encode(['result' => $professorDAO->SaveProfessor($professor)]);
            break;
        case 'PUT':
            $jsonProfessor = json_decode(file_get_contents("php://input"), true);
            $professor = new Professor(
                $jsonProfessor['firstName'],
                $jsonProfessor['lastName'],
                $jsonProfessor['city'],
                $jsonProfessor['yearsExperience'],
                $jsonProfessor['salary'],
                $jsonProfessor['id']
            );
            echo json_encode(['result' => $professorDAO->UpdateProfessor($professor)]);
            break;
        case 'DELETE':
            $queryString = $_SERVER['QUERY_STRING'];
            list($key, $value) = explode('=', $queryString);
            echo json_encode(['result' => $professorDAO->DeleteProfessor($value)]);
            break;
    }
?>