# megatag

WARNING! THIS IS BAD CODE!

i put it here for lazy guys to use and for perfectionists to improve.

Tagging system 

it relies on bootstrap and typehead

 
This plugin is designed to be used with a backend database.
you can let your users add custom tags using this plugin.

####Screenshot

![Screenshot](http://i.imgur.com/rxFB6h8.png)


#### Basic Example

It's easy to get started, first include the JavaScript files and the CSS

```html
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/megatag.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/typeahead.bundle.min.js"></script>
<script src="js/megatag.js"></script>
```


```html
<div class="megatag-s" data="GLOBI"></div>
```
dont forget to set up the sql database example.sql is provided
and change the server address in the megatag.js
and change the database connection in megatag.php

####Development

...

####TODO<br>
-no sql injection protection<br>
-some ugly javascript<br>
-html example for the search. (javscript example provided [try SearchItems('globi') in console])
