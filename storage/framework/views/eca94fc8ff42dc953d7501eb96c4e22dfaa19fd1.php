

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
            <div class=" col-lg-3 col-md-4">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp; height: 90%; margin-top: 2.5rem;">
                    <div class="card-body position-relative">
                        <span class="price-badge bg-primary"><?php echo e($plan->plan); ?></span>

                        <div class="flex-row-reverse p-0 m-0 d-flex ">
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
                            class="mb-4 f-w-600 p-price"><?php echo e($plan->currency == 'USD' ? '$' : ($plan->currency == 'EUR' ? '€' : ($plan->currency == 'XOF' || $plan->currency == 'XAF' ? 'FCFA' : ''))); ?>

                            <span style="<?php echo e($plan->is_offer_price == 1 ? 'display:none;' : ''); ?>" id="price<?php echo e($plan->id); ?>"><?php echo e(number_format($plan->price)); ?></span>
                            <span style="<?php echo e($plan->is_offer_price == 0 ? 'display:none;' : ''); ?>" id="offered_price<?php echo e($plan->id); ?>" ><?php echo e(number_format($plan->offered_price)); ?></span>
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

                        <ul class="my-4 list-unstyled">
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
                        <div class="mt-4 form-check form-switch position-absolute" style="bottom: 10px; left: 10px;">
                                          <input <?php echo e($plan->is_offer_price == 1 ? 'checked' : ''); ?> class="form-check-input" onchange="handleOfferPrice('<?php echo e($plan->id); ?>', this)" type="checkbox" id="flexSwitchCheckChecked<?php echo e($plan->id); ?>">
                                          <label class="form-check-label" for="flexSwitchCheckChecked"><?php echo e(__('Offer Price')); ?></label>
                                    </div>
                        
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

                        <div class="flex-row-reverse p-0 m-0 d-flex ">
                            

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

                        <ul class="my-4 list-unstyled">
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

    <script>
    
    function handleOfferPrice(planId, src) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // const planId = checkbox.dataset.id;
        const isChecked = src.checked ? 1 : 0;
        let price = document.getElementById('price'+planId);
        let offered_price = document.getElementById('offered_price'+planId);
          
        console.log(isChecked)
        fetch(`/Alsol/workkitsuperadmin/subscription-plans-update/${planId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ isOfferPrice: isChecked }),
        })
        .then(response => response.json())
        .then(data => {
               console.log(data);
               if (isChecked == 1) {
                price.style.display = 'none' 
                offered_price.style.display = 'inline'
               } else {
                price.style.display = 'inline' 
                offered_price.style.display = 'none'
               } 
            
        })
        .catch(error => console.error('Error:', error));
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/plan/index1.blade.php ENDPATH**/ ?>