<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserChatController;
// use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\MicrosoftController;

use App\Http\Controllers\Auth\GoogleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', [IndexController::class, 'index'])->name('welcome');
Route::get('novel', [IndexController::class, 'novel'])->name('novel');
Route::get('product-detail', [IndexController::class, 'product_detail'])->name('product-detail');
Route::get('about-us', [IndexController::class, 'about_us'])->name('about_us');
Route::get('checkout/{id?}', [IndexController::class, 'checkout'])->name('checkout');
Route::get('categories/{id?}', [IndexController::class, 'categories'])->name('categories');
Route::get('view-books/{id?}/{pro?}', [IndexController::class, 'view_books'])->name('view_books');
Route::post('search-on-year', [IndexController::class, 'search_on_year'])->name('search_on_year');
Route::get('/user-dashboard', [IndexController::class, 'user_dashboard'])->name('user_dashboard');
Route::get('/blogs', [IndexController::class, 'blogs'])->name('blogs');
Route::get('/blogs-detail/{id?}', [IndexController::class, 'blogs_detail'])->name('blogs_detail');
Route::post('search-detail', [IndexController::class, 'search_detail'])->name('search_detail');
Route::get('/about-us', [IndexController::class, 'about_us'])->name('about_us');
// Route::get('thankyou', [IndexController::class, 'thank_you_review'])->name('thank_you_review');
// Route::get('got-a-job', [IndexController::class, 'got_a_job'])->name('got_a_job');
// Route::post('stories-submit', [IndexController::class, 'stories_submit'])->name('stories_submit');
// Route::get('my-job', [IndexController::class, 'my_job'])->name('my_job');
// Route::post('interview-confirm', [IndexController::class, 'interview_confirm'])->name('interview_confirm');
// Route::post('interview-declined', [IndexController::class, 'interview_declined'])->name('interview_declined');
// Route::get('help-center', [IndexController::class, 'help_center'])->name('help_center');
// Route::get('getting-started', [IndexController::class, 'getting_started'])->name('getting_started');
// Route::get('submit-request', [IndexController::class, 'submit_request'])->name('submit_request');
// Route::get('not-employer', [IndexController::class, 'not_employer'])->name('not_employer');
// Route::get('personal-info', [IndexController::class, 'personal_info'])->name('personal_info');
// Route::get('personal-data', [IndexController::class, 'personal_data'])->name('personal_data');
// Route::get('help-center-employee', [IndexController::class, 'help_center_employee'])->name('help_center_employee');
// Route::get('explore-stories', [IndexController::class, 'explore_stories'])->name('explore_stories');
// Route::get('share-your-story', [IndexController::class, 'share_your_story'])->name('share_your_story');
// Route::get('stories', [IndexController::class, 'stories'])->name('stories');
// Route::get('submit-employer-request', [IndexController::class, 'submit_employer_request'])->name('submit_employer_request');
// Route::get('thank-you', [IndexController::class, 'thank_you_for_upload'])->name('thank_you_for_upload');
// Route::get('/popular-companies', [IndexController::class, 'popular_companies'])->name('popular_companies');
// Route::get('/view-reviews/{slug?}', [IndexController::class, 'view_reviews'])->name('view_reviews');
// Route::get('/terms-and-condition', [IndexController::class, 'terms'])->name('terms');
// Route::get('/Privacy-Policy', [IndexController::class, 'policy'])->name('policy');
// Route::post('/bulk-open', [IndexController::class, 'bulk_open'])->name('bulk_open');
// Route::get('/career', [IndexController::class, 'career'])->name('career');
// Route::get('/matches', [IndexController::class, 'matches'])->name('matches');
// Route::get('/news-detail/{slug?}', [IndexController::class, 'news_detail'])->name('news_detail');
// Route::post('contact_submit', [IndexController::class, 'contact_submit'])->name('contact_submit');
// Route::post('/newsletter-submit', [IndexController::class, 'newsletter_submit'])->name('newsletter_submit');
Route::get('/check_login/{email?}/{name?}', [IndexController::class, 'check_login'])->name('check_login');
Route::get('/contact-us', [IndexController::class, 'contact_us'])->name('contact_us');
Route::get('/signin', [IndexController::class, 'signup_login'])->name('signup_login');
Route::get('/signup', [IndexController::class, 'signup'])->name('signup');
Route::post('user-search', [IndexController::class, 'user_search'])->name('user_search');
// Route::get('job-details/{id?}', [IndexController::class, 'job_details'])->name('job_details');
// Route::get('view-applied-jobs/{id}', [IndexController::class, 'view_applied_jobs'])->name('view_applied_jobs');
// Route::get('job-close', [IndexController::class, 'job_close'])->name('job_close');
// Route::get('send-interview-feedback', [IndexController::class, 'send_interview_feedback'])->name('send_interview_feedback');
// Route::get('/feedback-reply/{id?}', [IndexController::class, 'feedback_reply'])->name('feedback_reply');
// Route::get('/company-reviews/{id?}', [IndexController::class, 'company_reviews'])->name('company_reviews');
// Route::get('/company-reviews-step2/{id?}', [IndexController::class, 'company_reviews_step2'])->name('company_reviews_step2');
// Route::get('/company-reviews-step3/{id?}', [IndexController::class, 'company_reviews_step3'])->name('company_reviews_step3');
// Route::post('/reviews-save', [IndexController::class, 'reviews_save'])->name('reviews_save');
// Route::get('confirm-review/{id}/{email}', [IndexController::class, 'confirm_review'])->name('confirm_review');


