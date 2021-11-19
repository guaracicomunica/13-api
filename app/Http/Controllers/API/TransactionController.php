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

        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'success' => 'required|boolean',
            'tokenOrIdTransaction' => 'exclude_if:success,false| required|string'
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



            $subject ="";
            $title = "";
            $message = "Transação realizada com sucesso!";
            if($request->success == true){
                $items = $transaction['items'];
                $subject = "Compra confirmada - Geral.com";

                $body = "Os seguintes items foram confirmados para a compra:  ";

                foreach ($items as $item)
                {
                    $preco = $item['unit_price'];
                    $preco = $preco/100;
                    $preco = sprintf($preco);
                    $preco = " -> preço: ".$preco;

                    $quantidade = sprintf($item['quantity']);
                    $quantidade = " ->  quantidade:  ". $quantidade;

                    $body = $body . $item['title'] . $preco .$quantidade . "\n";

                }


            }else{

                $subject = "Falha ao efetuar sua compra - Geral.com";

                $body = "Não foi possível confirmar a sua compra. \n";

                $message = "Falha ao efetuar sua transação";
            }


            $array = array( 'subject' => $subject,
                            'title' => $title,
                            'body' => $body);

            \Mail::to($request->email)->send(new TransactionEmail($array));

            return response()->json([
                'message' => $message,
            ], 200);
        }catch (\Throwable $e){

            if($e->getCode() > 400 && $e->getCode() < 500) ExceptionLog::makeFromException($e)->save();

            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }


}
