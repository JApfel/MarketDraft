{% extends 'templates/layout.volt' %}

	{% block title %}League {{ league.id }}{% endblock %}
	
	{% block body %}
		{{ league.name }}
		<a href="/leagues/{{ league.id }}/edit">Edit</a>
	{% endblock %}