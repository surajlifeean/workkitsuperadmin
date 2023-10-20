<?php
use App\Models\Utility;
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$languages = \App\Models\Utility::languages();
$profile = \App\Models\Utility::get_file('uploads/avatar/');
$unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
->where('seen', 0)
->count();
$unseen_count = DB::select('SELECT from_id, COUNT(*) AS totalmasseges FROM ch_messages WHERE seen = 0 GROUP BY from_id');
?>
<meta name="csrf-token" hidden content="<?php echo e(csrf_token()); ?>" />

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
<header class="dash-header transprent-bg">
    <?php else: ?>
    <header class="dash-header">
        <?php endif; ?>
        

        <div class="header-wrapper">
            <div class="me-auto dash-mob-drp">
                <ul class="list-unstyled">
                    <li class="dash-h-item mob-hamburger">
                        <a href="#!" class="dash-head-link" id="mobile-collapse">
                            <div class="hamburger hamburger--arrowturn">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="dropdown dash-h-item drp-company">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="theme-avtar">
                                <img alt="#" src="<?php echo e(!empty($users->avatar) ? $profile . $users->avatar : $profile . '/avatar.png'); ?>" class="header-avtar" style="width: 100%; border-radius:50%">
                            </span>
                            <span class="hide-mob ms-2"> <?php echo e('Hi, ' . Auth::user()->name . '!'); ?>

                                <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown">
                            <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span><?php echo e(__('My Profile')); ?></span>
                            </a>

                            <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="ti ti-power"></i>
                                <span><?php echo e(__('Logout')); ?></span>
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?></form>
                        </div>
                    </li>


                </ul>
            </div>
            <div class="ms-auto">
                <ul class="list-unstyled">

                    <?php if(Auth::user()->type == 'super admin'): ?>
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0 " id="msg-btn-brodcast"  data-url="<?php echo e(route('notifications.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Brodcust')); ?>" data-size="md" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Broadcast')); ?>">
                            <i class="ti ti-microphone-2"></i>
                        </a>

                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="ms-auto" style="margin-left: 0 !important;">
                <ul class="list-unstyled">
                    <?php
                    $unseenCounter = App\Models\Notification::where('company_id', '<>', null)
                        ->where('is_seen', 0)
                        ->count();
                        ?>
                        <?php if(Auth::user()->type == 'super admin'): ?>
                        <li class="dropdown dash-h-item drp-notification">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0 " data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" id="msg-btn-sp">
                                <i class="ti ti-message-2"></i>
                                <span class="bg-danger dash-h-badge message-counter "><?php echo e($unseenCounter); ?>

                                    <span class="sr-only"></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                                <div class="noti-header">
                                    <h5 class="m-0"><?php echo e(__('Messages')); ?></h5>
                                    <a href="#" class="cursor-pointer" onclick="checkAllSeen()"><?php echo e(__('Clear All')); ?></a>
                                </div>

                                <div class="flex noti-body dropdown-list-message-msg " id="notifibody">

                                </div>

                            </div>
                        </li>
                        <?php endif; ?>
                </ul>
            </div>
            <div class="ms-auto" style="margin-left: 0 !important;">
                <ul class="list-unstyled">

                    <?php
                    $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
                    ->where('seen', 0)
                    ->count();
                    ?>

                    <?php if(Auth::user()->type != 'super admin'): ?>
                    <li class="dash-h-item">
                        <a class="dash-head-link me-0" href="<?php echo e(url('/chats')); ?>">
                            <i class="ti ti-message-circle"></i>
                            <span class="bg-danger dash-h-badge message-counter custom_messanger_counter"><?php echo e($unseenCounter); ?>

                                <span class="sr-only"></span>
                            </span>
                        </a>
                    </li>
                    <?php endif; ?>

                    

                    <?php
                    $unreadCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
                    ->where('seen', 0)
                    ->count();
                    ?>

                    <?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0 " data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" id="msg-btn">
                            <i class="ti ti-message-2"></i>
                            <span class="bg-danger dash-h-badge message-counter custom_messanger_counter"><?php echo e($unreadCounter); ?>

                                <span class="sr-only"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                            <div class="noti-header">
                                <h5 class="m-0"><?php echo e(__('Messages')); ?></h5>
                                <a href="#" class="dash-head-link mark_all_as_read_message"><?php echo e(__('Clear All')); ?></a>
                            </div>

                            <div class="noti-body dropdown-list-message-msg">
                                <div style="display: flex;">
                                    <a href="#" class="show-listView"></a>
                                    
                                    <div class="count-listOfContacts">
                                    </div>
                                </div>
                            </div>
                            <div class="noti-footer">
                                <div class="d-grid">
                                    <a href="<?php echo e(route('chats')); ?>" class="mx-0 btn dash-head-link justify-content-center text-primary">View all</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php
                    // $currantLang = basename(\App::getLocale());
                    $languages = \App\Models\Utility::languages();
                    $lang = isset($users->lang) ? $users->lang : 'en';
                    if ($lang == null) {
                    $lang = 'en';
                    }
                    if (\Schema::hasTable('languages')) {
                    $LangName = \App\Models\Languages::where('code', $lang)->first()->fullName;
                    } else {
                    $LangName = 'english';
                    }
                    ?>

                    <li class="dropdown dash-h-item drp-language">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0 " data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage">
                            <i class="ti ti-world nocolor"></i>
                            <span class="drp-text hide-mob"><?php echo e(Str::ucfirst($LangName)); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end" aria-labelledby="dropdownLanguage">
                            
                            <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language', $code)); ?>" class="dropdown-item <?php echo e($currantLang == $code ? 'text-primary' : ''); ?>">
                                <span><?php echo e(ucFirst($lang)); ?></span>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                            <div class="m-0 dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-primary" data-size="md" data-url="<?php echo e(route('create.language')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Language')); ?>" data-bs-toggle="tooltip"><?php echo e(__('Create Language')); ?></a>
                            <div class="m-0 dropdown-divider"></div>
                            <a href="<?php echo e(route('manage.language', [basename(App::getLocale())])); ?>" class="dropdown-item text-primary"><?php echo e(__('Manage Language')); ?></a>
                            <?php endif; ?>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </header>
    <?php $__env->startPush('scripts'); ?>
    
    <?php if(Auth::user()->type == 'super admin'): ?>

    <script>
        $('#msg-btn-sp').on('click', function() {
            // Fetch API call
            fetchMessages();
            event.stopPropagation();
            console.log('hits')
        });
        setInterval(() => {
            fetchMessages();
        }, 500000);

        function fetchMessages() {
            console.log('w');

            // Fetch CSRF token from the meta tag
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/Alsol/workkitsuperadmin/notifications_from_clients',
                method: 'GET',
                headers: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    'Content-Type': 'application/json',

                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    // data.foreach(e => {
                    $('#notifibody').empty();
                    for (let i = 0; i < data.length; i++) {


                        const limitedTitle = data[i].title.substring(0, 50); // Change 50 to your desired limit
                        const limitedMessage = data[i].message.substring(0, 100); // Change 100 to your desired limit

                        // Format created_at date (assuming it's in a standard date format)
                        const formattedDate = new Date(data[i].created_at).toLocaleString();

                        $('#notifibody').append(`
                           <a class="py-2 cursor-pointer d-flex flex-column" href="" style="border-bottom: 1px solid black;">
                              <h4>${data[i].company_name} <small style="font-size: 9px;">(${data[i].email})</small></h4>
                              <h5>${data[i].title}...</h5>
                              <p class="m-0">${data[i].message}...</p>
                              <small class="ml-auto" style="margin-left: auto;">${formattedDate}</small>
                           </a>
                        `);

                    }
                    // });
                },
                error: function(error) {
                    console.error('Error fetching messages:', error);
                },
            });
        }

        function checkAllSeen() {
            $.ajax({
                url: '/Alsol/workkitsuperadmin/update-all-seen',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                },
                success: function(data) {
                    // Fetch messages after updating
                    fetchMessages();
                },
                error: function(error) {
                    console.error('Error updating seen status:', error);
                },
            });
        }
    </script>

    <?php else: ?>
    <script>
        // console.log('edfcgvhjnk')
        $('#msg-btn').click(function() {
            let contactsPage = 1;
            let contactsLoading = false;
            let noMoreContacts = false;
            $.ajax({
                url: url + "/getContacts",
                method: "GET",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    page: contactsPage,
                    type: 'custom',
                },
                dataType: "JSON",
                success: (data) => {

                    if (contactsPage < 2) {
                        $(".count-listOfContacts").html(data.contacts);

                    } else {
                        $(".count-listOfContacts").append(data.contacts);
                    }
                    $('.count-listOfContacts').find('.messenger-list-item').each(function(e) {
                        $('.noti-body .activeStatus').remove()
                        $('.noti-body .avatar').remove()
                        $(this).find('span').remove()
                        $(this).find('p').addClass("d-inline")
                        // $(this).find('b').addClass('position-absolute')
                        // $(this).find('b').css({position: "absolute"});
                        $(this).find('b').css({
                            "position": "absolute",
                            "right": "50px"
                        });
                        $(this).find('tr').remove('td')

                    })
                },
                error: (error) => {
                    setContactsLoading(false);
                    console.error(error);
                },
            });
        });
    </script>
    <?php endif; ?>
    <?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\Alsol\main-file\resources\views/partial/Admin/header.blade.php ENDPATH**/ ?>