<?php

    header("Content-Type: application/json");

    require 'student_dao.php';
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    $studentDAO = new StudentDAO();

    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET['id'])) {
                echo json_encode($studentDAO->findStudents());
            } else {
                echo json_encode($studentDAO->findStudentById($_GET['id']));
            }
            break;
        case 'POST':
            $jsonStudent = json_decode(file_get_contents("php://input"), true);
            $student = new Student(
                $jsonStudent['firstName'],
                $jsonStudent['lastName'],
                $jsonStudent['city'],
                $jsonStudent['semester']
            );
            echo json_encode(['result' => $studentDAO->save($student)]);
            break;
        case 'PUT':
            $jsonStudent = json_decode(file_get_contents("php://input"), true);
            $student = new Student(
                $jsonStudent['firstName'],
                $jsonStudent['lastName'],
                $jsonStudent['city'],
                $jsonStudent['semester'],
                $jsonStudent['id']
            );
            echo json_encode(['result' => $studentDAO->update($student)]);
            break;
        case 'DELETE':
            $queryString = $_SERVER['QUERY_STRING'];
            list($key, $value) = explode('=', $queryString);
            echo json_encode(['result' => $studentDAO->delete($value)]);
            break;
    }