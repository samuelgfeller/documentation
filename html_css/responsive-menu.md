# Responsive menu

### Stylesheet

```css
/* menu.css */

.menu {
    height: auto;
    position: relative;
    background-color: rgba(0, 110, 181, 0.2); /*#cccccc*/;
}

#nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    width: 100%;
}

.icon {
    display: none;
}

.topnav {
    display: none;
}

.menu li {
    float: left;
}

.menu li a, .dropbtn /*unterpunkt*/
{
    display: inline-block;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.menu li a:hover, .dropdown:hover .dropbtn {
    color: white;
    background-color: rgb(0, 110, 181);
}

.current {
    color: white;
    background-color: rgba(0, 110, 181, 0.75);
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: -8px 8px 16px 0px rgba(0, 0, 0, 0.2), 8px 0px 16px 0px rgba(0, 0, 0, 0.2);
}

.dropdown-content a {
    color: #1a1a1a;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    color: white;
    background-color: rgb(0, 110, 181);
}

.dropdown:hover .dropdown-content {
    display: block;
}

.menu .icon {
    display: none;
}

/*Phone*/
@media only screen and (max-width: 770px) {
    .menu {
        background-color: whitesmoke;
    }

    .menu li a {
        display: none;
    }

    .menu .icon {
        display: block;
        cursor: pointer;
        float: right;
        padding: 9px 9px 9px 100%;
    }

    .menu.responsive {
        position: relative;
        width: 100%;
    }

    .menu.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
        padding: 9px 9px 9px 30%;
    }

    .menu.responsive ul li {
        width: 100%;
    }

    .menu.responsive ul li a, .menu.responsive #newsMobile {
        float: none;
        display: block;
        text-align: left;
        padding: auto;
    }

    .menu.responsive .dropdown-content {
        width: 60%;
        margin-left: 40%;
        text-align: right;
    }

    .menu.responsive {
        display: block;
    }
}
```

### HTML

```html
<div class="menu" id="menuID">
    <ul id="nav">
        <li><a href="index.html" class="current">Home</a></li>
        <li><a href="vorstand.html">Vorstand</a></li>
        <li><a href="jahresprogramm.html">Jahresprogramm</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">JO SSDT</a>
            <div class="dropdown-content">
                <a href="organisation-jo.html">Organisation</a>
                <a href="teamplanbuch-jo.html">Teamplanbuch</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Ranglisten</a>
            <div class="dropdown-content">
                <a href="rangliste-jo.html">JO</a>
                <a href="rangliste-erwachsene.html">Erwachsene</a>
            </div>
        </li>
        <li><a href="dokumente.html">Dokumente</a></li>
        <li><a href="marktplatz.html">Marktplatz </a></li>
        <li><a href="sponsoren.html">Sponsoren </a></li>
        <li><a href="kontakt.html">Kontakt </a></li>
        <li><a href="newsMobile.html" id="newsMobile">News / Webcams </a></li>
        <img src="img/hamburger.svg" class="icon" onclick="resNav()">
    </ul>
</div>
```

### Javascript

```js
function resNav() {
    var x = document.getElementById("menuID");
    if (x.className === "menu") {
        x.className += " responsive";
    } else {
        x.className = "menu";
    }
}
```

