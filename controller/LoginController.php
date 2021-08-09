<?php 

include "BaseController.php";

class LoginController extends BaseController {

    function __construct() {

        if (isset($_SESSION['auth']) && $_SESSION['auth']->type == User::USER) { 
            App::redirect("task");
        } else if (isset($_SESSION['auth']) && $_SESSION['auth']->type == User::ADMIN) {
            App::redirect("admin-task");
        }
    }

	public function index () {

        $this->view('auth/login');
    }

    public function login() {

		$data['email'] = $_POST['email'];
		$data['password'] = $_POST['password'];

    	$vali = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

		if ($vali->fails()) {

			$vali->widthErrors();
		    App::redirect("login");
		} else {

	        $password = User::select('user.password')
		            	->where('email','=', $data['email'])->first();

	        if (!is_null($password)) {

	        	$verify = password_verify($data['password'], $password->password);

				if ($verify) {

					$auth = User::select('user.id, user.name, user.email, user.type')
					->where('email','=', $data['email'])->first();

					$_SESSION['auth'] = $auth;
					$_SESSION['notes'][] = array('type'=>'success','message'=>'You are loged in !');

					if ($auth->type == App::ADMIN) {
			            App::redirect("admin-task");
					}
			        
			        App::redirect("task");

				} else {
					$_SESSION['notes'][] = array('type'=>'danger','message'=>'wrong password !');
		            App::redirect("login");
				}

	        } else {		        	
	        	$_SESSION['notes'][] = array('type'=>'danger','message'=>'user not find !');
	            App::redirect("login");
	        }  

	    }
	}

	public function logout() {

		if (isset($_SESSION['auth'])) {

			unset($_SESSION['auth']);
            App::redirect("login");
		} else {
            App::redirect("task");
		}
	}

}