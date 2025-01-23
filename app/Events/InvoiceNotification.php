<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $patient ;
    public $message ;
    public $invoice_id ;
    public $doctor_id ;
    public $created_at ;

    public function __construct($data)
    {
        $this->patient = $data['patient'];
        $this->message = $data['message'];
        $this->invoice_id = $data['invoice_id'];
        $this->created_at = $data['created_at'];
        $this->doctor_id = $data['doctor_id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new  PrivateChannel('create-invoice.'.$this->doctor_id);
    }

    public function broadcastAs()
    {
        return 'create-invoice';
    }
}
