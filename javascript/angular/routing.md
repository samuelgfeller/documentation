# Routing 

### Generate route module

```
ng generate module app-routing --flat --module=app
```

> --flat puts the file in src/app instead of its own folder.  
> --module=app tells the CLI to register it in the imports array of the AppModule.

### Add routes

The generated file and routes in it looks like this:
```
import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {HeroesComponent} from './heroes/heroes.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import { HeroDetailComponent } from './hero-detail/hero-detail.component';

const routes: Routes = [
    { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
    { path: 'heroes', component: HeroesComponent },
    { path: 'dashboard', component: DashboardComponent },
    { path: 'detail/:id', component: HeroDetailComponent }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)], exports: [RouterModule]
})
export class AppRoutingModule {
}
```

#### Redirect to other route
A redirect can be done like this:
```
const routes: Routes = [
    { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
];
```

### Display routed views
```
//src/app/app.component.html

<h1>{{title}}</h1>
<router-outlet></router-outlet>
```

### Add navigation link
The `routerLink` is the selector for the RouterLink directive that turns user clicks into router navigations. 
It's another of the public directives in the RouterModule.

```
<nav>
  <a routerLink="/dashboard">Dashboard</a>
  <a routerLink="/heroes">Heroes</a>
</nav>
```

#### Parameterized Routes
A URL like `~/detail/11` would be a good URL for navigating to the Hero Detail view of the hero whose id is 11.
The path can be inserted like this in the `AppRoutingModule`:
```
{ path: 'detail/:id', component: HeroDetailComponent },
```
The colon (:) in the path indicates that :id is a placeholder for a specific hero id.

##### Example parameterized route

```
<a *ngFor="let hero of heroes" class="col-1-4"
    routerLink="/detail/{{hero.id}}">
  <div class="module hero">
    <h4>{{hero.name}}</h4>
  </div>
</a>
``` 

#### Route parameterized URL
In the example of the TourOfHeroes we want to display a specific hero with its `id` in the URL.
The `HeroDetailComponent` has the infos about one hero. Now it has to
* Get the route that created it,
* Extract the id from the route
* Acquire the hero with that id from the server via the HeroService  

Add following imports 
```
// src/app/hero-detail/hero-detail.component.ts

import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';

import { HeroService }  from '../hero.service';
```

Inject the ActivatedRoute, HeroService, and Location services into the constructor, saving their values in private fields:

`
constructor(
  private route: ActivatedRoute,
  private heroService: HeroService,
  private location: Location
) {}
`
The **`ActivatedRoute`** holds information about the route to this instance of the `HeroDetailComponent`. This component is interested in the route's bag of parameters extracted from the URL. The "id" parameter is the id of the hero to display.

The **`HeroService`** gets hero data from the remote server and this component will use it to get the hero-to-display.

The **`location`** is an Angular service for interacting with the browser. You'll use it later to navigate back to the view that navigated here.

##### Extract the *id* route parameter
This is one example how to use it
```
ngOnInit(): void {
  this.getHero();
}

getHero(): void {
  const id = +this.route.snapshot.paramMap.get('id');
  this.heroService.getHero(id)
    .subscribe(hero => this.hero = hero);
}
```
The paramMap is a dictionary of route parameter values extracted from the URL. The "id" key returns the id of 
the hero to fetch.  
The JavaScript (+) operator converts the string to a number, which is what a hero id should be.

Like `getHero()` should have an asynchronous signature. Then it returns a mock hero as an Observable, 
using the RxJS `of()` function. Then it can be used as a real Http request without having to change the 
`HeroDetailComponent` that calls it

```
// src/app/hero.service.ts 

getHero(id: number): Observable<Hero> {
  this.messageService.add(`HeroService: fetched hero id=${id}`);
  return of(HEROES.find(hero => hero.id === id));
}
```
