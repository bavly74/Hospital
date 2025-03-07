<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Repositories\Finance\ReceiptRepository;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $receipt;
    public function __construct(ReceiptRepositoryInterface $receipt){
        $this->receipt = $receipt;
    }

    public function index(){
        return $this->receipt->index();
    }
    public function create(){
        return $this->receipt->create();
    }

    public function store(Request $request){
        return $this->receipt->store($request);

    }

    public function edit($id){
        return $this->receipt->edit($id);
    }

    public function update(Request $request){
        return $this->receipt->update($request);
    }
    public function show($id){
        return $this->receipt->show($id);
    }

    public function destroy(Request $request){
        return $this->receipt->destroy($request);

    }
}
