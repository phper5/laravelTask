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

task

--- | :--- | :---
status     | int        ｜ 状态 0初始 10准备好可以开始 20开始 30结束 -10错误
progress   | int        ｜ 进度
taskId     | string     ｜任务id
service    | string     ｜服务类型
input      | text       ｜任务的输入 如oss id
args       | text       ｜参数
temp       ｜ text      ｜ 中间的info
output     | text       ｜任务的输出 入oss id

```
/**
     * @OA\Get(
     *     path="/api/tasks/{taskId}",
     *     @OA\Response(
     *       response="404",
     *       description="没有"
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/task"),
     *     )
     *     ),
     * )

     * @OA\Put(
     *     path="/api/tasks/{taskId}",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="任务参数",
     *                     property="args",
     *                     type="string",
     *                     format="string",
     *                 ),
     *                 @OA\Property(
     *                     description="任务数据",
     *                     property="input",
     *                     type="string"
     *                 ),
     *                 required={"input"}
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *       response="404",
     *       description="没有"
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/task"),
     *     )
     *     ),
     * )
    * 创建一个任务
     * @OA\Post(
     *     path="/api/tasks",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="任务参数",
     *                     property="args",
     *                     type="string",
     *                     format="string",
     *                 ),
     *                 @OA\Property(
     *                     description="任务数据",
     *                     property="input",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     description="服务类型",
     *                     property="service",
     *                     type="string"
     *                 ),
     *                 required={"input"}
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *       response="430",
     *       description="没有权限"
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/task"),
     *     )
     *     ),
     * )
     * @OA\Get(
     *     path="/api/tasks",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="页数",
     *                     property="page",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     description="每页数量",
     *                     property="pageNum",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     description="服务类型",
     *                     property="service",
     *                     type="string"
     *                 ),
     *                 required={"input"}
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *       response="430",
     *       description="没有权限"
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/task"),
     *     )
     *     ),
     * )
     * 读取任务列表
     * 后台读取一个需要处理的任务 根据service taskId group进行筛选 status=10的
     * @OA\Get(
     *     path="/api/crontask",
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/cronTask"),
     *     )
     *     ),
     * )
      * 后台更新任务状态
     * @OA\Put(
     *     path="/api/crontask/{taskId}",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="进度",
     *                     property="progress",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     description="状态",
     *                     property="status",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     description="中间数据",
     *                     property="temp",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     description="结果",
     *                     property="output",
     *                     type="string"
     *                 ),
     *                 required={"input"}
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/cronTask"),
     *     )
     *     ),
     * )
     *  CronTask
     * @OA\Property(
     *     @OA\Property(
     *      property="callbackUrl",
     *      type="string",
     *      description="callbackUrl"
     *      ),
     *    @OA\Property(
     *      property="taskId",
     *      type="string",
     *      ),
     *     @OA\Property(
     *      property="status",
     *      type="integer",
     *      ),
     *     @OA\Property(
     *      property="service",
     *      type="string",
     *      ),
     *     @OA\Property(
     *      property="progress",
     *      type="integer",
     *      ),
     *     @OA\Property(
     *      property="input",
     *      type="string",
     *      ),
     *     @OA\Property(
     *      property="output",
     *      type="string",
     *      )
     * )
     class Task
{
    /**
     * 任务id
     * @var string
     * @OA\Property()
     */
    public $taskId;

    /**
     * 
     * @var integer
     * @OA\Property()
     */
    protected $status;

    /**
     * @var integer
     * @OA\Property ()
     */
    protected $progress;
    /**
     * @var string
     * @OA\Property ()
     */
    protected $service;
    /**
     * @var string
     * @OA\Property ()
     */
    protected $args;
    /**
     * @var string
     * @OA\Property ()
     */
    protected $input;
    /**
     * @var string
     * @OA\Property ()
     */
    protected $output;
}
```
 - migration
