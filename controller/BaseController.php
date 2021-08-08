<?php

	session_start();

	class BaseController {

		public function view($name, $data = null) {

			$path = "./view/".$name.".php";

			if (file_exists($path)) {

				$old = [];
				$auth = null;
				$notes = [];
				$errors = [];

				if(isset($_SESSION['notes'])) {
					$notes = $_SESSION['notes'];
				}
				if(isset($_SESSION['auth'])) {
					$auth = $_SESSION['auth'];
				}

				if(isset($_SESSION['errors'])) {
					$errors = $_SESSION['errors'];
				}

				if(isset($_SESSION['old'])) {
					$old = $_SESSION['old'];
				}

				include $path;

				unset($_SESSION['old']);
				unset($_SESSION['notes']);
				unset($_SESSION['errors']);
			}
		}
	}
 ?>