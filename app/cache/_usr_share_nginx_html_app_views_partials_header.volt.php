<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<a class="navbar-brand" href="/">MarketDraft</a>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php if ($this->session->has('user')) { ?>
					<li>
						<a href="/leagues">Leagues</a>
					</li>
					<a class="btn btn-default navbar-btn" href="/logout">Logout</a>
				<?php } else { ?>
					<a class="btn btn-default navbar-btn" href="/login">Login</a>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>