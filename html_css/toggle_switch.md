# Toggle switch with variable height and width

This is my attempt to do switch with an easy way to change the with and height. The problem is when the height and width have 
a different ratio than width:60px, height:34px.  
I managed to work with this ratio but on the animation where the switch travels from one side to another I have the problem 
that if the bullet is too high, the traval distance is correct I think but since the bullet is bigger, it's like it went too much to 
the right. The distance width sould be shortened in relation to the bullet size (height).
  
This is how far I came:  

```css
:root {
    --slider-height: 40px;
    --slider-width: 60px;
}

/* Night mode switch */
.theme-switch-wrapper {
    display: flex;
    align-items: center;
}
.theme-switch {
    display: inline-block;
    height: var(--slider-height); /* 34px */
    position: relative;
    width: var(--slider-width); /* 60px */
}

.theme-switch input {
    display:none;
}

.slider {
    background-color: #ccc;
    bottom: 0;
    cursor: pointer;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    transition: .4s;
}

.slider:before {
    background-color: #fff;
    top: 50%;
    transform: translateY(-50%);
    /*bottom: calc(var(--slider-height) / 6.5); !*4px*!*/
    content: "";
    height: calc(var(--slider-height) / 1.3); /* 26px */
    left: 4px;
    position: absolute;
    transition: .4s;
    width: calc(var(--slider-height) / 1.3); /* 26px */
}

input:checked + .slider {
    background-color: gold;
}

input:checked + .slider:before {
    /*transform: translateX(calc(var(--slider-width) / 2.6)); !* 26px *!*/
    /*--difference: calc((var(--slider-width) / var(--slider-height)) - 1.7647);*/
    /*transform: translate3d(calc((var(--slider-width) / 2.3) + var(--difference)),-50%,0); !* 26px *!*/
    transform: translate3d(calc(var(--slider-width) / 2.3),-50%,0); /* 26px */
}

.slider.round {
    border-radius: var(--slider-height); /* 34px */
}

.slider.round:before {
    border-radius: 50%;
}

```

```html
<label class="theme-switch" for="checkbox">
     <input type="checkbox" id="checkbox" />
     <span class="slider round"></span>
</label>
```
