<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    public function user () {
        return $this->belongsTo('App\Models\User');
    }

    public function create($request, $message_id = null) {
        $this->name = $request->input('name');
        $this->user_id = Auth::user()->id;
        if ($request->file('image') != null) {
            $this->deleteImage();
            $this->image = $request->file('image')->store('uploads', 'public');
        }
        if ($message_id != null) {
            $this->answered_id = $message_id;
            $this->answer = true;
        }
        $this->save();
    }

    public function delete_() {
        $this->deleteImage();
        $this->delete();
    }
    private function deleteImage() {
        if ($this->image != null) unlink(public_path('storage/'.$this->image));
    }


    public function getMessages() {
        $mass = [];
        $messages = Message::all();
        foreach ($messages as $message) {
            $mass[$message->answered_id][] = $message;
        }
        return $mass;
    }

    public $messages = [];

    public function outTree($answered_id, $level) {
        $mass = $this->getMessages();
        if (isset($mass[$answered_id])) {
            foreach ($mass[$answered_id] as $m) {
                array_push($this->messages, [$level =>  $m]);
                //echo "<div style='margin-left:" . ($level * 25) . "px;'>" . $m->name. "</div>";
                $level = $level + 1;
                $this->outTree($m->id, $level);
                $level = $level - 1;
            }
        }
    }
}
