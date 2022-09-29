<?php

namespace RKREZA\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use RKREZA\Contact\Repositories\ContactRepository as Contact;

class ContactController extends Controller
{

    protected $_config;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact              = $contact;
        $this->_config              = request('_config');
    }


    public function show()
    {
        return view($this->_config['view']);
    }


    public function index()
    {
        $contact = $this->contact->all();
        return view($this->_config['view'], compact('contact'));
    }


    public function view($id)
    {

        $contact = $this->contact->findOrFail($id);

        return view($this->_config['view'], compact('contact'));
    }


    public function destroy($id=null)
    {
        
        $contact = $this->contact->findorFail($id);

        try {
            $this->contact->delete($id);

            session()->flash('success', trans('contact_lang::app.response.delete-success', ['name' => 'Message']));

        } catch(\Exception $e) {
            session()->flash('error', trans('contact_lang::app.response.delete-failed', ['name' => 'Message']));
        }


        return response()->json(['message' => false], 400);
    
    }




    // Shop Section
    public function sendMessage()
    {
        $this->validate(request(), [
            'name'              => 'required',
            'email'             => 'required|email',
            'message_body'      => 'required',
            'product_id'        => 'sometimes',
        ]);

        $data = request()->all();

        $contact = $this->contact->create($data);

        if ($contact) {
            session()->flash('success', trans('contact_lang::app.response.message-send-success'));
            return redirect()->route($this->_config['redirect']);
        }
        session()->flash('failed', 'Failed to Submit Message');
        return redirect()->route($this->_config['redirect']);
    }
}
