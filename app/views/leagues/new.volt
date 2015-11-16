{% extends 'templates/layout.volt' %}

	{% block title %}New League{% endblock %}
	
	{% block body %}
		<form action="/leagues/create" method="post">
			<input type="text" name="name" placeholder="League Name" />
			<input type="submit" value="Create League" />
		</form>
	{% endblock %}