# User friendly responsive error page 

![Error page](https://i.imgur.com/r1j4SoL.png) 

## HTMl
```html
<main>
    <section id="cloud-section" class="">
        <div class="cloud small-cloud"><span>404</span></div>
        <div class="cloud big-cloud"><span>&#129301;</span></div>
    </section>
    <section id="error-description-section">
        <h2 id="title">Nothing but clouds here.</h2>
        <p>Try to navigate with the menu or if you did, <a href="mailto:contact@samuel-gfeller.ch">contact me</a>.</p>
    </section>
    <section id="home-btn-section">
        <a href="/home" class="btn">Go back home</a>
    </section>

</main>
```

## CSS

```css
@font-face {
    font-family: ExpletusSans;
    src: url(ExpletusSans.ttf);
}

@font-face {
    font-family: Montserrat;
    src: url(../general/fonts/Montserrat.ttf);
}

:root {
    --small-cloud-size: 0.4;
    --big-cloud-size: 0.6;
}

/* mobile first min-width sets base and content is adapted to computers. */
@media (min-width: 100px) {
    main {
        background: lightblue;
        display: flex;
        flex-flow: column;
    }

    #cloud-section{
        flex: 1 0 auto;
    }

    #error-description-section {
        text-align: center;
        flex: 1 1 auto;
    }

    #home-btn-section{
        flex: 1 1 auto;
        width: 100%;
        text-align: center;
    }
    #home-btn-section a{
        width: 80%;
        padding: 15px 15px;
        border: none;
        box-shadow: 0 5px 10px white;
        display: inline-block; /* Needed to give the button a width */
        text-decoration: none;
    }
    #home-btn-section a:hover {
        box-shadow: 0 0 10px white;
        background: white; /* Default changes color */
        text-shadow: none;
    }

    .cloud {
        margin: calc(50px * var(--big-cloud-size));
        width: calc(350px * var(--big-cloud-size));
        height: calc(120px * var(--big-cloud-size));
        background: #ECEFF1;
        box-shadow: calc(10px * var(--big-cloud-size)) calc(10px * var(--big-cloud-size)) rgba(0, 0, 0, 0.2);
        border-radius: calc(100px * var(--big-cloud-size));
        position: relative;
    }
    .cloud::after, .cloud::before {
        content: "";
        position: relative;
        display: inline-block;
        background: inherit;
        border-radius: inherit;
    }
    .cloud::after {
        width: calc(100px * var(--big-cloud-size));
        height: calc(100px * var(--big-cloud-size));
        top: calc(-120px * var(--big-cloud-size));
        left: calc(-120px * var(--big-cloud-size));
    }
    .cloud::before {
        width: calc(180px * var(--big-cloud-size));
        height: calc(180px * var(--big-cloud-size));
        top: calc(-70px * var(--big-cloud-size));
        left: calc(130px * var(--big-cloud-size));
    }
    .cloud span {
        margin: 0;
        position: absolute;
        z-index: 999;
        top: 40%;
        transform: translate(-50%, -50%);
        font-size: calc(5em * var(--big-cloud-size));
        font-family: ExpletusSans, CenturyGothic, Geneva, AppleGothic, sans-serif;
        text-shadow: calc(5px * var(--big-cloud-size)) calc(5px * var(--big-cloud-size)) 2px rgba(0, 0, 0, 0.2);
    }

    .big-cloud {
        margin: 50px 0 0 0;
        position: absolute;
        right: 20px;
    }

    .small-cloud {
        margin: 170px 0 0 10px;
        width: calc(350px * var(--small-cloud-size));
        height: calc(120px * var(--small-cloud-size));
        background: #ECEFF1;
        box-shadow: calc(10px * var(--small-cloud-size)) calc(10px * var(--small-cloud-size)) rgba(0, 0, 0, 0.2);
        border-radius: calc(100px * var(--small-cloud-size));
        position: relative;
        float: left; /* To allow big cloud to be above */
    }
    .small-cloud::after, .cloud::before {
        content: "";
        position: relative;
        display: inline-block;
        background: inherit;
        border-radius: inherit;
    }
    .small-cloud::after {
        width: calc(100px * var(--small-cloud-size));
        height: calc(100px * var(--small-cloud-size));
        top: calc(-120px * var(--small-cloud-size));
        left: calc(-120px * var(--small-cloud-size));
    }
    .small-cloud::before {
        width: calc(180px * var(--small-cloud-size));
        height: calc(180px * var(--small-cloud-size));
        top: calc(-70px * var(--small-cloud-size));
        left: calc(130px * var(--small-cloud-size));
    }
    .small-cloud span {
        font-size: calc(5em * var(--small-cloud-size));
        text-shadow: calc(5px * var(--small-cloud-size)) calc(5px * var(--small-cloud-size)) 2px rgba(0, 0, 0, 0.2);
    }

    #error-description-section h2{
        font-size: 2em;
        font-weight: bold;
        color: white;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 1);
        font-family: Montserrat, CenturyGothic, Geneva, AppleGothic, sans-serif;
    }
    #error-description-section p{
        font-size: 1.2em;
    }
}

/* breakpoint where clouds distort with flex*/
@media (min-width:400px) {
    #cloud-section{
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .small-cloud{
        float: none;
        margin: 80px 0 0 0;
    }
    .big-cloud{
        position: relative;
        margin: 0;
        right: 0;
    }
    #home-btn-section a{
        width: 200px;
    }
}

/* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
@media (min-width:641px) {
    :root{
        --small-cloud-size: 0.5;
        --big-cloud-size: 0.7;
    }
    .big-cloud {
        margin: 60px 0 0 0;
    }
    .small-cloud{
        margin: 60px 0 0 0;
    }
    #error-description-section p{
        letter-spacing: 1px;
    }
    #error-description-section h2 {
        font-size: 2.3em;
    }
}

@media (min-width:710px) {
    /* Increase cloud size*/
    :root{
        --small-cloud-size: 0.6;
        --big-cloud-size: 0.8;
    }
}

/* tablet, landscape iPad, lo-res laptops and desktops */
@media (min-width: 961px) {
    #error-description-section h2 {
        font-size: 3em;
    }
    :root {
        --small-cloud-size: 0.8;
        --big-cloud-size: 1;
    }
}
```

## PHP-View Template
PHP Template file. 

```php
<?php
/**
 * @var \Slim\Interfaces\RouteParserInterface $route
 * @var array $errorMessage containing statusCode and reasonPhrase
 */

?>
<section id="cloud-section" class="">
    <div class="cloud small-cloud"><span><?= $errorMessage['statusCode'] ?></span></div>
    <div class="cloud big-cloud"><span>&#129301;</span></div>
</section>
<section id="error-description-section">
    <?php
    switch ($errorMessage['statusCode']) {
        case 404:
            $title = 'Nothing but clouds here.';
            $message = 'Try to navigate with the menu or if you did, <a href="mailto:contact@samuel-gfeller.ch">contact me</a>.';
            break;
        case 400:
            $title = 'The request is invalid';
            $message = 'There is something wrong with the request. <br>Please try again and 
<a href="mailto:contact@samuel-gfeller.ch">contact me</a>.';
            break;
        case 422:
            $title = 'Validation failed.';
            $message = 'Please try again with valid data or <a href="mailto:contact@samuel-gfeller.ch">contact me</a>.';
            break;
        case 500:
            $title = 'Internal Server Error.';
            $message = 'It\'s not your fault! The server has an internal error. <br> Please try again and 
<a href="mailto:contact@samuel-gfeller.ch">ping me</a> so I can have a look.';
            break;
        default:
            $title = 'An error occurred.';
            $message = 'Bad thing is that there is an error, but the good thing is that it\'s fixable! <br>
Please try again and then <a href="mailto:contact@samuel-gfeller.ch">contact me</a>.';
            break;
    }
    ?>
    <h2 id="title"><?= $title ?></h2>
    <p><?= $message ?></p>
</section>
<section id="home-btn-section">
    <a href="<?= $route->urlFor('hello') ?>" class="btn">Go back home</a>
</section>
```