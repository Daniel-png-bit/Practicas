<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('hello', [
        'hi' => 'Hello everyone'
    ]);
});*/

Route::get('/', 'App\Http\Controllers\TestController@show');

Route::get('/test', function () {
    /*return [
        'firstName' => 'Oscar',
        'lastName' => 'Contreras'
    ];*/

    $id = request('id');

    $data = [
        'one' => 'You selected one',
        'two' => 'You selected two'
    ];

    if (!array_key_exists($id, $data)) {
        abort(404, 'Not found');
    }

    return $data[$id] ?? 'There is nothing';
});

/*Route::get('/data/{id}', function ($id) {
    $data = [
        'one' => 'You selected one',
        'two' => 'You selected two'
    ];

    if (!array_key_exists($id, $data)) {
        abort(404, 'Not found');
    }

    return $data[$id] ?? 'There is nothing';
});*/

Route::get('/data/{id}', 'App\Http\Controllers\HelloController@hello');

/** 
 * EJERCICIO:
 * 
 * Por medio de make:controller crear la clase HolaMundoController
 * con el método hola que devuelve el json {"hola": "holaMundo"}
 * y asociar a la ruta /hola
 * 
 * 12:00
 */

Route::get('/students', 'App\Http\Controllers\StudentController@getStudents');
Route::get('/studentadd', 'App\Http\Controllers\StudentController@showStudentAdd');
Route::get('/studentaddangular', 'App\Http\Controllers\StudentController@showStudentAddAngular');
Route::post('/students', 'App\Http\Controllers\StudentController@postStudent');
Route::get('/students/{id}', 'App\Http\Controllers\StudentController@getStudent');
Route::put('/students', 'App\Http\Controllers\StudentController@putStudent');

Route::get('/ajaxstudents', 'App\Http\Controllers\StudentAjaxController@getStudents');
Route::post('/ajaxstudents', 'App\Http\Controllers\StudentAjaxController@postStudent');
Route::put('/ajaxstudents', 'App\Http\Controllers\StudentAjaxController@putStudent');
Route::delete('/ajaxstudents/{id}', 'App\Http\Controllers\StudentAjaxController@deleteStudent');

Route::get('/ajaxprofessors', 'App\Http\Controllers\ProfessorAjaxController@getProfessors');
Route::get('/ajaxprofessors/{id}', 'App\Http\Controllers\ProfessorAjaxController@getProfessor');
Route::post('/ajaxprofessors', 'App\Http\Controllers\ProfessorAjaxController@postProfessor');
Route::put('/ajaxprofessors', 'App\Http\Controllers\ProfessorAjaxController@putProfessor');
Route::delete('/ajaxprofessors/{id}', 'App\Http\Controllers\ProfessorAjaxController@deleteProfessor');

Route::get('/professors', 'App\Http\Controllers\ProfessorController@getProfessors');
Route::get('/professorsadd', 'App\Http\Controllers\ProfessorController@showProfessorAdd');
Route::get('/professors/{id}', 'App\Http\Controllers\ProfessorController@getProfessor');
Route::post('/professors', 'App\Http\Controllers\ProfessorController@postProfessor');
Route::put('/professors', 'App\Http\Controllers\ProfessorController@putProfessor');
Route::delete('/professors/{id}', 'App\Http\Controllers\ProfessorController@deleteProfessor')->name('professor.delete');