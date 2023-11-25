<?php
require '../credentials.php';
require '../keyauth.php';

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION['un'])) {
	header("Location: ../dashboard/");
	exit();
}

$KeyAuthApp = new KeyAuth\api($name, $OwnerId);

if (!isset($_SESSION['sessionid'])) {
	$KeyAuthApp->init();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<?php
	echo '
	    <title>KeyAuth - Register to ' . $name . ' Panel</title>
	    <meta name="og:image" content="https://cdn.discordapp.com/attachments/1166738491703574628/1178083740153561138/favicon.ico?ex=6574dafb&is=656265fb&hm=dd8bce540eda7d766cf21cec172189587418a3b7960c5bbe1b5311146239dbef&">
        <meta name="description" content="Register to reset your HWID or download ' . $name . '">
        ';
	?>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<link href="https://cdn.keyauth.cc/v2/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.keyauth.cc/v2/assets/css/style.bundle.css" rel="stylesheet" type="text/css">

	<style>
		/* width */
		::-webkit-scrollbar {
			width: 10px;
		}

		/* Track */
		::-webkit-scrollbar-track {
			box-shadow: inset 0 0 5px grey;
			border-radius: 10px;
		}

		/* Handle */
		::-webkit-scrollbar-thumb {
			background: #2549e8;
			border-radius: 10px;
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
			background: #0a2bbf;
		}
	</style>

	<script type="text/javascript">
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</head>

<body class="bg-dark">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
			<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
				<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
					<form class="form w-100" method="post">

						<div class="text-center mb-10">

							<h1 class="text-light mb-3">Register to <?php echo $name; ?></h1>

						</div>


						<div class="fv-row mb-10">

							<label class="form-label fs-6 fw-bolder text-light">Username</label>


							<input class="form-control text-light" type="text" name="username" placeholder="Enter Username" autocomplete="on">
							<div class="form-group row">
								<br>
							</div>


							<div class="fv-row mb-5">

								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-light fs-6 mb-0">Password</label>
								</div>


								<input class="form-control text-light" type="text" name="password" placeholder="Enter Password" autocomplete="on">

							</div>
							<div class="fv-row">
								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-light fs-6 mb-0">License</label>
								</div>

								<input class="form-control text-light" type="text" name="license" placeholder="Enter License" autocomplete="on">
							</div>
							<div class="fv-row mb-10">

								<br>

								<div class="text-center">

									<button name="register" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Continue</span>
										<span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
	<script src="https://cdn.keyauth.cc/v2/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="https://cdn.keyauth.cc/v2/assets/js/scripts.bundle.js" type="text/javascript"></script>

	<?php
	if (isset($_POST['register'])) {
		if ($KeyAuthApp->register($_POST['username'], $_POST['password'], $_POST['license'])) {
			$_SESSION['un'] = $_POST['username'];
			echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/'>";
			echo '
                        <script type=\'text/javascript\'>
                        
                        const notyf = new Notyf();
                        notyf
                          .success({
                            message: \'You have successfully registered!\',
                            duration: 3500,
                            dismissible: true
                          });                
                        
                        </script>
                        ';
		}
	}
	?>
</body>

</html>