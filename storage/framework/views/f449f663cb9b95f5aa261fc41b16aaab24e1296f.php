

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="center">
        Business Hours
    </h1>

    <div class="row center">

        <form action="<?php echo e(route('business_hours.update')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php $__currentLoopData = $businessHours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $businessHour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col s3">
                <h4>
                    <?php echo e($businessHour->day); ?>

                </h4>
            </div>
            <input type="hidden" name="data[<?php echo e($businessHour->day); ?>][day]" value="<?php echo e($businessHour->day); ?>">
            <div class="input-field col s3">
                <input type="text" class="timepicker" value="<?php echo e($businessHour->from); ?>" name="data[<?php echo e($businessHour->day); ?>][from]" placeholder="From">
            </div>

            <div class="input-field col s2">
                <input type="text" class="timepicker" value="<?php echo e($businessHour->to); ?>" name="data[<?php echo e($businessHour->day); ?>][to]" placeholder="To">
            </div>
            <div class="input-field col s1">
                <input type="number" name="data[<?php echo e($businessHour->day); ?>][step]" value="<?php echo e($businessHour->step); ?>" placeholder="Step">
            </div>

            <div class="input-field col s3">
                <p>
                    <label>
                        <input value="true" name="data[<?php echo e($businessHour->day); ?>][off]" class="filled-in" type="checkbox" @checked($businessHour->off) />
                        <span>OFF</span>
                    </label>
                </p>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            <div class="col s12">

                <button class="waves-effect waves-light btn info darken-2" type="submit">
                    save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            twelveHour:false
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kevin\OneDrive\Desktop\cyriz\mine\booking\resources\views/appointments/business_hours.blade.php ENDPATH**/ ?>