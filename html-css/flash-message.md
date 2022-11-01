# Flash messages

### Preview
![Gif of flash messages](https://i.imgur.com/gClOrif.gif)

## CSS

<details>
  <summary>File: <code>flash-message.css</code></summary>
  
```css
#flash-container {
    right: 50px;
    position: fixed;
    z-index: 101; /* On top of content placeholder and #modal */
}
.flash {
    width: 340px;
    min-height: 70px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    border-radius: 20px;
    /*background: white;*/
    display: flex;
    margin: 25px 0 10px 25px;
    transform: translateX(130%);
    opacity: 0;
    overflow: hidden; /* Prevent color from overflowing rounded border */

    /* Revert default styling of <dialog> */
    position: relative;
    border: none;
    padding: 0;
    align-items: center;

}

.flash-close-btn {
    position: absolute;
    /*top: -10px; !* Large font size and time symbol pretty small it has to be pushed upwards*!*/
    right: 10px;
    height: 20px;
    font-size: 30px;
    font-weight: 300;
    color: #6e6e6e;
    cursor: pointer;
    align-self: flex-start;
}

/* Color / icon part of flash */
.flash-fig { /* Flex item */
    position: relative;
    width: 60px;
    height: 60px;
    margin: 10px;
    z-index: 11;
    flex-shrink: 0;
    border-radius: 10px;
    cursor: pointer;
}

.flash-fig img {
    height: 30px; /* More relevant than width to have all images with the same size */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    filter: drop-shadow(5px 5px 7px rgba(0, 0, 0, 0.25));
}

.flash-fig img.open {
    /* Sadly I cannot set the image url with the `content:` tag because its impossible set basepath for css */
    display: block;
}

.flash.success {
    background: #bee8c2;
}
.flash.error {
    background: #fabfb5;
}
.flash.info {
    background: #bde4ee;
}
.flash.warning {
    background: #f8d9af;
}
.flash.success .flash-fig {
    background: #43c566;
}
.flash.error .flash-fig {
    background: #e65e45;
}
.flash.info .flash-fig {
    background: #45bdd4;
}
.flash.warning .flash-fig {
    background: #eaa030;
}



/* Text part of flash */
.flash-message { /* Flex item */
    flex-grow: 1;
}
.flash-message h3 {
    margin: 10px 10px 6px 10px;
    font-size: 1rem;
}
.flash.success h3, .flash.error h3, .flash.info h3, .flash.warning h3{
    /* Only remove title for those defined with CSS below */
    text-indent:-9999px; /* Change h3 text in css https://stackoverflow.com/a/26889106/9013718 */
}
.flash.success h3:before, .flash.error h3:before, .flash.info h3:before, .flash.warning h3:before{
    text-indent:0;
    float:left;
}
.flash.success h3:before{
    content: 'YAY! Success!';
    color: #28a548;
}
.flash.error h3:before{
    content: 'OOPS! Error...';
    color: #ae4931;
}
.flash.info h3:before{
    content: 'Information.';
    color: #008fa2;
}
.flash.warning h3:before{
    content: 'Caution!';
    color: #bc6500;
}

.flash-message p {
    margin: 3px 10px 10px 10px;
    font-size: 0.9rem;
    width: 200px;
}

.slide-in {
    animation: slide-in 0.9s forwards;
}

.slide-out {
    animation: slide-out 0.9s forwards;
}

@keyframes slide-in {
    100% {
        transform: translateX(0%);
        opacity: 1;
    }
}

@keyframes slide-out {
    0% {
        transform: translateX(0%);
        opacity: 1;
    }
    100% {
        transform: translateX(130%);
        opacity: 0;
    }
}

```

</details>

## Javascript 
This flash message design can be exclusively used by javascript as info banners. 


<details>
  <summary>File: <code>flash-message.js</code></summary>
  
```js
/**
 * Create and display flash message from the client side
 * Display server side flash: flash-messages.html.php
 *
 * @param {string} typeName (success | error | warning | info)
 * @param {string} message flash message content
 */
export function createFlashMessage(typeName, message) {
    // Wrapper
    let container = document.getElementById("flash-container");
    // If it isn't "undefined" and it isn't "null", then it exists.
    if (typeof (container) === 'undefined' || container === null) {
        // console.log(wrapper === null);
        container = document.createElement('aside');
        container.id = 'flash-container';
        document.appendChild(container);
    }

    // First child: dialog
    let dialog = document.createElement("dialog");
    dialog.className = 'flash ' + typeName;
    // Append dialog
    container.appendChild(dialog);

    // Second child: figure
    let figure = document.createElement('figure');
    figure.className = 'flash-fig';
    // Append figure to dialog
    dialog.appendChild(figure);

    // Third child: img
    let icon = document.createElement('img');
    icon.className = 'open';
    switch (typeName) {
        case 'success':
            // icon.className = typeName;
            icon.src = 'assets/general/img/checkmark.svg';
            icon.alt = 'success';
            break;
        case 'warning':
            icon.src = 'assets/general/img/warning-icon.svg';
            icon.alt = 'success';
            break;
        case 'info':
            icon.src = 'assets/general/img/info-icon.svg';
            icon.alt = 'success';
            break;
        case 'error':
            icon.src = 'assets/general/img/cross-icon.svg';
            icon.alt = 'error';
            break;
    }
    figure.appendChild(icon);

    // First dialog child: flash message content
    let flashMessageDiv = document.createElement('div');
    flashMessageDiv.className = 'flash-message';
    dialog.appendChild(flashMessageDiv);

    // First flash message content child: header
    let flashMessageHeader = document.createElement('h3');
    flashMessageHeader.textContent = 'Hey'; // Replaced by css
    flashMessageDiv.appendChild(flashMessageHeader);

    // Second flash message content child: message content
    let flashMessageContent = document.createElement('p');
    flashMessageContent.innerHTML = message;
    flashMessageDiv.appendChild(flashMessageContent);

    // Second dialog child: close flash button
    let closeBtn = document.createElement('span');
    closeBtn.className = 'flash-close-btn';
    closeBtn.innerHTML = "&times";
    dialog.appendChild(closeBtn);

    // Make it visible to the user
    showFlashMessages();
}

/**
 * Display flash messages to user
 *
 * In own function to be run client side after loading
 */
export function showFlashMessages() {
    let flashes = document.getElementsByClassName("flash");
    Array.from(flashes).forEach(function (flash, index) {
        if (index === 0) {
            // Add first without timeout
            flash.className += ' slide-in'
        } else {
            setTimeout(function () {
                flash.className += ' slide-in'
            }, index * 1000); // https://stackoverflow.com/a/45500721/9013718 (second snippet)
        }
        let closeBtn = flash.querySelector('.flash-close-btn');
        closeBtn.addEventListener('click', function () {
            slideFlashOut(flash);
        });
        let flashFig = flash.querySelector('.flash-fig');
        flashFig.addEventListener('click', function () {
            slideFlashOut(flash);
        });


        setTimeout(slideFlashOut, (index * 1000) + 8000, flash);
    });
}

/**
 * Remove flash message after a few seconds of display
 *
 * @param flash
 */
function slideFlashOut(flash) {
    flash.className = flash.className.replace('slide-in', "slide-out");
    // Hide a bit later so that page content can go to its place again
    setTimeout(function () {
        flash.style.display = 'none';
        flash.remove();
    }, 800); // .slide-out animation is 0.9s
}
```
  
</details>

## Assets

<details>
  <summary>File: <code>flash-checkmark.svg</code></summary>
 
```svg
<svg width="340" height="310" xmlns="http://www.w3.org/2000/svg">
    <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
    <rect fill="#60e282" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="1.51078" y="163.57676"
          width="170.0088" height="69.55698"
          transform="rotate(46.20000076293945 86.51518249511717,198.35525512695312) " rx="10" stroke="#000"/>
    <rect fill="#60e282" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="56.70539" y="122.25353"
          width="296.876" height="69.557"
          transform="rotate(136.6999969482422 205.14340209960938,157.0320281982422) " rx="10" stroke="#000"/>
</svg>
```
  
</details>


<details>
  <summary>File: <code>flash-info.svg</code></summary>
 
```svg
<svg width="131" height="131" xmlns="http://www.w3.org/2000/svg">
    <!-- Source: https://de.wikipedia.org/wiki/Datei:Infobox_info_icon.svg -->
    <g fill="#89e0f3">
        <path d="m65.50765,0.50765c-35.88,0 -65,29.12 -65,65s29.12,65 65,65s65,-29.12 65,-65s-29.12,-65 -65,-65zm0,10c30.36,0 55,24.64 55,55s-24.64,55 -55,55s-55,-24.64 -55,-55s24.64,-55 55,-55z"
        />
        <path d="m75.50614,36.75835a11.24976,11.2501 0 1 1 -22.49976,0a11.24976,11.2501 0 1 1 22.49976,0z"/>
        <path d="m76.17265,96.46765c-0.069,2.73 1.211,3.5 4.327,3.82l5.008,0.1l0,5.12l-39.073,0l0,-5.12l5.503,-0.1c3.291,-0.1 4.082,-1.38 4.327,-3.82l0,-30.813c0.035,-4.879 -6.296,-4.113 -10.757,-3.968l0,-5.074l30.665,-1.105"
        />
    </g>
</svg>
```
  
</details>


<details>
  <summary>File: <code>flash-warning.svg</code></summary>
 
```svg
<svg width="64" height="58" xmlns="http://www.w3.org/2000/svg">
    <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
    <g>
        <g mask="url(#mask)">
            <g fill="red" transform="matrix(0.455407,0,0,0.455407,26.271447,23.867517) ">
                <path fill="#ffd42a" stroke="#000000" stroke-width="0"
                      d="m-53.09119,59.50004c-0.91397,1.76129 -1.9912,3.408 -1.9913,5.341l0.00903,0.80788c0,4.172 3.26587,6.69412 7.02057,6.69412l121.3197,0c3.755,0 6.98886,-3.12652 6.98886,-7.29852l-0.03986,-0.81148c0,-1.933 -0.95029,-3.61152 -1.991,-5.341l-60.0834,-107.7802c-2.6546,-2.94957 -6.9583,-2.94957 -9.6133,0.0004l-61.6193,108.3878z"
                />
            </g>
        </g>
        <mask id="mask">
            <rect x="0" y="0" fill="white" width="80" height="80"/>
            <path d="m37.01568,46.06105a4.35951,4.35951 0 1 1 -8.71902,0a4.35951,4.35951 0 1 1 8.71902,0z"/>
            <path d="m32.62779,15.77208c1.71269,0 4.37072,1.36457 4.37072,3.05957l-1.27923,17.61571c0,1.695 -1.3788,3.05957 -3.09149,3.05957c-1.71268,0 -3.09148,-1.36457 -3.09148,-3.05957l-1.49244,-17.61571c0,-1.695 2.87124,-3.05957 4.58392,-3.05957z"
            />
        </mask>
    </g>
</svg>
```
  
</details>


<details>
  <summary>File: <code>flash-error.svg</code></summary>
 
```svg
<svg width="260" height="260" xmlns="http://www.w3.org/2000/svg">
    <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
    <rect stroke="#000" rx="10" transform="rotate(-45 130,130)"
          height="69.557" width="296.876" y="95" x="-18" fill-opacity="null" stroke-opacity="null"
          stroke-width="0" fill="#FF8C78"/>
    <rect stroke="#000" rx="10" transform="rotate(45 130,130)" height="69.557"
          width="296.876" y="95" x="-18" fill-opacity="null" stroke-opacity="null" stroke-width="0"
          fill="#FF8C78"/>
</svg>
```
  
</details>

## PHP view template
Display server side flash messages.
  
I use [PHP-View](https://github.com/slimphp/PHP-View) in combination with 
[odan/session](https://github.com/odan/session) but this technology is interchangeable, important is the logic. 

<details>
  <summary>File: <code>layout.html.php</code></summary>
  
```php
<?php /** @var \Odan\Session\FlashInterface $flash */ ?>
<aside id="flash-container">
    <!--    Display errors if there are some -->
    <?php
    foreach ($flash->all() as $key => $flashCategory) {
        foreach ($flashCategory as $msg) { ?>
            <dialog class="flash <?= $key /* success, error, info, warning */ ?>">
                <figure class="flash-fig">
                    <!-- Sadly I cannot use the `content:` tag because its impossible set basepath for css -->
                    <img class="<?= $key === "success" ? "open" : '' ?>" src="assets/general/img/checkmark.svg"
                         alt="success">
                    <img class="<?= $key === "error" ? "open" : '' ?>" src="assets/general/img/cross-icon.svg"
                         alt="error">
                    <img class="<?= $key === "info" ? "open" : '' ?>" src="assets/general/img/info-icon.svg"
                         alt="info">
                    <img class="<?= $key === "warning" ? "open" : '' ?>"
                         src="assets/general/img/warning-icon.svg" alt="warning">
                </figure>
                <div class="flash-message">
                    <h3><?= ucfirst($key) /* Gets overwritten in css, serves as default */ ?> message</h3>
                    <p><?= $msg ?></p>
                </div>
                <span class="flash-close-btn">&times;</span>
            </dialog>
            <?php
        }
    } ?>
</aside>
```
  
</details>

## Other flash design 

  <details>
  <summary><h3>Preview</h3></summary>
    
![Gif of flash messages](https://i.imgur.com/PlN5XB1.gif)
    
  </details>

## CSS

<details>
  <summary>File: <code>flash-message.css</code></summary>
  
```css
#flash-container {
    right: 50px;
    position: fixed;
    z-index: 101; 
}

.flash {
    width: 340px;
    min-height: 70px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    border-radius: 30px 0 30px 0;
    background: white;
    display: flex;
    margin: 25px 0 10px 25px;
    transform: translateX(130%);
    opacity: 0;
    overflow: hidden; /* Prevent color from overflowing rounded border */

    /* Revert default styling of <dialog> */
    position: relative;
    border: none;
    padding: 0;
    align-items: stretch;
}

.flash-close-btn {
    position: absolute;
    top: -10px; /* Large font size and time symbol pretty small it has to be pushed upwards*/
    right: 10px;
    height: 30px;
    font-size: 40px;
    font-weight: lighter;
    color: lightgrey;
    cursor: pointer;
}

/* Color / icon part of flash */
.flash-fig { /* Flex item */
    position: relative;
    width: 100px;
    margin: 0;
    z-index: 1;
    flex-shrink: 0;
}

.flash-fig img {
    height: 40px; /* More relevant than width to have all images with the same size */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    filter: drop-shadow(5px 5px 7px rgba(0, 0, 0, 0.25));
}

.flash-fig img.open {
    /* Sadly I cannot set the image url with the `content:` tag because its impossible set basepath for css */
    display: block;
}

.flash.success .flash-fig {
    background: #43c566;
}
.flash.error .flash-fig {
    background: #e65e45;
}
.flash.info .flash-fig {
    background: #45bdd4;
}
.flash.warning .flash-fig {
    background: #eaa030;
}

/* Text part of flash */
.flash-message { /* Flex item */
    flex-grow: 1;
}
.flash-message h3 {
    margin: 10px 10px 6px 10px;
    font-size: 1rem;
}
.flash.success h3, .flash.error h3, .flash.info h3, .flash.warning h3{
    /* Only remove title for those defined with CSS below */
    text-indent:-9999px; /* Change h3 text in css https://stackoverflow.com/a/26889106/9013718 */
}
.flash.success h3:before, .flash.error h3:before, .flash.info h3:before, .flash.warning h3:before{
    text-indent:0;
    float:left;
}
.flash.success h3:before{
    content: 'YAY! Success!';
    color: #28a548;
}
.flash.error h3:before{
    content: 'OOPS! Error...';
    color: #ae4931;
}
.flash.info h3:before{
    content: 'Information.';
    color: #008fa2;
}
.flash.warning h3:before{
    content: 'Caution!';
    color: #bc6500;
}

.flash-message p {
    margin: 3px 10px 10px 10px;
    font-size: 0.9rem;
    width: 200px;
}

.slide-in {
    animation: slide-in 0.9s forwards;
}

.slide-out {
    animation: slide-out 0.9s forwards;
}

@keyframes slide-in {
    100% {
        transform: translateX(0%);
        opacity: 1;
    }
}

@keyframes slide-out {
    0% {
        transform: translateX(0%);
        opacity: 1;
    }
    100% {
        transform: translateX(130%);
        opacity: 0;
    }
}
```

  </details> 
