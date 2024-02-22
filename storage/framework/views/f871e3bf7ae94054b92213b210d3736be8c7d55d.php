<!-- Modal -->
<div class="modal fade" id="delete<?php echo e($doctor->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <?php echo e(trans('doctors.delete_doctor')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('doctors.delete', 'test')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <h5><?php echo e(trans('sections_trans.Warning')); ?></h5>
                    <input type="hidden" value="1" name="page_id">
                    <?php if($doctor->image): ?>
                        <input type="hidden" name="filename" value="<?php echo e($doctor->image->filename); ?>">
                    <?php endif; ?>
                    <input type="hidden" name="id" value="<?php echo e($doctor->id); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('Dashboard/sections_trans.Close')); ?></button>
                    <button type="submit" class="btn btn-danger"><?php echo e(trans('Dashboard/sections_trans.submit')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH G:\Bavly's Projects\hospital\resources\views/dashboard/doctors/delete.blade.php ENDPATH**/ ?>