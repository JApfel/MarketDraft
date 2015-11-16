<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<a class="navbar-brand" href="/">MarketDraft</a>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				{% if session.has('user') %}
					<li>
						<a href="/leagues">Leagues</a>
					</li>
					<a class="btn btn-default navbar-btn" href="/logout">Logout</a>
				{% else %}
					<a class="btn btn-default navbar-btn" href="/login">Login</a>
				{% endif %}
			</ul>
		</div>
	</div>
</nav>