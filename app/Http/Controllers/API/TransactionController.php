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

    public function test(){
        return "testado";
    }

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

            $transaction = $pagarmeService->getTransaction($request->tokenOrIdTransaction);

            if(isset($transaction['errors'])){
                 throw new \Exception('transação não encontrada!', 404);
            }

            $email = $transaction['customer']['email'];

            $array = array('title' => 'Esse email só chega para gays - Geral.com',
                            'body' => 'Se você recebeu esse e-mail é porque você tem uma transação de suce$$o!');

            \Mail::to($email)->send(new TransactionEmail($array));

            return response()->json([
                'message' => "Transação realizada com sucesso!",
            ], 200);
        }catch (\Throwable $e){

            if($e->getCode() > 400 && $e->getCode() < 500) ExceptionLog::makeFromException($e)->save();

            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
