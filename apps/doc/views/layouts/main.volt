<!DOCTYPE html>
<html>
<head>
{{ get_title() }}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
{{ partial("partials/head") }}
</head>
<body>
{{ partial("partials/header") }}
{{ content() }}
{{ partial("partials/footer") }}
{{ javascript_include("js/jquery-1.11.3.min.js") }}
{{ javascript_include("js/bootstrap.min.js") }}
</body>
</html>
