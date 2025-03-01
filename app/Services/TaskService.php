<?php
namespace App\Services;
use App\Consts;
use App\Models\Task;
class TaskService extends BaseService
{

    public function __construct(private Task $task)
    {
        parent::__construct($task);
    }
    public function all()
    {
        return auth()->user()->tasks;
    }
    public function changeStatus($id, $status)
    {
        if (!in_array($status, [Consts::$STATUS_EN_ATTENTE, Consts::$STATUS_EN_COURS, Consts::$STATUS_TERMINE])) {
            abort(500, 'status inconnue');
        }
        $task = Task::findOrFail($id);
        $task->status = $status;
        return $task->save();
    }
}
