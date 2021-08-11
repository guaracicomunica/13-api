<?php

namespace App\Http\Controllers\API;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:newsletter',
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->toJson()], 400);
        }

        $newsletter = Newsletter::create(['email' => $request->email]);

        return response()->json([
            'message' => "{$request->email} successfully subscribed on newsletter",
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
