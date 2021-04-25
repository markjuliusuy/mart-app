<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Sales/Index',  [
            'sales' => Sale::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Sales/Create', [
            'discounts' => Discount::all(),
            'customers' => Customer::all(),
            'products' => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = DB::transaction(function () use ($request) {
            $customer = Customer::find($request->customer_id);
            $discount = Discount::find($request->discount_id);

            $total_quantity = 0;
            $total_price = 0;
            $total_amount = 0;
            $total_discount = 0;

            foreach ($request->selected_products as $product)
            {
                $total_price += $product['price'];
                $total_quantity += $product['quantity'];
                $total_amount += $product['total_amount'];
                $total_discount += $product['discount'];
            }

            $sale = [
                'customer_id' => $request->customer_id ?? 0,
                'customer_name' => $customer->name ?? 'Walk-in Customer',
                'customer_id_number' => $customer->id_number ?? '',
                'customer_contact_number' => $customer->contact_number ?? '',
                'customer_is_pwd_sc' => $customer->is_pwd_sc ?? 0,
                'discount_id' => $request->discount_id,
                'discount_name' => $discount->name ?? '',
                'discount' => $request->discount_value,
                'discount_amount' => $request->discount_amount,

                'total_quantity' => $total_quantity,
                'total_price' => $total_price,
                'total_amount' => $total_amount,
                'total_discount' => $total_discount,

                'change_amount' => $request->change_amount,
                'subtotal_amount' => $request->subtotal_amount,
                'grand_total' => $request->grand_total,
                'tendered_amount' => $request->tendered_amount,

                'notes' => $request->notes,
                'transaction_type' => $request->transaction_type,
                'user_id' => auth()->user()->id,
            ];

            $sale = Sale::create($sale);

            foreach ($request->selected_products as $selected_product)
            {
                $sale_products = [
                    'sale_id' => $sale->id,
                    'product_id' => $selected_product['id'],
                    'product_name' => $selected_product['name'],
                    'price' => $selected_product['price'],
                    'discount_price' => $selected_product['discount_price'],
                    'quantity' => $selected_product['quantity'],
                    'discount' => $selected_product['discount'],
                    'discount_type' => $selected_product['discount_type'],
                    'total_amount_no_discount' => $selected_product['price'] * $selected_product['quantity'],
                    'total_amount' => $selected_product['total_amount'],
                ];
                SaleProduct::create($sale_products);
            }

            return $sale->id;
        });

        $sale = Sale::find($id);

        return redirect()->route('sales.create')
            ->with(['success' =>'Sale created.', 'sale' => $sale]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale->load('products');
        return Inertia::render('Sales/Show', [
            'sale' => $sale
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
