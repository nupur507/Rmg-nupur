<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/cron', 'CronController@cron')->name('bv.matching.cron');
Route::get('/starcron', 'CronController@starcron')->name('bv.matching.starcron');


Route::namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('paypal', 'paypal\ProcessController@ipn')->name('paypal');
    Route::get('paypal_sdk', 'paypal_sdk\ProcessController@ipn')->name('paypal_sdk');
    Route::post('perfect_money', 'perfect_money\ProcessController@ipn')->name('perfect_money');
    Route::post('stripe', 'stripe\ProcessController@ipn')->name('stripe');
    Route::post('stripe_js', 'stripe_js\ProcessController@ipn')->name('stripe_js');
    Route::post('stripe_v3', 'stripe_v3\ProcessController@ipn')->name('stripe_v3');
    Route::post('skrill', 'skrill\ProcessController@ipn')->name('skrill');
    Route::post('paytm', 'paytm\ProcessController@ipn')->name('paytm');
    Route::post('payeer', 'payeer\ProcessController@ipn')->name('payeer');
    Route::post('paystack', 'paystack\ProcessController@ipn')->name('paystack');
    Route::post('voguepay', 'voguepay\ProcessController@ipn')->name('voguepay');
    Route::get('flutterwave/{trx}/{type}', 'flutterwave\ProcessController@ipn')->name('flutterwave');
    Route::post('razorpay', 'razorpay\ProcessController@ipn')->name('razorpay');
    Route::post('instamojo', 'instamojo\ProcessController@ipn')->name('instamojo');
    Route::get('blockchain', 'blockchain\ProcessController@ipn')->name('blockchain');
    Route::get('blockio', 'blockio\ProcessController@ipn')->name('blockio');
    Route::post('coinpayments', 'coinpayments\ProcessController@ipn')->name('coinpayments');
    Route::post('coinpayments_fiat', 'coinpayments_fiat\ProcessController@ipn')->name('coinpayments_fiat');
    Route::post('coingate', 'coingate\ProcessController@ipn')->name('coingate');
    Route::post('coinbase_commerce', 'coinbase_commerce\ProcessController@ipn')->name('coinbase_commerce');
    Route::get('mollie', 'mollie\ProcessController@ipn')->name('mollie');
    Route::post('cashmaal', 'cashmaal\ProcessController@ipn')->name('cashmaal');
});

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});


