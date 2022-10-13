<?php

namespace App\Http\Controllers\Quote;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\Models\Backend\BasicInfo;
use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Quote\Quote;
use App\Models\Quote\QuoteItem;

class QuoteController extends Controller
{
    public function index()
    {
        $data['quotes'] = Quote::with('users')->paginate(15);
        return view('backend.quote.index', $data);
    }

    public function view($id){
        $data['info'] = BasicInfo::first();
        $data['quote'] = Quote::with('quote_items')->where('id', $id)->first();
        $data['quote_items'] = QuoteItem::where('quote_id', $id)->get();
        return view('backend.quote.view', $data);
    }

    public function add(){
        return view('backend.quote.add');
    }

    public function search(Request $request)
    {
        $product_name = $request->name;
        $data['product'] = Product::where('name', 'LIKE', '%' . $product_name . '%')->get();
        return response()->json($data);
    }

    public function store(Request $request){
        DB::transaction(function() use($request){
            $quote = new Quote();
            $quote->user_id = Auth::id();
            $quote->billing_name = $request->billing_name;
            $quote->billing_email = $request->billing_email;
            $quote->billing_phone = $request->billing_phone;
            $quote->billing_address = $request->billing_address;
            $quote->shipping_name = $request->shipping_name;
            $quote->shipping_email = $request->shipping_email;
            $quote->shipping_phone = $request->shipping_phone;
            $quote->shipping_address = $request->shipping_address;
            $quote->quote_date = $request->quote_date;
            $quote->quote_due_date = $request->quote_due_date;
            $quote->notes = $request->quote_notes;
            $quote_number = date('Ydhs');
            $quote->quote_number = '#QUOTE-' . $quote_number;
            //dd($quote->quote_number);
            $quote->tax = $request->quote_tax;
            $quote->discount = $request->quote_discount;
            $quote->subtotal_cents = $request->quote_subtotal_cents;
            $quote->zw_subtotal_cents = $request->quote_zw_subtotal_cents;
            $quote->grandtotal_cents = $request->grandtotal_cents;
            $quote->zw_grandtotal_cents = $request->zw_grandtotal_cents;
            $quote->save();
            /* Quotation Items Details */
            $product_name = $request->product_name;
            $quote_description = $request->description;
            $quote_quantity = $request->quantity;
            $quote_price_cents = $request->price_cents;
            $quote_total_cents = $request->product_total_cents;
            $quote_zw_price_cents = $request->zw_price_cents;
            $quote_zw_total_cents = $request->zw_total_cents;
            //dd($product_name);
            if(!empty($product_name)){
                for($i = 0; $i < count($product_name); $i++){
                    $quoteitem = new QuoteItem();
                    $quoteitem->quote_id = $quote->id;
                    $quoteitem->product_name = $product_name[$i];
                    $quoteitem->description = $quote_description[$i];
                    $quoteitem->quantity = $quote_quantity[$i];
                    $quoteitem->price_cents = $quote_price_cents[$i];
                    $quoteitem->total_cents = $quote_total_cents[$i]; 
                    $quoteitem->save();
                }
            }

        });
        $notification = [
            'message' => 'Quote Added Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.quote')->with($notification);
    }

    public function edit($id){
        $data['quote'] = Quote::with('quote_items')->where('id', $id)->first();
        // dd($data['quote']);
        $data['quote_items'] = QuoteItem::where('quote_id', $id)->get();
        return view('backend.quote.edit', $data);
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request, $id){
            $quote = Quote::find($id);
            $quote->user_id = Auth::id();
            $quote->billing_name = $request->billing_name;
            $quote->billing_email = $request->billing_email;
            $quote->billing_phone = $request->billing_phone;
            $quote->billing_address = $request->billing_address;
            $quote->shipping_name = $request->shipping_name;
            $quote->shipping_email = $request->shipping_email;
            $quote->shipping_phone = $request->shipping_phone;
            $quote->shipping_address = $request->shipping_address;
            $quote->quote_date = $request->quote_date;
            $quote->quote_due_date = $request->quote_due_date;
            $quote->notes = $request->quote_notes;
            $quote->tax = $request->quote_tax;
            $quote->discount = $request->quote_discount;
            $quote->subtotal_cents = $request->quote_subtotal_cents;
            $quote->zw_subtotal_cents = $request->quote_zw_subtotal_cents;
            $quote->grandtotal_cents = $request->grandtotal_cents;
            $quote->zw_grandtotal_cents = $request->zw_grandtotal_cents;
            $quote->save();
            /* Quotation Items Details */
            $product_name = $request->product_name;
            $quote_description = $request->description;
            $quote_quantity = $request->quantity;
            $quote_price_cents = $request->price_cents;
            $quote_total_cents = $request->product_total_cents;
            $quote_zw_price_cents = $request->zw_price_cents;
            $quote_zw_total_cents = $request->zw_total_cents;
            //dd($product_name)
            $quoteitem = QuoteItem::where('quote_id', $id)->delete();
            if(!empty($product_name)){
                for($i = 0; $i < count($product_name); $i++){
                    $quoteitem = new QuoteItem();
                    $quoteitem->quote_id = $quote->id;
                    $quoteitem->product_name = $product_name[$i];
                    $quoteitem->description = $quote_description[$i];
                    $quoteitem->quantity = $quote_quantity[$i];
                    $quoteitem->price_cents = $quote_price_cents[$i];
                    $quoteitem->total_cents = $quote_total_cents[$i]; 
                    $quoteitem->save();
                }
            }

        });
        
        $notification = [
            'message' => 'Quote Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.quote')->with($notification);
    }

    public function delete($id){
        DB::transaction(function() use($id){
            $quote = Quote::find($id);
            $quote->delete();
            /* Delete Quote Items */
            $quoteitem = QuoteItem::where('quote_id', $id);
            $quoteitem->delete();
        });

        $notification = [
            'message' => 'Quote Deleted Successfully!!...',
            'alert-type' => 'danger'
        ];
        return redirect()->route('admin.quote')->with($notification);
    }

}
