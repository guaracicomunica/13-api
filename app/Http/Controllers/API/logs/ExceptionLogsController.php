<?php

namespace App\Http\Controllers\API\logs;

use App\Http\Controllers\Controller;

class ExceptionLogsController extends Controller
{
    public function GetAll(){
        $exceptions = \App\Models\ExceptionLogs::All();
        return response()->json($exceptions);
    }
}
