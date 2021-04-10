<?php


namespace SoftDD\Task;


class TaskStatus
{
    const STATUS_INIT = 0;//用户刚刚创建
    const STATUS_BEGIN = 10;//用户配置完毕，可以开始的任务
    const STATUS_START = 20;//开始
    const STATUS_FINISHED = 30;
    const STATUS_ERROR = -10;
}
