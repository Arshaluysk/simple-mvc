<?php

include "BaseController.php";

class TaskController extends BaseController{

    public function index () {

        $tasks = Task::select('task.* , user.name, user.email')
                    ->join('user','id','user_id')
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

        $tasks = Task::select('task.* , user.name, user.email')
                    ->join('user','id','user_id')
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

        $data['user_id'] = (int)$_POST['user'];
        $data['description'] = $_POST['description'];

        $vali = Validator::make($data, [
            'user' => ['required', 'number'],
            'description' => ['required','string','min:4','max:255'],
        ]);

        if ($vali->fails()) {
            $vali->widthErrors();
            App::redirect("task-create");
        } else {

            $user = User::select('user.id')
                ->where('id','=', $data['user_id'])->get();

            if (!is_null($user)) {

                $task = new Task();
                $result = $task->create($data);

                if ($result) {
                    $_SESSION['notes'][] = array('type'=>'success','message'=>'Task created Successfully !');
                    App::redirect("task");
                }

                $_SESSION['notes'][] = array('type'=>'danger','message'=>'Someting went wrong !');
                App::redirect("task-create");

            } else {

                $_SESSION['notes'][] = array('type'=>'danger','message'=>'user not found !');
                App::redirect("task-create");
            }
        }
    }
}

