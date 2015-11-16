{% extends 'templates/auth.volt' %}

	{% block title %}Login{% endblock %}
	
	{% block body %}
		<form action method="post">
			<div class="form-group">
				<input class="form-control" type="text" name="username" placeholder="Username" />
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Password" />
			</div>
			<input class="btn btn-primary" type="submit" value="Login" />
		</form>
		<a href="/signup">Sign Up</a>
		{% if signedUp %}
			Successfully signed up! Please login.
		{% endif %}
	{% endblock %}