<?php

/**
 * Class Task
 *  @OA\Schema(schema="task")
 */
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