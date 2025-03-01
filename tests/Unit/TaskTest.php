<?php
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;



uses(TestCase::class, RefreshDatabase::class);

test('example', function () {
    expect(true)->toBeTrue();
});
test('test_it_returns_all_task_for_authenticated_user', function(){
    $user = User::factory()->create();
    $user2 = User::factory()->create();
    Task::factory()->count(3)->create(['user_id' => $user->id]);
    Task::factory()->count(2)->create(['user_id' => $user2->id]);
    Auth::shouldReceive('user')->once()->andReturn($user);
    $taskService = new TaskService(new Task());
    $result = $taskService->all();
    $allTasks = Task::all();
    expect($result)->toHaveCount(3);
    expect($allTasks)->toHaveCount(5);

});
test('user_can_create_task', function () {
    $user = User::factory()->create();

    $taskData = ['title' => 'New Task', 'user_id'=>$user->id];
    $taskService = new TaskService(new Task());
    $task = $taskService->store($taskData);
    expect($task)->toBeInstanceOf(Task::class);
    expect($task->title)->toEqual('New Task');
    expect($task->user_id)->toEqual($user->id);
});
test('user_can_update_task', function () {
    $user = User::factory()->create();

    $taskData = ['title' => 'New Task', 'user_id'=>$user->id];
    $taskService = new TaskService(new Task());
    $task = $taskService->store($taskData);
    expect($task->title)->toEqual('New Task');
    expect($task->user_id)->toEqual($user->id);
    $taskService->update($task->id, ['title' => 'titre modifié',]);
    $updatedtask = Task::findOrFail($task->id);
    expect($updatedtask)->toBeInstanceOf(Task::class);
    expect($updatedtask->title)->toEqual('titre modifié');
});
test('user_can_delete_task', function(){
    $user = User::factory()->create();
    $taskData = ['title' => 'New Task', 'user_id'=>$user->id];
    $taskService = new TaskService(new Task());
    $task = $taskService->store($taskData);
    expect($task->title)->toEqual('New Task');
    expect($task->user_id)->toEqual($user->id);
    $taskService->delete($task->id);
    $deletedtask = Task::find($task->id);
    expect($deletedtask)->toBeNull();
});
