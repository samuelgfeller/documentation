# SVG Checkmark in ios app style

### Preview 
<img src="https://i.imgur.com/JFf1jfJ.png" title="Checkmark" width="100px">


### HTML
```html
<div id="container">
    <figure id="checkmark-fig">
        <img id="checkmark" src="checkmark.svg" alt="checkmark">
    </figure>
</div>
```

### CSS
```css
#container{
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 25%;
    width: 70px;
    height: 70px;
    display: flex;
    justify-content: center;
    align-items: center;
}
#checkmark-fig{
    position: relative;
    background: #60c67e;
    width: 50px;
    height: 50px;
    border-radius: 10px;
    margin: 0;
}
#checkmark{
    width: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
```

### SVG Checkmark
```svg
<svg width="340" height="260" xmlns="http://www.w3.org/2000/svg">
    <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
    <rect stroke="#000" rx="10" transform="rotate(46.20000076293945 86.5151748657226,172.35525512695315) " id="svg_7"
          height="69.55698" width="170.0088" y="137.57676" x="1.51078" fill-opacity="null" stroke-opacity="null"
          stroke-width="0" fill="#87ffa4"/>
    <rect stroke="#000" rx="10" transform="rotate(136.6999969482422 205.14340209960938,130.03204345703125) " id="svg_9"
          height="69.557" width="296.876" y="95.25353" x="56.70539" fill-opacity="null" stroke-opacity="null"
          stroke-width="0" fill="#87ffa4"/>
</svg>
``` 