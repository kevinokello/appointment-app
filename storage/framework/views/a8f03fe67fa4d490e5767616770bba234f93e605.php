

<?php $__env->startSection('content'); ?>
    <div class="">
        <h1 class="center">
            Available Appointments
        </h1>
        <div class="row">
            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col 1">
                    <h5 class="center">
                        <?php echo e($appointment['date']); ?>

                    </h5>
                    <h5 class="center">
                        <b> <?php echo e($appointment['day_name']); ?></b>
                    </h5>
                    <?php if(!$appointment['off']): ?>
                        <?php $__currentLoopData = $appointment['business_hours']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!in_array($time, $appointment['reserved_hours'])): ?>
                                <form action="<?php echo e(route('reserve')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="date" value=" <?php echo e($appointment['full_date']); ?>">
                                    <input type="hidden" name="time" value="<?php echo e($time); ?>">
                                    <button class="waves-effect waves-light btn info darken-2" type="submit">
                                        <?php echo e($time); ?>

                                    </button>
                                    <br>
                                    <br>
                                </form>
                            <?php else: ?>
                                <button  class="waves-effect waves-light btn info darken-2" disabled>
                                    <?php echo e($time); ?>

                                </button>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.timepicker');
            var instances = M.Timepicker.init(elems, {
                twelveHour: false
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kevin\OneDrive\Desktop\cyriz\mine\booking\resources\views/appointments/reserve.blade.php ENDPATH**/ ?>