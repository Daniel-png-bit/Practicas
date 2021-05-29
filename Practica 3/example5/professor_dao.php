<?php
    require 'dbutil.php';
    require 'professor.php';

    class ProfessorDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = DBUtil::getConnection();
        }

        public function findProfessors() {
            $result = $this->pdo->query("SELECT id, first_name, last_name, city, years_experience, salary FROM professor");
            $professors = [];

            while ($row = $result->fetch()) {
                array_push($professors, new Professor(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['years_experience'],
                    $row['salary'],
                    $row['id']
                ));
            }

            return $professors;
        }

        public function findProfessorsById($id) {
            $stmt = $this->pdo->prepare("SELECT id, first_name, last_name, city, years_experience, salary FROM professor WHERE id=:id");
            $stmt->execute(['id' => $id]);

            if ($row = $stmt->fetch()) {
                $professor = new Professor(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['years_experience'],
                    $row['salary'],
                    $row['id']
                );

                return $professor;
            }

            return null;
        }

        public function SaveProfessor($professor) {
            try {
                $stmt = $this->pdo->prepare("INSERT INTO professor(first_name, last_name, city, years_experience, salary) " .
                                            "VALUES (:firstName, :lastName, :city, :yearsExperience, :salary)");
                $stmt->execute([
                    'firstName' => $professor->getFirstName(),
                    'lastName' => $professor->getLastName(),
                    'city' => $professor->getCity(),
                    'yearsExperience' => $professor->getYearsExperience(),
                    'salary' => $professor->getSalary(),
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: '. $e->getMessage();
            }

            return 0;
        }

        public function UpdateProfessor($professor) {
            try {
                $stmt = $this->pdo->prepare("UPDATE professor SET first_name=:firstName, last_name=:lastName," .
                                            "city=:city, years_experience=:yearsExperience, salary=:salary WHERE id=:id");
                $stmt->execute([
                    'firstName' => $professor->getFirstName(),
                    'lastName' => $professor->getLastName(),
                    'city' => $professor->getCity(),
                    'yearsExperience' => $professor->getYearsExperience(),
                    'salary' => $professor->getSalary(),
                    'id' => $professor->getId()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: '. $e->getMessage();
            }

            return 0;
        }

        public function DeleteProfessor($id) {
            try {
                $stmt = $this->pdo->prepare("DELETE FROM professor WHERE id=:id");
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
?>