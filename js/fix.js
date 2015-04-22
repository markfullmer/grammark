function fixCtrl ($scope, $routeParams, sharedProperties) {

    $scope.postId = $routeParams.postId;
    $scope.title = $scope.postId;
    $scope.feedback = "Feedback goes here";
    $scope.img = "img/pass.png";
    $scope.text = sharedProperties.getProperty();
    switch ($routeParams.postId) {
        case 'passive':
            $scope.content = "This is my first post";
            break;
        case 'wordiness':
            $scope.content = "This is my first post";
            break;
        case 'academic':
            $scope.content = "Bye";
            break;
    }
}
