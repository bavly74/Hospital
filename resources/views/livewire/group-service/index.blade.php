<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">اضافة مجموعة خدمات </button><br><br>
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>اجمالي العرض شامل الضريبة</th>
            <th>الملاحظات</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
            @each('livewire.group-service.table',$groups,'group')
        </tbody>

    </table>
</div>
