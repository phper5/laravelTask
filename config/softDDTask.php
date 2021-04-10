<?php
return [
    'model'=>\SoftDD\Task\Task::class,
    'controller'=>\SoftDD\Task\TaskController::class,
    'error'=>\SoftDD\Task\ErrorNum::class,
    'status'=>\SoftDD\Task\TaskStatus::class,
    'defaultService'=>'default',
    'response'=>\SoftDD\Task\Response::class,
    'callbackUrl'=>config('app.url').'/api/callback/task/finished',
    'postTaskUri'=>'/api/tasks'
];
