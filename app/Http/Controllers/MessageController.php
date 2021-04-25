<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;

class MessageController extends Controller
{
    public function form () {
        if ($this->is_auth()) return redirect()->route('home');
        $message = new Message();
        return view('message/message_form', [
            'message' => $message
        ]);
    }

    public function create(MessageRequest $request) {
        $message = new Message();
        $message->create($request);
        return response()->json(['status' => 200,'msg'=> 'Ваше сообщение добавлено']);
    }

    public function update(MessageRequest  $request, $id) {
        $message = Message::find($id);
        $message->create($request, null);
        return response()->json(['status' => 200,'msg'=> 'Ваше сообщение изменено']);
    }

    public function delete ($id) {
        $message = Message::find($id);
        $message->delete_();
        return response()->json(['status' => 200,'msg'=> 'Ваше сообщение удалено']);
    }

    public function edit($id) {
        if ($this->is_auth()) return redirect()->route('home');
        $message = Message::find($id);

        return view('message/message_edit', [
            'message' => $message
        ]);
    }

    public function answerForm($id) {
        if ($this->is_auth()) return redirect()->route('home');
        $message = Message::find($id);

        return view('message/message_answer', [
            'message' => $message
        ]);
    }

    public function answer(MessageRequest $request,$id) {
        $message = new Message();
        $message->create($request, $id);
        return response()->json(['status' => 200,'msg'=> 'Вы ответили на сообщение']);

    }

    private function is_auth() {
        //if (Auth::user() == null) return redirect()->route('home');
        return Auth::user() == null;
    }

}
