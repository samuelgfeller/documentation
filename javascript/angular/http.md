# Angular HTTP

### Enable HTTP services
import the HttpClientModule symbol from @angular/common/http

```
// src/app/app.module.ts

import { HttpClientModule }    from '@angular/common/http';
```
add it to the @NgModule.imports array

### Get elements via HTTP

**Import needed HTTP symbols**
```
// src/app/hero.service.ts

import { HttpClient, HttpHeaders } from '@angular/common/http';
```

**Inject `HttpClient` into the constructor**
```

constructor(
  private http: HttpClient,
  private messageService: MessageService) { }
```

**Define api URL**
```
private heroesUrl = 'api/heroes';  // URL to web api
```

**Get elements from the server in an Observable**
```
getHeroes (): Observable<Hero[]> {
  return this.http.get<Hero[]>(this.heroesUrl)
}
```
This particular HttpClient.get call returns an Observable<Hero[]>, literally "an observable of hero arrays". 
In practice, it will only return a single hero array

### Error handling
To catch errors, you "pipe" the observable result from `http.get()` through an RxJS `catchError()` operator.

Import `catchError` symbol from `rxjs/operators`
```
import { catchError, map, tap } from 'rxjs/operators';
```
Extend the observable result with the `.pipe()` method and give it a `catchError()` operator
```
getHeroes (): Observable<Hero[]> {
  return this.http.get<Hero[]>(this.heroesUrl)
    .pipe(
      catchError(this.handleError<Hero[]>('getHeroes', []))
    );
}
```
**`catchError()`** function
```js
/**
 * Handle Http operation that failed.
 * Let the app continue.
 * @param operation - name of the operation that failed
 * @param result - optional value to return as the observable result
 */
private handleError<T> (operation = 'operation', result?: T) {
  return (error: any): Observable<T> => {
 
    // TODO: send the error to remote logging infrastructure
    console.error(error); // log to console instead
 
    // TODO: better job of transforming error for user consumption
    this.log(`${operation} failed: ${error.message}`);
 
    // Let the app keep running by returning an empty result.
    return of(result as T);
  };
}
```

### Get one element by id
Most web APIs support a get by id request in the form :baseURL/:id.

```
// src/app/hero.service.ts

/** GET hero by id. Will 404 if id not found */
getHero(id: number): Observable<Hero> {
  const url = `${this.heroesUrl}/${id}`;
  return this.http.get<Hero>(url).pipe(
    tap(_ => this.log(`fetched hero id=${id}`)),
    catchError(this.handleError<Hero>(`getHero id=${id}`))
  );
}
```
[`tap()` documentation](https://angular.io/tutorial/toh-pt6#tap-into-the-observable)

There are three significant differences from `getHeroes()`:
* it constructs a request URL with the desired hero's `id`.
* the server should respond with a single hero rather than an array of heroes.
* therefore, getHero returns an `Observable<Hero>` ("an observable of Hero objects") 
rather than an observable of hero arrays 

### Update data 
Make sure to pass the hero object as an argument while calling the `updateHero` function in the service 
([example](https://angular.io/tutorial/toh-pt6#update-heroes))

```
// src/app/hero.service.ts

/** PUT: update the hero on the server */
  updateHero (hero: Hero): Observable<any> {
  const httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };
  return this.http.put(this.heroesUrl, hero, httpOptions).pipe(
    tap(_ => this.log(`updated hero id=${hero.id}`)),
    catchError(this.handleError<any>('updateHero'))
  );
}
```
The `HttpClient.put()` method takes three parameters
* the URL
* the data to update (the modified hero in this case)
* options

The URL can stay unchanged. The web API should know which hero to update by looking at the hero's id since it gets 
the whole object.

### Add new hero

