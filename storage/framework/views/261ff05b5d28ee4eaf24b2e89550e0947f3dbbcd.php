<!-- Modal -->
<div class="modal fade" id="delete_select" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <?php echo e(trans('doctors.delete_select')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('doctors.delete', 'test')); ?>" method="post">

                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <h5><?php echo e(trans('sections_trans.Warning')); ?></h5>
                    <input type="hidden" id="delete_select_id" name="delete_select_id" value=''>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('sections_trans.Close')); ?></button>
                    <button type="submit" class="btn btn-danger"><?php echo e(trans('sections_trans.submit')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH G:\Bavly's Projects\hospital\resources\views/dashboard/doctors/delete_select.blade.php ENDPATH**/ ?>