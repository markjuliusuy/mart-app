<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\InventoryProduct;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Inventories/Index',  [
            'inventories' => Inventory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Inventories/Create', [
            'inventories' => Inventory::all(),
            'suppliers' => Supplier::all(),
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
        $request->validate([
            'supplier_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $supplier = Supplier::find($request->supplier_id);

            $total_quantity = 0;
            $total_price = 0;
            $total_amount = 0;

            foreach ($request->selected_products as $product)
            {
                $total_price += $product['price'];
                $total_quantity += $product['quantity'];
                $total_amount += ($product['price'] * $product['quantity']);
            }

            $inventory = [
                'supplier_id' => $request->supplier_id,
                'supplier_company_name' => $supplier->company_name,
                'supplier_name' => $supplier->name,
                'supplier_address' => $supplier->address,
                'supplier_contact_number' => $supplier->contact_number,
                'total_quantity' => $total_quantity,
                'total_price' => $total_price,
                'total_amount' => $total_amount,
                'user_id' => auth()->user()->id,
            ];

            $inventory = Inventory::create($inventory);

            foreach ($request->selected_products as $product)
            {
                $product_item = Product::find($product['id']);
                $inventory_products = [
                    'inventory_id' => $inventory->id,
                    'product_id' => $product['id'],
                    'product_name' => $product_item->name,
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'total_amount' => $product['price'] * $product['quantity'],
                ];
                InventoryProduct::create($inventory_products);
            }
        });

        return redirect()->route('inventories.index')->with('success', 'Inventory created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        $inventory->load('products');
        return Inertia::render('Inventories/Show', [
            'inventory' => $inventory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
