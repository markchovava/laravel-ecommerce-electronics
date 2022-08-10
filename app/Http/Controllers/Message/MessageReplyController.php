<?php

namespace App\Http\Controllers\Message;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use App\Models\Message\MessageReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageReplyController extends Controller
{
    public function send(Request $request){
        $name = env('APP_NAME');
        $first_name = Auth::user()->first_name;
        $last_name = Auth::user()->last_name;
        $email = $request->reply_email;
        $subject = $request->reply_subject;
        $message = $request->reply_message;
        $message_id = $request->reply_message_id;
        //dd($message_id);

        $inbox = Message::find($message_id);
        $customer_name = $inbox->first_name . ' ' . $inbox->last_name;
        //dd($customer_name);

        $reply = MessageReply::where('message_id', $message_id)->get();
        if(isset($reply)){
            $reply = MessageReply::where('message_id', $message_id)->delete();
            $reply = new MessageReply();
            $reply->name = $name;
            $reply->first_name = $first_name;
            $reply->last_name = $last_name;
            $reply->email = $email;
            $reply->subject = $subject;
            $reply->message = $message;
            $reply->message_id = $message_id;
            $reply->status = "Sent";
            $reply->save();
        } else{
            $reply = new MessageReply();
            $reply->name = $name;
            $reply->first_name = $first_name;
            $reply->last_name = $last_name;
            $reply->email = $email;
            $reply->subject = $subject;
            $reply->message = $message;
            $reply->message_id = $message_id;
            $reply->status = "Sent";
            $reply->save();
        }
        

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
        $mail->addAddress($email, $customer_name);     //Add a recipient
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;
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
        
    }
}
