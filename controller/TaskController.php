<?php

include "BaseController.php";

class TaskController extends BaseController{

    public function index () {

        $tasks = Task::select('task.*')
                    ->sort('id',0)
                    ->limit()->get();

        $page_count = Task::count()->first();
        $page_count = ceil($page_count->count/3);

        $this->view('task/index',['tasks'=>$tasks, 'page_count'=>$page_count]);
    }

    public function getlist () {

        $page   = $_POST['page'];
        $sort   = $_POST['sort'];
        $action = $_POST['action'];

        $to = $page*3;
        $from = $to-3;

        $tasks = Task::select('task.*')
                    ->sort($sort,$action)
                    ->limit($from,$to)->get();

        print json_encode(['status'=>'success','data' => $tasks]);
    }

    public function create () {

        $users = User::select('user.id, user.name')
                ->where('type','=', '0')->get();

        $this->view('task/create', ['users'=>$users] );
    }

    public function store () {

        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['description'] = $_POST['description'];

        $vali = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'description' => ['required','string','min:4','max:255'],
        ]);

        if ($vali->fails()) {
            $vali->widthErrors();
            App::redirect("task-create");
        } else {

            $task = new Task();
            $result = $task->create($data);

            if ($result) {
                $_SESSION['notes'][] = array('type'=>'success','message'=>'Task created Successfully !');

                if ($_SESSION['auth']->type == User::ADMIN) {
                    App::redirect("admin-task");
                }
                
                App::redirect("task");
            }

            $_SESSION['notes'][] = array('type'=>'danger','message'=>'Someting went wrong !');
            App::redirect("task-create");

        }
    }
}

