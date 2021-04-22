<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function form () {
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
        $message->create($request);
        return response()->json(['status' => 200,'msg'=> 'Ваше сообщение изменено']);
    }

    public function delete ($id) {
        $message = Message::find($id);
        $message->delete_();
        return response()->json(['status' => 200,'msg'=> 'Ваше сообщение удалено']);
    }

    public function edit($id) {
        $message = Message::find($id);

        return view('message/message_edit', [
            'message' => $message
        ]);
    }

    public function answerForm($id ,$user, $message_text) {
        $message = Message::find($id);

        return view('message/message_answer', [
            'message' => $message,
            'user' => $user,
            'message_text' => $message_text
        ]);
    }

    public function answer(MessageRequest $request,$id, $user, $message_text) {

        $message = new Message();

        $message->create($request, $id, $user, $message_text);
        return response()->json(['status' => 200,'msg'=> 'Вы ответили на сообщение']);

    }
}
