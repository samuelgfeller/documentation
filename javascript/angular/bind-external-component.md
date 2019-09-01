# Bind and display data in external component

### Create new component
```
ng generate component hero-detail
```

### Write template in the (sub) component

```html
<div *ngIf="hero">
  <h2>{{hero.name | uppercase}} Details</h2>
  <div><span>id: </span>{{hero.id}}</div>
  <div>
    <label>name:
      <input [(ngModel)]="hero.name" placeholder="name"/>
    </label>
  </div>
</div>
```

### Add the @Input() hero property

#### Import the class 
The HeroDetailComponent template binds to the component's hero property which is of type Hero.

```
import { Hero } from '../hero';
```

#### Enable possibility to get external value
The `@Input` makes it possible to populate a property from an external source and execute the components content.

First of all the `Input` has to be imported
```
import { Component, OnInit, Input } from '@angular/core';
```
In the HeroDetailComponent a property can be preceded by the `@Input()` decorator
```
@Input() hero: Hero;
```

### Display the sub component 
The two components will have a parent/child relationship. The parent HeroesComponent will control the child HeroDetailComponent by 
sending it a new hero to display whenever the user selects a hero from the list.  
The `HeroesComponent.selectedHero` is bound to the elements property like this
```
<app-hero-detail [hero]="selectedHero"></app-hero-detail>
```
In this way `HeroDetailComponent` class is called with the `hero` with the value of the `HeroesComponent.selectedHero`

`[hero]="selectedHero"` is an Angular [property binding](https://angular.io/guide/template-syntax#property-binding). 
It's a one way data binding from the selectedHero property of the HeroesComponent to the hero property of the target element

When the selectedHero changes, the property binding updates hero and the HeroDetailComponent displays the new hero.


----

https://angular.io/tutorial/toh-pt3#heroes-component-template






