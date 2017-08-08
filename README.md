# megatag

Tagging system based on StackOverflows tags with descriptions.

I found myself in need of a tagging system, so I searched far and wide on the internet for a decent one, and I couldn't find one! The style I was going for was the tagging system used on StackOverflow (hence the name SOTag). And searching StackOverflow there are hundreds of questions asking for tagging systems like it!


First a little description about what this plugin is for. This plugin is designed to be used with a backend database.
you can let your users add custom tags using this plugin.

####Screenshot

![Screenshot](http://i.imgur.com/3XlrepR.png)

Please note the sample data is taken directly off the StackOverflow website and remains their property.

#### Basic Example

It's easy to get started, first include the JavaScript files and the CSS

```html
<link rel="stylesheet" type="text/css" href="css/so_tag.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/so_tag.js"></script>
```


```html
<input type="text" value="1_some, 2_example, 3_tags" id="basic_example" />
<script type="text/javascript">
$('#basic_example').sotag({
	description : true
});
</script>
```

To actually get it to post to the server side just wrap it in a form and add a submit button!

```html
<form action="result.php" method="post">
	<input type="text" value="3_php" name="single_example" id="single_example" />
	<input type="submit" value="Submit" />
</form>

<script type="text/javascript">
$('#single_example').sotag({
	description : true
});
</script>
```
####Development



####TODO

