<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<meta charset="UTF-8">
	<title>TEST MAIL 1.0.0</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>
<body>
<pre class="alert alert-warning">
<?php 
	include "PHPMailerAutoload.php";
	$valid_data = array();
	if(!empty($_POST) ):
		if(empty($_POST['host'])):
			$valid_data[] = 'empty Host'; 
		endif;
		if(empty($_POST['username'])):
			$valid_data[] = 'empty username'; 
		endif;
		if(empty($_POST['password'])):
			$valid_data[] = 'empty Password'; 
		endif;

		if(empty($_POST['port'])):
			$valid_data[] = 'empty Port'; 
		endif;

		if(empty($_POST['from'])):
			$valid_data[] = 'empty From'; 
		endif;

		if(empty($_POST['from_name'])):
			$valid_data[] = 'empty From Name'; 
		endif;

		if(empty($_POST['sender'])):
			$valid_data[] = 'empty Sender'; 
		endif;

		if(empty($_POST['sender_name'])):
			$valid_data[] = 'empty Sender name'; 
		endif;		

		if(!$valid_data):
			
			$corpoHTML = "";
			$corpoHTML .= '<div>Email test '.date("Y-m-d h:i:s").'</div>';


			$mail = new PHPMailer;
			$mail->CharSet = 'UTF-8';
			$mail->SMTPDebug = 2;
			$mail->Host = $_POST['host'];                           
			$mail->Username = $_POST['username']; 
			$mail->Password = $_POST['password'];
			$mail->SMTPSecure = $_POST['secure'];                            
			$mail->Port = $_POST['port'];                                 
			$mail->From = $_POST['from'];
			$mail->FromName = $_POST['from_name'];
			$mail->addAddress($_POST['sender'],$_POST['sender_name']);

			$mail->isSMTP();  
			$mail->SMTPAuth = true;
			$mail->isHTML(true);
			$mail->Subject = "TESTE - PHPMAILER";
			$mail->Body    = $corpoHTML;
			$mail->send();
		else:
			foreach ($valid_data as $value) {
				echo $value."\n";
			}
		endif;
	endif;
?>
</pre>
<form action="" method="POST">
	<div class="row justify-content-md-center">
		<div class="col col-lg-2">
			<label for="">Host</label>
			<input class="form-control" type="text" name="host" value="<?= !empty($_POST['host']) ? addslashes($_POST['host']) : "";  ?>">
			<br>
			<label for="">Username</label>
			<input class="form-control" type="text" name="username" value="<?= !empty($_POST['username']) ? addslashes($_POST['username']) : "";  ?>">
			<br>
			<label for="">Password</label>
			<input class="form-control" type="text" name="password" value="<?= !empty($_POST['password']) ? addslashes($_POST['password']) : "";  ?>">
			<br>
			<label for="">Port</label>
			<input class="form-control" type="text" name="port" value="<?= !empty($_POST['port']) ? addslashes($_POST['port']) : "";  ?>">
			<br>
			<fieldset class="form-group">
				<br>
				<p>Secure</p>

				<div class="form-check">
				  <label class="form-check-label">
				    <input type="radio" class="form-check-input" name="secure" id="optionsRadios1" value="" <?= empty($_POST['secure']) ? "checked" : "";  ?>>
				   	Nenhum
				  </label>
				</div>

				<div class="form-check">
				  <label class="form-check-label">
				    <input type="radio" class="form-check-input" name="secure" id="optionsRadios2" value="tts" <?php if(!empty($_POST['secure']) && $_POST['secure'] == "tts") echo "checked";  ?>>
				   	TTS
				  </label>
				</div>

				<div class="form-check">
				  <label class="form-check-label">
				    <input type="radio" class="form-check-input" name="secure" id="optionsRadios3" value="ssl" <?php if(!empty($_POST['secure']) && $_POST['secure'] == "ssl") echo "checked";  ?>>
				   	SSL
				  </label>
				</div>
			</fieldset>

		</div>
		<div class="col col-lg-2">
			<label for="">From(email)</label>
			<input class="form-control" type="text" name="from" value="<?= !empty($_POST['from']) ? addslashes($_POST['from']) : "";  ?>">	
			<br>
			<label for="">From name</label>
			<input class="form-control" type="text" name="from_name" value="<?= !empty($_POST['from_name']) ? addslashes($_POST['from_name']) : "";  ?>">	
			<br>
			<label for="">Sender(email)</label>
			<input class="form-control" type="text" name="sender" value="<?= !empty($_POST['sender']) ? addslashes($_POST['sender']) : "";  ?>">	
			<br>
			<label for="">Sender Name</label>
			<input class="form-control" type="text" name="sender_name" value="<?= !empty($_POST['sender_name']) ? addslashes($_POST['sender_name']) : "";  ?>">
		</div>
	</div>
	<br>
	<div class="row justify-content-md-center">
		<button class="btn btn-info btn-lg">Send test</button>
	</div>
	<br>
	<div class="row justify-content-md-center">
		<label for="">Após terminar os testes é aconselhavel que todos os arquivos sejam removidos do servidor.</label>
	</div>
</form>

	
</body>
</html>