# Pure css rounded loader

### DOM container
The first thing to do is write a `div` where the loader will be populated into.  
Something like this will do it  

`page.html`
```html
...
<div id="loader"></div>
...
```

### Show loader
You can either put these spans directly in the HTML file with the style `display: none` until you want to show it 
or populate the file using jquery.   
`loader.js`
```js
function showLoader() {
    let html = '<span></span> ' +
        '<span></span> ' +
        '<span></span> ' +
        '<span></span> ' +
        '<span></span> ' +
        '<span></span> ' +
        '<span></span> ' +
        '<span></span> ';
    $('#loader').append(html);
}
```
### Hide lodader 
To hide you it can either set `display: none` or remove the `span`s entirely from the DOM with jquery
```js
 $('#loader').empty();
```

### Stylesheet
The size and color of the loader can be defined in the `--factor`and `--color` css vars.  
`loader.css`
```css
:root{
    --factor: 5;
    --color: black;
}
#loader{
    height: 100px;
    width: 100px;
    left: 50%;
    top: 50%;
    /*transform: translate3d(50%,10%,0);*/
    position: absolute;
    /*background:blue;*/
}

/*Square 6*/
#loader span{
    display: block;
    position: absolute;
    width: calc(10px*var(--factor));
    height: calc(10px*var(--factor));
    border-radius: 50%;
    background-color: var(--color);
}
#loader span:nth-child(1){
    animation: s6animation1 2.5s ease-in-out infinite;
}
#loader span:nth-child(2){
    animation: s6animation2 2.5s ease-in-out infinite;
}
#loader span:nth-child(3){
    animation: s6animation3 2.5s ease-in-out infinite;
}
#loader span:nth-child(4){
    animation: s6animation4 2.5s ease-in-out infinite;
}
#loader span:nth-child(5){
    animation: s6animation5 2.5s ease-in-out infinite;
}
#loader span:nth-child(6){
    animation: s6animation6 2.5s ease-in-out infinite;
}
#loader span:nth-child(7){
    animation: s6animation7 2.5s ease-in-out infinite;
}
#loader span:nth-child(8){
    animation: s6animation8 2.5s ease-in-out infinite;
}
@keyframes s6animation1 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(calc(20px*var(--factor)),calc(-20px*var(--factor)),0);
    }
    80%{
        transform: translate3d(calc(20px*var(--factor)),calc(20px*var(--factor)),0) rotate(90deg);
    }
}
@keyframes s6animation2 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(calc(-20px*var(--factor)),calc(20px*var(--factor)),0);
    }
    80%{
        transform: translate3d(calc(-20px*var(--factor)),calc(-20px*var(--factor)),0) rotate(90deg);
    }
}
@keyframes s6animation3 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(calc(20px*var(--factor)),calc(20px*var(--factor)),0);
    }
    80%{
        transform: translate3d(calc(-20px*var(--factor)),calc(20px*var(--factor)),0) rotate(90deg);
    }

}
@keyframes s6animation4 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(calc(-20px*var(--factor)),calc(-20px*var(--factor)),0);
    }
    80%{
        transform: translate3d(calc(20px*var(--factor)),calc(-20px*var(--factor)),0) rotate(90deg);
    }
}
@keyframes s6animation5 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(0,calc(-25px*var(--factor)),0);
    }
    80%{
        transform: translate3d(calc(25px*var(--factor)),0,0) rotate(90deg);
    }
}
@keyframes s6animation6 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(calc(25px*var(--factor)),0,0);
    }
    80%{
        transform: translate3d(0,calc(25px*var(--factor)),0) rotate(90deg);
    }
}
@keyframes s6animation7 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(0,calc(25px*var(--factor)),0);
    }
    80%{
        transform: translate3d(calc(-25px*var(--factor)),0,0) rotate(90deg);
    }
}
@keyframes s6animation8 {
    0%,100%{
        transform: translate3d(0, 0, 0);
    }
    30%,40%{
        transform: translate3d(calc(-25px*var(--factor)),0,0);
    }
    80%{
        transform: translate3d(0,calc(-25px*var(--factor)),0) rotate(90deg);
    }
}
```
