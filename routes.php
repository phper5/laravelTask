<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(config("softDDTask.middleware",[]))
    ->get(config("softDDTask.uri",'/api/docs'), function (Request $request) {
        $file = config("softDDTask.docPath",storage_path('docs')."/doc.json");
        if ($request->input('force',0)==1 || !file_exists($file)){
            \SoftDD\DocMaker\DocMaker::build();
        }
        $content = file_get_contents($file);
        return $content;
});
