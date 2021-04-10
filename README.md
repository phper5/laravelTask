# softdd/task
任务管理类
## Installation
```bash
composer require softdd/task
php artisan vendor:publish --provider="SoftDD\Task\TaskServiceProvider"
```

## Usage
自定义类，扩展Task的功能
自定义类，扩展TaskController的功能

### 配置说明
```php
//softDDTask.php
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
```
todo:
 - migration
