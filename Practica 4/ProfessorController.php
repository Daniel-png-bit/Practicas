<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proffesor;
use DB;

class ProfessorController extends Controller
{
    public function getProfessors(Request $request) {
        $professors = Proffesor::where([]);

        if (!empty($request['firstName'])) {
            $criteria = strtolower($request['firstName']);
            $professors->whereRaw("LOWER(firstName) LIKE '%$criteria%'");
        }

        if (!empty($request['lastName'])) {
            $criteria = strtolower($request['lastName']);
            $professors->whereRaw("LOWER(lastName) LIKE '%$criteria%'");
        }

        if (!empty($request['city'])) {
            $criteria = strtolower($request['city']);
            $professors->whereRaw("LOWER(city) LIKE '%$criteria%'");
        }

        if (!empty($request['address'])) {
            $criteria = strtolower($request['address']);
            $professors->whereRaw("LOWER(address) LIKE '%$criteria%'");
        }

        if (!empty($request['salary'])) {
            $professors->where('salary', $request['salary']);
        }

        $professors = $professors->get();

        return view('professorstable', [
            'professors' => $professors,
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'city' => $request['city'],
            'address' => $request['address'],
            'salary' => $request['salary']
        ]);
    }

    public function showProfessorAdd() {
        return view('professorsadd');
    }

    public function getProfessor($id) {
        $professor = Proffesor::where('id', $id)->firstOrFail();
        return view('professoredit', [
            'professor' => $professor
        ]);
    }

    public function postProfessor(Request $request) {
        Proffesor::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'salary' => $request->input('salary')
        ]);

        return redirect('/professors');;
    }

    public function putProfessor(Request $request) {
        $professor = Proffesor::find($request->get('id'));
        $professor->firstName = $request->get('firstName');
        $professor->lastName = $request->get('lastName');
        $professor->city = $request->get('city');
        $professor->address = $request->get('address');
        $professor->salary = $request->get('salary');
        $professor->save();
        
        return redirect('/professors');
    }

    public function deleteProfessor($id) {
        $professor = Proffesor::where('id', $id);
        $professor -> delete();

        return redirect('/professors');
    }
}
