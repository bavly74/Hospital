<div>
    @if ($InvoiceSaved)
        <div class="alert alert-info">تم حفظ البيانات بنجاح.</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">تم تعديل البيانات بنجاح.</div>
    @endif

    @if($showTable)
        @include('livewire.single-invoice.table')

    @else

        <form method="post" wire:submit.prevent="store" >
            @csrf

            <div class="row">
                <div class="col">
                    <label>اسم المريض</label>
                    <select wire:model="patient_id" class="form-control" required>
                        <option value=""  >-- اختار من القائمة --</option>
                        @foreach($patients as $Patient)
                            <option value="{{$Patient->id}}">{{$Patient->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>اسم الدكتور</label>
                    <select wire:model="doctor_id"  wire:change="get_section" class="form-control"  id="exampleFormControlSelect1" required>
                        <option value="" >-- اختار من القائمة --</option>
                        @foreach($Doctors as $Doctor)
                            <option value="{{$Doctor->id}}">{{$Doctor->email}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>القسم</label>
                    <input type="text" wire:model="section"  class="form-control"  disabled >
                </div>

                <div class="col">
                    <label>نوع الفاتورة</label>
                    <select wire:model="type" class="form-control">
                        <option value="" >-- اختار من القائمة --</option>
                        <option value="1">نقدي</option>
                        <option value="2">اجل</option>
                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <label>اسم الخدمة</label>
                    <select wire:model="service_id" wire:change="getServicePrice" class="form-control">
                        <option>choose</option>

                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>سعر الخدمة</label>
                    <input type="number" class="form-control" disabled wire:model="service_price">
                </div>
                <div class="col">
                    <label>قيمة الخصم</label>
                    <input type="number" class="form-control"  wire:model="discount_value">
                </div>

                <div class="col">
                    <label>قيمة الضريبة</label>
                    <input type="number" class="form-control"  wire:model="tax_rate">
                </div>


                <div class="col">
                    <label>الاجمالي بعد الضريبة</label>
                    <input type="number" class="form-control"  value="{{$total}}">
                </div>


            </div><br>

            <button type="submit" class="btn btn-primary">تأكيد</button>

        </form>

    @endif

</div>
