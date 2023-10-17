<?php echo Form::open(['route' => isset($company) ? ['companies.update', $company->id] : 'companies.store', 'method' => isset($company) ? 'put' : 'post']); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo Form::text('name', isset($company) ? $company->name : null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Name']); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo Form::text('email', isset($company) ? $company->email : null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Email']); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('mobile', __('Mobile'), ['class' => 'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo Form::text('mobile', isset($company) ? $company->mobile : null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile']); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('password', __('Password'), ['class' => 'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'required' => 'required', 'id' => 'password-input']); ?>


                <span class="cursor-pointer toggle-password" onclick="togglePasswordVisibility()">Show</span>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(isset($company) ? __('Update') : __('Create')); ?>" class="btn btn-primary">
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password-input');
        const togglePassword = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            togglePassword.textContent = 'Show';
        }
    }
</script>

<?php echo Form::close(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/companies/create.blade.php ENDPATH**/ ?>