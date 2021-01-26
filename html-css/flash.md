# Flash messages

### Preview
![Gif of flash messages](https://i.imgur.com/PlN5XB1.gif)

## View template
I use [PHP-View](https://github.com/slimphp/PHP-View) in combination with 
[odan/session](https://github.com/odan/session) but this technology is interchangeable, important is the logic.   
  
File: `layout.html.php`
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

## CSS
File: `flash.css`
```css
#flash-container {
    float: right;
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

## Javascript
File: `flash.js`
```js
window.addEventListener("load",function(event) {
    let flashes = document.getElementsByClassName("flash");
    Array.from(flashes).forEach(function(flash, index) {
        if (index === 0){
            // Add first without timeout
            flash.className += ' slide-in'
        }else {
            setTimeout(function () {
                flash.className += ' slide-in'
            }, index * 1000); // https://stackoverflow.com/a/45500721/9013718 (second snippet)
        }
        let closeBtn = flash.querySelector('.flash-close-btn');
        closeBtn.addEventListener('click', function () {
            slideFlashOut(flash)
        });

        setTimeout(slideFlashOut, (index * 1000) + 8000, flash);
    });
    function slideFlashOut(flash){
        flash.className = flash.className.replace('slide-in', "slide-out");
        // Hide a bit later so that page content can go to its place again
        setTimeout(function () {
            flash.style.display = 'none';
        }, 800); // .slide-out animation is 0.9s
    }
});
```