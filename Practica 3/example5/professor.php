<?php
    require 'person.php';

    class Professor extends Person implements JsonSerializable {
        private $yearsExperience;
        private $salary;

        public function __construct($firstName, $lastName, $city, $yearsExperience, $salary, $id = null) {
            parent::__construct($id, $firstName, $lastName, $city);
            $this->yearsExperience = $yearsExperience;
            $this->salary = $salary;
        }

        public function getYearsExperience() {
            return $this->yearsExperience;
        }

        public function setYearsExperience($yearsExperience) {
            $this->yearsExperience = $yearsExperience;
        }

        public function getSalary() {
            return $this->salary;
        }

        public function setSalary($salary) {
            $this->salary = $salary;
        }

        public function jsonSerialize() {
            return [
                'id' => $this->id,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'city' => $this->city,
                'yearsExperience' => $this->yearsExperience,
                'salary' => $this->salary
            ];
        }
    }

    $professor = new Professor('Pedro','Garcia','Cochabamba',3,5000,0);
    //echo json_encode($professor->jsonSerialize());

?>