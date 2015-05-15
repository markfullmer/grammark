function pageCtrl ($scope, $routeParams, type) {
    $scope.title = "Page Not Found";
    $scope.postId = $routeParams.postId;
    switch ($routeParams.postId) {
        case 'about':
            $scope.title = "About";
            $scope.source = "models/about.html";
            break;
        case 'source':
            $scope.title = "Download";
            $scope.source = "models/source.html";
            break;
        case 'resources':
            $scope.title = "Resources";
            $scope.source = 'models/resources.html';
            $scope.data = [];
            break;
        case 'contact':
            $scope.title = "Contact";
            $scope.source = "models/contact.html";
            break;
    }
}
