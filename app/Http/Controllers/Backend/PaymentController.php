<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Finance\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $payment ;

    public function __construct(PaymentRepositoryInterface $payment){
        $this->payment = $payment ;
    }

    public function index(){
        return $this->payment->index();
    }
}
