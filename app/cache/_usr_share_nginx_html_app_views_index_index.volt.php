<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->tag->stylesheetLink('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
        <?php echo $this->tag->stylesheetLink('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>
		<?php echo $this->tag->javascriptInclude('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>
        <?php echo $this->tag->javascriptInclude('//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'); ?>
        <?php echo $this->tag->javascriptInclude('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'); ?>
        <?php echo $this->tag->javascriptInclude('js/app.js'); ?>
		
		
		<title>Home | MarketDraft</title>
	</head>
	<body id="page-top" class="index">
			
       <nav class="navbar navbar-default">
            <div class="topbar-nav clearfix">
                <div class="container">
                    <ul class="topbar-left list-unstyled list-inline">
                        <li> <span class="fa fa-phone"></span> 123-456-7890 </li>
                        <li> <span class="fa fa-envelope"></span> info@yourdomain.com </li>
                    </ul>
                    <ul class="topbar-right list-unstyled list-inline topbar-social">
                        <li>
                            <a href="/"> <span class="fa fa-facebook"></span> </a>
                        </li>
                        <li>
                            <a href="/"> <span class="fa fa-twitter"></span> </a>
                        </li>
                        <li>
                            <a href="/"> <span class="fa fa-google-plus"></span> </a>
                        </li>
                        <li>
                            <a href="/"> <span class="fa fa-dribbble"></span> </a>
                        </li>
                        <li>
                            <a href="/"> <span class="fa fa-instagram"></span> </a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="container" style="max-width: 1050px;">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">Market Draft</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="/login">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header id="hero">
            <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in hidden">Market Draft</div>
                    <div class="intro-heading">Market Draft</div>
                    <a href="/" class="page-scroll btn btn-xl mr30 btn-primary">Learn More</a>
                    <a href="/league" class="page-scroll btn btn-xl btn-wire">Make a League</a>
                </div>
            </div>
        </header>
         <section id="features-flat" class="bg-light">
        <div class="container">
             
            <div class="row">
                <div class="col-sm-12 col-md-6 text-center">
                    <h2 class="section-heading mt70">Play With Your Friends</h2>
                    <h3 class="section-subheading text-muted mb30">Easily invite friends and go against the odds.</h3>
                    <p class="text-muted mb50">Invite as many friends as you want. Invite as many friends as you want in your league. Have fun! </p>
	                <a href="/" class="page-scroll btn btn-xl mr30 btn-primary pv15">Learn More</a>

                </div>
                <div class="hidden-sm hidden-xs col-md-6">
              		<img src="img/pic1.png" title="iMac Image" class="img-responsive pull-right">
              </div>
            </div>
            
        </div>
    </section>
    <section id="features-flat">
        <div class="container">
             
            <div class="row">
                <div class="hidden-sm hidden-xs col-md-6">
              		<img src="img/features/flat_feature2.png" title="iMac Image" class="img-responsive pull-left">
                </div>
                <div class="col-sm-12 col-md-6 text-center">
                    <h2 class="section-heading mt70">Donate to a Better Cause</h2>
                    <h3 class="section-subheading text-muted mb30">This is your way to help others!</h3>
                    <p class="text-muted mb50">When you win, everyone wins.</p>
	                <a href="index.html#services" class="page-scroll btn btn-xl mr30 btn-danger pv15">Learn about Charities Near You</a>
                </div>
            </div>
            
        </div>
    </section>
	
	</body>
</html>