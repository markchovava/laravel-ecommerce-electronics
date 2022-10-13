<?php

namespace App\Http\Controllers\PDF;

use App\Actions\Fpdf\FPDF;
use App\Http\Controllers\Controller;
use App\Models\Backend\BasicInfo;
use App\Models\Quote\CustomerQuoteOrder;
use App\Models\Quote\CustomerQuoteOrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function quote_pdf()
    {    
      
        /*  */
        $customer_id = Auth::id();
        $user = User::where('id', $customer_id)->first();
        $info = BasicInfo::first();

        $customer_quote_order = CustomerQuoteOrder::where('customer_id', $customer_id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
        $customer_quote_order_items = CustomerQuoteOrderItem::where('customer_quote_order_id', $customer_quote_order->id)
                                                            ->orderBy('product_name', 'ASC')
                                                            ->get();
        
        /* Tax */
        // $tax_percent = (15 / $customer_quote_order->total) * 100;

        /**
        *   Creating the page 
        *   Page width: 189mm
        **/
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        /* Row */
        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(69, 5, 'QUOTATION', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        /* Row */
        $pdf->Cell(120, 5, $info->company_name, 0, 0);
        $pdf->Cell(25, 5, 'Currency: ', 0, 0);
        $pdf->Cell(69, 5, $customer_quote_order->currency, 0, 1); // end of line
        /* Row */
        $pdf->Cell(120, 5, $info->company_address, 0, 0);
        $pdf->Cell(25, 5, 'Quote:', 0, 0);
        $pdf->Cell(44, 5, 'Online', 0, 1); // end of line
        /* Row */
        $pdf->Cell(120, 5, $info->company_phone_number, 0, 0);
        $pdf->Cell(25, 5, 'Date', 0, 0);
        $pdf->Cell(44, 5, $customer_quote_order->created_at, 0, 1); // end of line
        $pdf->SetFont('Arial', 'B', 12);
        /* Row */
        $pdf->Cell(120, 5, $info->company_email, 0, 0);
        $pdf->Cell(25, 5, 'Quote #:', 0, 0);
        $pdf->Cell(44, 5, $customer_quote_order->reference_id, 0, 1); // end of line

        /** 
        *   Row 
        *   Vertical Spacer
        **/
        $pdf->Cell(189, 10, '', 0, 1);

        /*  Row Vertical Spacer  */
        $pdf->Cell(189, 10, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 12);

        /* Row */
        $pdf->Cell(90, 7, 'Description', 1, 0);
        $pdf->Cell(35, 7, 'Unit Price', 1, 0);
        $pdf->Cell(30, 7, 'Quantity', 1, 0);
        $pdf->Cell(34, 7, 'Amount', 1, 1); // end of line

        $pdf->SetFont('Arial', '', 11);

        $pdf->Cell(189, 2, '', 0, 1);
        foreach($customer_quote_order_items as $item){
            /* Row */
            $pdf->Cell(90, 5, $item->product_name, 0, 0);
            $usd_unit_price = $item->unit_price / 100;
            $zwl_unit_price = $item->zwl_unit_price / 100;
            if( $customer_quote_order->currency == 'USD' ){
                $unit_price = number_format($usd_unit_price, 2, '.', '');
            }
            elseif( $customer_quote_order->currency == 'ZWL' ){
                $unit_price = number_format($zwl_unit_price, 2, '.', '');
            } else{
                $unit_price = NULL;
            }
            $pdf->Cell(35, 5, $unit_price, 0, 0);
            $pdf->Cell(30, 5, $item->quantity, 0, 0);
            $item_total = (int)$item->product_total / 100;
            $product_total = number_format($item_total, 2, '.','');
            $pdf->Cell(34, 5, $product_total, 0, 1); // end of line
            $pdf->Cell(189, 1, '', 0, 1);
        }

        /* *********************** */
        $pdf->Cell(189, 3, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        /* Row */
        $pdf->Cell(125, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 0, 0);
        $pdf->Cell(4, 5, '$', 0, 0);
        
        $subtotal_calculate = $customer_quote_order->subtotal / 100;
        $subtotal = number_format($subtotal_calculate, 2, '.', '');

        $pdf->Cell(30, 5, $subtotal, 0, 1, 'R'); // end of line

        /* Row */
       
        $grandtotal_calculate = $customer_quote_order->total / 100;
        $grandtotal = number_format($grandtotal_calculate, 2, '.', '');

        $pdf->Cell(30, 5, $grandtotal, 0, 1, 'R'); // end of line

        /* Row */
        $pdf->Cell(125, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Grand Total', 0, 0);
        $pdf->Cell(4, 5, '$', 0, 0);
        /* Row */
        $pdf->Cell(125, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Grand Total', 0, 0);
        $pdf->Cell(4, 5, '$', 0, 0);

        $grandtotal_calculate = $customer_quote_order->total / 100;
        $grandtotal = number_format($grandtotal_calculate, 2, '.', '');

        $pdf->Cell(30, 5, $grandtotal, 0, 1, 'R'); // end of line

        /* Output the page */
        $pdf->Output('TEST.pdf', 'I');

        exit;
    }

}
