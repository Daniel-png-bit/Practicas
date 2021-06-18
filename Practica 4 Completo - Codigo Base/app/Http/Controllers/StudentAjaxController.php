<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentAjaxController extends Controller
{
    public function getStudents() {
        return Student::all();
    }

    public function postStudent(Request $request) {
        $student = $request->all();
        return ['result' => Student::create($student)];
    }

    public function putStudent(Request $request) {
        $studentData = $request->all();
        $student = Student::find($studentData['id']);
        $student->firstName = $studentData['firstName'];
        $student->lastName = $studentData['lastName'];
        $student->city = $studentData['city'];
        $student->semester = $studentData['semester'];
        return ['result' => $student->save()];
    }

    public function deleteStudent($id) {
        Student::where('id', $id)->delete();
        return ['result' => true];
    }
}
