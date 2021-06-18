@extends('layouts.master')
@section('title', 'Edit Professor')
@section('content')
<div class="container">
    <h2>Edit Professor</h2>
    {{ Form::open(array('url' => '/professors', 'method' => 'PUT')) }}
        @csrf
        <input name="id" type="hidden" value="{{ $professor->id }}" />
        <div class="form-group">
            <label for="txtFirstName">First Name</label>
            <input id="txtFirstName" class="form-control" name="firstName" value="{{ $professor->firstName }}" />
        </div>
        <div class="form-group">
            <label for="txtLastName">Last Name</label>
            <input id="txtLastName" class="form-control" name="lastName" value="{{ $professor->lastName }}" />
        </div>
        <div class="form-group">
            <label for="txtCity">City</label>
            <input id="txtCity" class="form-control" name="city" value="{{ $professor->city }}" />
        </div>
        <div class="form-group">
            <label for="txtAddress">Address</label>
            <input id="txtAddress" class="form-control" name="address" value="{{ $professor->address }}" />
        </div>
        <div class="form-group">
            <label for="txtSalary">Salary</label>
            <input id="txtSalary" class="form-control" name="salary" value="{{ $professor->salary }}" />
        </div>
        <input type="submit" class="btn btn-dark" value="Submit" />
    {{ Form::close() }}
</div>
@stop