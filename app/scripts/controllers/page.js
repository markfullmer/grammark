'use strict';

function pageController ($scope, $routeParams) {
    $scope.title = 'Page Not Found';
    switch ($routeParams.postId) {
        case 'about':
            $scope.title = 'About';
            $scope.source = 'scripts/models/about.html';
            break;
        case 'source':
            $scope.title = 'Download';
            $scope.source = 'scripts/models/source.html';
            break;
        case 'resources':
            $scope.title = 'Resources';
            $scope.source = 'scripts/models/resources.html';
            $scope.data = [];
            break;
        case 'contact':
            $scope.title = 'Contact';
            $scope.source = 'scripts/models/contact.html';
            break;
    }
}

pageController.$inject = ['$scope', '$routeParams'];
