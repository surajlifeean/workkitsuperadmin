<?php
    $chatgpt_key = Utility::getValByName('chatgpt_key');
    $chatgpt_enable = !empty($chatgpt_key);
?>

<?php echo e(Form::open(['url' => 'plans', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">

    <?php if($chatgpt_enable): ?>
    <div class="text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="<?php echo e(route('generate', ['plan'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate Content With AI')); ?>">
            <i class="fas fa-robot"></i><?php echo e(__(' Generate With AI')); ?>

        </a>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control font-style','placeholder' => __('Enter Plan Name'),'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('price', null, ['class' => 'form-control', 'placeholder' => __('Enter Plan Price')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('duration', __('Duration'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::select('duration', $arrDuration, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_users', __('Maximum Users'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('max_users', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_employees', __('Maximum Employees'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('max_employees', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('storage_limit', __('Storage Limit'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('storage_limit', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            <span class="small"><?php echo e(__('Note: Upload size in MB')); ?></span>
        </div>
        <div class="form-group col-6">
            <div class="custom-control form-switch pt-5">
                <input type="checkbox" class="form-check-input" name="enable_chatgpt" id="enable_chatgpt">
            <label class="custom-control-label form-check-label"
                for="enable_chatgpt"><?php echo e(__('Enable Chatgpt')); ?></label>
            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
<input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/plan/create.blade.php ENDPATH**/ ?>