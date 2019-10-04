# Presentation Offline First

### Progressive Web App
A website with some improvements

People of Google and WWW sat together and found 
4 reasons why mobile applications are so popular over websites on mobile  
**F**ast  
**I**ntegrated  
**R**eliable - responsibility inside ui of app without any connection 
(for eg. an email app you can read emails even if there is no network)  
**E**ngaging


## Static files
### ServiceWorker
Registered inside local browser.
With service worker, a request goes from the site to the service Worker then to the internet.
If internet is cut down the service worker can still send data

#### Register service worker
```js
if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register('/service-worker.js');
}
```

```js
self.addEventListener('install', event => console.log('serviceworker install..'));

self.addEventListener('activate', event => console.log('serviceworker installed.'));

self.addEventListener('fetch', event => {
	console.log(`Request Method ${event.request.method}`);
	console.log(`Handling fetch event for ${event.request.url}`);
);
```

'fetch' event processes the requests

#### WorkboxJS

Tool to give us caching strategies and pre cache files
https://developers.google.com/web/tools/workbox

Examples:  
```js
importScripts('/workbox-v4.3.1/workbox-sw.js');
workbox.routing.registerRoute(
	/\.(?:png|gif|jpg|svg|ico)$/,
	new workbox.strategies.CacheFirst({
		cacheName: 'image-cache'
	})
);
```

Delete cached element after a year:
```js
importScripts('/workbox-v4.3.1/workbox-sw.js');
workbox.routing.registerRoute(
	/\.(?:png|gif|jpg|svg|ico)$/,
	new workbox.strategies.CacheFirst({
		"cacheName":"image-cache",
		plugins: [
			new workbox.expiration.Plugin({
				maxAgeSeconds: 60 * 60 * 24 * 365,
			}),
		]
	})
);
```

[Slide](https://slides.nico.dev/vuebasel-offline-first/#/3/6)

### IndexedDB
IndexedDB is a Non-relational database (an Object Store) inside the Browser  
[Example](https://slides.nico.dev/vuebasel-offline-first/#/4/1)

[Slide](https://slides.nico.dev/vuebasel-offline-first/#/4)

### WC Guide
Example of website with offline first  
https://wc-guide.com  
[Generate Service worker](https://github.com/wc-guide/wc-guide-pwa/blob/master/webpack.config.babel.js#L192)
[Offline First with Vuex](https://github.com/wc-guide/wc-guide-pwa/blob/master/src/app/store/modules/entries.js#L25)

[Slide](https://slides.nico.dev/vuebasel-offline-first/#/5)

### Persistent Storage
If every site would store everything locally the storage would run out so Chrome 
decides whether the site is allowed to store the data or not with indicators such as if 
the site is bookmarked or on the home screen

[Persistant storage](https://slides.nico.dev/vuebasel-offline-first/#/6)
