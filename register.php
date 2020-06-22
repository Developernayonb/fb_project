
<?php include_once "app/db.php"; ?>
<?php include_once "app/function.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
  <?php 

  $mess[] = '';
  
  if ( isset( $_POST['register'] ) ) {
  	
  	// Get value
  	 $name = $_POST['name'];
  	 $uname = $_POST['uname'];
  	 $email = $_POST['email'];
  	 $cell = $_POST['cell'];

  	 // Username Check
  	 $user_name_check = unique($connection, 'users', 'uname', $uname);

  	 // Email Check
  	 $email_check = unique($connection, 'users', 'email', $email);

  	 // Cell Check
  	 $cell_check = unique($connection, 'users', 'cell', $cell);

  	 // Pass Hash
  	 $pass = $_POST['pass'];
  	 $pass_hash = password_hash( $pass, PASSWORD_DEFAULT);


  	 // Value check
  	 if ($user_name_check == false) {
  	 	$mess[] = '<p class="alert alert-warning"> Username Already exists ! <button class="close" data-dismiss="alert">&times;</button></p>';

  	 }else{
       $mess = '';
  	 }

  	 if ($email_check == false) {
  	 	$mess[] = '<p class="alert alert-warning"> Email Already exists ! <button class="close" data-dismiss="alert">&times;</button></p>';
  	 }else{
       $mess = '';
  	 }
  	 
  	 if ($cell_check == false) {
  	 	$mess[] = '<p class="alert alert-warning"> Cell Already exists ! <button class="close" data-dismiss="alert">&times;</button></p>';
  	 }else{
       $mess = '';
  	 }




  	 if ( empty($name) || empty($uname) || empty($email) || empty($cell) || empty($pass) ) {
  	 	$mess[] = '<p class="alert alert-warning"> All Fied are Required ! <button class="close" data-dismiss="alert">&times;</button></p>';

  	 }elseif ( filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
  	 	$mess[] = '<p class="alert alert-warning"> Invaild Email Address ! <button class="close" data-dismiss="alert">&times;</button></p>';

  	 }else {

  	 	$data = fileUp($_FILES['photo'], 'photos/users/');
  	 	$photo_name = $data['file_name'];

  	 	if ( $data['status'] == 'yes' ) {

  	 		$sql = "INSERT INTO users ( name, uname, email, cell, password, photo ) VALUES('$name', '$uname','$email','$cell','$pass_hash','$photo_name' )";

  	 	     $connection -> query($sql);

  	 	}else {
  	 		$mess[] = '<p class="alert alert-warning"> Invaild File Format ! <button class="close" data-dismiss="alert">&times;</button></p>';
  	 	}

  	 	
  	 }
  }

   ?>
	
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Create an account</h2>
                 
                 <?php 

                  if ( count($mess) > 0 ) {
                  	foreach ($mess as $m) {
                  		echo $m;
                  	}
                  }
                  ?>

				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text">
					</div>
					
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text">
					</div>

					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control"  type="text">
					</div>

					<div class="form-group">
						<label for="">Photo</label>
						<input name="photo" class="form-control" type="file">
					</div>
					
					<div class="form-group">
						<input name="register" class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="index.php">Log in now</a>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>