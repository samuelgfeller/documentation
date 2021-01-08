# Pretty responsive menu with changing colors

Responsive menu with underline hover effect and changing colors at the same time.  
It is kinda complicated but works with pure JS. 

![Gif of menu](https://i.imgur.com/xZq2QnB.gif)


<details>
<summary><b>HTML navbar (click to expand code)</b></summary>
<p>

```html
<div id="nav" class="clearfix">
    <span id="brand-name-span">Slim Example Project</span>
    <a href="#" class="is-active" data-active-color="firebrick">Home</a>
    <a href="#" data-active-color="orange">Users</a>
    <a href="#" data-active-color="yellow">Profile</a>
    <a href="#" data-active-color="limegreen">Own posts</a>
    <a href="#" data-active-color="darkcyan">All posts</a>
    <a href="#" data-active-color="royalblue">Login</a>
    <a href="#" data-active-color="slateblue">Register</a>
    <div id="nav-icon">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <span class="nav-indicator noAnimationOnPageLoad" id="nav-indicator"></span>
</div>
```

</p>
</details>  


<details>
<summary><b>CSS navbar (click to expand code)</b></summary>
<p>

```css
/* mobile first min-width sets base and content is adapted to computers. */
@media (min-width: 100px) {
    /* Nav */
    #brand-name-span {
        color: #757575;
        width: 80%;
        display: block;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
    }

    #nav {
        overflow: hidden;
        /*background-color: #defeff;*/
        white-space: nowrap;
        position: relative;
        max-width: 100%;
        background-color: #fff;
        padding: 0 20px;
        margin-top: 20px;
        border-radius: 25px; /* Open borders shouldn't be too round*/
        box-shadow: 0 0 20px rgba(159, 162, 177, .3);
        height: 50px; /* fixed height to center nav-icon and bypass transition movement when opened*/
    }

    #nav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 20px 16px;
        text-decoration: none;
        /*font-size: 17px;*/
        transition: 0.3s;
        width: 50%;
        position: relative;
    }

    #nav a:hover {
        font-weight: normal; /*default hover over links makes it bold*/
    }

    #nav a:before, #nav-indicator {
        position: absolute;
        left: 15%;
        width: 70%;
        height: 5px;
        border-radius: 8px 8px 0 0;
    }

    /* Similar than .nav-indicator */
    #nav a:before {
        content: "";
        bottom: -6px;
        background-color: #dfe2ea;
        opacity: 0;
        transition: 0.3s;
    }

    /* Here because it shares a lot with a:before*/
    #nav-indicator {
        bottom: 0;
        margin: auto;
        transition: 0.4s;
        z-index: 1;
    }

    #nav a {
        display: none;
    }

    #nav a.icon {
        float: right;
        display: block;
    }

    #nav.open {
        height: auto;
    }

    #nav.open .icon {
        position: absolute;
        right: 0;
        top: 0;
    }

    #nav.open a {
        display: block;
    }

    #nav a:not(.is-active):hover:before {
        opacity: 1;
        bottom: 0;
    }

    #nav a:not(.is-active):hover {
        color: #333;
    }

    :root {
        /* With a 50px height on nav div */
        --nav-icon-size: 0.8;
    }

    #nav-icon {
        width: calc(40px * var(--nav-icon-size));
        height: calc(30px * var(--nav-icon-size));
        position: absolute;
        right: 25px;
        top: calc(10px / var(--nav-icon-size));
        float: right;
        display: block;
        transform: rotate(0deg);
        transition: .5s ease-in-out;
        cursor: pointer;
    }

    #nav-icon span {
        display: block;
        position: absolute;
        height: calc(6px * var(--nav-icon-size));
        width: 100%;
        background: transparent; /* Is tinted in js on page load */
        border-radius: calc(6px * var(--nav-icon-size));
        opacity: 1;
        left: 0;
        transform: rotate(0deg);
        transition: .25s ease-in-out;
    }

    #nav-icon span:nth-child(1) {
        top: 0;
    }

    #nav-icon span:nth-child(2), #nav-icon span:nth-child(3) {
        top: calc(12px * var(--nav-icon-size));
    }

    #nav-icon span:nth-child(4) {
        top: calc(24px * var(--nav-icon-size));
    }

    #nav.open #nav-icon span:nth-child(1) {
        top: calc(12px * var(--nav-icon-size));
        width: 0;
        left: 50%;
    }

    #nav.open #nav-icon span:nth-child(2) {
        transform: rotate(45deg);
    }

    #nav.open #nav-icon span:nth-child(3) {
        transform: rotate(-45deg);
    }

    #nav.open #nav-icon span:nth-child(4) {
        top: calc(12px * var(--nav-icon-size));
        width: 0;
        left: 50%;
    }
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
}

@media (min-width: 340px) {
    /* 340px enough wide to add letter-spacing*/
    #brand-name-span {
        letter-spacing: 1vw;
    }
}

@media (min-width: 961px) {
    /* tablet, landscape iPad, lo-res laptops ands desktops */

    #nav {
        display: block;
    }

    #nav .icon {
        display: none;
    }
}

/* Desktop / mobile nav breakpoint. If min-width changes, navbar.js should be updated as well */
@media (min-width: 1025px) {
    /* big landscape tablets, laptops, and desktops */
    /* Desktop Nav */
    #brand-name-span {
        display: none;
    }

    #nav-icon {
        display: none;
    }

    #nav {
        height: auto;
        border-radius: 999px;
    }

    #nav a {
        float: none;
        display: inline-block;
        color: black;
        text-align: left;
        padding: 20px 16px;
        text-decoration: none;
        /*font-size: 17px;*/
        transition: 0.3s;
        width: auto;
        position: relative;
        margin: 0 6px;
    }

    #nav a:before, #nav-indicator {
        width: auto;
        left: 0;

    }
}
```

</p>
</details>  


<details>
<summary><b>Javascript (click to expand code)</b></summary>
<p>

```javascript
// Prevent animation on page load for active element
window.onload = function () {
    let elements = document.getElementsByClassName("noAnimationOnPageLoad");
    // elements is a HTMLCollection and does not have forEach method. It has to be converted as array before
    Array.from(elements).forEach(function (element) {
        element.classList.remove("noAnimationOnPageLoad");
    });
}
// Navigation bar
let nav = document.getElementById("nav");
let indicator = document.getElementById('nav-indicator');
let items = document.querySelectorAll('#nav a');

// Cannot use entire nav because then it collapses on each click on a menu element since its also in nav
document.getElementById("nav-icon").addEventListener("click", toggleMobileNav);
document.getElementById("brand-name-span").addEventListener("click", toggleMobileNav);

// Cannot be passed as an argument when calling loopOverItems since on resize event listeners are added
// multiple times on resize and there is a bug when click event calls handleIndicator with isMobile true [SLE-63]
let isMobile = true;

// At 1025px the menu is in desktop version and not collapsed.
if (window.matchMedia("(min-width: 1025px)").matches) {
    isMobile = false;
    loopOverItems();
}else{
    isMobile = true;
    // Has to be called even if mobile because of the color change of the burger icon.
    loopOverItems();
}

window.addEventListener('resize', function () {
    let oldIsMobile = isMobile;

    isMobile = !window.matchMedia("(min-width: 1025px)").matches;

    if (oldIsMobile !== isMobile) {
        if (isMobile === false) {
            // If menu was open close it
            nav.classList.remove("open");
            // Move indicator back to nav
            nav.appendChild(indicator);
        }

        // Prevent to take mobile style to desktop or vice versa
        // CSS style is overwritten by set element style from handleIndicator function
        indicator.removeAttribute('style');
        loopOverItems();
    }
});

function toggleMobileNav() {
    nav.classList.toggle('open');

    if (nav.className.includes('open')) {
        isMobile = true;
        // If menu collapsed it should old loop over indicators when menu opened
        loopOverItems();
    }
}

function loopOverItems() {
    items.forEach(function (item, index) {
        item.addEventListener('click', function (e) {
            handleIndicator(e.target)
        });

        // If contains is active, execute function
        item.classList.contains('is-active') && handleIndicator(item);
    });
}

function handleIndicator(el) {
    items.forEach(function (item) {
        item.classList.remove('is-active');
        item.removeAttribute('style');
    });

    if (isMobile === true) {
        // Move indicator to clicked menu item or just append it.
        el.appendChild(indicator);
        indicator.style.backgroundColor = 'transparent';
        window.setTimeout(function () {
            // Change indicator to new color
            indicator.style.backgroundColor = el.dataset.activeColor; // "-" become camel case
        }, 10);

        // Tint hamburger icon bars to the active color
        document.querySelectorAll('#nav-icon span').forEach(function (bar) {
            bar.style.background = el.dataset.activeColor; // "-" become camel case
        });
    } else {
        indicator.style.width = "".concat(el.offsetWidth, "px");
        indicator.style.left = "".concat(el.offsetLeft, "px");
        indicator.style.backgroundColor = el.dataset.activeColor; // "-" become camel case
    }

    el.classList.add('is-active');
    el.style.color = el.dataset.activeColor;
}
```

</p>
</details>  
