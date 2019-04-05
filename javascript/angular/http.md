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

**Get elements from the server**
```
getHeroes (): Observable<Hero[]> {
  return this.http.get<Hero[]>(this.heroesUrl)
}
```
