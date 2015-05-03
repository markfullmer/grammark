angular-underscore-module - Use Underscore from an Angular Controller or Service
======


## Usage

0. Make sure you have included underscore.js in your project

    ```<script src="bower_components/underscore/underscore.js">```

1. get it 

   ```bower install angular-underscore-module```

2. Add angular-underscore-module.js to your main file (index.html)

    ```<script src="bower_components/angular-underscore-module/angular-underscore-module.js"></script>```

3. Add the module as a dependency in your App definition

   ```javascript
  var myapp = angular.module('MyApp', ['underscore'])
   ```

4. To use, add as an injected dependency to your Controller/Service and it is ready to use

    ```javascript
  angular.module('MyApp')
  .controller('MyCtrl', function ($scope, _) {
  ...
  //Use underscore
   _.each(...);
  ...
  ```

  References:
  
 Underscore:
 http://underscorejs.org/
 Stackoverflow:
 http://stackoverflow.com/questions/14968297/use-underscore-inside-controllers
 Github:
 https://github.com/andresesfm/angular-underscore-module
