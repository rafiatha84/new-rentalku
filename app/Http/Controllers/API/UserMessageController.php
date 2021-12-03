<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;
Use App\Events\FormSubmitted;
class UserMessageController extends Controller
{
    public function get_chat_room(){
        $room = ChatRoom::get();
        $room = json_encode($room);
        return response()->json($room, 200);
    }
    public function get_room_by_id(Request $request,$id){
        $room = ChatRoom::with("user","userTo","message")->where('user_id', $id)->orWhere('user_to_id',$id)->orderBy('updated_at', 'DESC')->get();
        return response()->json($room, 200);
    }
    public function get_message_by_room(Request $request,$chat_room_id){
        $messages = Message::where('chat_room_id',$chat_room_id)->orderBy('id','ASC')->get();
        return response()->json($messages, 200);
    }
    public function send_message(Request $request){
        $text = $request->post('message');
        
        $request->validate([
            'user_id' => 'required',
            'chat_room_id' => 'required',
            'message' => 'required'
        ]);
        
        $message=Message::create($request->all());
        event(new FormSubmitted($message->toArray()));
        return response()->json($message, 201);
    }
}
