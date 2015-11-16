<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->tag->stylesheetLink('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>
		
		
		<title>Signup | MarketDraft</title>
	</head>
	<body>
		<div class="container">
			
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
		<?php foreach ($errors as $error) { ?>
			<?php echo $error; ?>
		<?php } ?>
	
		</div>
	</body>
</html>