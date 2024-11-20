<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\PaymentRepositoryInterface;
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

    public function create(){
        return $this->payment->create();
    }

    public function store( Request $request){
        return $this->payment->store($request);
    }
    public function edit($id){
        return $this->payment->edit($id);
    }

    public function update(Request $request){
        return $this->payment->update($request);

    }
    public function show($id){
        return $this->payment->show($id);
    }
    public function destroy(Request $request){
        return $this->payment->destroy($request);
    }
}
