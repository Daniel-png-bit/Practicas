var app = angular.module('practicalAssignment', ['ngRoute']);

app.config( ($routeProvider) => {
    $routeProvider
        .when('/', {
            templateUrl: 'mainMenu.html'
        })
        .when('/attractions', {
            templateUrl: './practical_assignment1/practical_assignment1.html',
            controller: 'AttractionsController'
        })
        .when('/videogame', {
            templateUrl: './practical_assignment2/juego.html',
            controller: 'GameController'
        });
});