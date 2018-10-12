# CSS Animations

### Make something move
```css
.msg {
    background: white;
    text-align: center;
    color: black;
    animation: slideUp 2s ease-in-out;
    transform: translate3d(0px, -20px, 0px);
}
@keyframes slideUp {
    0% {
        display: inline;
        transform: translate3d(0, 0,0);
    }
    75% {
        transform: translate3d(0, 0,0);
    }
    100% {
        transform: translate3d(0px, -20px, 0px);
    }
}
```
