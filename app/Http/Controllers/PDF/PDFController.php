<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DomPDF;

use App\Models\Quote\Quote;
use App\Models\Quote\QuoteItem;

class PDFController extends Controller
{
    public function pdf($id)
    {
        $data['quote'] = Quote::with('quote_items')->where('id', $id)->first();
        $data['quote_items'] = QuoteItem::where('quote_id', $id)->get();
        return view('backend.quote.pdf', $data);
          
        /* $pdf = DomPDF::loadView('backend.quote.pdf', $data);
    
        return $pdf->download('Quotation.pdf'); */
    }
}
