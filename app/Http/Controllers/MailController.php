<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input("name");
        $phone = $request->input("phone") ?? "Non renseigné";
        $message = $request->input("message");

        $messageContent = <<<HTML
            <strong>Cette Email est envoyé depuis MyBlog</strong><br><br>

            <strong>Mr/Mdm:</strong> $name <br>
            <strong>Email:</strong> $email <br>
            <strong>Phone:</strong> $phone <br>
            <strong>Message:</strong><br> $message
        HTML;

        Mail::html($messageContent, function ($stmp) {
            $stmp->to('enzo.boron.pro@gmail.com')
                    ->subject('MyBlog New Client')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        return redirect('dashboard')->with('success_mail', 'Email envoyé avec succès.');
    }
}
