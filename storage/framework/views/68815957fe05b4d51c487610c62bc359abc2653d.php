
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('main-sidebar_trans.sections')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- Internal Data table css -->
    <link href="<?php echo e(URL::asset('Dashboard/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="<?php echo e(URL::asset('dashboard/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"><?php echo e(trans('main-sidebar_trans.sections')); ?></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <?php echo e(trans('main-sidebar_trans.view_all')); ?></span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('dashboard.messages_alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<!-- row -->
                    <!-- row opened -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                            <?php echo e(trans('sections_trans.add_sections')); ?>

                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap" id="example2">
                                            <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">#</th>
                                                <th class="wd-15p border-bottom-0"><?php echo e(trans('sections_trans.name_sections')); ?></th>
                                                <th class="wd-15p border-bottom-0"><?php echo e(trans('sections_trans.description')); ?></th>
                                                <th class="wd-20p border-bottom-0"><?php echo e(trans('sections_trans.created_at')); ?></th>
                                                <th class="wd-20p border-bottom-0"><?php echo e(trans('sections_trans.Processes')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <tr>
                                                   <td><?php echo e($loop->iteration); ?></td>
                                                   <td><a href="#"><?php echo e($section->name); ?></a> </td>
                                                   <td><?php echo e(\Str::limit($section->description, 50)); ?></td>
                                                   <td><?php echo e($section->created_at->diffForHumans()); ?></td>
                                                   <td>
                                                       <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit<?php echo e($section->id); ?>"><i class="las la-pen"></i></a>
                                                       <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete<?php echo e($section->id); ?>"><i class="las la-trash"></i></a>
                                                   </td>
                                               </tr>

                                               <?php echo $__env->make('dashboard.sections.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                               <?php echo $__env->make('dashboard.sections.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div>
                        <!--/div-->
                        <?php echo $__env->make('dashboard.sections.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 
                    <!-- /row -->

				</div>
				<!-- row closed -->

			<!-- Container closed -->

		<!-- main-content closed -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


    <!--Internal  Notify js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/notify/js/notifIt.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/plugins/notify/js/notifit-custom.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Bavly's Projects\hospital\resources\views/dashboard/sections/index.blade.php ENDPATH**/ ?>