<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\OutMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $m = new Message();
        $out = new OutMessage();
        $m->outTree(0,0);
        $out->create($m->messages);
        $messages = OutMessage::where('id', '>', 0)->simplePaginate(25);

        return view('home', [
            'messages' => $messages,
            'model' => $m
        ]);
    }
}
