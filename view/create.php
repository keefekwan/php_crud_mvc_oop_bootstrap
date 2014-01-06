<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Crud app Contact Form</title>
		<meta charset="utf-8">
		<link href="http://localhost/projects/dist/css/bootstrap.min.css" rel="stylesheet"> 
		<script src="http://localhost/projects/dist/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<div class="container">
			<div class="span 10 offset1">
				<div class="row">
					<h3><strong>Create a contact</strong></h3>
					<?php
						if ($errors) {
							echo '<ul class="errors">';
							foreach ($errors as $field => $error) {
								echo '<li>' . htmlentities($error) . '</li>';
							}
							echo '</ul>';
						}
					?>
				</div>

				<form class="form-horizontal" action="" method="post">
					<div class="control-group">
						<label class="control-label">Name</label>
							<div class="controls">
								<input type="text" name="name" placeholder="Name" value="<?php echo htmlentities($name); ?>">
								<span class="help-inline"></span>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Email Address</label>
							<div class="controls">
								<input type="text" name="email" placeholder="Email Address" value="<?php echo htmlentities($email); ?>">
								<span class="help-inline"></span>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Mobile Number</label>
							<div class="controls">
								<input type="text" name="mobile" placeholder="Mobile Number" value="<?php echo htmlentities($mobile); ?>">
								<span class="help-inline"></span>
							</div>
					</div>
					<br>
					<div class="form-actions">
						<input type="hidden" name="form-submitted" value="1">
						<button type="submit" class="btn btn-success">Create</button>
						<a class="btn btn-default" href="index.php">Back</a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>