<html>
	<body>
		<?php
			session_start();
			
			if(isset($_POST["logout"])){
				session_destroy();

				unset($_SESSION["user"]);
				unset($_SESSION["pass"]);
			}

			if(isset($_SESSION["user"])){
				include_once("logout_form.php");
			}else{
				if(isset($_POST["user"]) && isset($_POST["pass"])){
					if($_POST["user"] == "admin" && $_POST["pass"] == "admin"){
						$_SESSION["user"] = $_POST["user"];
						$_SESSION["pass"] = $_POST["pass"];
					}

					include_once("logout_form.php");
				}else{
					include_once("login_form.php");
				}
			}
		?>
	</body>
</html>
