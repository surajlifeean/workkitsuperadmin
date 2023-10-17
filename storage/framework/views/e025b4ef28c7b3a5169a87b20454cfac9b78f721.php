

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Company Deatails')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('companies.index')); ?>"><?php echo e(__('Companies')); ?></a></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-12">
                <div class=" card" style="height: 95%;">
                    <div class="card-header">
                        <h4><?php echo e(__('Company Name:')); ?> <?php echo e($company->name); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <p><?php echo e(__('Company Email:')); ?> <?php echo e($company->email); ?></p>
                                <p><?php echo e(__('Company Created:')); ?> <?php echo e($company->created_at); ?></p>
                            </div>
                            <div class="col-lg-6">
                                <div class="card" style="background-color:  transparent; box-shadow: unset;">

                                    <div class="card-body">
                                        <p style="margin-top: -1.1rem;"><?php echo e(__('Active plan')); ?></p>
                                        <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp; max-width: 300px;">
                                            <div class="card-body ">
                                                <span class="price-badge bg-primary"><?php echo e($companyInfo[0]->plan); ?></span>

                                                <span class="mb-4 f-w-600 p-price"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e(number_format($companyInfo[0]->price)); ?>

                                                    <small class="text-sm">
                                                        / <?php echo e($companyInfo[0]->duration > 1 && $companyInfo[0]->duration < 12 ?
                                                                 ($companyInfo[0]->duration == 1 ? $companyInfo[0]->duration . ' month' :  $companyInfo[0]->duration . ' months'):
                                                                 ($companyInfo[0]->duration >= 12 ?
                                                                     number_format($companyInfo[0]->duration / 12, 1) . ' year' :
                                                                     $companyInfo[0]->duration . ' months')); ?>

                                                    </small>

                                                </span>

                                                <p class="mb-0">
                                                    <?php echo e($companyInfo[0]->description); ?>

                                                </p>

                                                <ul class="my-4 list-unstyled">
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e($companyInfo[0]->total_users == -1 ? __('Unlimited') : $companyInfo[0]->total_users); ?> <?php echo e(__('Users')); ?>

                                                    </li>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e($companyInfo[0]->total_users == -1 ? __('Unlimited') : $companyInfo[0]->total_users - 1); ?>

                                                        <?php echo e(__('Employees')); ?>

                                                    </li>
                                                    
                                                    
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                
            </div> -->
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo e(__('All Plan Requests')); ?></h4>
            </div>
            <div class=" card-body table-border-style">
                <div class="table-responsive">


                    <div class="p-3 table-responsive">
                        <table class="table" id="pc-dt-simple">

                            <thead>
                                <tr>
                                    <th><?php echo e(__('Plan Name')); ?></th>
                                    <th><?php echo e(__('Price')); ?></th>
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
                                <?php $__currentLoopData = $companyInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e($plan_request->plan); ?></td>
                                    <td>
                                        <?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e(number_format($companyInfo[0]->price)); ?>

                                    </td>
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
                                    <td>
                                        <?php if(isset($plan_request->transaction_id)): ?>
                                        <a href="<?php echo e(route('transactions.show', $plan_request->transaction_id)); ?>" class="btn btn-sm btn-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <?php endif; ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/companies/show.blade.php ENDPATH**/ ?>