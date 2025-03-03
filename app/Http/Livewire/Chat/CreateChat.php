<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CreateChat extends Component
{
    use WithPagination;
    public   $auth_email ;
    protected $users ;
    public function mount(){
        $this->auth_email = Auth::user()->email ;
    }

    public function openConversation( $receiver_email )  {
       $check_conversation = Conversation::checkConversation($this->auth_email , $receiver_email )->get() ;
       if ($check_conversation->isEmpty()) {
           DB::beginTransaction();
           try{
              $conversation = Conversation::create([
                   'sender_email' => $this->auth_email,
                   'receiver_email' => $receiver_email,
                   'last_time_message'=>NULL
               ]);

               Message::create([
                  'conversation_id'=>$conversation->id,
                  'sender_email'=>$this->auth_email,
                  'receiver_email'=>$receiver_email,
                  'read'=>0,
                  'body'=>'HI' ,
                  'type'=>1
               ]);
               DB::commit();

           }catch (\Exception $e){
               dd($e->getMessage());
               DB::rollBack();
           }


       }else{
           dd('theres convo');
       }
    }

    public function render()
    {
        if (Auth::guard('patient')->check()) {
            $users= Doctor::paginate(10);
        }else{
            $users = Patient::all();
        }
        return view('livewire.chat.create-chat',['users'=>$users])->extends('dashboard.layouts.master');
    }
}
