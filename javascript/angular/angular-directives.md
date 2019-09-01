# Angular directive

## Description
Coming soon...

## Set up
#### `MainController.js` 
**js/controllers/MainController.js**
```js
app.controller('MainController', ['$scope', function($scope) {
  $scope.move = {
    icon: 'img/move.jpg',
    title: 'MOVE',
    developer: 'MOVE, Inc.',
    price: 0.99
  };

  $scope.shutterbugg = {
    icon: 'img/shutterbugg.jpg',
    title: 'Shutterbugg',
    developer: 'Chico Dusty',
    price: 2.99
  };
}]);
```

#### `appInfo.js`
```js
app.directive('appInfo', function() { 
  return { 
    restrict: 'E', 
    scope: { 
      info: '=' 
    }, 
    templateUrl: 'js/directives/appInfo.html' 
  }; 
});
```
First in **js/directives/appInfo.js**, we made a new directive. We used `app.directive` 
to create a new directive named 'appInfo'. It returns an object with three options:  
1. `restrict` specifies how the directive will be used in the view. The `'E'` means it will 
be used as a new HTML element.
2. scope specifies that we will pass information into this directive through an attribute 
named `info`. The `=` tells the directive to look for an attribute named `info` in the 
`<app-info>` element, like this: 
    ```html
    <app-info info="shutterbugg"></app-info>
    ```
    The data in info becomes available to use in the template given by templateURL.
3. `templateUrl` specifies the HTML to use in order to display the data in `scope.info`. 
Here we use the HTML in **js/directives/appInfo.html**.

#### `appInfo.html`
Looking at **js/directives/appInfo.html**, we define the HTML to display details about an app, 
like its title and price. We use expressions and filters to display the data.
```angular2html
<img class="icon" ng-src="{{ info.icon }}"> 
<h2 class="title">{{ info.title }}</h2> 
<p class="developer">{{ info.developer }}</p> 
<p class="price">{{ info.price | currency }}</p>
```

#### `index.html`
Then in `index.html` we use the new directive as the HTML element `<app-info>`. 
We pass in objects from the controller's scope (`$scope.shutterbugg`) into the `<app-info>` 
element's `info` attribute so that it displays.
```angular2html
<div class="card">
    <app-info info="move"></app-info> 
</div>
<div class="card">
    <app-info info="shutterbugg"></app-info>
</div>

<script src="js/directives/appInfo.js">
```

## Loop over Custom directive with `ng-repeat`  
`ng-repeat` and `ng-click` are built-in directives.

#### `MainController.js`
```js
$scope.apps = [ 
        {
            icon: 'img/move.jpg', 
	    title: 'MOVE', 
	    developer: 'MOVE, Inc.', 
	    price: 0.99 
	}, 
	{ 
	    icon: 'img/shutterbugg.jpg', 
	    title: 'Shutterbugg', 
	    developer: 'Chico Dusty', 
	    price: 2.99 
	}
];
```

#### `index.html`
```html
<div class="main" ng-controller="MainController">
  <div class="card" ng-repeat="app in apps">
    <app-info info="app"></app-info>
  </div>
</div>
```

## Directive which reacts to user's click
This new directive **js/directives/installApp.js** contains the option `link` which is used to
create interactive directives that respond to user action.  

The link function takes three inputs:
1. `scope` refers to the directive's scope. Any new properties attached to `$scope` will become 
available to use in the directive's template.
2. `element` refers to the directive's HTML element.
3. `attrs` contains the element's attributes.
Inside the `link` function, there are two properties `buttonText` and `installed`, 
and the function `download()`.
```js
app.directive('installApp', function() {
  return {
    restrict: 'E',
    scope: {},
    templateUrl: 'js/directives/installApp.html',
    
    link: function(scope, element, attrs) {
      scope.buttonText = "Install",
      scope.installed = false,

      scope.download = function() {
        element.toggleClass('btn-active')
        if(scope.installed) {
          scope.buttonText = "Install";
          scope.installed = false;
        } else {
          scope.buttonText = "Uninstall";
          scope.installed = true;
        }
      }
    }
  };
});
```

#### `installApp.html`
**js/directives/installApp.html**
```html
<button class="btn btn-active" ng-click="download()"> 
  {{ buttonText }} 
</button>
```
#### `index.html`
```html
<div class="card" ng-repeat="app in apps">
  <app-info info="app"></app-info>
  <install-app></install-app>
</div>

<!-- Directives -->
<script src="js/directives/appInfo.js"></script>
<script src="js/directives/installApp.js"></script>
```


----
##Source  
https://www.codecademy.com/de/courses/learn-angularjs