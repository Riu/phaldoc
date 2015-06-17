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
{{ javascript_include("themes/default/js/jquery-1.11.2.min.js") }}
{{ javascript_include("themes/default/js/bootstrap.min.js") }}
{{ javascript_include("themes/default/js/plugins/validate/jquery.validate.min.js") }}
{{ javascript_include("themes/default/js/plugins/validate/messages_pl.min.js") }}
{{ javascript_include("themes/default/js/app.js") }}
</body>
</html>
