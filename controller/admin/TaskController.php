<?php

include_once __DIR__ . "./../BaseController.php";

class TaskController extends BaseController{

    function __construct() {

        if (!isset($_SESSION['auth']) || (isset($_SESSION['auth']) && $_SESSION['auth']->type == User::USER)) { 
            App::redirect("task");
        }
    }

    public function index (array $params=[]) {

        $tasks = Task::select('task.* , user.name, user.email')
                    ->join('user','id','user_id')
                    ->sort('id',0)
                    ->limit()->get();

        $page_count = Task::count()->first();
        $page_count = ceil($page_count->count/3);

        $this->view('admin/task/index', ['tasks'=>$tasks, 'page_count'=>$page_count]);
    }

    public function status() {

        $id = (int)$_POST['id'];

        if (isset($_SESSION['auth']) && $_SESSION['auth']->type == User::ADMIN) {

            $task_exist = Task::select('status')->where('id','=', $id)->first();

            if ($task_exist) {
                $status = ($task_exist->status == 0) ? 1 : 0 ;
                $result = Task::updateStatus($status,$id);
                
                if ($result) {
                    print json_encode(array('status' => $status, 'type' => 'success', 'message' => 'Task status updated Successfully !'));
                } else {
                    print json_encode(array('status' => false, 'type' => 'danger', 'message' => 'Someting went wrong !'));
                }            
            } else {
                print json_encode(array('status' => false, 'type' => 'danger', 'message' => 'Someting went wrong !'));
            }
        } else {
            print json_encode(array('status' => false, 'type' => 'danger', 'message' => 'Someting went wrong !'));
        }
    }

    public function edit() {

        if (!isset($_GET['id'])) {
            $_SESSION['notes'][] = array('type'=>'danger','message'=>'Someting went wrong !');
            App::redirect("admin-task");
        }

        $id = (int)$_GET['id'];

        $task = Task::select('task.*')
                    ->where('id','=', $id)->first();
        
        if (is_null($task)) {
            $_SESSION['notes'][] = array('type'=>'danger','message'=>'Task not found !');
            App::redirect("admin-task");    
        }            

        $this->view('admin/task/edit', ['task'=>$task]);
    }


    public function update() {

        $task_id= (int)$_POST['task_id'];
        $data['status'] = (int)$_POST['status'];
        $data['description'] = $_POST['description'];

        $vali = Validator::make($data, [
            'user' => ['required', 'number'],
            'description' => ['required','string','min:4','max:255'],
        ]);

        if ($vali->fails()) {
            $vali->widthErrors();
            App::redirect("task-e");
        } else {

            $task_exist = Task::select('task.id')
                ->where('id','=', $task_id)->get();
            if (!is_null($task_exist)) {

                $result = Task::update($data, $task_id);

                if ($result) {
                    $_SESSION['notes'][] = array('type'=>'success','message'=>'Task updated Successfully !');
                    App::redirect("admin-task");
                }

                $_SESSION['notes'][] = array('type'=>'danger','message'=>'Someting went wrong !');
                App::redirect("task-edit");

            } else {

                $_SESSION['notes'][] = array('type'=>'danger','message'=>'user not found !');
                App::redirect("task-edit");
            }
        }
    }
}

