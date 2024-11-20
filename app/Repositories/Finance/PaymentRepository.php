<?php

namespace App\Repositories\Finance;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;
class PaymentRepository implements PaymentRepositoryInterface
{
    public function index(){
        $payments=PaymentAccount::with('patients')->get();

        return view('dashboard.payments.index',compact('payments'));
    }
    public function create(){
        $Patients = Patient::all();
        return view('dashboard.payments.create',compact('Patients'));
    }

    public function store($request){
        DB::beginTransaction();
        try{
            $payment= new PaymentAccount() ;
            $payment->date = date('Y-m-d');
            $payment->patient_id = $request->patient_id ;
            $payment->amount = $request->credit ;
            $payment->description = $request->description ;
            $payment->save();

            $patient = new PatientAccount() ;
            $patient->date = date('Y-m-d') ;
            $patient->payment_id = $payment->id ;
            $patient->patient_id = $request->patient_id ;
            $patient->Debit  = $request->credit ;
            $patient->save();

            $fund = new FundAccount() ;
            $fund->date = date('Y-m-d');

            $fund->payment_id = $payment->id ;
            $fund->Debit = $request->credit ;
            $fund->save();
            DB::commit();
            session()->flash('add');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id){
        $payment_accounts = PaymentAccount::findOrFail($id);
        $Patients = Patient::all();
        return view('dashboard.payments.edit',compact(['payment_accounts','Patients']));
    }

    public function update($request){
        DB::beginTransaction();
        try {
            // جلب الدفع باستخدام id
            $payment = PaymentAccount::findOrFail($request->id);
            $payment->date = date('Y-m-d');
            $payment->patient_id = $request->patient_id;
            $payment->amount = $request->credit;
            $payment->description = $request->description;
            $payment->save();

            // جلب حساب المريض باستخدام payment_id
            $patient = PatientAccount::where('payment_id', $payment->id)->first();
            if ($patient) {
                $patient->date = date('Y-m-d');
                $patient->payment_id = $payment->id;
                $patient->patient_id = $request->patient_id;
                $patient->credit = $request->credit;
                $patient->save();
            }

            // جلب حساب الصندوق باستخدام payment_id
            $fund = FundAccount::where('payment_id', $payment->id)->first();
            if ($fund) {
                $fund->date = date('Y-m-d');
                $fund->payment_id = $payment->id;
                $fund->Debit = $request->credit;
                $fund->save();
            }

            // تأكيد التغييرات في قاعدة البيانات
            DB::commit();
            session()->flash('add');
            return redirect()->back();

        } catch (\Exception $e) {
            // في حالة حدوث خطأ، نقوم بالرجوع عن التغييرات
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        $payment_account=PaymentAccount::findOrfail($id);
        return view('dashboard.payments.print',compact('payment_account'));
    }

    public function destroy($request)
    {
        try {
            PaymentAccount ::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
