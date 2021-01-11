# Flexbox footer 

## HTML
```html
<!DOCTYPE html>
<html lang="en">
<head> <!-- ... --> </head>
<body>
<div id="wrapper">
    <header> <!-- ... --> </header>
    <main> <!-- ... --> </main>
    <footer>
        Footer content
    </footer>
</div>        
</body>
</html>

```

## CSS

```css
body, html {
    min-height: 100vh;
    margin: 0;
    padding: 0;
}
#wrapper{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    /* No top/bottom margin on wrapper it makes body not touch the top */
}
header{
    flex: none;
}
main {
    width: 100%;
    padding: 1em 0.5em 0.5em; /* Not margin, it creates a scrollbar because of wrapper 100vh*/
    /* Prevent Browser from letting these items shrink to smaller than their content's default minimum size. */
    flex: 1 0 auto;
}
footer{
    flex: none;
    /* Prevent Browser from letting these items shrink to smaller than their content's default minimum size. */
    flex-shrink: 0;
    background: #f6f6f6;
    padding: 10px;
    text-align: center;
}
```



---
Sources  
 * [Sticky Footer, Five Ways | CSS-Tricks (css-tricks.com)](https://css-tricks.com/couple-takes-sticky-footer/#there-is-flexbox)
 * [Sticky Footer with Flexbox (codepen.io)](https://codepen.io/chriscoyier/pen/RRbKrL)
 * [Sticky Footer — Solved by Flexbox — Cleaner, hack-free CSS (philipwalton.github.io)](https://philipwalton.github.io/solved-by-flexbox/demos/sticky-footer/)
 * [solved-by-flexbox/site.css at master · philipwalton/solved-by-flexbox (github.com)](https://github.com/philipwalton/solved-by-flexbox/blob/master/assets/css/components/site.css)
