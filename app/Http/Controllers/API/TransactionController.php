<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PagarmeRequestService;
use Binarcode\LaravelDeveloper\Models\ExceptionLog;
use Illuminate\Http\Request;
use App\Mail\TransactionEmail;
use Illuminate\Support\Facades\Validator;


class TransactionController extends Controller
{

    /**
     * Send a Email of Sucess Transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmailOfSucessTransaction(Request $request){

        $validator = Validator::make($request->all(), [
            'tokenOrIdTransaction' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->toJson()], 400);
        }
        try {

            $pagarmeService = new PagarmeRequestService();

            $transaction = $pagarmeService->getTransaction("14101069");

            if(isset($transaction['errors'])){
                 throw new \Exception('transação não encontada!', 404);
            }

            $email = "profissional.diogolima@gmail.com";

            $array = array('title' => 'CARAAA VOCÊ TEVE UMA TRANSAÇÃO DE SUCESSO',
                            'body' => 'TUDO para MIM!');

            //   foreach ($emails as $email) {
            \Mail::to($email)->send(new TransactionEmail($array));
           // }

            return response()->json([
                'message' => "Promo sent!",
            ], 200);
        }catch (\Throwable $e){

            if($e->getCode() > 400 && $e->getCode() < 500) ExceptionLog::makeFromException($e)->save();

            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
