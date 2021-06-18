@extends('layouts.master')
@section('title', 'Edit Student')
@section('content')
<div class="container">
    <h2>Edit Student</h2>
    {{ Form::open(array('url' => '/students', 'method' => 'PUT')) }}
        @csrf
        <input name="id" type="hidden" value="{{ $student->id }}" />
        <div>
            <label for="txtFirstName">First Name</label>
            <input id="txtFirstName" name="firstName" value="{{ $student->firstName }}" />
        </div>
        <div>
            <label for="txtLastName">Last Name</label>
            <input id="txtLastName" name="lastName" value="{{ $student->lastName }}" />
        </div>
        <div>
            <label for="txtCity">City</label>
            <input id="txtCity" name="city" value="{{ $student->city }}" />
        </div>
        <div>
            <label for="txtSemester">Semester</label>
            <input id="txtSemester" name="semester" value="{{ $student->semester }}" />
        </div>
        <input type="submit" value="Submit" />
    {{ Form::close() }}
</div>
@stop