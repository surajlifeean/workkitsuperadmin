

<?php echo e(Form::open(['url' => 'subscrption_plans', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">

    

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
            <?php echo e(Form::label('price', __('Offer Price'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('offered_price', null, ['class' => 'form-control', 'placeholder' => __('Enter Plan Price')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('duration', __('Duration'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('duration', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter duration in months (e.g., 1)'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('Currency', __('Currency'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::select('currency', $currency, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_users', __('Maximum Users'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('max_users', null, ['class' => 'form-control', 'required' => 'required'])); ?>

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
<input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">

</div>
<script>
    console.log('hghjg');
    window.onload = function() {
        document.getElementById('max_employees').addEventListener('input', function () {
            var maxEmployeesValue = parseInt(this.value) || 0;
            var maxUsersInput = document.getElementById('max_users');

            maxUsersInput.setAttribute('max', maxEmployeesValue - 1);

            if (parseInt(maxUsersInput.value) > maxEmployeesValue - 1) {
                maxUsersInput.value = maxEmployeesValue - 1;
            }
        });
    };
</script>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/plan/create1.blade.php ENDPATH**/ ?>