<?php
    header("Content-Type: application/json");
    require 'students_controller_class.php';
    $studentsController = new StudentsController();

    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET['id'])) {
                echo json_encode($studentsController->getStudents());
            } else {
                echo json_encode($studentsController->getStudentById($_GET['id']));
            }
            break;
        case 'POST':
            $jsonStudent = file_get_contents("php://input");
            echo json_encode(['result' => $studentsController->postStudent($jsonStudent)]);
            break;
        case 'PUT':
            $jsonStudent = file_get_contents("php://input");
            echo json_encode(['result' => $studentsController->putStudent($jsonStudent)]);
            break;
        case 'DELETE':
            $queryString = $_SERVER['QUERY_STRING'];
            list($key, $value) = explode('=', $queryString);
            echo json_encode(['result' => $studentsController->deleteStudent($value)]);
            break;
    }