Route::group(['middleware' => 'admin_role'], function () {

    Route::get('/manage-category', [ReportController::class, 'manage_category'])->name('manage_category');
    Route::get('/manage-product', [ReportController::class, 'manage_product'])->name('manage_product');
    Route::get('/manage-book', [ReportController::class, 'manage_book'])->name('manage_book');
    Route::get('/add-product', [ReportController::class, 'add_product'])->name('add_product');
    Route::get('/edit_products/{id?}', [ReportController::class, 'edit_product'])->name('edit_products');
    Route::get('/manage-orders', [ReportController::class, 'manage_orders'])->name('manage_orders');
    Route::get('/manage-banner', [ReportController::class, 'manage_banner'])->name('manage_banner');
    Route::get('/manage-blog', [ReportController::class, 'manage_blog'])->name('manage_blog');
    Route::get('/manage-blog-comment', [ReportController::class, 'manage_blog_comment'])->name('manage_blog_comment');

});

Route::get('/purchased-product', [ReportController::class, 'purchased_product'])->name('purchased_product');
Route::get('/user-profile', [CandidateController::class, 'userprofile'])->name('userprofile');

Route::post('/select-category', [HomeController::class, 'select_category'])->name('select_category');
Route::post('/select-year', [HomeController::class, 'select_year'])->name('select_year');
Route::post('/select-month', [HomeController::class, 'select_month'])->name('select_month');
Route::post('/active-blog', [HomeController::class, 'active_blog'])->name('active_blog');
Route::post('/active-book', [HomeController::class, 'active_book'])->name('active_book');
Route::post('/active-comment', [HomeController::class, 'active_comment'])->name('active_comment');
Route::get('/select-category1', [HomeController::class, 'select_category1'])->name('select_category1');
Route::get('/select-year1', [HomeController::class, 'select_year1'])->name('select_year1');
Route::post('/add-page-images', [HomeController::class, 'add_page_images'])->name('add_page_images');
Route::post('/add-category', [HomeController::class, 'add_category'])->name('add_category');
Route::post('/add-banner', [HomeController::class, 'add_banner'])->name('add_banner');
Route::post('/add-product', [HomeController::class, 'add_product'])->name('add_product');
Route::post('/add-book', [HomeController::class, 'add_book'])->name('add_book');
Route::post('/update-book', [HomeController::class, 'update_book'])->name('update_book');
Route::post('/check-product', [HomeController::class, 'check_product'])->name('check_product');
Route::post('/readBook', [HomeController::class, 'readBook'])->name('readBook');
Route::post('/order-status-change', [HomeController::class, 'order_status_change'])->name('order_status_change');
Route::get('/add_to_cart/{id?}', [HomeController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/place_order', [HomeController::class, 'place_order'])->name('place_order');
Route::post('/edit-product', [HomeController::class, 'edit_product'])->name('edit_product');
Route::any('/img-destroy/{id?}', [HomeController::class, 'pro_img_destroy'])->name('pro_img_destroy');
Route::post('/add-blog', [HomeController::class, 'add_blog'])->name('add_blog');
Route::get('/email-verify/{id?}', [HomeController::class, 'email_verify'])->name('email_verify');
Route::get('/email-verify-for-comment/{id?}', [HomeController::class, 'email_verify_for_comment'])->name('email_verify_for_comment');
Route::post('/send-comment', [HomeController::class, 'send_comment'])->name('send_comment');


// Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');
// Route::get('dropbox', [GoogleController::class, 'dropbox'])->name('dropbox');
// Route::get('auth/graph', [GoogleController::class, 'redirectToProvider'])->name('redirectToProvider');
// Route::get('uth/graph/callback', [GoogleController::class, 'handleProviderCallback'])->name('handleProviderCallback');


// Route::get('/microsoft_login', [MicrosoftController::class, 'microsoft_login'])->name('microsoft_login');
// Route::get('/microsoft_callback', [MicrosoftController::class, 'microsoft_callback'])->name('microsoft_callback');

// Route::get('/auth', [FaceBookController::class, 'loginUsingFacebook'])->name('facebook_login');
// Route::get('/callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});

// Reviews
// Review End

// Route::post('/employee-registration-submit', [RegistrationController::class, 'registration_submit'])->name('registration_submit');
// Route::get('confirm-email/{id}/{email}', [RegistrationController::class, 'confirm_email'])->name('confirm_email');
// Route::post('validator', [RegistrationController::class, 'validator_check'])->name('validator_check');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/steps', [HomeController::class, 'steps'])->name('steps');
    Route::get('/switch-project/{id}', [HomeController::class, 'switch_project'])->name('switch_project');
    Route::get('/profile', [HomeController::class, 'user_profile'])->name('user_profile');

    Route::post('/user-info-update', [HomeController::class, 'user_infoupdate'])->name('user_infoupdate');
    Route::post('/password-update', [HomeController::class, 'password_update'])->name('password_update');
    Route::get('/user-office-details', [HomeController::class, 'user_office_details'])->name('user_office_details');
    Route::post('/user-office-info-update', [HomeController::class, 'user_office_infoupdate'])->name('user_office_infoupdate');
    Route::post('/user-file-info-update', [HomeController::class, 'user_file_infoupdate'])->name('user_file_infoupdate');
    Route::get('/user-file-details', [HomeController::class, 'user_file_details'])->name('user_file_details');
    Route::post('/user-photo-update', [HomeController::class, 'upload_image'])->name('upload_image');
    Route::post('/profile-submit', [HomeController::class, 'profile_submit'])->name('profile_submit');
    Route::get('/user-rights', [HomeController::class, 'user_rights'])->name('user_rights');
    Route::get('/inquiry-manage', [HomeController::class, 'inquiry_manage'])->name('inquiry_manage');

    // Reports Routes
    Route::post('/user-updates', [HomeController::class, 'user_updates'])->name('user_updates');
    Route::post('/shift-change', [HomeController::class, 'shift_change'])->name('shift_change');
    // blog
    Route::get('/blog-listing', [BlogController::class, 'blogs_index'])->name('blogs_index');
    Route::post('/store-blog/{id?}', [BlogController::class, 'blogs_store'])->name('blogs_store');
    Route::get('/show-blog/{id?}', [BlogController::class, 'blogs_show'])->name('blogs_show');
    Route::get('/edit-blog/{id?}', [BlogController::class, 'blogs_edit'])->name('blogs_edit');
    Route::post('/update_blog', [BlogController::class, 'blogs_update'])->name('blogs_update');
    Route::any('/destroy_blog/{id?}', [BlogController::class, 'blogs_destroy'])->name('blogs_destroy');
    Route::get('/status-blogs', [BlogController::class, 'blogs_status'])->name('blogs_status');

    // Route::get('/add-applicant', [HomeController::class, 'add_applicant'])->name('add_applicant');


    // Route::post('/cms_create', [GenericController::class, 'cms_generator'])->name('cms_generator');
    // Route::post('/modalform', [GenericController::class, 'modalform'])->name('modalform');


    Route::get('/registered-user-report', [ReportController::class, 'registered_user_report'])->name('registered_user_report');
    Route::get('/all-user-report/{slug?}', [ReportController::class, 'all_registered_user_report'])->name('all_registered_user_report');
    // Route::get('/attendance-sheet-import', [ReportController::class, 'attendance_sheet_import'])->name('attendance_sheet_import');
    // Route::post('attendance-import-submit', [ReportController::class, 'attendance_import_submit'])->name('attendance_import_submit');
    // Route::get('/all-leave-application-report', [ReportController::class, 'all_leave_application_report'])->name('all_leave_application_report');
    // Route::get('/birthday-list', [ReportController::class, 'birthday_list'])->name('birthday_list');
    // Reports Routes End
    Route::get('/attributes', [GenericController::class, 'roles'])->name('roles');
    Route::get('/attribute/{slug}', [GenericController::class, 'listing'])->name('listing');
    // Route::get('/report/{slug}', [GenericController::class, 'report_user'])->name('report_user');
    // Route::post('/custom-report', [GenericController::class, 'custom_report'])->name('custom_report');
    // Route::get('/custom-report/{slug}/{slug2}', [GenericController::class, 'custom_report_user'])->name('custom_report_user');
    // Route::post('/generic-submit', [GenericController::class, 'generic_submit'])->name('generic_submit');
    Route::post('/assign-role-submit', [GenericController::class, 'roleassign_submit'])->name('roleassign_submit');
    Route::post('/role-assign-modal', [GenericController::class, 'role_assign_modal'])->name('role_assign_modal');
    // Payroll Routes
    // Route::get('/payroller', [PayrollController::class, 'payroller'])->name('payroller');
    // Route::post('/payroll-month-report', [PayrollController::class, 'payroll_month_report'])->name('payroll_month_report');
    // Route::get('/payslips', [PayrollController::class, 'payslips'])->name('payslips');
    // Route::get('/view-payslip/{id}', [PayrollController::class, 'view_payslip'])->name('view_payslip');
    // Route::post('/payslip-generate', [PayrollController::class, 'payslip_generate'])->name('payslip_generate');
    // Payroll Routes End
    // Chat Room
    // Route::get('chat', [ChatController::class, 'chat'])->name('chat');
    // Route::post('save-msg', [ChatController::class, 'save_msg'])->name('save_msg');
    // Route::post('fetch-messages', [ChatController::class, 'fetch_msg'])->name('fetch_msg');


    // Configuration
    Route::get('configure-settings', [HomeController::class, 'config'])->name('config');
    Route::post('config-update', [HomeController::class, 'config_update'])->name('config_update');

});


