
<?php $__env->startSection('css'); ?>
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="<?php echo e(URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css')); ?>">
    <link href="<?php echo e(URL::asset('dashboard/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet"/>

    <!-- Internal Select2 css -->
    <link href="<?php echo e(URL::asset('Dashboard/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="<?php echo e(URL::asset('Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')); ?>"
          rel="stylesheet">
    <link href="<?php echo e(URL::asset('Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')); ?>"
          rel="stylesheet">
    <link href="<?php echo e(URL::asset('Dashboard/plugins/pickerjs/picker.min.css')); ?>" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="<?php echo e(URL::asset('Dashboard/plugins/spectrum-colorpicker/spectrum.css')); ?>" rel="stylesheet">

<?php $__env->startSection('title'); ?>
    <?php echo e(trans('doctors.add_doctor')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> <?php echo e(trans('main-sidebar_trans.doctors')); ?></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
               <?php echo e(trans('doctors.add_doctor')); ?></span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('Dashboard.messages_alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('doctors.update')); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        
                        <?php echo e(csrf_field()); ?>

                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div>
                                <?php if($doctor->image): ?>
                                    <img style="border-radius:20%"
                                         src="<?php echo e(Url::asset('dashboard/images/doctors/'.$doctor->image->filename)); ?>"
                                         height="150px" width="150px" alt="">
                                <?php else: ?>
                                    <img style="border-radius:50%"
                                         src="<?php echo e(Url::asset('dashboard/images/doctor_default.png')); ?>"
                                         height="50px"
                                         width="50px" alt="">
                                <?php endif; ?>
                            </div>
                            <br><br>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        <?php echo e(trans('doctors.name')); ?></label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name" value="<?php echo e($doctor->name); ?>" type="text">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        <?php echo e(trans('doctors.email')); ?></label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="<?php echo e($doctor->email); ?>" name="email" type="email">
                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        <?php echo e(trans('doctors.phone')); ?></label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="<?php echo e($doctor->phone); ?>" name="phone" type="tel">
                                    <input class="form-control" value="<?php echo e($doctor->id); ?>" name="id" type="hidden">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        <?php echo e(trans('doctors.section')); ?></label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="section_id" class="form-control SlectBox">
                                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($section->id); ?>" <?php echo e($section->id == $doctor->section_id ? 'selected':""); ?>><?php echo e($section->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            </div>

                            <div class=" row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        <?php echo e(trans('doctors.appointments')); ?></label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select multiple="multiple" class="testselect2" name="appointments[]">
                                        <?php $__currentLoopData = $doctor->doctorappointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointmentDOC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($appointmentDOC->id); ?>" selected><?php echo e($appointmentDOC->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($appointment->id); ?>"><?php echo e($appointment->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        <?php echo e(trans('Doctors.doctor_photo')); ?></label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                    <img style="border-radius:50%" width="150px" height="150px" id="output"/>
                                </div>
                            </div>


                            <button type="submit"
                                    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5"><?php echo e(trans('Doctors.submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="<?php echo e(URL::asset('Dashboard/js/select2.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('Dashboard/js/advanced-form-elements.js')); ?>"></script>

    <!--Internal Sumoselect js-->
    <script src="<?php echo e(URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js')); ?>"></script>
    <!--Internal  Notify js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/notify/js/notifIt.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/plugins/notify/js/notifit-custom.js')); ?>"></script>


    <!--Internal  Datepicker js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js')); ?>"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.js')); ?>"></script>
    <!-- Internal Select2.min js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/select2/js/select2.min.js')); ?>"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')); ?>"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')); ?>"></script>
    <!-- Ionicons js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')); ?>"></script>
    <!--Internal  pickerjs js -->
    <script src="<?php echo e(URL::asset('dashboard/plugins/pickerjs/picker.min.js')); ?>"></script>
    <!-- Internal form-elements js -->
    <script src="<?php echo e(URL::asset('dashboard/js/form-elements.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Dashboard.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Bavly's Projects\hospital\resources\views/dashboard/doctors/edit.blade.php ENDPATH**/ ?>