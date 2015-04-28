function overviewCtrl ($scope, $routeParams, textProperties) {
    $scope.title = "Potential Problems";
    $scope.content = "Table goes here";
    $scope.text = textProperties.getCurrent();

}
