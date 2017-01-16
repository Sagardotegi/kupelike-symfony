<html>
	<head>
		<title>Your Website Title</title>
	    <!-- You can use open graph tags to customize link previews.
	    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
		<!--<meta property="og:url"           content="https://c9.io/jauzmendiji" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Facebook proba" />
		<meta property="og:description"   content="Your description" />
		<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />-->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css" type="text/css" />
		

		<script>
		
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		</script>

	</head>
	<body>
		
		<div class="container">
			
			<div class="row">
				<div class="col-xs-12 col-md-6 offset-md-3">
				    <div class="input-group pt-3">
				      <input type="text" class="form-control" placeholder="Bilatu...">
				      <span class="input-group-btn">
				        <button class="btn btn-secondary search-button" type="button"><i class="fa fa-search fa-3" aria-hidden="true"></i></button>
				      </span>
				    </div>
			  	</div>
			</div>
			
			<div class="row pt-3">
				
				<div class="col-xs-9">
					
					<div class="row kupela">
						<div class="col-xs-5">
							<img src="/img/kupela.jpg" alt="Kupela 1" class="img-thumbnail rounded-circle kupela-img">
						</div>
						<div class="col-xs-7 kupela-testua pt-2">
							<h1 class="display-3 hidden-sm-down">Kupela 1</h1>
							<h2 class="hidden-md-up display-5">Kupela 1</h2>
							<blockquote class="blockquote hidden-md-down">
								<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
							</blockquote>
						</div>
					</div>
					
				</div>
				
				<div class="col-xs-3">
						
					<!-- Your like button code	-->
					<?php
						session_start();
						require_once('../../vendor/autoload.php');
						//require_once('../../vendor/Facebook/src/Facebook/autoload.php');
						$fb = new Facebook\Facebook([
						  'app_id' => '765683296917544', // Replace {app-id} with your app id
						  'app_secret' => '31ad4ff7d32353f15149a55b4b965596',
						  'default_graph_version' => 'v2.8'
						  ]);
						
						$helper = $fb->getRedirectLoginHelper();
						
						$permissions = ['email']; // Optional permissions
						$loginUrl = $helper->getLoginUrl('https://kupelike-oalba.c9users.io/web/likes/datos.php', $permissions);
						
						echo '<div><button class="btn"><a href="' . htmlspecialchars($loginUrl) . '">Recibir aviso</a></button></div>';
						
					?>
					
					<div class="fb-like" data-href="https://kupelike-oalba.c9users.io/princi.php" data-layout="button"
					data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
				
				</div>
	
		</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
	
	</body>
</html>