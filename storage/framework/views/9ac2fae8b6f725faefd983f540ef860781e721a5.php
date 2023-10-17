

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Transaction Deatails')); ?>

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
                        <h4><?php echo e(__('Transaction Deatails')); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-4"><b><?php echo __('Customer Details'); ?></b></h5>
                                <p><b><?php echo __('Customer Name'); ?></b>: <?php echo e($transaction['customer_details']['name'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Email'); ?></b>: <?php echo e($transaction['customer_details']['email'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Phone'); ?></b>: <?php echo e($transaction['customer_details']['phone'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('City'); ?></b>: <?php echo e($transaction['customer_details']['address']['city'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Country'); ?></b>: <?php echo e($transaction['customer_details']['address']['country'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Postal Code'); ?></b>: <?php echo e($transaction['customer_details']['address']['postal_code'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('State'); ?></b>: <?php echo e($transaction['customer_details']['address']['state'] ?? __('N/A')); ?></p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-4"><b><?php echo __('Payment Details'); ?></b></h5>
                                <p><b><?php echo __('Transaction Id'); ?></b>: <a style="font-size: 9px; cursor: pointer;" id="transactionId" class="cursor-pointer" 
                                    onclick="copyToClipboard()" title="copy"><?php echo e($transaction['id'] ?? __('N/A')); ?></a></p>
                                <p><b><?php echo e(__('Plan')); ?></b>: <?php echo e($plan_request->plan); ?></p>
                                <p><b><?php echo e(__('Plan Price')); ?></b>: <?php echo e($plan_request->is_offer_price == 1 ? $plan_request->offered_price : $plan_request->price); ?></p>
                                <p><b><?php echo __('Duration'); ?></b>: <?php echo e($plan_request->duration > 1 && $plan_request->duration < 12 ?
                                                ($plan_request->duration == 1 ? $plan_request->duration . ' month' :  $plan_request->duration . ' months'):
                                                ($plan_request->duration >= 12 ?
                                                    number_format($plan_request->duration / 12, 1) . ' year' :
                                                    $plan_request->duration . ' months')); ?></p>
                                <p><b><?php echo __('Offer Price'); ?></b>: <?php echo e($plan_request->is_offer_price == 1 ? 'Yes' : 'No'); ?></p>
                                <p><b><?php echo __('Currency'); ?></b>: <?php echo e(strtoupper($transaction['currency']) ?? __('N/A')); ?></p>

                            </div>
                            <div class="col-lg-4 col-md-6">
                                <h5 class="mb-5"></h5>
                                <p><b><?php echo __('Payment Link'); ?></b>: <?php echo e($transaction['payment_link'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Payment Status'); ?></b>: <?php echo e($transaction['payment_status'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Status'); ?></b>: <?php echo e($transaction['status'] ?? __('N/A')); ?></p>
                                <p><b><?php echo __('Amount Subtotal'); ?></b>: <?php echo e(( strtoupper($transaction['currency']) == 'XOF' || strtoupper($transaction['currency']) == 'XAF') ? $transaction['amount_subtotal'] : ( $transaction['amount_subtotal'] / 100 ?? __('N/A') )); ?></p>
                                <p><b><?php echo __('Amount Total'); ?></b>: <?php echo e(( strtoupper($transaction['currency']) == 'XOF' || strtoupper($transaction['currency']) == 'XAF') ? $transaction['amount_total'] :  ( $transaction['amount_total'] / 100 ?? __('N/A') )); ?></p>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo e(__('Activate Plan')); ?></h4>
                    </div>
                    <div class="card-body">
                        
                            <?php echo e(Form::model($plan_request, ['route' => ['plan_request.update', $plan_request->id], 'method' => 'PUT'])); ?>

                                <div class="row d-flex flex-wrap">
                               
                                     <div class="col-lg-4 col-md-6 col-12 my-2">
                                        
                                         <?php echo e(Form::label('status', 'Status')); ?>

                                         <?php
                                             $statusOptions = [
                                                 'active' => 'Activate',
                                                 'rejected' => 'Reject',
                                                 'hold' => 'Hold'
                                             ];
                                         
                                             if ($plan_request->status == 'pending') {
                                                 $statusOptions['pending'] = 'Pending';
                                             }
                                             if ($plan_request->status == 'active') {
                                                $statusOptions['active'] = 'Activated';
                                             }
                                             if ($plan_request->status == 'rejected') {
                                                $statusOptions = [];
                                                $statusOptions['rejected'] = 'Rejected';
                                             }
                                           
                                         ?>
                                         
                                         <?php echo e(Form::select('status', $statusOptions, $plan_request->status, ["class" => "form-control", "name" => "status",
                                         "readonly" => ( $plan_request->status == 'rejected' ) ? "readonly" : null])); ?>

                                      </div>

                                     <div class="col-lg-4 col-md-6 col-12 my-2">
                                         <?php echo e(Form::label('days', 'Number of Days')); ?>

                                         <?php echo e(Form::number('days', ($plan_request->duration * 30), [
                                            "class" => "form-control",
                                            "name" => "days",
                                            "placeholder" => "Exact no of days",
                                            "readonly" => ($plan_request->status != 'pending') ? "readonly" : null
                                        ])); ?>

                                        
                                          <span style="font-weight: 600; font-size: 11px;">Ex: for 1 month package days can be 30 or 28 or 29 etc... ( Default 30 days per month)</span>
                                     </div>

                                     <div class="col-lg-4 col-md-6 col-12 my-2">
                                         <?php echo e(Form::label('start_date', 'Start Date and Time')); ?>

                                         <?php echo e(Form::datetimeLocal('start_date', ($plan_request->start_date ? $plan_request->start_date : now()->format('Y-m-d\TH:i')), ["class" => "form-control", "name" => "start_date", "placeholder" => "Select Start Date and Time",  
                                         "readonly" => ($plan_request->start_date || $plan_request->status == 'rejected' ? "readonly" : null )
                                         ])); ?>

                                     </div>
                                     <div class="col-lg-4 col-md-6 col-12 my-2">
                                        <?php echo e(Form::label('end_date', 'End Date and Time')); ?>

                                        <?php echo e(Form::datetimeLocal('end_date', $plan_request->end_date, ["class" => "form-control", "name" => "start_date", "placeholder" => "Select Start Date and Time" , "readonly" => "readonly"])); ?>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 my-2">
                                        <?php echo e(Form::label('hold_date', 'Hold Date and Time')); ?>

                                        <?php echo e(Form::datetimeLocal('hold_date', $plan_request->hold_date, ["class" => "form-control", "name" => "start_date", "placeholder" => "Select Start Date and Time" , "readonly" => "readonly"])); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <?php echo e(Form::submit('Update', ["class" => "btn btn-primary", "onclick" => "return confirm('Are you sure you want to continue?')",
                                         "disabled" => ($plan_request->status == 'rejected') ? "disabled" : null
                                        ])); ?>

                                    </div>                                    
                                </div>
                            <?php echo e(Form::close()); ?>

                         
                    </div>
                </div>
            </div>
        </div>

        <script>
            function copyToClipboard() {
                var textToCopy = document.getElementById('transactionId').innerText;
        
                var textarea = document.createElement('textarea');
                textarea.value = textToCopy;
                document.body.appendChild(textarea);
        
                textarea.select();
                document.execCommand('copy');
                
                document.body.removeChild(textarea);
        
                // alert('Copied to clipboard: ' + textToCopy);
            }
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/transactions/show.blade.php ENDPATH**/ ?>