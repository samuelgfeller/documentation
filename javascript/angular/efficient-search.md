# Search with fewest possible requests
As the user types a name into a search box, you'll make repeated HTTP requests for heroes filtered by that name. 
The goal is to issue only as many requests as necessary.
  
The function to make the search request
```js
// src/app/hero.service.ts

/* GET heroes whose name contains search term */
searchHeroes(term: string): Observable<Hero[]> {
  if (!term.trim()) {
    // if not search term, return empty hero array.
    return of([]);
  }
  return this.http.get<Hero[]>(`${this.heroesUrl}/?name=${term}`).pipe(
    tap(_ => this.log(`found heroes matching "${term}"`)),
    catchError(this.handleError<Hero[]>('searchHeroes', []))
  );
}
```

Creating component 
```
ng generate component hero-search
```

Implement the search html construct
```html
<!-- src/app/hero-search/hero-search.component.html -->

<div id="search-component">
  <h4>Hero Search</h4>
 
  <input #searchBox id="search-box" (input)="search(searchBox.value)" />
 
  <ul class="search-result">
    <li *ngFor="let hero of heroes$ | async" >
      <a routerLink="/detail/{{hero.id}}">
        {{hero.name}}
      </a>
    </li>
  </ul>
</div>
```
The $ is a convention that indicates heroes$ is an Observable, not an array.
 
The *ngFor can't do anything with an Observable. But there's also a pipe character (|) followed by async, 
which identifies Angular's AsyncPipe.

The AsyncPipe subscribes to an Observable automatically so you won't have to do so in the component class.


Include it in the wanted site 
```html
<!--src/app/dashboard/dashboard.component.html-->

<!--other stuff-->
...

<!--Search box-->
<app-hero-search></app-hero-search>
```

### Implement the `HeroSearchComponent` class

The final class looks like this:
```js 
src/app/hero-search/hero-search.component.ts
content_copy
import { Component, OnInit } from '@angular/core';
 
import { Observable, Subject } from 'rxjs';
 
import {
   debounceTime, distinctUntilChanged, switchMap
 } from 'rxjs/operators';
 
import { Hero } from '../hero';
import { HeroService } from '../hero.service';
 
@Component({
  selector: 'app-hero-search',
  templateUrl: './hero-search.component.html',
  styleUrls: [ './hero-search.component.css' ]
})
export class HeroSearchComponent implements OnInit {
  heroes$: Observable<Hero[]>;
  private searchTerms = new Subject<string>();
 
  constructor(private heroService: HeroService) {}
 
  // Push a search term into the observable stream.
  search(term: string): void {
    this.searchTerms.next(term);
  }
 
  ngOnInit(): void {
    this.heroes$ = this.searchTerms.pipe(
      // wait 300ms after each keystroke before considering the term
      debounceTime(300),
 
      // ignore new term if same as previous term
      distinctUntilChanged(),
 
      // switch to new search observable each time the term changes
      switchMap((term: string) => this.heroService.searchHeroes(term)),
    );
  }
}
```

Notice the declaration of `heroes$` as an Observable
```js
heroes$: Observable<Hero[]>;
```
You'll set it in `ngOnInit()`. Before you do, focus on the definition of searchTerms.

#### The searchTerms RxJS subject
The searchTerms property is declared as an RxJS Subject.
```js
private searchTerms = new Subject<string>();

// Push a search term into the observable stream.
search(term: string): void {
  this.searchTerms.next(term);
}
```
A Subject is both a source of observable values and an Observable itself. You can subscribe to a Subject as you would any Observable.

You can also push values into that Observable by calling its `next(value)` method as the `search()` method does.

The `search()` method is called via an event binding to the textbox's input event.

```angular2html
<input #searchBox id="search-box" (input)="search(searchBox.value)" />
```

Every time the user types in the textbox, the binding calls `search()` with the textbox value, a "search term". 
The `searchTerms` becomes an Observable emitting a steady stream of search terms.

#### Chaining RxJS operators
Passing a new search term directly to the `searchHeroes()` after every user keystroke would create an excessive 
amount of HTTP requests, taxing server resources.

Instead, the `ngOnInit()` method pipes the `searchTerms` observable through a sequence of `RxJS` operators that 
reduce the number of calls to the `searchHeroes()`, ultimately returning an observable of timely hero search 
results (each a `Hero[]`).

```js
this.heroes$ = this.searchTerms.pipe(
  // wait 300ms after each keystroke before considering the term
  debounceTime(300),

  // ignore new term if same as previous term
  distinctUntilChanged(),

  // switch to new search observable each time the term changes
  switchMap((term: string) => this.heroService.searchHeroes(term)),
);
```

* `debounceTime(300)` waits until the flow of new string events pauses for 300 milliseconds before passing along the 
latest string. You'll never make requests more frequently than 300ms.
* `distinctUntilChanged()` ensures that a request is sent only if the filter text changed.
* `switchMap()` calls the search service for each search term that makes it through debounce and distinctUntilChanged. 
It cancels and discards previous search observables, returning only the latest search service observable.

Remember that the component class does not subscribe to the `heroes$` observable. That's the job of the 
[AsyncPipe](https://angular.io/tutorial/toh-pt6#asyncpipe) in the template.



