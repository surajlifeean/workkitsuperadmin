

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Plan')): ?>
            <a href="#" data-url="<?php echo e(route('subscrption_plans.create')); ?>" data-size="md" data-ajax-popup="true"
                data-title="<?php echo e(__('Create New Plan')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                data-bs-original-title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-4">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body ">
                        <span class="price-badge bg-primary"><?php echo e($plan->plan); ?></span>

                        <div class="d-flex flex-row-reverse m-0 p-0 ">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Plan')): ?>
                                <div class="action-btn bg-primary ms-2">
                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>"
                                        data-url="<?php echo e(route('subscrption_plans.edit', $plan->id)); ?>" data-size="lg" data-bs-toggle="tooltip"
                                        data-bs-original-title="<?php echo e(__('Edit')); ?>" data-bs-placement="top"><span
                                            class="text-white"><i class="ti ti-pencil"></i></span></a>
                                </div>
                            <?php endif; ?>

                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                <span class="d-flex align-items-center ms-2">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                </span>
                            <?php endif; ?>
                        </div>


                        <span
                            class="mb-4 f-w-600 p-price"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e(number_format($plan->price)); ?>

                            <small class="text-sm">
                                
                                / <?php echo e($plan->duration > 1 && $plan->duration < 12 ?
                                        ($plan->duration == 1 ? $plan->duration . ' month' :  $plan->duration . ' months'):
                                        ($plan->duration >= 12 ?
                                            number_format($plan->duration / 12, 1) . ' year' :
                                            $plan->duration . ' months')); ?>

                            </small>
                               
                        </span>

                        <p class="mb-0">
                            <?php echo e($plan->description); ?>

                        </p>

                        <ul class="list-unstyled my-4">
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->total_users == -1 ? __('Unlimited') : $plan->total_users); ?> <?php echo e(__('Users')); ?>

                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->total_users == -1 ? __('Unlimited') : $plan->total_users - 1); ?>

                                <?php echo e(__('Employees')); ?>

                            </li>
                            
                            
                        </ul>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <h4 class="my-5">Non active plans</h4>

        <?php $__currentLoopData = $not_active_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-4">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body ">
                        <span class="price-badge bg-primary"><?php echo e($plan->plan); ?></span>

                        <div class="d-flex flex-row-reverse m-0 p-0 ">
                            

                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                <span class="d-flex align-items-center ms-2">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                </span>
                            <?php endif; ?>
                        </div>


                        <span
                            class="mb-4 f-w-600 p-price"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e(number_format($plan->price)); ?>

                            <small class="text-sm">
                                
                                / <?php echo e($plan->duration > 1 && $plan->duration < 12 ?
                                        ($plan->duration == 1 ? $plan->duration . ' month' :  $plan->duration . ' months'):
                                        ($plan->duration >= 12 ?
                                            number_format($plan->duration / 12, 1) . ' year' :
                                            $plan->duration . ' months')); ?>

                            </small>
                               
                        </span>

                        <p class="mb-0">
                            <?php echo e($plan->description); ?>

                        </p>

                        <ul class="list-unstyled my-4">
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->total_users == -1 ? __('Unlimited') : $plan->total_users); ?> <?php echo e(__('Users')); ?>

                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->total_users == -1 ? __('Unlimited') : $plan->total_users - 1); ?>

                                <?php echo e(__('Employees')); ?>

                            </li>
                            
                            
                        </ul>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/plan/index1.blade.php ENDPATH**/ ?>