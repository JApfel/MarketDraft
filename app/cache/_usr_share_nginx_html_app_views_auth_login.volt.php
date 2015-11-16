<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->tag->stylesheetLink('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>
		
		
		<title>Login | MarketDraft</title>
	</head>
	<body>
		<div class="container">
			
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
		<?php if ($signedUp) { ?>
			Successfully signed up! Please login.
		<?php } ?>
	
		</div>
	</body>
</html>