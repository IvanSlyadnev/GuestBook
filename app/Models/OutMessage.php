<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutMessage extends Model
{
    use HasFactory;

    public function create ($mess) {
        $messages = OutMessage::all();
        foreach ($messages as $message) {
            $message->delete();
        }

        foreach ($mess as $message) {
            $m = new OutMessage();
            $m->id = $message[key($message)]->id;
            $m->name = $message[key($message)]->name;
            $m->image = $message[key($message)]->image;
            $m->user_id = $message[key($message)]->user_id;
            $m->answered_id = $message[key($message)]->answered_id;
            $m->key = key($message);
            $m->save();
        }

    }


    public function isUpdate () {
        $messages = OutMessage::where('answered_id', $this->id)->get();
        return count($messages) == 0;
    }
}
