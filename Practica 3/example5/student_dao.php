<?php
    require 'dbutil.php';
    require 'student.php';

    class StudentDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = DBUtil::getConnection();
        }

        public function findStudents() {
            $result = $this->pdo->query("SELECT id, first_name, last_name, city, semester FROM student");
            $students = [];

            while ($row = $result->fetch()) {
                array_push($students, new Student(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['semester'],
                    $row['id']
                ));
            }

            return $students;
        }

        public function findStudentById($id) {
            $stmt = $this->pdo->prepare("SELECT id, first_name, last_name, city, semester FROM student WHERE id=:id");
            $stmt->execute(['id' => $id]);

            if ($row = $stmt->fetch()) {
                $student = new Student(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['semester'],
                    $row['id']
                );

                return $student;
            }

            return null;
        }

        public function save($student) {
            try {
                $stmt = $this->pdo->prepare("INSERT INTO student(first_name, last_name, city, semester) " .
                                            "VALUES (:firstName, :lastName, :city, :semester)");
                $stmt->execute([
                    'firstName' => $student->getFirstName(),
                    'lastName' => $student->getLastName(),
                    'city' => $student->getCity(),
                    'semester' => $student->getSemester()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: '. $e->getMessage();
            }

            return 0;
        }

        public function update($student) {
            try {
                $stmt = $this->pdo->prepare("UPDATE student SET first_name=:firstName, last_name=:lastName," .
                                            "city=:city, semester=:semester WHERE id=:id");
                $stmt->execute([
                    'firstName' => $student->getFirstName(),
                    'lastName' => $student->getLastName(),
                    'city' => $student->getCity(),
                    'semester' => $student->getSemester(),
                    'id' => $student->getId()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: '. $e->getMessage();
            }

            return 0;
        }

        public function delete($id) {
            try {
                $stmt = $this->pdo->prepare("DELETE FROM student WHERE id=:id");
                $stmt->execute([
                    'id' => $id
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: '. $e->getMessage();
            }

            return 0;
        }
    }