@extends('layouts.master')
@section('title', 'Professors List')

@section('content')
<h1>
Professors list
</h1>
<form action="/professors" method="GET">
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
    <label for="txtAddress">
        Address
    </label>
    <input name="address" id="txtAddress" value="{{ $address }}" />
    <label for="txtSalary">
        Salary
    </label>
    <input name="salary" id="txtSalary" value="{{ $salary }}" />
    <input type="submit" value="Search" />
</form>
<table class="table table-danger table-striped table-hover">
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
                Address
            </th>
            <th>
                Salary
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($professors as $professor)
        <tr>
            <td>
                {{ $professor->firstName }}
            </td>
            <td>
                {{ $professor->lastName }}
            </td>
            <td>
                {{ $professor->city }}
            </td>
            <td>
                {{ $professor->address }}
            </td>
            <td>
                {{ $professor->salary }}
            </td>
            <td>
                <a class="btn btn-dark" href="/professors/{{ $professor-> id }}">Edit</a>
            </td>
            <td>                
                {{ Form::open(array('route' => array('professor.delete', $professor->id), 'method' => 'DELETE')) }}
                    @csrf
                    <input type="submit" class="btn btn-dark" value="Delete" />
                {{ Form::close() }}            
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="/professorsadd" class="btn btn-dark">New professor</a>
@stop