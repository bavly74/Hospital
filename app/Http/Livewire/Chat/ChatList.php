<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    public $auth_email , $conversations ,$receivers;
    public function mount(){
        $this->auth_email = Auth::user()->email;
    }

    public function getUsers (Conversation  $conversation , $name){
        if ($conversation->sender_email == $this->auth_email){
            $this->receivers = Doctor::firstWhere('email' , $conversation->receiver_email ) ;
        }else{
            $this->receivers = Patient::firstwhere('email',$conversation->sender_email) ;
        }
        if(isset($name)){
            return $this->receivers->name ;
        }
    }

    public function render()
    {
        $this->conversations = Conversation::where('sender_email' , $this->auth_email)->orWhere('receiver_email',$this->auth_email)->orderBy('created_at','DESC')->get();
        return view('livewire.chat.chat-list');
    }
}
