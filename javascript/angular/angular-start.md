# Starting with AngularJS

## Installation
[Documentation](https://angular.io/guide/quickstart)
#### Install angular/cli
```
npm install -g @angular/cli
```

#### Create project
This command creates **a new workspace**, with a **root folder** named my-app, an **initial skeleton app** project, also called my-app (in the src subfolder), an **end-to-end test project** (in the e2e subfolder) and related configuration files  
```
ng new my-app
```
#### Launch server
The --open (or just -o) option automatically opens your browser to http://localhost:4200/.

```
cd my-app
ng serve --open
```

## Getting started

[Documentation](https://angular.io/guide/quickstart#step-4-edit-your-first-angular-component)

To change the first page we need these three files in `/src/app/`
1. `app.component.ts`— the component class code, written in TypeScript.
2. `app.component.html`— the component template, written in HTML.
3. `app.component.css`— the component's private CSS styles.

### Change title
`app.component.ts`
```angular
title = 'Tour of Heroes';
```

`app.component.html`
```
<h1>{{title}}</h1>
```

Style can be added in `app.component.css`

### Create component
The CLI creates a new folder, src/app/heroes/, and generates the four files of the HeroesComponent
```cmd
ng generate component heroes
```
The next steps explained in their [documentation](https://angular.io/tutorial/toh-pt1#selector)


### Format string with pipe
[Pipes](https://angular.io/guide/pipes) are a good way to format strings, currency amounts, dates and other display data.
```html
<h2>{{hero.name | uppercase}} Details</h2>
```

### Two-way binding
[Documentation](https://angular.io/tutorial/toh-pt1#two-way-binding)

`src/app/heroes/heroes.component.html`
```js
<div>
  <label>name:
    <input [(ngModel)]="hero.name" placeholder="name">
  </label>
</div>
```
**[(ngModel)]** is Angular's two-way data binding syntax.

Here it binds the hero.name property to the HTML textbox so that data can flow in both directions: from the hero.name property to the textbox, and from the textbox back to the hero.name.

But this won't directly cause you need to import the Module it belongs to (see next point).

### App module
https://angular.io/tutorial/toh-pt1#appmodule

The import is located at `app.module.ts` and for the form element above it can be imported that way:
```js
import { FormsModule } from '@angular/forms';
@NgModule({
imports: [
  BrowserModule,
  FormsModule
]
})
```
Now the above example should work.


----

https://angular.io/guide/quickstart
