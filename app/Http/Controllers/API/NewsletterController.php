<?php

namespace App\Http\Controllers\API;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
     * Send a promo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendPromo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5|max:100',
            'body' => 'required|string|min:5|max:580',
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->toJson()], 400);
        }

        $emails = DB::table('newsletter')
        ->select('email')
        ->get();

        foreach ($emails as $email) {
            \Mail::to($email)->send(new \App\Mail\PromoMail($validator->validated()));
        }

        return response()->json([
            'message' => "Promo sent!",
        ], 200);
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
