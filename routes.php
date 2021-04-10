<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(config("softDDTask.middleware",[]))
    ->post(config("softDDTask.postTaskUri",'/api/tasks'), [\SoftDD\Task\TaskController::class,'post']);
Route::middleware(config("softDDTask.middleware",[]))
    ->delete(config("softDDTask.deletTaskUri",'/api/tasks'), [\SoftDD\Task\TaskController::class,'delete']);


Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.getTaskListUri",'/api/tasks'), [\SoftDD\Task\TaskController::class,'getList']);

Route::middleware(config("softDDTask.middleware",[]))
    ->put(config("softDDTask.putTaskUri",'/api/tasks/{taskId}'), [\SoftDD\Task\TaskController::class,'put']);
Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.getTaskUri",'/api/tasks/{taskId}'), [\SoftDD\Task\TaskController::class,'getOne']);

Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.getCronTask.uri",'/api/crontask'), [\SoftDD\Task\TaskController::class,'getCronTask']);

Route::middleware(config("softDDTask.middleware",[]))
    ->put(config("softDDTask.putCronTaskUri",'/api/crontask/{taskId}'), [\SoftDD\Task\TaskController::class,'putCronTask']);


