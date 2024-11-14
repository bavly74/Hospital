<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\SingleInvoice;

use Illuminate\Support\Facades\DB;
use Livewire\Component;


class SingleInvoices extends Component
{
    public $showTable =true ,
        $update  ,
        $InvoiceSaved ,
        $InvoiceUpdated ,
        $section ,
        $doctor_id ,
        $patient_id ,
        $type ,
        $service_id ,
        $service_price ,
        $discount_value =0 ,
        $updateMode=false,
        $single_invoice_id ,
        $tax_rate=15 ;

    public function render()
    {
        return view('livewire.single-invoice.single-invoice',[
            'patients'=>Patient::all(),
            'Doctors'=>Doctor::all(),
            'services'=>Service::all(),
            'total'=> ( $this->service_price - $this->discount_value ) + ($this->tax_rate * ($this->service_price - $this->discount_value )/100 ),
            'single_invoices'=> SingleInvoice::all(),
        ]);
    }
    public function get_section(){
        $doctor = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section = $doctor->section->name;
    }
    public function getServicePrice()
    {
        $service = Service::where('id',$this->service_id)->first();
        $this->service_price = $service->price;

    }


    public function store() {
        DB::beginTransaction(); // Start a transaction

        try {
            if ($this->type == 1) { //نقدي
                if ($this->updateMode) {

                    $single_invoices = SingleInvoice::findOrFail($this->single_invoice_id);
                } else {
                    $single_invoices = new SingleInvoice();
                }

                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;
                $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section)->first()->section_id;
                $single_invoices->Service_id = $this->service_id;
                $single_invoices->price = $this->service_price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;

                $single_invoices->tax_value = ($this->service_price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                $single_invoices->total_with_tax = $single_invoices->price - $this->discount_value + $single_invoices->tax_value;
                $single_invoices->type = $this->type;

                if (!$single_invoices->patient_id || !$single_invoices->doctor_id || !$single_invoices->section_id) {
                    throw new \Exception('Required fields missing for SingleInvoice.');
                }

                if (!$single_invoices->save()) {
                    throw new \Exception('Failed to save SingleInvoice.');
                }

                if ($this->updateMode) {
                    $fund_accounts = FundAccount::where('single_invoice_id', $this->single_invoice_id)->first();
                } else { //اجل
                    $fund_accounts = new FundAccount();
                }

                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->single_invoice_id = $single_invoices->id;
                $fund_accounts->Debit = $single_invoices->total_with_tax;
                $fund_accounts->credit = 0.00;

                if (!$fund_accounts->single_invoice_id || !$fund_accounts->Debit) {
                    throw new \Exception('Required fields missing for FundAccount.');
                }

                if (!$fund_accounts->save()) {
                    throw new \Exception('Failed to save FundAccount.');
                }

                if ($this->updateMode) {
                    $this->InvoiceUpdated = true;
                } else {
                    $this->InvoiceSaved = true;
                }

                $this->showTable = true;

            }else {
                if ($this->updateMode) {
                    $single_invoices = SingleInvoice::findOrFail($this->single_invoice_id);
                }else{
                    $single_invoices=new SingleInvoice();
                }

                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;
                $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section)->first()->section_id;
                $single_invoices->Service_id = $this->service_id;
                $single_invoices->price = $this->service_price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;

                $single_invoices->tax_value = ($this->service_price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                $single_invoices->total_with_tax = $single_invoices->price - $this->discount_value + $single_invoices->tax_value;
                $single_invoices->type = $this->type;

                $single_invoices->save();

                if($this->updateMode) {
                    $patient_accounts = PatientAccount::where('single_invoice_id',$this->single_invoice_id)->first();

                }else{
                    $patient_accounts = new PatientAccount();
                }

                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->single_invoice_id = $single_invoices->id;
                $patient_accounts->patient_id = $single_invoices->patient_id;
                $patient_accounts->Debit = $single_invoices->total_with_tax;
                $patient_accounts->credit = 0.00;
                $patient_accounts->save();


                if ($this->updateMode) {
                    $this->InvoiceUpdated = true;
                } else {
                    $this->InvoiceSaved = true;
                }

                $this->showTable = true;

                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            \Log::error('Error during invoice save: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Error during invoice save: ' . $e->getMessage()]);
        }
    }



    public function show_form_add(){
        $this->showTable =false;
    }

    public function edit($id){
        $this->updateMode =true;
        $this->showTable =false;
        $single_invoice = SingleInvoice::findorfail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->service_id = $single_invoice->Service_id;
        $this->service_price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;
    }

    public function delete($id)
    {
        $this->single_invoice_id = $id;

    }

    public function destroy(){
        SingleInvoice::destroy($this->single_invoice_id);
        return redirect()->back();
    }

}
