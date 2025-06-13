## Dark mode toggle switch black and white

### HTML

```html
    <div id="dark-theme-toggle-container">
        <div id="dark-theme-toggle"></div>
    </div>
```

### CSS

```css
/*mobile first min-width sets base and content is adapted to computers.*/
@media (min-width: 100px) {
    #dark-theme-toggle-container {
        position: absolute;
        height: auto;
        width: 65px; /*width of the toggle (45px) + right padding*/
        right: 10px;
        left: auto;
        top: 50px;
    }

    #dark-theme-toggle {
        position: absolute;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(180deg, black 50%, #ffffff 50%);
        cursor: pointer;
        transition: background 0.3s ease-in-out;
        /*box-shadow: 0px 0px 10px rgba(255,255,255, 0.1);*/
        /*box-shadow: 0px 0px 10px ;*/
        top: 50%;
        transform: translateY(-50%);
        left: 10px;
    }

    #dark-theme-toggle.dark-theme-enabled {
        background: linear-gradient(180deg, #ffffff 50%, black 50%);
    }
}

/*portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones*/
@media (min-width: 641px) {

}

/*tablet, landscape iPad, lo-res laptops ands desktops*/
@media (min-width: 961px) {
    #dark-theme-toggle {
        right: 15px;
        width: 40px;
        height: 40px;
    }
}
```

### JavaScript

```js
// Script for dark mode with black & white toggle button

// Get the toggle element
const toggleButton = document.querySelector('#dark-theme-toggle');

if (toggleButton) {
    // Add event listener to the toggle switch for theme switching
    toggleButton.addEventListener('click', switchTheme, false);

    // Retrieve the current theme from localStorage
    const currentTheme = getCurrentTheme();

    // Set the data-theme attribute on the html element
    document.documentElement.setAttribute('data-theme', currentTheme);

    // Check the toggle switch if the current theme is 'dark'
    if (currentTheme === 'dark') {
        toggleButton.classList.add('dark-theme-enabled');
    }
}

/**
 * Handle theme switching with localstorage
 *
 * @param e
 */
function switchTheme(e) {
    let theme;
    // Check the current theme and switch to the opposite theme
    if (document.documentElement.getAttribute('data-theme') === 'dark') {
        theme = 'light';
        toggleButton.classList.remove('dark-theme-enabled');
    } else {
        theme = 'dark';
        toggleButton.classList.add('dark-theme-enabled');
    }
    // Set html data-attribute and local storage entry
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
}

function getCurrentTheme() {
    // Check if the user has set a theme in the local storage
    if (localStorage.getItem("theme") !== null) {
        return localStorage.getItem("theme");
    }
    // Check if the user has set a global system preference for dark mode
    if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        // Set the theme to dark mode in localstorage for faster loading in layout
        localStorage.setItem("theme", "dark");
        return "dark";
    }
    // Default to light mode
    return "light";
}
```