/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::get('password', 'AdminController@password')->name('password');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        //Manage Survey
        Route::get('survey/category/all', 'SurveyController@allCategory')->name('survey.category.all');
        Route::post('survey/category/add', 'SurveyController@addCategory')->name('survey.category.add');
        Route::post('survey/category/update', 'SurveyController@updateCategory')->name('survey.category.update');

        Route::get('survey/report', 'SurveyController@report')->name('survey.report');
        Route::get('survey/report/{id}', 'SurveyController@reportQuestion')->name('survey.report.question');
        Route::get('survey/report/download/{id}', 'SurveyController@reportDownload')->name('survey.report.download');

        Route::get('survey/all', 'SurveyController@allSurvey')->name('survey.all');
        Route::get('survey/new', 'SurveyController@newSurvey')->name('survey.new');
        Route::post('survey/add', 'SurveyController@addSurvey')->name('survey.add');
        Route::get('survey/edit/{id}', 'SurveyController@editSurvey')->name('survey.edit');
        Route::post('survey/update', 'SurveyController@updateSurvey')->name('survey.update');

        Route::get('survey/all/question/{id}', 'SurveyController@allQuestion')->name('survey.all.question');
        Route::get('survey/new/question/{id}', 'SurveyController@newQuestion')->name('survey.new.question');
        Route::post('survey/question/add', 'SurveyController@addQuestion')->name('survey.add.question');
        Route::get('survey/question/edit/{question_id}/{survey_id}', 'SurveyController@editQuestion')->name('survey.question.edit');
        Route::post('survey/question/update', 'SurveyController@updateQuestion')->name('survey.question.update');

        Route::get('notification/read/{id}','AdminController@notificationRead')->name('notification.read');
        Route::get('notifications','AdminController@notifications')->name('notifications');

        // Users Manager
        Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
        Route::get('users/kyc', 'ManageUsersController@allKyc')->name('users.kyc');
        Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
        Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
        Route::get('users/email-verified', 'ManageUsersController@emailVerifiedUsers')->name('users.emailVerified');
        Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
        Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
        Route::get('users/sms-verified', 'ManageUsersController@smsVerifiedUsers')->name('users.smsVerified');
        Route::get('user/login/{id}', 'ManageUsersController@login')->name('users.login');

        Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
        Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
        Route::get('user/referral/{id}', 'ManageUsersController@userRef')->name('users.ref');
        Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update');

        Route::get('users/password/{id}', 'ManageUsersController@password')->name('users.password');
        Route::post('users/password/{id}', 'ManageUsersController@passwordUpdate')->name('users.password.update');

        Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance');
        Route::get('user/send-email/{id}', 'ManageUsersController@showEmailSingleForm')->name('users.email.single');
        Route::post('user/send-email/{id}', 'ManageUsersController@sendEmailSingle')->name('users.email.single');
        Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
        Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
        Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageUsersController@depViaMethod')->name('users.deposits.method');
        Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
        Route::get('user/withdrawals/via/{method}/{type?}/{userId}', 'ManageUsersController@withdrawalsViaMethod')->name('users.withdrawals.method');
        // Login History
        Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');

        Route::get('users/send-email', 'ManageUsersController@showEmailAllForm')->name('users.email.all');
        Route::post('users/send-email', 'ManageUsersController@sendEmailAll')->name('users.email.send');

        Route::get('user/completed/survey/{id}', 'ManageUsersController@survey')->name('users.survey');

        // mlm plan
        Route::get('plans', 'MlmController@plan')->name('plan');
        Route::post('plan/store', 'MlmController@planStore')->name('plan.store');

        Route::post('plan/update', 'MlmController@planUpdate')->name('plan.update');

        // matching bonus
        Route::post('matching-bonus/update', 'MlmController@matchingUpdate')->name('matching-bonus.update');

        // tree
        Route::get('/tree/{id}', 'ManageUsersController@tree')->name('users.single.tree');
        Route::get('/user/tree/{user}', 'ManageUsersController@otherTree')->name('users.other.tree');
        Route::get('/user/tree/search', 'ManageUsersController@otherTree')->name('users.other.tree.search');

        Route::get('notice', 'GeneralSettingController@noticeIndex')->name('setting.notice');
        Route::post('notice/update', 'GeneralSettingController@noticeUpdate')->name('setting.notice.update');




        // Subscriber
        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
        Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail');


        // Deposit Gateway
        Route::name('gateway.')->prefix('gateway')->group(function(){
            // Automatic Gateway
            Route::get('automatic', 'GatewayController@index')->name('automatic.index');
            Route::get('automatic/edit/{alias}', 'GatewayController@edit')->name('automatic.edit');
            Route::post('automatic/update/{code}', 'GatewayController@update')->name('automatic.update');
            Route::post('automatic/remove/{code}', 'GatewayController@remove')->name('automatic.remove');
            Route::post('automatic/activate', 'GatewayController@activate')->name('automatic.activate');
            Route::post('automatic/deactivate', 'GatewayController@deactivate')->name('automatic.deactivate');



            // Manual Methods
            Route::get('manual', 'ManualGatewayController@index')->name('manual.index');
            Route::get('manual/new', 'ManualGatewayController@create')->name('manual.create');
            Route::post('manual/new', 'ManualGatewayController@store')->name('manual.store');
            Route::get('manual/edit/{alias}', 'ManualGatewayController@edit')->name('manual.edit');
            Route::post('manual/update/{id}', 'ManualGatewayController@update')->name('manual.update');
            Route::post('manual/activate', 'ManualGatewayController@activate')->name('manual.activate');
            Route::post('manual/deactivate', 'ManualGatewayController@deactivate')->name('manual.deactivate');
        });


        // DEPOSIT SYSTEM
        Route::name('deposit.')->prefix('deposit')->group(function(){
            Route::get('/', 'DepositController@deposit')->name('list');
            Route::get('pending', 'DepositController@pending')->name('pending');
            Route::get('rejected', 'DepositController@rejected')->name('rejected');
            Route::get('approved', 'DepositController@approved')->name('approved');
            Route::get('successful', 'DepositController@successful')->name('successful');
            Route::get('details/{id}', 'DepositController@details')->name('details');

            Route::post('reject', 'DepositController@reject')->name('reject');
            Route::post('approve', 'DepositController@approve')->name('approve');
            Route::get('via/{method}/{type?}', 'DepositController@depViaMethod')->name('method');
            Route::get('/{scope}/search', 'DepositController@search')->name('search');
            Route::get('date-search/{scope}', 'DepositController@dateSearch')->name('dateSearch');

        });

         // Products
         Route::name('product.')->prefix('product')->group(function(){
            Route::get('/', 'ProductController@list')->name('index');
            Route::get('create', 'ProductController@create')->name('create');
            Route::post('create', 'ProductController@store')->name('store');
            Route::get('edit/{id}', 'ProductController@edit')->name('edit');
            Route::post('edit/{id}', 'ProductController@update')->name('update');

         });


        // WITHDRAW SYSTEM
        Route::name('withdraw.')->prefix('withdraw')->group(function(){
            Route::get('pending', 'WithdrawalController@pending')->name('pending');
            Route::get('approved', 'WithdrawalController@approved')->name('approved');
            Route::get('rejected', 'WithdrawalController@rejected')->name('rejected');
            Route::get('log', 'WithdrawalController@log')->name('log');
            Route::get('via/{method_id}/{type?}', 'WithdrawalController@logViaMethod')->name('method');
            Route::get('{scope}/search', 'WithdrawalController@search')->name('search');
            Route::get('date-search/{scope}', 'WithdrawalController@dateSearch')->name('dateSearch');
            Route::get('details/{id}', 'WithdrawalController@details')->name('details');
            Route::post('approve', 'WithdrawalController@approve')->name('approve');
            Route::post('reject', 'WithdrawalController@reject')->name('reject');


            // Withdraw Method
            Route::get('method/', 'WithdrawMethodController@methods')->name('method.index');
            Route::get('method/create', 'WithdrawMethodController@create')->name('method.create');
            Route::post('method/create', 'WithdrawMethodController@store')->name('method.store');
            Route::get('method/edit/{id}', 'WithdrawMethodController@edit')->name('method.edit');
            Route::post('method/edit/{id}', 'WithdrawMethodController@update')->name('method.update');
            Route::post('method/activate', 'WithdrawMethodController@activate')->name('method.activate');
            Route::post('method/deactivate', 'WithdrawMethodController@deactivate')->name('method.deactivate');
        });

        // Report
        Route::get('report/referral-commission', 'ReportController@refCom')->name('report.refCom');
        Route::get('report/binary-commission', 'ReportController@binary')->name('report.binaryCom');
        Route::get('report/invest', 'ReportController@invest')->name('report.invest');

        Route::get('report/bv-log', 'ReportController@bvLog')->name('report.bvLog');
        Route::get('report/bv-log/{id}', 'ReportController@singleBvLog')->name('report.single.bvLog');

        Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
        Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');


        Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
        Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');


        // Admin Support
        Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
        Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
        Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
        Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
        Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
        Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');


        // Language Manager
        Route::get('/language', 'LanguageController@langManage')->name('language.manage');
        Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
        Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
        Route::post('/language/update/{id}', 'LanguageController@langUpdatepp')->name('language.manage.update');
        Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
        Route::post('/language/import', 'LanguageController@langImport')->name('language.import_lang');



        Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
        Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
        Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key');



        // General Setting
        Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo_icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo_icon');

        
        // Autopool
        Route::get('setting/autopool', 'GeneralSettingController@autopool')->name('setting.autopool');
        Route::post('setting/autopool', 'GeneralSettingController@autopoolUpdate')->name('setting.autopool');

        
        // Reward
        Route::get('setting/reward', 'GeneralSettingController@reward')->name('setting.reward');
        Route::post('setting/reward', 'GeneralSettingController@rewardUpdate')->name('setting.reward');

        // Plugin
        Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
        Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
        Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
        Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');


        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.sendTestMail');


        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms.template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.global');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.sendTestSMS');

        // SEO
        Route::get('seo', 'FrontendController@seoEdit')->name('seo');


        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {

            Route::get('templates', 'FrontendController@templates')->name('templates');
            Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');

            Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
            Route::post('remove', 'FrontendController@remove')->name('remove');

            // Page Builder
            Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
            Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
        });

        // Frontend
        Route::name('franchise.')->prefix('franchise')->group(function () {
            Route::get('registration', 'FranchiseController@registrationForm')->name('registration');
            Route::post('create', 'FranchiseController@create')->name('create');
            Route::get('list', 'FranchiseController@franchiseList')->name('list');
            Route::get('edit/{id}', 'FranchiseController@edit')->name('edit');
            Route::post('edit/{id}', 'FranchiseController@update')->name('update');
            Route::get('search', 'FranchiseController@search')->name('search');
            Route::post('delete', 'FranchiseController@delete')->name('delete');
        });

        Route::name('stock.')->prefix('stock')->group(function () {
            Route::get('franchise-orderRequest', 'FranchiseController@franchiseOrderRequest')->name('franchise.orderRequest');
            Route::get('search-orderRequest', 'FranchiseController@searchOrderRequest')->name('search.orderRequest');
            Route::post('franchise-order-products', 'FranchiseController@franchiseOrderProducts')->name('franchiseOrderProducts');
            Route::post('franchise-order-approve', 'FranchiseController@franchiseOrderApprove')->name('franchiseOrderApprove');
            Route::post('franchise-order-discount-approve', 'FranchiseController@franchiseOrderDiscountApprove')->name('franchiseOrderDiscountApprove');
            Route::post('franchise-order-reject', 'FranchiseController@franchiseOrderReject')->name('franchiseOrderReject');
        });

    });
});


