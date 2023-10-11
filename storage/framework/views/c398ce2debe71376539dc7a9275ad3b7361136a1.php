<?php
    $chatgpt_key = Utility::getValByName('chatgpt_key');
    $chatgpt_enable = !empty($chatgpt_key);
?>

<?php echo e(Form::model($plan, ['route' => ['subscrption_plans.update', $plan->id],'method' => 'PUT','enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">

    
   
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('name', $plan->plan, ['class' => 'form-control font-style','placeholder' => __('Enter Plan Name'),'required' => 'required'])); ?>

        </div>
        <?php if($plan->price > 0): ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('price', __('Price'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::number('price', null, ['class' => 'form-control','placeholder' => __('Enter Plan Price'),'required' => 'required'])); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('price', __('Offer Price'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('offered_price', $plan->offered_price, ['class' => 'form-control', 'placeholder' => __('Enter Plan Price')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('Currency', __('Currency'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::select('currency', $currency, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('duration', __('Duration'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::number('duration', $plan->duration, ['class' => 'form-control ', 'required' => 'required']); ?>

            <span>Enter duration in months (e.g., 1) / <?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_users', __('Maximum Users'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('max_users', $plan->total_users, ['class' => 'form-control', 'required' => 'required'])); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        
        
        
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/plan/edit1.blade.php ENDPATH**/ ?>