@extends('layouts.master')
@section('title', 'New student')

@section('content')
<script type="text/javascript">
    var app = angular.module('StudentAddModule', []);
    app.controller('StudentAddController', ($scope, $http) => {
        $scope.student = {};

        $scope.addStudent = () => {
            $http.post('/ajaxstudents', $scope.student).then((result) => {
                console.log(result);
            })
        }
    })
</script>
<div class="container pl-5 pr-5" ng-app="StudentAddModule" ng-controller="StudentAddController">
    <h2>
    {{ $pagetitle }}
    </h2>
    <p>
        @{{ student.firstName }}
    </p>
    <form action="/students" method="POST">
        @csrf
        <div class="form-group">
            <label for="txtFirstName">First Name</label>
            <input id="txtFirstName" class="form-control" name="firstName" ng-model="student.firstName" />
        </div>
        <div class="form-group">
            <label for="txtLastName">Last Name</label>
            <input id="txtLastName" class="form-control" name="lastName" ng-model="student.lastName" />
        </div>
        <div class="form-group">
            <label for="txtCity">City</label>
            <input id="txtCity" class="form-control" name="city" ng-model="student.city" />
        </div>
        <div class="form-group">
            <label for="txtSemester">Semester</label>
            <input id="txtSemester" class="form-control" name="semester" ng-model="student.semester" />
        </div>
        <input type="button" class="btn btn-dark" value="Submit" ng-click="addStudent()" />
        <a href="/students" class="btn btn-dark">Back</a>
    </form>
</div>
@stop