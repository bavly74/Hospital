<!-- Modal -->
<div class="modal fade" id="edit<?php echo e($section->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('sections_trans.edit_sections')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('section.update')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <label for="exampleInputPassword1"><?php echo e(trans('sections_trans.name_sections')); ?></label>
                    <input type="hidden" name="id" value="<?php echo e($section->id); ?>">
                    <input type="text" name="name" value="<?php echo e($section->name); ?>" class="form-control">
                    <textarea name="description" ><?php echo e($section->description); ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('sections_trans.Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(trans('sections_trans.submit')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH G:\Bavly's Projects\hospital\resources\views/dashboard/sections/edit.blade.php ENDPATH**/ ?>