# How to vertically align an icon next to a `span`?

### HTML
```html
<div>
    <span class="value">This is text</span>
    <img src="assets/general/img/edit_icon.svg" class="edit-icon" alt="Edit">
</div>
```

### CSS
```css
.value{
    vertical-align: middle;
}
.edit-icon {
    width: 30px;
    vertical-align: middle;
}
```


---

Source: https://stackoverflow.com/a/21373009/9013718
