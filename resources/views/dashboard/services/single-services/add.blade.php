<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Services.add_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<<<<<<< HEAD
            <form action="{{ route('single-services.store') }}" method="post" autocomplete="off">
=======
            <form action="{{ route('service.store') }}" method="post" autocomplete="off">
>>>>>>> fff3bce05da4ab03f3ab28c42c9ea6f50f13fbd2
                @csrf
                <div class="modal-body">
                    <label for="name">{{trans('Services.name')}}</label>
                    <input type="text" name="name" id="name" class="form-control"><br>

                    <label for="price">{{trans('Services.price')}}</label>
                    <input type="number" name="price" id="price" class="form-control"><br>

                    <label for="description">{{trans('Services.description')}}</label>
                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> fff3bce05da4ab03f3ab28c42c9ea6f50f13fbd2
