<?php 

include "BaseController.php";

class RegisterController extends BaseController {

    function __construct() {

        if (isset($_SESSION['auth']) && $_SESSION['auth']->type == App::USER) { 
            App::redirect("task");
        } else if (isset($_SESSION['auth']) && $_SESSION['auth']->type == App::ADMIN) {
            App::redirect("admin-task");
        }
    }

	public function index () {

        $this->view('auth/register');
    }

    public function register() {

		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['password'] = $_POST['password'];

    	$vali = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

		if ($vali->fails()) {

			$vali->widthErrors();
    		App::redirect("register");
		} else {
			$checkpassword = Validator::confirm($data['password'], $_POST['password_confirmation']);

			if ($checkpassword->fails()) {

				$checkpassword->widthErrors();
        		App::redirect("register");
	        } else {

	        	$user = User::select('user.id')
		            ->where('email','=', $data['email'])->first();

		        if (is_null($user)) {

		        	$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					$user = new User();
					$result = $user->create($data);

					if ($result) {
						$_SESSION['notes'][] = array('type'=>'success','message'=>'You are registered Successfully !');
	            		App::redirect("login");
					}

					$_SESSION['notes'][] = array('type'=>'danger','message'=>'Someting went wrong !');
            		App::redirect("register");

		        } else {		        	
		        	$_SESSION['notes'][] = array('type'=>'danger','message'=>'user with this email already exists !');
            		App::redirect("register");

		        }  

	        }
		}
    }

}