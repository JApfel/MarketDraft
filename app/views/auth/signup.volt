{% extends 'templates/auth.volt' %}

	{% block title %}Signup{% endblock %}
	
	{% block body %}
		<form action method="post">
			<div class="form-group">
				<input class="form-control" type="text" name="username" placeholder="Username" />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="email" placeholder="Email" />
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Password" />
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />
			</div>
			<input class="btn btn-primary" type="submit" value="Sign up" />
		</form>
		{% for error in errors %}
			{{ error }}
		{% endfor %}
	{% endblock %}