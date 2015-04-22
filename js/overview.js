function overviewCtrl ($scope, $routeParams, sharedProperties) {
    $scope.title = "Potential Problems";
    $scope.content = "Table goes here";
    $scope.text = sharedProperties.getProperty();

}