/*
|--------------------------------------------------------------------------
| Start Franchise Area
|--------------------------------------------------------------------------
*/

Route::namespace('Franchise')->prefix('franchise')->name('franchise.')->group(function () {

    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');

    });

    Route::middleware('franchise')->group(function () {
        Route::get('dashboard', 'FranchiseController@dashboard')->name('dashboard');

        // Request Stocks
        Route::get('request-stock/index', 'FranchiseController@request')->name('request.stock.index');
        Route::post('request-stock/place-order', 'FranchiseController@placeOrder')->name('request.stock.placeOrder');
        Route::post('request-stock/add-product', 'FranchiseController@addProduct')->name('request.stock.addProduct');
        Route::get('request-stock/order-history', 'FranchiseController@orderHistory')->name('request.stock.orderHistory');
        Route::get('request-stock/order-search', 'FranchiseController@orderSearch')->name('request.stock.orderSearch');
        Route::post('request-stock/order-history-products', 'FranchiseController@orderHistoryProducts')->name('request.stock.orderHistoryProducts');


    });

});


/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/


Route::name('user.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code_verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify-code');
});



Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');

        Route::middleware(['checkStatus'])->group(function () {
            Route::get('dashboard', 'UserController@home')->name('home');

            Route::get('profile-setting', 'UserController@profile')->name('profile-setting');
            Route::post('profile-setting', 'UserController@submitProfile');
            Route::get('change-password', 'UserController@changePassword')->name('change-password');
            Route::post('change-password', 'UserController@submitPassword');
            Route::get('update-kyc', 'UserController@updatekyc')->name('update-kyc');
            Route::post('approve-kyc', 'UserController@approvekyc')->name('approve-kyc');
            Route::post('reject-kyc', 'UserController@rejectkyc')->name('reject-kyc');

            Route::post('update-kyc', 'UserController@submitkyc')->name('update-kyc');
            Route::get('adhaar/{kyc}', 'UserController@adhaarDownload')->name('adhaar.download');
            Route::get('pan/{kyc}', 'UserController@panDownload')->name('pan.download');
            Route::get('bankfile/{kyc}', 'UserController@bankfileDownload')->name('bankfile.download');
            Route::get('update-bank', 'UserController@updatebank')->name('update-bank');
            Route::post('update-bank', 'UserController@submitbank')->name('update-bank');


            //2FA
            Route::get('twofactor', 'UserController@show2faForm')->name('twofactor');
            Route::post('twofactor/enable', 'UserController@create2fa')->name('twofactor.enable');
            Route::post('twofactor/disable', 'UserController@disable2fa')->name('twofactor.disable');
            Route::get('login/history', 'UserController@userLoginHistory')->name('login.history');

            //plan
            Route::get('/plan', 'PlanController@planIndex')->name('plan.index');
            Route::post('/plan', 'PlanController@planStore')->name('plan.purchase');
            Route::get('/referral-log', 'UserController@referralCom')->name('referral.log');

            Route::get('/binary-log', 'PlanController@binaryCom')->name('binary.log');
            Route::get('/binary-summery', 'PlanController@binarySummery')->name('binary.summery');
            Route::get('/bv-log', 'PlanController@bvlog')->name('bv.log');
            Route::get('/referrals', 'PlanController@myRefLog')->name('my.ref');
            Route::get('/tree', 'PlanController@myTree')->name('my.tree');
            Route::get('/tree/{user}', 'PlanController@otherTree')->name('other.tree');
            Route::get('/tree/search', 'PlanController@otherTree')->name('other.tree.search');

            //balance transfer
            Route::get('/transfer', 'UserController@indexTransfer')->name('balance.transfer');
            Route::post('/transfer', 'UserController@balanceTransfer')->name('balance.transfer.post');
            Route::post('/search-user', 'UserController@searchUser')->name('search.user');

            //Report
            Route::get('report/deposit/log', 'UserReportController@depositHistory')->name('report.deposit');
            Route::get('report/invest/log', 'UserReportController@investLog')->name('report.invest');
            Route::get('report/transactions/log', 'UserReportController@transactions')->name('report.transactions');
            Route::get('report/withdraw/log', 'UserReportController@withdrawLog')->name('report.withdraw');
            Route::get('report/referral/commission', 'UserReportController@refCom')->name('report.refCom');
            Route::get('report/binary/commission', 'UserReportController@binaryCom')->name('report.binaryCom');
            Route::get('report/star/commission', 'UserReportController@starCom')->name('report.starCom');
            Route::get('report/super-star/commission', 'UserReportController@superCom')->name('report.superCom');
            Route::get('report/ruby-star/commission', 'UserReportController@rubyCom')->name('report.rubyCom');
            Route::get('report/diamond-star/commission', 'UserReportController@diamondCom')->name('report.diamondCom');
            Route::get('report/autopool/commission', 'UserReportController@autopoolCom')->name('report.autopoolCom');
            Route::get('report/reward/commission', 'UserReportController@rewardCom')->name('report.rewardCom');

            // Deposit
            Route::any('deposit', 'Gateway\PaymentController@deposit')->name('deposit');
            Route::post('deposit/insert', 'Gateway\PaymentController@depositInsert')->name('deposit.insert');
            Route::get('deposit/preview', 'Gateway\PaymentController@depositPreview')->name('deposit.preview');
            Route::get('deposit/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');
            Route::get('deposit/manual', 'Gateway\PaymentController@manualDepositConfirm')->name('deposit.manual.confirm');
            Route::post('deposit/manual', 'Gateway\PaymentController@manualDepositUpdate')->name('deposit.manual.update');
            Route::get('deposit/history', 'UserController@depositHistory')->name('deposit.history');

            // Withdraw
            Route::get('withdraw', 'UserController@withdrawMoney')->name('withdraw');
            Route::post('withdraw', 'UserController@withdrawStore')->name('withdraw.money');
            Route::get('withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
            Route::post('withdraw/preview', 'UserController@withdrawSubmit')->name('withdraw.submit');
            Route::get('withdraw/history', 'UserController@withdrawLog')->name('withdraw.history');

            //Survey
            Route::get('/survey', 'UserController@surveyAvailable')->name('survey');
            Route::get('/survey/{id}/questions', 'UserController@surveyQuestions')->name('survey.questions');
            Route::post('/survey/answers', 'UserController@surveyQuestionsAnswers')->name('survey.questions.answers');



        });
    });
});

Route::post('/check/referral', 'SiteController@CheckUsername')->name('check.referral');
Route::post('/check/username', 'SiteController@findUsername')->name('check.username');
Route::post('/get/user/position', 'SiteController@userPosition')->name('get.user.position');

Route::post('subscriber', 'SiteController@subscriberStore')->name('subscriber.store');
// Policy Details
Route::get('policy/{slug}/{id}', 'SiteController@policyDetails')->name('policy.details');

Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit')->name('contact.send');
Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');

Route::get('/legal', 'SiteController@legal')->name('legal');

Route::get('/banker', 'SiteController@banker')->name('banker');

Route::get('/blog', 'SiteController@blog')->name('blog');
Route::get('/blog/details/{slug}/{id}', 'SiteController@singleBlog')->name('singleBlog');

Route::get('/', 'SiteController@index')->name('home');
Route::get('/{slug}', 'SiteController@pages')->name('pages');

Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholderImage');
Route::get('links/{slug}', 'SiteController@links')->name('links');
Route::post('users/bankdetail', 'SiteController@bankdetail')->name('users.bankdetail');
