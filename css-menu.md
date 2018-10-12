# Example of CSS navigation

### HTML
```html
<div class="menu">
    <ul id="nav">
        <li class="nav"><a class="nav" href="">Home</a></li>
        <li class="nav"><a href="#" class="nav ">Link 1</a></li>
        <li class="nav"><a href="#" class="nav dropbtn">Artikel</a></li>
        <li class="nav dropdown">
            <a href="#" class="nav dropbtn">Dropdwon</a>
            <div class="dropdown-content">
                <a href="#" class="nav">Link 1</a>
                <a href="#" class="nav">Link 2</a>
            </div>
        </li>
        <li class="nav dropdown">
            <a href="#" class="nav dropbtn">Dropdown 2</a>
            <div class="dropdown-content">
                <a href="#" class="nav">Link 1</a>
                <a href="#" class="nav">Link 2</a>
            </div>
        </li>
    </ul>
</div>
```

### CSS
```css
.menu {
    background-color: black;
}

#nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    width: 100%;
}

li.nav {
    float: left;
}

li.nav a.nav, .dropbtn {
    display: block;
    padding: 10px 12px;
    text-decoration: none;
    color: white;
}

li.nav a.nav:hover, .dropdown:hover .dropbtn {
    background-color: gold;
    color: #1a1a1a;
}

.dropdown-content {
    position: absolute;
    display: none;
    min-width: 100px;
    background-color: #1a1a1a;
    box-shadow: -8px 8px 16px 0 rgba(0, 0, 0, 0.2), 8px 8px 16px 0 rgba(0, 0, 0, 0.2);
    z-index: 999;
}

.dropdown-content > a {
    padding: 10px 12px;

    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content > a:hover {
    background: gold;
    color: #000;
}

.dropdown:hover .dropdown-content {
    display: block;
}

#menu {
    margin: 0 0 10px 0;
}

#menu a {
    padding: 10px 10px 10px 10px;
    text-decoration: none;
}

#menu a:hover {
    background-color: gold;
}
```
