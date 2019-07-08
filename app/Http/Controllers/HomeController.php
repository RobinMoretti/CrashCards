<?php

namespace App\Http\Controllers;


use App\Events\MessagePushed;
use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {

        if(env("ALPHA", "true")){
            return view('alpha.home');
        }else{

            $workshops = Workshop::all();

            $event = new MessagePushed();

            //connected
            event($event);

            return view('home', compact('workshops'));
        }
    }

    public function receive()
    {
        $workshops = Workshop::all();
        return view('home', compact('workshops'));
    }

    public function getUser(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::check()){
                return Auth::user()->toJson();
            }
        }
    }
}
