<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan Request')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan Request')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        

                    <div class="table-responsive p-3">
                        <table class="table" id="pc-dt-simple">
    
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Company Id')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Plan Name')); ?></th>
                                    <th><?php echo e(__('Total Users')); ?></th>
                                    <th><?php echo e(__('Total Employees')); ?></th>
                                    <th><?php echo e(__('Duration')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <?php $__currentLoopData = $plan_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($plan_request->company_id); ?></td>
                                    <td><?php echo e($plan_request->company_name); ?></td>
                                    <td><?php echo e($plan_request->plan); ?></td>
                                    <td><?php echo e($plan_request->total_users == -1 ? 'Unlimited' :  $plan_request->total_users); ?></td>
                                    <td><?php echo e($plan_request->total_users == -1 ? 'Unlimited' : $plan_request->total_users - 1); ?></td>
                                    <td>
                                        
                                        <?php echo e($plan_request->duration > 1 && $plan_request->duration < 12 ?
                                                ($plan_request->duration == 1 ? $plan_request->duration . ' month' :  $plan_request->duration . ' months'):
                                                ($plan_request->duration >= 12 ?
                                                    number_format($plan_request->duration / 12, 1) . ' year' :
                                                    $plan_request->duration . ' months')); ?>

                                    </td>
                                    <td><?php echo e($plan_request->start_date); ?></td>
                                    <td><?php echo e($plan_request->end_date); ?></td>
                                    <td>
                                        <?php echo e(ucfirst($plan_request->status)); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/plan_request/index.blade.php ENDPATH**/ ?>