function pageCtrl ($scope, $routeParams) {
    $scope.title = "Error";
    $scope.content = "No page with that ID";

    $scope.postId = $routeParams.postId;
    switch ($routeParams.postId) {
        case 'about':
            $scope.title = "About";
            $scope.content = "This is my first post";
            break;
        case 'source':
            $scope.title = "Download";
            $scope.content = "This is my first post";
            break;
        case 'resources':
            $scope.title = "Resources";
            $scope.content = "This is my first post";
            break;
        case 'contact':
            $scope.title = "Contact";
            $scope.content = "Bye";
            break;
    }
}
