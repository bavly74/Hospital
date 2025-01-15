
<!-- Modal -->
<div class="modal fade" id="edit{{ $lab_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات موظف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('lab-employees.update', $lab_employee->id) }}" method="post">
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">الاسم</label>
                    <input type="text" value="{{$lab_employee->name}}" name="name" class="form-control"><br>

                    <label for="exampleInputPassword1">البريد الالكتروني</label>
                    <input type="email" value="{{$lab_employee->email}}" name="email" class="form-control"><br>

                    <label for="exampleInputPassword1">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
