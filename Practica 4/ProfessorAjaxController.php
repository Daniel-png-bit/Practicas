<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proffesor;

class ProfessorAjaxController extends Controller
{
    public function getProfessors() {
        return Proffesor::all();
    }

    public function getProfessor($id) {
        $professor = Proffesor::where('id', $id)->firstOrFail();
        return [($professor)];
    }

    public function postProfessor(Request $request) {
        $professor = $request->all();
        return ['result' => Proffesor::create($professor)];
    }

    public function putProfessor(Request $request) {
        $professorData = $request->all();
        $professor = Proffesor::find($professorData['id']);
        $professor->firstName = $professorData['firstName'];
        $professor->lastName = $professorData['lastName'];
        $professor->city = $professorData['city'];
        $professor->address = $professorData['address'];
        $professor->salary = $professorData['salary'];
        return ['result' => $professor->save()];
    }

    public function deleteProfessor($id) {
        Proffesor::where('id', $id)->delete();
        return ['result' => true];
    }
}
