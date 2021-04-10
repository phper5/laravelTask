<?php


namespace SoftDD\Task;


class Response
{
    public $data;
    public $headers=[];

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public  function Json()
    {
        return response()->json([
            "status" => 1,
            "data"=>$this->data
        ], 200,$this->headers);
    }
}
