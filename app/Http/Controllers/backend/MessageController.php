<?php


namespace App\Http\Controllers\backend;


use App\Views\View;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Contact::all();
        return View::render('backend.contacts.index', compact('messages'));
    }

    public function show(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('message');
        $message = Contact::find($id);
        $message->update(['readed' => 1]);
        return View::render('backend.contacts.show', compact('message'));
        
    }

    public function delete(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $category = Contact::destroy($request->getAttribute('message'));
            if ($category) { success(); } else { error();}
        } else {
            Contact::destroy($request->getAttribute('message'));
            return redirect('/admin/messages');
        }
    }

}