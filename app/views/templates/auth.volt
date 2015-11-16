<!DOCTYPE html>
<html>
	<head>
		{{ stylesheet_link("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css") }}
		{{ stylesheet_link("css/style.css") }}
		{{ javascript_include("//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js") }}
		{{ javascript_include("//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js") }}
		{% block head %}
		{% endblock %}
		<title>{% block title %}{% endblock %} | MarketDraft</title>
	</head>
	<body>
		<div class="container">
			{% block body %}
			{% endblock %}
		</div>
	</body>
</html>