<?php


namespace SoftDD\Task;



use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use SoftDD\ApiException\ApiException;

class TaskController
{
    /**
     * 读取一个任务
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOne(Request $request,$id)
    {
        /**
         * @var Task::Class
         */
        $taskClass =config('softDDTask.model');
        $user = $request->user('api');
        if ($task = $taskClass::find($id))
        {
            if ($task->user_id!=$user->getKey())
            {
                throw new ApiException(ErrorNum::INVAILD_ACCESS);
            }
            return (new Response())->setData($task->toResponse())->setHeaders(['Cache-Control'=>'no-cache'])->Json();

        }
    }

    public function put(Request $request,$taskId)
    {
        $taskClass =config('softDDTask.model');
        $taskStatus = config('softDDTask.status');
        if (!$user = $request->user('api')){
            throw new ApiException(ErrorNum::INVAILD_ACCESS);
        }
        $uid = $user->getAuthIdentifier();
        if ($task = $taskClass::where('id',$taskId)->where('user_id',$uid)->first()){
            if ($args = $request->input('args')){
                $task->args = $args;
            }
            if ($input = $request->input('input')){
                $task->input = $input;
            }
            $task->save();
            $responseClass = config('softDDTask.response');
            return (new $responseClass())->setData($task->toResponse())->setHeaders(['Cache-Control'=>'no-cache'])->Json();
        }
        throw new ApiException(ErrorNum::NOT_FOUND);


    }

    /**
     * 创建一个任务
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request)
    {
        $taskClass =config('softDDTask.model');
        $taskStatus = config('softDDTask.status');
        if (!$user = $request->user('api')){
            throw new ApiException(ErrorNum::INVAILD_ACCESS);
        }
        $uid = $user->getAuthIdentifier();
        $task = new $taskClass();
        $task->user_id = $uid;
        $task->id = Uuid::uuid();
        $task->status =$taskStatus::STATUS_INIT;
        $task->progress =0;
        $task->service =$request->get('service',config('softDDTask.defaultService'));
        $task->args =($request->input('args'));
        $task->input = ($request->input('input'));
        $task->save();
        $responseClass = config('softDDTask.response');
        return (new $responseClass())->setData($task->toResponse())->setHeaders(['Cache-Control'=>'no-cache'])->Json();
    }

    /**
     * 读取任务列表
     */
    public function getList(Request $request)
    {
        if (!$user = $request->user('api')){
            throw new ApiException(ErrorNum::INVAILD_ACCESS);
        }
        $uid = $user->getAuthIdentifier();
        $taskClass =config('softDDTask.model');
        $conditions = ['user_id'=>$uid];
        if ($service = $request->input('service')){
            $conditions['service']  =$service;
        }
        $page = $request->input('page',1);
        $pageNum = $request->input('pageNum',10);
        $list = $taskClass::where($conditions) ->offset($pageNum*($page-1))
            ->limit($pageNum)->orderBy('created_at', 'DESC')->get();
        $return = [];
        foreach ($list as $task){
            $return[] = $task->toResponse();
        }
        return (new Response())->setData(['list'=>$return])->setHeaders(['Cache-Control'=>'no-cache'])->Json();
    }

    /**
     * 批量删除任务
     */
    public function delTasks()
    {

    }
    /**
     * 后台读取一个需要处理的任务
     */
    public function getCronTask(Request $request)
    {
        $taskClass =config('softDDTask.model');
        $taskStatus = config('softDDTask.status');
        $testTaskId = $request->input('taskId','');
        if ($testTaskId) {
            $task=$taskClass::find($testTaskId);
        }
        else{
            if ($service = $request->input('service'))
            {
                $task = $taskClass::where('status',$taskStatus::STATUS_BEGIN)->where('service',$service) ->orderBy('created_at', 'ASC')->first();
            }
            else{
                $task = $taskClass::where('status',$taskStatus::STATUS_BEGIN) ->orderBy('created_at', 'ASC')->first();
            }
        }
        if ($task)
        {
            if ($testTaskId || $taskClass::where('id', $task->id)
                    ->where('status', $taskStatus::STATUS_BEGIN)
                    ->update(['status' => $taskStatus::STATUS_START])) {
                $data ['task'] =$task->toResponse();
                $data ['task']['update_url'] = config('softDDTask.callbackUrl');
                return (new Response())->setData([$data])->setHeaders(['Cache-Control'=>'no-cache'])->Json();
            }
        }
        return (new Response())->setData([])->setHeaders(['Cache-Control'=>'no-cache'])->Json();

    }

    /**
     * 后台更新一个任务
     */
    public function putCronTask(Request $request,$id)
    {
        $taskClass =config('softDDTask.model');
        $taskStatus = config('softDDTask.status');
        if ($task = $taskClass::find($id))
        {
            $needUpdated = [];
            if ($progress = $request->get('progress',0))
            {
                $needUpdated['progress'] = $progress;
            }
            if ($status = $request->get('status'))
            {
                $needUpdated['status'] = $status;
            }
            if ($temp = $request->input('temp')){
                $needUpdated['temp'] = $temp;
            }
            if ($output = $request->input('output')){
                $needUpdated['output'] = $output;
            }
            if ($needUpdated){
                $taskClass::where('id', $task->id)
                    ->where('status', '!=',$taskStatus::STATUS_FINISHED)
                    ->update($needUpdated
                    );
            }

        }
        $responseClass = config('softDDTask.response');
        return (new $responseClass())->setData([])->Json();
    }
}
