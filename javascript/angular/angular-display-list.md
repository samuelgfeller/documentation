# Display a List
 
### Data
Eventually you'll get them from a remote data server. For now, you'll create some mock heroes and pretend they came from the server.

`src/app/mock-heroes.ts`
```js
import { Hero } from './hero';

export const HEROES: Hero[] = [
  { id: 11, name: 'Mr. Nice' },
  { id: 12, name: 'Narco' },
  { id: 13, name: 'Bombasto' },
  { id: 14, name: 'Celeritas' },
];
```

### Import it into the component 
`src/app/heroes/heroes.component.ts`
```js
import { HEROES } from '../mock-heroes';

export class HeroesComponent implements OnInit {
  heroes = HEROES;
```

### Display 
`heroes.component.html`
```html
<h2>My Heroes</h2>
<ul class="heroes">
  <li *ngFor="let hero of heroes">
    <span class="badge">{{hero.id}}</span> {{hero.name}}
  </li>
</ul>
```
The `*ngFor` is Angular's repeater directive. It repeats the host element for each element in a list. 
(`<li>` is the host element in this example)

### Style

The stylesheet url is added in the `@Component` in `compName.component.ts` by default with the `styleUrls` tag.

### Click event

A click event can be bound with `(click)="onSelect(hero)"` in the html tag. Our `<li>` should look like:
```html
<li *ngFor="let hero of heroes" (click)="onSelect(hero)">
```
The parentheses around click tell Angular to listen for the `<li>` element's click event. When the user clicks in the 
`<li>`, Angular executes the `onSelect(hero)` expression.

#### Add event handler
`src/app/heroes/heroes.component.ts`
```js
export class HeroesComponent implements OnInit {
  heroes = HEROES;
  // Defining variable
  selectedHero: Hero;
  // Function onselect
  onSelect(hero: Hero): void {
    this.selectedHero = hero;
  }
```

#### Add affected element

```html
<div *ngIf="selectedHero">
  <h2>{{selectedHero.name | uppercase}} Details</h2>
  <div><span>id: </span>{{selectedHero.id}}</div>
  <div>
    <label>name:
      <input [(ngModel)]="selectedHero.name" placeholder="name">
    </label>
  </div>
</div>
```
**\*ngIf** is used to only show the div, if selectedHero is true
**[(ngModel)]** and Two-way binding is described [here](https://github.com/samuelgfeller/documentation/blob/master/javascript/angular/angular-start.md#two-way-binding)

### Add class if
The Angular class binding makes it easy to add and remove a CSS class conditionally. 
Just add `[class.some-css-class]="some-condition"` to the element you want to style.

```html
<li *ngFor="let hero of heroes"
  [class.selected]="hero === selectedHero"
  (click)="onSelect(hero)">
  <span class="badge">{{hero.id}}</span> {{hero.name}}
</li>
```


----

Source:  
https://angular.io/tutorial/toh-pt2
