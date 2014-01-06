<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>View Contact</title>
		<meta charset="utf-8">
		<link href="http://localhost/projects/dist/css/bootstrap.min.css" rel="stylesheet"> 
		<script src="http://localhost/projects/dist/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<div class="container">
			<div class="span10 offset 1">
				<div class="row">
					<h3><strong>View Contact</strong></h3>
				</div>

				<div class="form-horizontal">
					<div class="control-group">
						<label class="control-label">Name:</label>
							<div class="controls">
								<label class="checkbox">
									<?php echo $contact->name; ?>
								</label>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Email Address:</label>
							<div class="controls">
								<label class="checkbox">
									<?php echo $contact->email; ?>
								</label>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Mobile Number:</label>
							<div class="controls">
								<label class="checkbox">
									<?php echo $contact->phone; ?>
								</label>
							</div>
					</div>
					<br>
					<div class="form-actions">
						<a class="btn btn-default" href="index.php">Back</a>
					</div>
			</div>
		</div>
	</body>
</html>