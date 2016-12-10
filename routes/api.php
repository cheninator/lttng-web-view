<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Http\Request;

Route::post('/charts', function (Request $request) {
    
    $name = $request->input('name');
    $name = str_replace(':', '/', $name);
    $filePath = "../resources/lttng-parser/resultjs/{$name}";

    $count = $request->input('count');
    $sort = $request->input('sort');

    $content = file_get_contents($filePath);
    $content = json_decode($content, true);

    if($sort == "ASC")
    {
        $labels = $content["labels"];
        $data = $content["datasets"][0]["data"];

        array_multisort($data, $labels);

        if($count != 0 && $count < count($data)) 
        {
            $data = array_splice($data, 0, $count);
            $labels = array_splice($labels, 0, $count);            
        }

        $content["labels"] = $labels;
        $content["datasets"][0]["data"] = $data;
    }
    else if($sort == "DESC") 
    {
        $labels = $content["labels"];
        $data = $content["datasets"][0]["data"];

        array_multisort($data, SORT_DESC, $labels);

        if($count != 0 && $count < count($data)) 
        {
            $data = array_splice($data, 0, $count);
            $labels = array_splice($labels, 0, $count);
        }

        $content["labels"] = $labels;
        $content["datasets"][0]["data"] = $data;
    }

    return json_encode($content);
});