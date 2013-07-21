{{ get_doctype() }}
<html>
<head>
{{ get_title() }}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
{{ stylesheet_link("assets/css/bootstrap.min.css") }}
{{ stylesheet_link("assets/css/bootstrap-responsive.min.css") }}
{{ stylesheet_link("assets/css/prettify.css") }}
{{ stylesheet_link("assets/css/style.css") }}
</head>
<body>
{{ content() }}
{{ javascript_include("assets/js/html5.js") }}
{{ javascript_include("assets/js/jquery-1.10.1.min.js") }}
{{ javascript_include("assets/js/bootstrap.min.js") }}
{{ javascript_include("assets/js/prettify.js") }}
{{ javascript_include("assets/js/app.js") }}
</body>
</html>


