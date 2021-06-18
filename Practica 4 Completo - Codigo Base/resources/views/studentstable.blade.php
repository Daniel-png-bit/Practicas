@extends('layouts.master')
@section('title', 'Students List')

@section('content')
<h1>
Students list
</h1>
<form action="/students" method="GET">
    <label for="txtFirstName">
        First name
    </label>
    <input name="firstName" id="txtFirstName" value="{{ $firstName }}" />
    <label for="txtLastName">
        Last name
    </label>
    <input name="lastName" id="txtLastName" value="{{ $lastName }}" />
    <label for="txtCity">
        City
    </label>
    <input name="city" id="txtCity" value="{{ $city }}" />
    <label for="txtSemester">
        Semester
    </label>
    <input name="semester" id="txtSemester" value="{{ $semester }}" />
    <input type="submit" value="Search" />
</form>
<table class="table table-dark table-striped table-hover">
    <thead>
        <tr>
            <th>
                First name
            </th>
            <th>
                Last name
            </th>
            <th>
                City
            </th>
            <th>
                Semester
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>
                {{ $student->firstName }}
            </td>
            <td>
                {{ $student->lastName }}
            </td>
            <td>
                {{ $student->city }}
            </td>
            <td>
                {{ $student->semester }}
            </td>
            <td>
                <a href="/students/{{ $student->id }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="/studentadd" class="btn btn-dark">New student</a>
@stop