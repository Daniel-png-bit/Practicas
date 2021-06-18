<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DB;

class StudentController extends Controller
{
    public function getStudents(Request $request) {
        //$students = DB::table('students')->get();
        $students = Student::where([]);

        if (!empty($request['firstName'])) {
            $criteria = strtolower($request['firstName']);
            $students->whereRaw("LOWER(firstName) LIKE '%$criteria%'");
        }

        if (!empty($request['lastName'])) {
            $criteria = strtolower($request['lastName']);
            $students->whereRaw("LOWER(lastName) LIKE '%$criteria%'");
        }

        if (!empty($request['city'])) {
            $criteria = strtolower($request['city']);
            $students->whereRaw("LOWER(city) LIKE '%$criteria%'");
        }

        if (!empty($request['semester'])) {
            $students->where('semester', $request['semester']);
            // $request['semester'] == $request->input('semester') == $request->get('semester')
        }

        //$students = $students->get();
        $students = $students->paginate(3);

        return view('studentstable', [
            'students' => $students,
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'city' => $request['city'],
            'semester' => $request['semester']
        ]);
    }

    public function showStudentAdd() {
        return view('studentadd');
    }

    public function showStudentAddAngular() {
        return view('studentaddangular', [
            'pagetitle' => 'New Student'
        ]);
    }

    public function getStudent($id) {
        $student = Student::where('id', $id)->firstOrFail();
        return view('studentedit', [
            'student' => $student
        ]);
    }

    public function postStudent(Request $request) {
        Student::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'city' => $request->input('city'),
            'semester' => $request->input('semester')
        ]);
        return $this->getStudents();
    }

    public function putStudent(Request $request) {
        $student = Student::find($request->get('id'));
        $student->firstName = $request->get('firstName');
        $student->lastName = $request->get('lastName');
        $student->city = $request->get('city');
        $student->semester = $request->get('semester');
        $student->save();
        return $this->getStudents();
    }
}
