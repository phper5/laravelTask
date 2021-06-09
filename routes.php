<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(config("softDDTask.middleware",[]))
    ->post(config("softDDTask.postTaskUri",'/api/tasks'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'post']);
Route::middleware(config("softDDTask.middleware",[]))
    ->delete(config("softDDTask.deletTaskUri",'/api/tasks'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'delete']);


Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.getTaskListUri",'/api/tasks'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'getList']);

Route::middleware(config("softDDTask.middleware",[]))
    ->put(config("softDDTask.putTaskUri",'/api/tasks/{taskId}'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'put']);
Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.getTaskUri",'/api/tasks/{taskId}'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'getOne']);

Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.getCronTask.uri",'/api/crontask'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'getCronTask']);

Route::middleware(config("softDDTask.middleware",[]))
    ->put(config("softDDTask.putCronTaskUri",'/api/crontask/{taskId}'), [config("softDDTask.controller",\SoftDD\Task\TaskController::class),'putCronTask']);


