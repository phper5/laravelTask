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
            $args = json_decode($this->args,true);
        }else{
            $args=[];
        }
        $data['args'] = $args;
        if ($this->input){
            $input = json_decode($this->input,true);
        }else{
            $input=[];
        }
        $data['input'] = $input;
        if ($this->output){
            $output = json_decode($this->output,true);
        }else{
            $output=[];
        }
        $data['output'] = $output;

        if ($this->temp){
            $temp = json_decode($this->temp,true);
        }else{
            $temp=[];
        }
        $data['temp'] = $temp;
        return $data;
    }
}
