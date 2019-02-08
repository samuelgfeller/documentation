# Starting with AngularJS

## Installation
Comming soon.

## Getting started

### Structure 
```css  
img  
js  
|- controllers  
   |- MainController.js  
|- app.js  
index.html
```

### `app.js` creating a new Module 
In app.js, create a new module named myApp. A module contains the different components of an AngularJS app.
```js 
var app = angular.module("myApp", []);
```

### `index.html` Include the AngulareJS and add the module to html element

```html
<head>
    <!-- Include the AngularJS library -->
    <script      src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js">
    </script>
</head>
<body ng-app="myApp">
</body>
```
`ng-app` is called a directive. It tells AngularJS that the myApp module will live within the `<body>` element, 
termed the application's scope. In other words, the `ng-app` directive is used to define the application scope.

### `MainController.js` add data to the controller
In MainController.js a new controller named MainController is created. A controller manages the app's data.
Here the property title is used to store a string, and attach it to $scope.

```js 
app.controller('MainController', ['$scope', function($scope)
{
    $scope.title = 'This is a title';
    $scope.products = [ 
  { 
    name: 'The Book of Trees', 
    price: 19, 
    pubdate: new Date('2014', '03', '08'), 
    cover: 'img/the-book-of-trees.jpg' 
  }, 
  { 
    name: 'Program or be Programmed', 
    price: 8, 
    pubdate: new Date('2013', '08', '01'), 
    cover: 'img/program-or-be-programmed.jpg' 
  } 
]
}
```

### `index.html` display data from the Controller 
In index.html, we added `<div class="main" ng-controller="MainController">`. Like `ng-app`, `ng-controller` is a directive that 
defines the controller scope. This means that properties attached to $scope in MainController become available to use within 
`<div class="main">`.
Inside `<div class="main">` we accessed `$scope.title` using `{{ title }}`. 
This is called an expression. Expressions are used to display values on the page.

```html
<div class="main" ng-controller="MainController">
  <div class="container">
      <h1>{{ title }}</h1>
  </div>
```

### Filters
[`filter`](https://docs.angularjs.org/api/ng/filter/filter) are here to format the data in the view.
AngularJS gets the value of `product.price`.
It sends this number into the currency filter. The pipe symbol (|) takes the output on the left and "pipes" it to the right.
The filter outputs a formatted currency with the dollar sign and the correct decimal places. 
```html
  <p class="title">{{ product.name | uppercase }}</p> 
	<p class="price">{{ product.price | currency }}</p> 
	<p class="date">{{ product.pubdate | date }}</p> 
```

### Keywords
* A **module** contains the different components of an AngularJS app
* A **controller** manages the app's data
* An **expression** displays values on the page
* A **filter** formats the value of an expression

### Loop over data
`<div ng-repeat="product in products">`. Like `ng-app` and `ng-controller`, the `ng-repeat` is a directive. It loops through an array and displays each element. Here, the `ng-repeat` repeats all the HTML inside `<div class="col-md-6">` for each element in the products array.
In this way, `ng-repeat` shows both products in the `$scope.products` array. Instead of writing the same HTML twice as before, we just use `ng-repeat` to generate the HTML twice. 
The `ng-src` is a directive that sets the `<img>` element's src to a property in the controller.
	
```html
<div ng-repeat="product in products" class="col-md-6"> 
  <div class="thumbnail"> 
    <img src="img/the-book-of-trees.jpg"> 
    <p class="title">{{ product.name }}</p> 
    <p class="price">{{ product.price | currency }}</p> 
    <p class="date">{{ product.pubdate | date }}</p> 
    <img ng-src="{{ product.cover }}">
  </div> 
</div>
```

### Events over elements in loop 

#### index.html
```html
<div ng-repeat="product in products" class="col-md-6">
    <div class="thumbnail">
    	<img ng-src="{{ product.cover }}">
    	<p class="title">{{ product.name }}</p> 
	<p class="price">{{ product.price | currency }}</p> 
	<p class="date">{{ product.pubdate | date }}</p> 
	<div class="rating">
    	     <p class="likes" ng-click="plusOne($index)">+{{ product.likes }}</p> 
	     <p class="dislikes" ng-click="minusOne($index)">{{ product.dislikes }}</p>
	</div>
    </div> 
</div>
```
#### MainController.js
```js
app.controller('MainController', ['$scope', function($scope) { 
...
$scope.plusOne = function(index) { 
   $scope.products[index].likes += 1; 
};
$scope.minusOne = function(index){
   $scope.products[index].dislikes += 1;
}
}]);
```


----
##Source  
https://www.codecademy.com/fr/courses/learn-angularjs/