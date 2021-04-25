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

    public function create($request, $message_id = 0) {
        $this->name = $request->input('name');
        $this->user_id = Auth::user()->id;
        $image = $request->file('image');
        if ($image != null) {
            $this->deleteImage();
            $image_name = md5(rand(10,99)).$this->get_type($image);
            $width = $this->getSize(getimagesize($image)[3])['width'];
            $height = $this->getSize(getimagesize($image)[3])['height'];
            if ($width > 500 | $height > 500) {
                \Image::make($image)->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/uploads/'.$image_name));
                $this->image = 'uploads/'.$image_name;
            } else {
                $this->image = $request->file('image')->store('uploads', 'public');
            }
        }
        if ($message_id !== null) $this->answered_id = $message_id;
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
                $level = $level + 1;
                $this->outTree($m->id, $level);
                $level = $level - 1;
            }
        }
    }

    public function getMessage($id) {
        return Message::find($id);
    }

    private function get_type ($image) {
        $full_type = image_type_to_mime_type(exif_imagetype($image));
        $type = ".";
        $write = false;
        for ($i = 0; $i < strlen($full_type); $i++) {
            if ($full_type[$i] == '/') {
                $write = true;
                continue;
            }
            if ($write) $type = $type.$full_type[$i];
        }
        return $type;
    }

    private function getSize ($size) {
        $width = '';
        $height = '';
        $c = 0;
        $write = true;
        for ($i = 0; $i < strlen($size); $i++) {
            if ($size[$i] == "=") {
                $c = $c + 1;
                $write = true;
                continue;
            }
            if ($size[$i] == 'h') $write = false;
            if ($c == 1 && $write) $width = $width.$size[$i];
            else if ($c==2 && $write) $height = $height.$size[$i];
        }
        return [
            'width' => (int)$this->get_value($width),
            'height' => (int)$this->get_value($height),
        ];
    }

    private function get_value($value) {
        $v = "";
        $numbers = [];
        for ($i = 0; $i <= 9; $i++) {
            array_push($numbers, (string)$i);
        }
        for($i = 0; $i < strlen($value); $i++) {
            if (in_array($value[$i], $numbers)) $v = $v.$value[$i];
        }
        return $v;
    }


}
