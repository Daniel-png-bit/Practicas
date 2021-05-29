<?php

    require 'person.php';


    class Student extends Person implements JsonSerializable {
        private $semester;

        public function __construct($firstName, $lastName, $city, $semester, $id = null) {
            parent::__construct($id, $firstName, $lastName, $city);
            $this->semester = $semester;
        }

        public function getSemester() {
            return $this->semester;
        }

        public function setSemester($semester) {
            $this->semester = $semester;
        }

        public function jsonSerialize() {
            return [
                'id' => $this->id,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'city' => $this->city,
                'semester' => $this->semester
            ];
        }
    }