<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesResource;
use App\Models\Customers;
use App\Models\Products;
use App\Models\PurchaseSales;
use App\Models\Sales;
use App\Models\Stores;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{

    use HttpResponses;
    
    public function all()
    {
        $sales = Sales::with('customer')->with('purchases')->get();
        return response()->json(SalesResource::collection($sales));
    }

    public function allCloseds()
    {
        $sales = Sales::whereNotNull('status_sales')->with('customer')->with('purchases')->get();
        return response()->json(SalesResource::collection($sales));
    }

    public function listSalesByStore($id)
    {
        $sales = Sales::where('store_id', $id)->with('customer')->with('purchases')->get();
        return response()->json(SalesResource::collection($sales));
    }

    public function showSale($id)
    {
        $sale = Sales::where('id', $id)->with('customer')->with('purchases')->get();
        return response()->json(SalesResource::collection($sale));
    }

    public function salesBatch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'products'    => 'array',
            'store_id'    => 'required',
            'customer_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Data invalid', 422, $validator->errors());
        }

        $store        = Stores::find($request->store_id);
        $customer     = Customers::find($request->customer_id);
        $price_total  = 0;
        $amount_total = 0;

        // Registra a venda que está sendo realizada
        $sale = Sales::create([
            'customer_id'    => $customer->id,
            'store_id'       => $store->id,
            'payment_method' => $request->payment_method,
            'status_pay'      => $request->status_pay,
            'status_delivery' => $request->status_delivery
        ]);

        // Registrar os produtos da venda
        foreach($request->products as $product){
            $product_item  = Products::find($product['id']);
            PurchaseSales::create([
                'sale_id'         => $sale->id,
                'product_id'      => $product['id'],
                'amount'          => $product['amount'],
                'price'           => $product_item->price
            ]);

            // Soma os totais de prices e amounts de pedidos e atribui a venda principal (Main)
            $price_total  += $product_item->price * $product['amount'];
            $amount_total += $product['amount'];
        }

        $sale->price_total  = $price_total;
        $sale->amount_total = $amount_total;
        $sale->save();

        return $this->response('Sales concluded!', 200, new SalesResource($sale->load('customer', 'purchases')));
    }

    public function salesUnique(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'  => 'required',
            'store_id'    => 'required',
            'customer_id' => 'required',
            'sale_id'     => 'nullable',
            'amount'      => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->error('Data invalid', 422, $validator->errors());
        }

        $product  = Products::find($request->product_id);
        $store    = Stores::find($request->store_id);
        $customer = Customers::find($request->customer_id);

        // Verifica se a venda em questão já existe na base de dados
        // Regra a seguir pode ser utilizada para duas situacões:
        // 1: utilizar o ID Sale no body da requisicão do front-end;
        // 2: cadastrar o ID Sale de acordo com a última venda;
        if(!$request->sale_id || !Sales::find($request->sale_id)){
            $sale = Sales::create([
                'customer_id' => $customer->id,
                'store_id' => $store->id,
                'payment_method' => $request->payment_method,
                'status_pay' => $request->status_pay,
                'status_delivery' => $request->status_delivery,
            ]);
        }else{
            $sale = Sales::find($request->sale_id);
        }

        // Registrar os produtos da venda
        $purchase = PurchaseSales::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'amount' => $request->amount
        ]);

        // Soma os totais de prices e amounts de pedidos e atribui a venda principal (Main)
        $sale->price_total += $purchase->price*$purchase->amount;
        $sale->amount_total += $purchase->amount;
        $sale->save();

        return $this->response('Sales concluded!', 200, new SalesResource($sale->load('customer', 'purchases')));
    }

    public function updateSales(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'  => 'required',
            'sale_id'     => 'required',
            'amount'      => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->error('Data invalid', 422, $validator->errors());
        }

        $product  = Products::find($request->product_id);
        $sale = Sales::find($request->sale_id);

        // Registra novos produtos produtos da venda
        $purchase = PurchaseSales::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'amount' => $request->amount
        ]);

        // Soma os totais de prices e amounts de pedidos e atribui a venda principal (Main)
        $sale->price_total += $purchase->price*$purchase->amount;
        $sale->amount_total += $purchase->amount;
        $sale->save();

        return $this->response('Sales updated - New product added!', 200, new SalesResource($sale->load('customer', 'purchases')));
    }

    public function cancelSales(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sale_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->error('Data invalid', 422, $validator->errors());
        }

        $sale = Sales::find($request->sale_id);
        if($sale->status_sales){
            return $this->closed('Sales invalid or closed', 422, $sale);
        }
        $sale->status_sales = 'cancelada';
        $sale->save();

        return $this->response('Sales closed!', 200, new SalesResource($sale->load('customer', 'purchases')));
    }

}
