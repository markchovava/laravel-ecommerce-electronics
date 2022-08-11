<?php

namespace App\Http\Controllers\Contact;

/*
*   Custom Function call 
*/
use App\Actions\RoleManagement\CheckRoles;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart\Cart;
use App\Models\Product\Brand;
use App\Models\Backend\BasicInfo;
use App\Models\Message\Message;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Tag\Tag;
use App\Models\Quote\CustomerQuote;
use Illuminate\Support\Facades\Cookie;

class ContactPageController extends Controller
{
    public function index(){
       /*   Check Roles    */
       $data['role_id'] = CheckRoles::check_role();
       /*  Check Cookie */
       $shopping_session = Cookie::get('shopping_session');
       $quote_session = Cookie::get('quote_session');
       /*  IP Address */
       $ip_address = $this->ip();
       /* Shopping Cart */
       if( isset($shopping_session) || isset($ip_address) ){
           $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
           if( !empty($data['cart']) ){
               $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
           } 
       }
       elseif( !(isset($shopping_session)) || !isset($ip_address) ){
           $data['cart'] = NULL;
           $data['cart_quantity'] = 0;
       }
       /* Shopping Quote */
       if( isset($quote_session) || isset($ip_address) ){
           $quote = CustomerQuote::with('customer_quote_items')
                   ->where('quote_session', $shopping_session)
                   ->orWhere('ip_address', $ip_address)->first();
           $data['quote'] = $quote;
           if( !empty($data['quote']) ){
               $data['quote_quantity'] = $data['quote']->customer_quote_items->sum('quantity');
           } 
       }
       elseif( !(isset($quote_session)) || !isset($ip_address) ){
           $data['quote'] = NULL;
           $data['quote_quantity'] = 0;
       }


        /*  
        *   Brands 
        */
        $data['brands'] = Brand::latest()->paginate(10);


        /* 
        *   Footer Products 
        *   3 First Tag, Trending Products 
        */
        $data['tag_first_three'] = Product::whereHas('tags', function($query){
            $query->where('position', 'First'); //this refers id field from categories table
        })
        ->orderBy('updated_at','desc')
        ->paginate(3);

        /* 
        *   3 Latest Products 
        */
        $data['latest_three'] = Product::latest()->paginate(3);

        /* 
        *  3 Daily Hot Products 
        */
        $data['tag_second_three'] = Product::whereHas('tags', function($query){
            $query->where('position', 'Second'); //this refers id field from categories table
        })
        ->orderBy('updated_at','desc')
        ->paginate(3);

        /* 
        *   Website Basic Info
        */
        $data['info'] = BasicInfo::first();
        /* Categories */
        $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
        /* Tags */
        $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
        /* Brands */
        $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;


        return view('frontend.pages.contact.index', $data);
    }

    public function store(Request $request){
        $message = new Message();
        $message->first_name = $request->first_name;
        $message->last_name = $request->last_name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->status = 'Unread';
        $message->type = 'Enquiry';
        $message->created_at = now();
        $message->updated_at = now();
        $message->save();

        $name = $message->first_name . ' ' . $message->last_name;


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);    
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = env('MAIL_HOST');                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = env('MAIL_USERNAME');                     //SMTP username
        $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom(env('MAIL_USERNAME'), $name);
        $mail->addAddress(env('MAIL_USERNAME'), env('APP_NAME'));     //Add a recipient
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $message->subject;
        $mail->Body    = $message->message;
        $mail->AltBody = $message->message;
        $dt = $mail->send();  
        if( $dt ){
            $notification = [
                'message' => 'Message Sent Successfully.',
                'alert-type' => 'success'
            ];
        } else{
            $notification = [
                'message' => 'Message Not Sent.',
                'alert-type' => 'danger'
            ];
        } 
        return redirect()->route('admin.message.all')->with($notification);

        $notification = [
            'message' => 'Message sent Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('contact.index')->with($notification);
    }


     /* 
    *   Get Ip
    */
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
    public function ip(){
        return $this->getIp(); // the above method
    }
}
