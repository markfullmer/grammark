'use strict';

function ContactController($scope, $http) {
  $scope.success = false;
  $scope.error = false;
  $scope.send = function () {

  var htmlBody = '<div>Name: ' + $scope.user.name + '</div>' +
                 '<div>Email: ' + $scope.user.email + '</div>' +
                 '<div>Message: ' + $scope.user.body + '</div>' +
                 '<div>Date: ' + (new Date()).toString() + '</div>';

    $http({
      url: 'https://api.postmarkapp.com/email',
      method: 'POST',
      data: {
        'From': 'foo@foo.com',
        'To': 'bar@bar.com',
        'HtmlBody': htmlBody,
        'Subject': 'New Contact Form Submission'
      },
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Postmark-Server-Token': '8569dcd45-6a1a-4e7b-ae75-ea37629de4'
      }
    }).
    success(function (data) {
        $scope.success = true;
        $scope.user = {};
    }).
    error(function (data) {
        $scope.error = true;
    });
  };
}
