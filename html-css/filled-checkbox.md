# Checkbox design with filled color 

## HTML
```html
<div class="check-button">
    <label>
        <input type="checkbox">
        <span></span>
    </label>
</div>
```
## CSS
```css
.check-button {
    border-radius: 10px;
    border: 0px solid #D0D0D0;
    overflow: auto;
    background-color: red;
    text-align: center;
    width: 18px;
    margin: auto;
}

:root {
    --lightShadow: #e6e6e6;
}

.check-button:hover {
    background: red;
}

.check-button label span {
    text-align: center;
    padding: 9px 0px;
    display: block;
    cursor: pointer;
}

.check-button label input {
    position: absolute;
    top: -20px;
}

.check-button input:checked + span {
    background-color: mediumseagreen;
    color: #fff;
}
```
