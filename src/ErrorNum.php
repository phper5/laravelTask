<?php


namespace SoftDD\Task;


class ErrorNum
{
    const INVAILD_ACCESS = [
        'code'=>14002,
        'msg'=>'invaild access',
        'httpCode'=>430,
        'headers'=>[]
    ];
    const INVAILD_TOKEN = [
        'code'=>10001,
        'msg'=>'invaild token',
        'httpCode'=>430,
        'headers'=>[]
    ];
    const NOT_FOUND = [
        'code'=>14001,
        'msg'=>'not found',
        'httpCode'=>404,
        'headers'=>[]
    ];
    const TOO_MANY_TASK = [
        'code'=>14003,
        'msg'=>'too many tasks',
        'httpCode'=>403,
        'headers'=>[]
    ];
}
