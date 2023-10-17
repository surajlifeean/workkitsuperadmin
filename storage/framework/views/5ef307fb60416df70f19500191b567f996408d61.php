

<?php $__env->startSection('page-title'); ?>
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Manage Companies')); ?>

    <?php else: ?>
        <?php echo e(__('Manage Users')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <li class="breadcrumb-item"><?php echo e(__('Companies')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item"><?php echo e(__('Users')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(Gate::check('Manage Employee Last Login')): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Employee Last Login')): ?>
            <a href="<?php echo e(route('lastlogin')); ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?php echo e(__('User Logs History')); ?>"><i class="ti ti-user-check"></i>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create User')): ?>
        <?php if(\Auth::user()->type == 'super admin'): ?>
            <a href="#" data-url="<?php echo e(route('companies.create')); ?>" data-ajax-popup="true"
                data-title="<?php echo e(__('Create New Company')); ?>" data-size="md" data-bs-toggle="tooltip" title=""
                class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        
        <?php endif; ?> 
    <?php endif; ?>


<?php $__env->stopSection(); ?>


<?php
    $logo = \App\Models\Utility::get_file('uploads/avatar/');
    
    $profile = \App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">

                    <div class="p-3 table-responsive">
                        <table class="table" id="pc-dt-simple">
    
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Company Id')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Password')); ?></th>
                                    <th><?php echo e(__('Mobile')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
    
                            <tbody>
                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($company->id); ?></td>
                                    <td><?php echo e($company->name); ?></td>
                                    <td><?php echo e($company->email); ?></td>
                                    <td><?php echo e(substr($company->password, 0, 8)); ?>...</td>
                                    <td><?php echo e($company->mobile); ?></td>
                                    <td>
                                     <a href="#" data-url="<?php echo e(route('companies.edit', $company->id)); ?>" data-ajax-popup="true"
                                          data-title="<?php echo e(__('Edit Company')); ?>" data-size="md" data-bs-toggle="tooltip" title=""
                                          class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                          <i class="ti ti-pencil"></i>
                                     </a>
                                     <a href="<?php echo e(route('companies.show', $company->id)); ?>" class="btn btn-sm btn-primary">
                                          <i class="ti ti-eye"></i>
                                     </a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/companies/index.blade.php ENDPATH**/ ?>