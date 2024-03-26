<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class PurchaseController extends Controller
{

    public function __construct(
        protected CategoryService $categoryService
    )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::whereNotNull('category')->whereNotNull('item_code')->get();
        return view('purchase-form-index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories               = $this->categoryService->getCategories();
        $categoryCodesWithDetails = $this->categoryService->getCategorycodesWithDetails();
        $categoryCodes            = $categoryCodesWithDetails['category_codes'];
        $codeDetails              = $categoryCodesWithDetails['code_details'];
        $GST                      =  $this->categoryService->getGst();
        $invoice                  = Purchase::latest()->first()->id;
        return view('purchase-form', compact('categories', 'categoryCodes', 'codeDetails', 'GST', 'invoice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    
        $data = $request->all();


        // Loop through the arrays and save each record
        foreach ($data['category'] as $key => $category) {
            // Assuming 'category', 'item_code', 'description', 'quantity', 'price', 'vat_code', 'discount', 'discount_type', 'basic_amount', and 'total_price' are all present and corresponding to each other in the arrays
            Purchase::create([
                'category' => $data['category'][$key] ?? null,
                'item_code' => $data['item_code'][$key] ?? null,
                'description' => $data['description'][$key] ?? null,
                'quantity' => $data['quantity'][$key] ?? null,
                'price' => $data['price'][$key] ?? null,
                'vat_code' => $data['vat_code'][$key] ?? null,
                'discount' => $data['discount'][$key] ?? null,
                'discount_type' => $data['discount_type'][$key] ?? null,
                'basic_amount' => $data['basic_amount'][$key] ?? null,
                'total_price' => $data['total_price'][$key] ?? null,
            ]);
            break;
        }
        return redirect()->back()->with('success', 'Purchase created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
