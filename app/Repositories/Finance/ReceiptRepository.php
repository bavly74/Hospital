<?php

namespace App\Repositories\Finance;

use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{
    public function index(){
        $receipts = ReceiptAccount::with('patients')->get();

        return view('dashboard.receipts.index', compact('receipts'));
    }
    public function create(){
        $patients=patient::all();
        return view('dashboard.receipts.create', compact('patients'));
    }

    public function store($request){
        DB::beginTransaction();

        try {
            $receipt = new ReceiptAccount();
            $receipt->date = date('Y-m-d');
            $receipt->patient_id = $request->patient_id;
            $receipt->amount = $request->Debit;
            $receipt->description = $request->description;
            $receipt->save();

            $patient = new PatientAccount();
            $patient->date = date('Y-m-d');
            $patient->receipt_id = $receipt->id ;
            $patient->patient_id = $request->patient_id;
            $patient->credit = $request->Debit;
            $patient->save();

            $fund  = new FundAccount();
            $fund->date= date('Y-m-d');
            $fund->receipt_id = $receipt->id ;
            $fund->Debit = $request->Debit;
            $fund->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('receipt.create');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }
    public function edit($id){
        $receipt_accounts = ReceiptAccount::findorfail($id);
        $Patients = Patient::all();
        return view('dashboard.receipts.edit', compact('receipt'));
    }

    public function update($request){
        DB::beginTransaction();
        try {
            $receipt = ReceiptAccount::findOrFail($request->id);
            $receipt->date = date('Y-m-d');
            $receipt->patient_id = $request->patient_id;
            $receipt->amount = $request->Debit;
            $receipt->description = $request->description;
            $receipt->save();

            $patient = PatientAccount::findOrFail($request->patient_id);
            $patient->date = date('Y-m-d');
            $patient->receipt_id = $receipt->id ;
            $patient->patient_id = $request->patient_id;
            $patient->credit = $request->Debit;
            $patient->save();

            $fund  = FundAccount::where('receipt_id',$receipt->id);
            $fund->date= date('Y-m-d');
            $fund->receipt_id = $receipt->id ;
            $fund->Debit = $request->Debit;
            $fund->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('receipt.create');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    public function destroy($request){
        try {
            ReceiptAccount ::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
