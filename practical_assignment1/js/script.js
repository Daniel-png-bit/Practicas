app.controller('AttractionsController', function($scope) {
    /** TO DO
        Complete all required code to complete the functionality of the application
    */
    $scope.attractions = new Array();
    $scope.productsChosen = new Array();

    $scope.view = {
        get total() {
            return _.sumBy($scope.productsChosen, prod => prod.subtotal );
        }
    };

    $scope.attractions.push(new Attraction(
        0,
        'Tiwanaku',
        'Located near La Paz City, it is undoubtedly one of the most outstanding cultural places in our country',
        './practical_assignment1/images/tiwanaku.jpg',
        8000
    ));

    $scope.attractions.push(new Attraction(
        1,
        'Uyuni Salt Flat',
        'This is by far one of the most beautiful places on earth. Come to Bolivia and visit it.',
        './practical_assignment1/images/uyuni.webp',
        10000
    ));

    $scope.attractions.push(new Attraction(
        2,
        'Villa Tunari',
        'This is one of Cochabamba\'s most beautiful places. There will always be something to do here.',
        './practical_assignment1/images/villa_tunari.jpg',
        2500
    ));

    $scope.chooseAttraction = (id) => {
        _.find($scope.productsChosen, p => p.id == id)
            ? alert("Product already chosen.")
            : $scope.attractions[id].numPeopleShown = true;
    }

    $scope.putFalseAttractions = () => {
        for (let attraction of $scope.attractions) {
            attraction.quantity = 1;
            attraction.numPeopleShown = false;
        }
    }

    $scope.addAttraction = (id) => {
        let attraction = _.find($scope.attractions, a => a.id == id);
        if (attraction.quantity <= 0) {
            alert("You must select minimun 1 person.");
        }
        else {
            let attractionClone = _.cloneDeep(attraction);
            attractionClone.subtotal = attractionClone.price * attractionClone.quantity;
            $scope.productsChosen.push(attractionClone);
            $scope.putFalseAttractions();                
        }
    }

    $scope.cancelAttraction = () => $scope.putFalseAttractions();

    $scope.deleteAttraction = (id) => {
        $scope.productsChosen = _.filter($scope.productsChosen, product => product.id != id);
    }


});



