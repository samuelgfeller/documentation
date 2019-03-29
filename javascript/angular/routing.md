#Routing 

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
