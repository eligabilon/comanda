<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - 4x4</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.php">
				Sistema 4x4 Monobloco
			</a>		
			
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container">
	
	<div class="content clearfix">
		
		<form action="#" method="post">
		
			<h1>Fazer Login</h1>
			
			<div class="login-fields">
				<p></p>
				
				<div class="field">
					<label for="username">Login</label>
					<input type="text" id="username" name="username" value="" placeholder="Usuário" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Senha:</label>
					<input type="password" id="password" name="password" value="" placeholder="Senha" class="login password-field"/>
				</div> <!-- /password -->
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				<span class="login-checkbox">
                    <a href="esqueci_senha.php"><label class="choice" for="Field">Esqueci a senha</label></a>
				</span>

                <button class="button btn btn-success btn-large">Entrar</button>

			</div> <!-- .actions -->

		</form>
	</div> <!-- /content -->
</div> <!-- /account-container -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
