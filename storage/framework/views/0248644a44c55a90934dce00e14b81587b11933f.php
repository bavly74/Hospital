
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('main-sidebar_trans.doctors')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('Dashboard/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="<?php echo e(URL::asset('dashboard/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="my-auto mb-0 content-title"><?php echo e(trans('main-sidebar_trans.doctors')); ?></h4>
                <span class="mt-1 mb-0 mr-2 text-muted tx-13">/
                    <?php echo e(trans('main-sidebar_trans.view_all')); ?></span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('dashboard.messages_alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="pb-0 card-header">
                    <div class="card-header pb-0">
                        <a href="<?php echo e(route('doctors.create')); ?>" class="btn btn-primary" role="button" aria-pressed="true"><?php echo e(trans('doctors.add_doctor')); ?></a>
                        <button type="button" class="btn btn-danger" id="btn_delete_all"><?php echo e(trans('doctors.delete_select')); ?></button>

                </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input type="checkbox" name="select_all"  id="example-select-all" ></th>
                                <th ><?php echo e(trans('doctors.doc_img')); ?></th>
                                <th ><?php echo e(trans('doctors.name')); ?></th>
                                <th ><?php echo e(trans('doctors.email')); ?></th>
                                <th><?php echo e(trans('doctors.section')); ?></th>
                                <th ><?php echo e(trans('doctors.phone')); ?></th>
                                <th ><?php echo e(trans('doctors.appointments')); ?></th>
                                <th><?php echo e(trans('doctors.price')); ?></th>
                                <th ><?php echo e(trans('doctors.Status')); ?></th>
                                <th><?php echo e(trans('doctors.created_at')); ?></th>
                                <th><?php echo e(trans('doctors.Processes')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                          <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                  <td><?php echo e($loop->iteration); ?></td>
                                  <th><input type="checkbox" name="delete_select" value="<?php echo e($doctor->id); ?>" class="delete_select"></th>
                                  <td>
                                    <?php if($doctor->image): ?>
                                    <img src="<?php echo e(asset('dashboard/images/doctors/'.$doctor->image->filename)); ?>"/>
                                    <?php else: ?>
                                    <img src="<?php echo e(asset('dashboard/images/doctor_default.png')); ?>" style="width:50px;heigh:50px" />
                                    <?php endif; ?>
                                  </td>
                                  <td><?php echo e($doctor->name); ?></td>


                                  <td><?php echo e($doctor->email); ?></td>
                                  <td><?php echo e($doctor->section->name); ?></td>
                                  <td><?php echo e($doctor->phone); ?></td>
                                  <td>
                                    <?php $__currentLoopData = $doctor->doctorappointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php echo e($appointment->name); ?>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                  <td><?php echo e($doctor->price); ?></td>
                                  <td>
                                      <div class="dot-label bg-<?php echo e($doctor->status == 1 ? 'success':'danger'); ?> ml-1"></div>
                                      <?php echo e($doctor->status == 1 ? trans('doctors.Enabled'):trans('doctors.Not_enabled')); ?>


                                      
                                      <!-- <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1"  <?php echo e($doctor->status == 1 ? 'checked': ''); ?>>
                                        <label class="custom-control-label" for="customSwitch1">تغيير الحالة</label>
                                      </div> -->
                                  </td>

                                                  <!-- Default checked -->


                                  <td><?php echo e($doctor->created_at->diffForHumans()); ?></td>
                                  <td>
                                  <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button"><?php echo e(trans('doctors.Processes')); ?><i class="fas fa-caret-down mr-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item" href="<?php echo e(route('doctors.edit',$doctor->id)); ?>"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;تعديل البيانات</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_password<?php echo e($doctor->id); ?>"><i   class="text-primary ti-key"></i>&nbsp;&nbsp;تغير كلمة المرور</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status<?php echo e($doctor->id); ?>"><i   class="text-warning ti-back-right"></i>&nbsp;&nbsp;تغير الحالة</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete<?php echo e($doctor->id); ?>"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;حذف البيانات</a>

                                    </div>
                                </div>
                            </td>
                              </tr>
                              <?php echo $__env->make('dashboard.doctors.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              <?php echo $__env->make('dashboard.doctors.delete_select', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              <?php echo $__env->make('dashboard.doctors.update_password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              <?php echo $__env->make('dashboard.doctors.update_status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(function() {
        jQuery("[name=select_all]").click(function(source) {
            checkboxes = jQuery("[name=delete_select]");
            for(var i in checkboxes){
                checkboxes[i].checked = source.target.checked;
            }
        });
    })
</script>

<script type="text/javascript">
    $(function () {
        $("#btn_delete_all").click(function () {
            var selected = [];
            $("#example input[name=delete_select]:checked").each(function () {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_select').modal('show')
                $('input[id="delete_select_id"]').val(selected);
            }
        }); 
    });
</script>

    <!-- Internal Data tables -->
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')); ?>"></script>
    <!--Internal  Datatable js -->
    <script src="<?php echo e(URL::asset('Dashboard/js/table-data.js')); ?>"></script>

    <!--Internal  Notify js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/notify/js/notifIt.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/plugins/notify/js/notifit-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Bavly's Projects\hospital\resources\views/dashboard/doctors/index.blade.php ENDPATH**/ ?>