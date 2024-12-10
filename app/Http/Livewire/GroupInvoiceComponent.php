<?php

namespace App\Http\Livewire;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Group;
use App\Models\GroupInvoice;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\SectionTranslation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class GroupInvoiceComponent extends Component
{
    public $show_table = true ,
        $catchError,
        $patient_id ,
        $doctor_id ,
        $section_id ,
        $updateMode = false ,
        $type ,
        $Group_id ,
        $group_invoice_id ,
        $discount_value = 0 ,
        $price =0 ,
        $tax_rate = 0 ,
        $InvoiceSaved ,
        $InvoiceUpdated= false
            ;
    public function render()
    {
        return view('livewire.group-invoice.group-invoice-component',[
            'group_invoices'=>Invoice::with('Service','Patient','Doctor','Section')->where('invoice_type',2)->get(),
            'Patients'=>Patient::all(),
            'Doctors'=>Doctor::all(),
            'Groups'=>Group::all() ,
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=>$Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)

        ]);
    }

    public function get_price(){
        $this->price = Group::where('id',$this->Group_id)->first()->Total_before_discount;
        $this->discount_value = Group::where('id',$this->Group_id)->first()->discount_value ;
        $this->tax_rate = Group::where('id',$this->Group_id)->first()->tax_rate ;
    }
    public function get_section (){
        $this->section_id = Doctor::with('section')->where('id', $this->doctor_id)->first()->section->name;

    }

    public function store()
    {
        if($this->type==1){
            DB::beginTransaction();
            try {
                if($this->updateMode==true){
                    $group_invoices = Invoice::findOrFail($this->group_invoice_id);
                    $fund_accounts = FundAccount::where('invoice_id',$this->group_invoice_id)->first();

                } else {
                    $group_invoices = new Invoice();
                    $fund_accounts = new FundAccount();
                }
                $group_invoices->invoice_type = 2;
                $group_invoices->invoice_date = date('Y-m-d');
                $group_invoices->patient_id = $this->patient_id;
                $group_invoices->doctor_id = $this->doctor_id;
                $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                $group_invoices->Group_id = $this->Group_id;
                $group_invoices->price = $this->price;
                $group_invoices->discount_value = $this->discount_value;
                $group_invoices->tax_rate = $this->tax_rate;
                // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                $group_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                $group_invoices->total_with_tax = $group_invoices->price -  $group_invoices->discount_value + $group_invoices->tax_value;
                $group_invoices->type = $this->type;
                $group_invoices->save();

                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->invoice_id = $group_invoices->id;
                $fund_accounts->Debit = $group_invoices->total_with_tax;
                $fund_accounts->credit = 0.00;
                $fund_accounts->save();

                if($this->updateMode==true){
                    $this->InvoiceUpdated =true;

                }else{
                    $this->InvoiceSaved =true;

                }
                $this->show_table =true;

                DB::commit();

            }catch (\Exception $e){
                DB::rollback();
                $this->catchError = $e->getMessage();
            }

//            $this->rest();
        }else {
            DB::beginTransaction();
            try {
                if($this->updateMode==true){
                    $group_invoices = Invoice::findOrFail($this->group_invoice_id);
                    $patient_accounts = PatientAccount::where('invoice_id',$this->group_invoice_id)->first();

                } else {
                    $group_invoices = new Invoice();
                    $patient_accounts = new PatientAccount();

                }
                $group_invoices->invoice_type = 2;
                $group_invoices->invoice_date = date('Y-m-d');
                $group_invoices->patient_id = $this->patient_id;
                $group_invoices->doctor_id = $this->doctor_id;
                $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                $group_invoices->Group_id = $this->Group_id;
                $group_invoices->price = $this->price;
                $group_invoices->discount_value = $this->discount_value;
                $group_invoices->tax_rate = $this->tax_rate;
                // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                $group_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                $group_invoices->total_with_tax = $group_invoices->price -  $group_invoices->discount_value + $group_invoices->tax_value;
                $group_invoices->type = $this->type;
                $group_invoices->save();


                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->invoice_id = $group_invoices->id;
                $patient_accounts->patient_id = $group_invoices->patient_id;
                $patient_accounts->Debit = $group_invoices->total_with_tax;
                $patient_accounts->credit = 0.00;
                $patient_accounts->save();

                if($this->updateMode==true){
                    $this->InvoiceUpdated =true;
                } else {
                    $this->InvoiceSaved =true;
                }

                $this->show_table =true;

               DB::commit();
            }catch (\Exception $e){
                DB::rollback();
                return $e->getMessage();
            }

        }
    }

    public function show_form_add(){
        $this->show_table = false;
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $this->show_table = false;
        $group_invoice = Invoice::with('Section')->findorfail($id);
        $this->group_invoice_id = $group_invoice->id;
        $this->patient_id = $group_invoice->patient_id;
        $this->doctor_id = $group_invoice->doctor_id;
        $this->section_id = $group_invoice->Section->name;
        $this->price = $group_invoice->price;
        $this->discount_value = $group_invoice->discount_value;
        $this->Group_id = $group_invoice->group_id;
        $this->type = $group_invoice->type;
        $this->tax_rate = $group_invoice->tax_rate;
        $this->tax_value = $group_invoice->tax_value;

    }

    public function delete($id){
       $this->group_invoice_id = $id;
    }

    public function destroy(){
        Invoice::destroy($this->group_invoice_id);
        return redirect()->route('group-invoice');
    }
    public function print($id){
        $single_invoice = Invoice::findorfail($id);
        return Redirect::route('group-invoice.print',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'Group_id' => $single_invoice->Group->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);
    }

}
