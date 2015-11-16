<!DOCTYPE html>
<html>
	<head>
		{{ stylesheet_link("//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css") }}
		{{ stylesheet_link("css/style.css") }}
        {{ stylesheet_link("//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css") }}
		{{ javascript_include("//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js") }}
		{{ javascript_include("//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js") }}
        {{ javascript_include("//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js") }}
        {{ javascript_include("//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js") }}
        {{ javascript_include("js/app.js") }}
		{% block head %}
		{% endblock %}
		<title>{% block title %}{% endblock %} | MarketDraft</title>
	</head>
	<body id="page-top" class="index">
			{% block body %}
			{% endblock %}
	</body>
</html>