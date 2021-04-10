<?php

/**
 * Class CronTask
 * 
 * @OA\Schema(schema="cronTask")
 */
class CronTask
{
    /**
     * @var object
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
     */
    protected $task;
    /**
     * @var string
     * @OA\Property ()
     */
    protected $updateUrl;
}
