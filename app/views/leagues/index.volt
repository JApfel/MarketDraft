{% extends 'templates/layout.volt' %}

	{% block title %}Leagues{% endblock %}
	
	{% block body %}
	
		<div class="row">
			<a class="btn btn-default" href="/leagues/new">Create new league</a>
		</div>
		
		
		<div class="row">
			{% for userLeague in userLeagues %}
				<a href="/leagues/{{ userLeague.leagues.id }}">{{ userLeague.leagues.name }}</a>
			{% else %}
				You have no leagues
			{% endfor %}
		</div>
		
	{% endblock %}