<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->tag->stylesheetLink('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>
        <?php echo $this->tag->javascriptInclude('js/app.js'); ?>
		
		
		<title>Leagues | MarketDraft</title>
	</head>
	<body>
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
		<div class="container">
			
	
		<div class="row">
			<a class="btn btn-default" href="/leagues/new">Create new league</a>
		</div>
		
		
		<div class="row">
			<?php $v12271633445250366541iterated = false; ?><?php foreach ($userLeagues as $userLeague) { ?><?php $v12271633445250366541iterated = true; ?>
				<a href="/leagues/<?php echo $userLeague->leagues->id; ?>"><?php echo $userLeague->leagues->name; ?></a>
			<?php } if (!$v12271633445250366541iterated) { ?>
				You have no leagues
			<?php } ?>
		</div>
		
	
		</div>
	</body>
</html>