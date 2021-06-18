@extends('layouts.master')
@section('title', 'New student')

@section('content')
<div class="container pl-5 pr-5">
    <h2>
    New Professor
    </h2>
    <form action="/professors" method="POST">
        @csrf
        <div class="form-group">
            <label for="txtFirstName">First Name</label>
            <input id="txtFirstName" class="form-control" name="firstName" />
        </div>
        <div class="form-group">
            <label for="txtLastName">Last Name</label>
            <input id="txtLastName" class="form-control" name="lastName" />
        </div>
        <div class="form-group">
            <label for="txtCity">City</label>
            <input id="txtCity" class="form-control" name="city" />
        </div>
        <div class="form-group">
            <label for="txtAddress">Address</label>
            <input id="txtAddress" class="form-control" name="address" />
        </div>
        <div class="form-group">
            <label for="txtSalary">Salary</label>
            <input id="txtSalary" class="form-control" name="salary" />
        </div>
        <input type="submit" class="btn btn-dark" value="Submit" />
        <a href="/professors" class="btn btn-dark">Back</a>
    </form>
</div>
@stop