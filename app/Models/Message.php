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

    public function getAnswered() {
        return Message::where('answered_id', $this->id)->get();
    }

}
