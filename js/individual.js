function individualCtrl ($scope, $routeParams, textProperties) {
    $scope.title = $routeParams.postId;
/*    $scope.postId = $routeParams.postId;
    $scope.text = textProperties.getCurrent();

    /*
    $scope.text = textProperties.getCurrent();
    $scope.wordcount = textProperties.wordCount();
    $scope.$watch( 'text',
function(newValue, oldValue){
console.log('text Changed');
console.log(newValue);
console.log(oldValue);
}
);

    if (textProperties.getExisting() != textProperties.getCurrent()) {
        // Reprocess text
        $scope.text = textProperties.getCurrent();
        textProperties.setExisting($scope.text);
        textProperties.setCurrent($scope.text);
        console.log('run process on ' + $scope.text);
    }
    else {
        // Return existing values
        console.log('bypass processing ' + textProperties.getExisting());
        $scope.text = textProperties.getExisting();
        $scope.feedback = "Feedback goes here";
        $scope.img = "img/pass.png";
    }*/


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

/*function sourceText ($scope, $routeParams, sharedProperties) {

    var text = sharedProperties.getProperty();
    var clean = text;

}*/

