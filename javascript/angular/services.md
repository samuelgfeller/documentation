# Services
AngularJS services are substitutable objects that are wired together using dependency injection (DI). 
You can use services to organize and share code across your app.  

[Documentation](https://angular.io/tutorial/toh-pt4#services)

## Create service

```
ng generate service hero
```
The command generates skeleton HeroService class in `src/app/hero.service.ts` 

```
// src/app/hero.service.ts

import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class HeroService {

  constructor() { }

}
```

### Get data
In this example the data comes directly from a class but it could also come from a remote server.
#### Importing the class and data
```
import { Hero } from './hero';
import { HEROES } from './mock-heroes';
 ```
#### Adding function which returns the data
If the data comes from a remote server there is always a little delay. In the following **bad** way, the data 
has to be available directly. It will work only in this example since we use mock heroes but if it takes the data 
remotly there is going to be a problem.
```
getHeroes(): Hero[] {
  return HEROES;
}
```
Instead, we can use the Observable class from the [RxJS library](http://reactivex.io/rxjs/) which will get the data 
asynchronously.
**Import Observable**
```
//src/app/hero.service.ts 

import { Observable, of } from 'rxjs';
```
**Get data with Observable**
```
getHeroes(): Observable<Hero[]> {
  return of(HEROES);
}
```
**Use Observable data**  
The `HeroService.getHeroes` method returns an `Observable<Hero[]>`. It can be accessed with 
`.subscribe(heroes => this.heroes = heroes)`.
```
getHeroes(): void {
  this.heroService.getHeroes().subscribe(heroes => this.heroes = heroes);
}
```



#### Provide
https://angular.io/tutorial/toh-pt4#provide-the-heroservice  
Standard is 
By default, the Angular CLI command ng generate service registers a provider with the root injector for your 
service by including provider metadata in the @Injectable decorator.

### Inject and use data from service

```
import { Component, OnInit } from '@angular/core';
import {Hero} from '../hero';
import { HeroService } from '../hero.service';


@Component({
  selector: 'app-heroes',
  templateUrl: './heroes.component.html',
  styleUrls: ['./heroes.component.css']
})
export class HeroesComponent implements OnInit {
  // Defining variable
  selectedHero: Hero;
  heroes: Hero[];

  constructor(private heroService: HeroService) { }
  ngOnInit() {
    this.getHeroes();
  }

  getHeroes(): void {
    this.heroService.getHeroes().subscribe(heroes => this.heroes = heroes);
  }
  // Function onselect
  onSelect(hero: Hero): void {
    // Set the value of selectedHero
    this.selectedHero = hero;
  }
}
```

The service gets injected in the constructor. The parameter simultaneously defines a private `heroService` 
property and identifies it as a `HeroService` injection site.
While you could call getHeroes() in the constructor, that's not the best practice.

Reserve the constructor for simple initialization such as wiring constructor parameters to properties. 
The constructor shouldn't do anything. It certainly shouldn't call a function that makes HTTP requests to 
a remote server as a real data service would.
                                              

