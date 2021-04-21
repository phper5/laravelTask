<?php

namespace SoftDD\Task;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $incrementing = false;
    public function toResponse($config=[])
    {
        $data = [
            'status'=>$this->status,
            'progress'=>$this->progress,
            'taskId' => $this->id,
            'service' => $this->service,
        ];
        if ($data['progress']>100){
            $data['progress'] = 100;
        }
        if ($this->args){
            $args = $this->args;
        }else{
            $args='';
        }
        $data['args'] = $args;
        if ($this->input){
            $input = $this->input;
        }else{
            $input='';
        }
        $data['input'] = $input;
        if ($this->output){
            $output = $this->output;
        }else{
            $output='';
        }
        $data['output'] = $output;

        if ($this->temp){
            $temp = $this->temp;
        }else{
            $temp='';
        }
        $data['temp'] = $temp;
        return $data;
    }
}
