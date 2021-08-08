<?php

include_once __DIR__ . "./../BaseController.php";

class TaskController extends BaseController{

    function __construct() {

        if (!isset($_SESSION['auth']) || (isset($_SESSION['auth']) && $_SESSION['auth']->type != 1)) { 
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

    public function edit() {

        $id = (int)$_POST['id'];

        if (isset($_SESSION['auth']) && $_SESSION['auth']->type == 1) {

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
}

