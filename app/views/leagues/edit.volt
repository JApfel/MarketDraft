{% extends 'templates/layout.volt' %}

	{% block title %}Edit League{% endblock %}
	
	{% block body %}
		<div class="row">
			<form class="form-inline" action="/leagues/{{ league.id }}/update" method="post">
				<div class="form-group">
					<input class="form-control" type="text" name="name" placeholder="League Name" value="{{ league.name }}" />
				</div>
				<input class="btn btn-default" type="submit" value="Update League" />
			</form>
		</div>
		
		<div class="row">
			<a class="btn btn-danger" href="/leagues/{{ league.id }}/delete">Delete this league</a>
		</div>
	{% endblock %}