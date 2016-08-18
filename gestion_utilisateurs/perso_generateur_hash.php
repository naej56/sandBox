<?php 
if(isset($_POST['login']) && isset($_POST['password'])){
	$passwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$login = $_POST['login'];
	$db = new PDO('mysql:dbname=quoma;host=localhost', 'quoma', 'quoma');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$statement = 'UPDATE t_user SET password = :passwd WHERE login = :login';
	$rqt = $db->prepare($statement);
	$attribues = ['passwd' => $passwd, 'login' => $login];
	$rqt->execute($attribues);

	if(password_verify($_POST['password'], $passwd)){
		echo "<pre> Mot de passe encodé avec succes </pre>";
	} else {
		echo "<pre> Erreur d'encodage </pre>"; 
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<title>Encodage MDP</title>
</head>
<body>
<div class="container">
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<form action="perso_generateur_hash.php" method="POST" class="form-signin">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-group">
					<label for="inputEmail" class="sr-only">Utilisateur ou adresse mail</label>
					<input type="text" name="login" id="inputEmail" class="form-control" placeholder="Utilisateur ou adresse mail" required autofocus>
				</div>
			</div>
			<div class="col-md-6 col-md-offset-3">
				<div class="form-group">
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
				</div>
			</div>
			<div class="col-md-6 col-md-offset-3">
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-primary btn-block">Encoder le mdp</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</body>
</html>