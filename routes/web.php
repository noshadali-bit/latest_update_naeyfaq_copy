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
Route::get('view-books/{id?}', [IndexController::class, 'view_books'])->name('view_books');
Route::post('search-on-year', [IndexController::class, 'search_on_year'])->name('search_on_year');


Route::get('/manage-category', [ReportController::class, 'manage_category'])->name('manage_category');
Route::get('/manage-product', [ReportController::class, 'manage_product'])->name('manage_product');
Route::get('/manage-book', [ReportController::class, 'manage_book'])->name('manage_book');
Route::get('/add-product', [ReportController::class, 'add_product'])->name('add_product');

Route::get('/edit_products/{id?}', [ReportController::class, 'edit_product'])->name('edit_products');
Route::get('/purchased-product', [ReportController::class, 'purchased_product'])->name('purchased_product');
Route::get('/manage-orders', [ReportController::class, 'manage_orders'])->name('manage_orders');
Route::get('/manage-banner', [ReportController::class, 'manage_banner'])->name('manage_banner');
Route::get('/manage-blog', [ReportController::class, 'manage_blog'])->name('manage_blog');
Route::get('/manage-blog-comment', [ReportController::class, 'manage_blog_comment'])->name('manage_blog_comment');


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

Route::get('/user-dashboard', [IndexController::class, 'user_dashboard'])->name('user_dashboard');

Route::get('/blogs', [IndexController::class, 'blogs'])->name('blogs');
Route::get('/blogs-detail/{id?}', [IndexController::class, 'blogs_detail'])->name('blogs_detail');

Route::post('/add-blog', [HomeController::class, 'add_blog'])->name('add_blog');
Route::get('/email-verify/{id?}', [HomeController::class, 'email_verify'])->name('email_verify');
Route::get('/email-verify-for-comment/{id?}', [HomeController::class, 'email_verify_for_comment'])->name('email_verify_for_comment');

Route::post('/send-comment', [HomeController::class, 'send_comment'])->name('send_comment');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');
Route::get('dropbox', [GoogleController::class, 'dropbox'])->name('dropbox');
Route::get('auth/graph', [GoogleController::class, 'redirectToProvider'])->name('redirectToProvider');
Route::get('uth/graph/callback', [GoogleController::class, 'handleProviderCallback'])->name('handleProviderCallback');
Route::post('search-detail', [IndexController::class, 'search_detail'])->name('search_detail');
Route::get('/about-us', [IndexController::class, 'about_us'])->name('about_us');

Route::get('thankyou', [IndexController::class, 'thank_you_review'])->name('thank_you_review');

Route::get('got-a-job', [IndexController::class, 'got_a_job'])->name('got_a_job');
Route::post('stories-submit', [IndexController::class, 'stories_submit'])->name('stories_submit');

Route::get('my-job', [IndexController::class, 'my_job'])->name('my_job');
Route::post('interview-confirm', [IndexController::class, 'interview_confirm'])->name('interview_confirm');
Route::post('interview-declined', [IndexController::class, 'interview_declined'])->name('interview_declined');

Route::get('help-center', [IndexController::class, 'help_center'])->name('help_center');
Route::get('getting-started', [IndexController::class, 'getting_started'])->name('getting_started');

Route::get('submit-request', [IndexController::class, 'submit_request'])->name('submit_request');
Route::get('not-employer', [IndexController::class, 'not_employer'])->name('not_employer');
Route::get('personal-info', [IndexController::class, 'personal_info'])->name('personal_info');
Route::get('personal-data', [IndexController::class, 'personal_data'])->name('personal_data');
Route::get('help-center-employee', [IndexController::class, 'help_center_employee'])->name('help_center_employee');
Route::get('explore-stories', [IndexController::class, 'explore_stories'])->name('explore_stories');
Route::get('share-your-story', [IndexController::class, 'share_your_story'])->name('share_your_story');
Route::get('stories', [IndexController::class, 'stories'])->name('stories');
Route::get('submit-employer-request', [IndexController::class, 'submit_employer_request'])->name('submit_employer_request');

Route::get('/microsoft_login', [MicrosoftController::class, 'microsoft_login'])->name('microsoft_login');
Route::get('/microsoft_callback', [MicrosoftController::class, 'microsoft_callback'])->name('microsoft_callback');

Route::get('/check_login/{email?}/{name?}', [IndexController::class, 'check_login'])->name('check_login');
// Route::prefix('/facebook')->name('facebook.')->group( function(){
//     Route::get('/auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
//     Route::get('/callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
// });

Route::get('/auth', [FaceBookController::class, 'loginUsingFacebook'])->name('facebook_login');
Route::get('/callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');

Route::get('thank-you', [IndexController::class, 'thank_you_for_upload'])->name('thank_you_for_upload');

Route::get('/popular-companies', [IndexController::class, 'popular_companies'])->name('popular_companies');
Route::get('/view-reviews/{slug?}', [IndexController::class, 'view_reviews'])->name('view_reviews');
Route::get('/terms-and-condition', [IndexController::class, 'terms'])->name('terms');
Route::get('/Privacy-Policy', [IndexController::class, 'policy'])->name('policy');
Route::get('/contact-us', [IndexController::class, 'contact_us'])->name('contact_us');
Route::post('/bulk-open', [IndexController::class, 'bulk_open'])->name('bulk_open');
Route::get('/career', [IndexController::class, 'career'])->name('career');
Route::get('/matches', [IndexController::class, 'matches'])->name('matches');
Route::get('/news-detail/{slug?}', [IndexController::class, 'news_detail'])->name('news_detail');
Route::get('/signin', [IndexController::class, 'signup_login'])->name('signup_login');
Route::post('contact_submit', [IndexController::class, 'contact_submit'])->name('contact_submit');
Route::post('/newsletter-submit', [IndexController::class, 'newsletter_submit'])->name('newsletter_submit');
Route::get('/signup', [IndexController::class, 'signup'])->name('signup');

Route::get('job-details/{id?}', [IndexController::class, 'job_details'])->name('job_details');

Route::post('user-search', [IndexController::class, 'user_search'])->name('user_search');

Route::get('view-applied-jobs/{id}', [IndexController::class, 'view_applied_jobs'])->name('view_applied_jobs');

Route::get('job-close', [IndexController::class, 'job_close'])->name('job_close');

Route::get('send-interview-feedback', [IndexController::class, 'send_interview_feedback'])->name('send_interview_feedback');

Route::get('/feedback-reply/{id?}', [IndexController::class, 'feedback_reply'])->name('feedback_reply');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});


// Reviews
Route::get('/company-reviews/{id?}', [IndexController::class, 'company_reviews'])->name('company_reviews');
Route::get('/company-reviews-step2/{id?}', [IndexController::class, 'company_reviews_step2'])->name('company_reviews_step2');
Route::get('/company-reviews-step3/{id?}', [IndexController::class, 'company_reviews_step3'])->name('company_reviews_step3');
Route::post('/reviews-save', [IndexController::class, 'reviews_save'])->name('reviews_save');
// Review End

//Route::get('/', [IndexController::class, 'home'])->name('welcome');
//Route::get('/employee-registration', [RegistrationController::class, 'index'])->name('employee_registration');

Route::post('/employee-registration-submit', [RegistrationController::class, 'registration_submit'])->name('registration_submit');

Route::get('confirm-email/{id}/{email}', [RegistrationController::class, 'confirm_email'])->name('confirm_email');

Route::get('confirm-review/{id}/{email}', [IndexController::class, 'confirm_review'])->name('confirm_review');

Route::post('validator', [RegistrationController::class, 'validator_check'])->name('validator_check');
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

    Route::get('/add-applicant', [HomeController::class, 'add_applicant'])->name('add_applicant');
    // review
    // Route::get('/review-listing', [ReviewController::class, 'reviews_index'])->name('reviews_index');
    // Route::post('/store-review/{id?}', [ReviewController::class, 'reviews_store'])->name('reviews_store');
    // Route::get('/show-review/{id?}', [ReviewController::class, 'reviews_show'])->name('reviews_show');
    // Route::get('/edit-review/{id?}', [ReviewController::class, 'reviews_edit'])->name('reviews_edit');
    // Route::post('/update_review', [ReviewController::class, 'reviews_update'])->name('reviews_update');
    // Route::any('/destroy_review/{id?}', [ReviewController::class, 'reviews_destroy'])->name('reviews_destroy');
    // Route::get('/status-review', [ReviewController::class, 'reviews_status'])->name('reviews_status');
    // // testimonials
    // Route::get('/testimonials-listing', [TestimonialsController::class, 'testimonials_index'])->name('testimonials_index');
    // Route::post('/store-testimonials/{id?}', [TestimonialsController::class, 'testimonials_store'])->name('testimonials_store');
    // Route::get('/show-testimonials/{id?}', [TestimonialsController::class, 'testimonials_show'])->name('testimonials_show');
    // Route::get('/edit-testimonials/{id?}', [TestimonialsController::class, 'testimonials_edit'])->name('testimonials_edit');
    // Route::post('/update_testimonials', [TestimonialsController::class, 'testimonials_update'])->name('testimonials_update');
    // Route::any('/destroy_testimonials/{id?}', [TestimonialsController::class, 'testimonials_destroy'])->name('testimonials_destroy');
    // Route::get('/status-testimonials', [TestimonialsController::class, 'testimonials_status'])->name('testimonials_status');
    // // faqs
    // Route::get('/faqs-listing', [FaqsController::class, 'faqs_index'])->name('faqs_index');
    // Route::post('/store-faqs/{id?}', [FaqsController::class, 'faqs_store'])->name('faqs_store');
    // Route::get('/show-faqs/{id?}', [FaqsController::class, 'faqs_show'])->name('faqs_show');
    // Route::get('/edit-faqs/{id?}', [FaqsController::class, 'faqs_edit'])->name('faqs_edit');
    // Route::post('/update_faqs', [FaqsController::class, 'faqs_update'])->name('faqs_update');
    // Route::any('/destroy_faqs/{id?}', [FaqsController::class, 'faqs_destroy'])->name('faqs_destroy');
    // Route::get('/status-faqs', [FaqsController::class, 'faqs_status'])->name('faqs_status');


    Route::post('/cms_create', [GenericController::class, 'cms_generator'])->name('cms_generator');
    Route::post('/modalform', [GenericController::class, 'modalform'])->name('modalform');



    Route::get('/registered-user-report', [ReportController::class, 'registered_user_report'])->name('registered_user_report');
    Route::get('/all-user-report/{slug?}', [ReportController::class, 'all_registered_user_report'])->name('all_registered_user_report');
    Route::get('/attendance-sheet-import', [ReportController::class, 'attendance_sheet_import'])->name('attendance_sheet_import');
    Route::post('attendance-import-submit', [ReportController::class, 'attendance_import_submit'])->name('attendance_import_submit');
    Route::get('/all-leave-application-report', [ReportController::class, 'all_leave_application_report'])->name('all_leave_application_report');
    Route::get('/birthday-list', [ReportController::class, 'birthday_list'])->name('birthday_list');
    // Reports Routes End
    Route::get('/attributes', [GenericController::class, 'roles'])->name('roles');
    Route::get('/attribute/{slug}', [GenericController::class, 'listing'])->name('listing');
    Route::get('/report/{slug}', [GenericController::class, 'report_user'])->name('report_user');
    Route::post('/custom-report', [GenericController::class, 'custom_report'])->name('custom_report');
    Route::get('/custom-report/{slug}/{slug2}', [GenericController::class, 'custom_report_user'])->name('custom_report_user');
    Route::post('/generic-submit', [GenericController::class, 'generic_submit'])->name('generic_submit');
    Route::post('/assign-role-submit', [GenericController::class, 'roleassign_submit'])->name('roleassign_submit');
    Route::post('/role-assign-modal', [GenericController::class, 'role_assign_modal'])->name('role_assign_modal');
    // Payroll Routes
    Route::get('/payroller', [PayrollController::class, 'payroller'])->name('payroller');
    Route::post('/payroll-month-report', [PayrollController::class, 'payroll_month_report'])->name('payroll_month_report');
    Route::get('/payslips', [PayrollController::class, 'payslips'])->name('payslips');
    Route::get('/view-payslip/{id}', [PayrollController::class, 'view_payslip'])->name('view_payslip');
    Route::post('/payslip-generate', [PayrollController::class, 'payslip_generate'])->name('payslip_generate');
    // Payroll Routes End
    // Chat Room
    Route::get('chat', [ChatController::class, 'chat'])->name('chat');
    Route::post('save-msg', [ChatController::class, 'save_msg'])->name('save_msg');
    Route::post('fetch-messages', [ChatController::class, 'fetch_msg'])->name('fetch_msg');
    // Leave Application Form
    // Route::get('all-leave-application', [LeaveApplicationController::class, 'all_leave_application'])->name('all_leave_application');
    // Route::get('leave-applicaton/show', [LeaveApplicationController::class, 'leave_show'])->name('leave_show');
    // Route::get('leave-applicaton/team-show', [LeaveApplicationController::class, 'leave_teamshow'])->name('leave_teamshow');
    // Route::post('leave-applicaton-submit', [LeaveApplicationController::class, 'leave_submit'])->name('leave_submit');
    // Route::get('leave-applicaton-delete/{id}', [LeaveApplicationController::class, 'application_delete'])->name('application_delete');
    // Route::post('update-team-leave-applicaton', [LeaveApplicationController::class, 'update_leave_form'])->name('update_leave_form');
    // Route::post('leave-form-validate', [LeaveApplicationController::class, 'leave_form_validate'])->name('leave_form_validate');
    // Candidate Form
    // Step 1
    Route::get('dashboard/job/get-started/{id?}', [CandidateController::class, 'step1_form'])->name('step1_form');
    Route::get('dashboard/job/create/{id?}', [CandidateController::class, 'step2_form'])->name('step2_form');
    Route::get('dashboard/job/include-details/{id?}', [CandidateController::class, 'step3_form'])->name('step3_form');
    Route::get('dashboard/job/compensation-details/{id?}', [CandidateController::class, 'step4_form'])->name('step4_form');
    Route::get('dashboard/job/job-description/{id?}', [CandidateController::class, 'step5_form'])->name('step5_form');
    Route::get('dashboard/job/set-app-preferences/{id?}', [CandidateController::class, 'step6_form'])->name('step6_form');
    Route::get('application', [CandidateController::class, 'candidate_form'])->name('candidate_form');
    Route::get('dashboard/job/company-profile/{id?}', [CandidateController::class, 'company_profile'])->name('company_profile');
    Route::post('dashboard/job/save', [CandidateController::class, 'job_create_save'])->name('job_create_save');
    Route::post('dashboard/company/save', [CandidateController::class, 'company_create_save'])->name('company_create_save');
    Route::post('dashboard/company/logo', [CandidateController::class, 'companylogo_submit'])->name('companylogo_submit');
    Route::get('manage/jobs/{sort_by?}/{order_by?}', [CandidateController::class, 'job_display'])->name('job_display');

    Route::get('all-candidates-display', [CandidateController::class , 'all_candidates_display'])->name('all_candidates_display');
    Route::get('applicant-change-status', [CandidateController::class, 'applicant_change_status'])->name('applicant_change_status');

    Route::get('all-candidate-details', [CandidateController::class, 'all_candidate_details'])->name('all_candidate_details');


    Route::get('sechedule-interview', [CandidateController::class, 'sechedule_interview'])->name('sechedule_interview');

    Route::post('save-notes', [CandidateController::class, 'save_notes'])->name('save_notes');





    Route::get('candidate_delete', [CandidateController::class, 'candidate_delete'])->name('candidate_delete');


    Route::get('candidate-interview-status', [CandidateController::class, 'candidate_interview_status'])->name('candidate_interview_status');


    Route::get('archied-status', [CandidateController::class, 'archied_status'])->name('archied_status');

    Route::get('unarchied-status', [CandidateController::class, 'unarchied_status'])->name('unarchied_status');


    Route::get('withdraw-status', [CandidateController::class, 'withdraw_status'])->name('withdraw_status');

    Route::post('report-job-status', [CandidateController::class, 'report_job_status'])->name('report_job_status');

    Route::get('reviewd-application', [CandidateController::class, 'reviewd_application'])->name('reviewd_application');



    Route::get('candidates/{id?}', [CandidateController::class, 'candidates_display'])->name('candidates_display');
    Route::post('/job-applied-status', [CandidateController::class, 'job_applied_status'])->name('job_applied_status');
    Route::post('/candidate_invite', [CandidateController::class, 'candidate_invite'])->name('candidate_invite');
    Route::post('/job-mark-status', [CandidateController::class, 'job_mark_status'])->name('job_mark_status');
    Route::post('/job-applied-delete', [CandidateController::class, 'job_applied_delete'])->name('job_applied_delete');
    Route::post('/job-applied-interested', [CandidateController::class, 'job_applied_interested'])->name('job_applied_interested');
    Route::post('/change-job-status', [CandidateController::class, 'change_job_status'])->name('change_job_status');

    Route::get('/show_employee/{id?}/{job_id?}', [CandidateController::class, 'show_employee'])->name('show_employee');

    Route::post('/company-data', [CandidateController::class, 'company_data'])->name('company_data');

    Route::post('/candidate-message', [CandidateController::class, 'candidate_message'])->name('candidate_message');
    Route::post('/candidate-message-tab', [CandidateController::class, 'candidate_message_tab'])->name('candidate_message_tab');
    Route::post('/message-tab-close', [CandidateController::class, 'message_tab_close'])->name('message_tab_close');


    Route::get('/employee-seen-message', [CandidateController::class, 'employee_seen_message'])->name('employee_seen_message');


    Route::post('/save-job', [CandidateController::class, 'save_job'])->name('save_job');

    Route::get('/applied-job-thank-you/{id?}', [CandidateController::class, 'applied_job_thank_you'])->name('applied_job_thank_you');




    Route::get('view-all-resume', [CandidateController::class, 'view_all_resume'])->name('view_all_resume');

    Route::post('job-status-change', [CandidateController::class, 'job_status_change'])->name('job_status_change');

    Route::get('manage/job-response/{id?}', [CandidateController::class, 'job_response'])->name('job_response');
    Route::get('marked-interviews/{id?}', [CandidateController::class, 'marked_interviews'])->name('marked_interviews');
    Route::get('show-marked-interviews/{id?}', [CandidateController::class, 'show_marked_interviews'])->name('show_marked_interviews');
    Route::post('update-marked-interviews/{id?}', [CandidateController::class, 'update_marked_interviews'])->name('update_marked_interviews');
    Route::get('/user-profile', [CandidateController::class, 'userprofile'])->name('userprofile');
    Route::post('ajx_candidate', [CandidateController::class, 'ajx_candidate'])->name('ajx_candidate');
    Route::post('/remove-candidate', [CandidateController::class, 'remove_candidate'])->name('remove_candidate');




    Route::get('manage/job-candidate/{id?}', [CandidateController::class, 'job_candidate'])->name('job_candidate');
    Route::post('get-download', [CandidateController::class, 'get_download'])->name('get_download');
    Route::get('applied-job-edit/{id?}', [CandidateController::class, 'applied_job_edit'])->name('applied_job_edit');
    Route::post('applied-job-update', [CandidateController::class, 'applied_job_update'])->name('applied_job_update');


    Route::get('dashboard/job-edit/{id?}', [CandidateController::class, 'job_edit'])->name('job_edit');
    Route::get('/upload-resume', [CandidateController::class, 'upload_resume'])->name('upload_resume');
    Route::post('/upload-resume-submit', [CandidateController::class, 'upload_resume_submit'])->name('upload_resume_submit');
    Route::get('apply-job/{id?}', [CandidateController::class, 'apply_job'])->name('apply_job');
    Route::post('job-applied', [CandidateController::class, 'job_applied'])->name('job_applied');
    Route::post('resume-upload-submit', [CandidateController::class, 'resume_upload_submit'])->name('resume_upload_submit');
    Route::post('resume-privacy-setting', [CandidateController::class, 'resume_privacy_setting'])->name('resume_privacy_setting');


    Route::get('/edit-job_status/{id?}', [CandidateController::class, 'job_status_edit'])->name('job_status_edit');
    Route::post('/job_status_update', [CandidateController::class, 'job_status_update'])->name('job_status_update');
    // Manage resume
    Route::get('/manage-resume', [CandidateController::class, 'manage_resume'])->name('manage_resume');
    Route::get('user-chat-connection', [CandidateController::class, 'user_chat_connection'])->name('user_chat_connection');


    // review last step
    Route::post('/reviews-save2', [CandidateController::class, 'reviews_save2'])->name('reviews_save2');

    // Configuration
    Route::get('configure-settings', [HomeController::class, 'config'])->name('config');
    Route::post('config-update', [HomeController::class, 'config_update'])->name('config_update');

    // Chat

    // Route::get('all-user-chat/{id?}', [UserChatController::class, 'all_user_chat'])->name('all_user_chat');
    // Route::get('user-chat', [UserChatController::class, 'user_chat'])->name('user_chat');
    // Route::get('user-chat-now/{id?}', [UserChatController::class, 'user_chat_now'])->name('user_chat_now');
    // Route::post('user-fetch-msg', [UserChatController::class, 'user_fetch_msg'])->name('user_fetch_msg');
    // Route::post('user-save-msg', [UserChatController::class, 'user_save_msg'])->name('user_save_msg');
    // Route::post('tab-user-save-msg', [UserChatController::class, 'tab_user_save_msg'])->name('tab_user_save_msg');
    // Route::post('user-chat-attached', [UserChatController::class, 'user_chat_attached'])->name('user_chat_attached');
    // Route::post('tab_user_unread_message', [UserChatController::class, 'tab_user_unread_message'])->name('tab_user_unread_message');

    // Route::get('setup-interview', [UserChatController::class, 'setup_interview'])->name('setup_interview');

    // Route::get('set-interview/{id?}', [UserChatController::class, 'set_interview'])->name('set_interview');
    // Route::post('interview-submit', [UserChatController::class, 'interview_submit'])->name('interview_submit');

    // Route::get('all-interviews', [UserChatController::class, 'all_interviews'])->name('all_interviews');

    // Route::get('view_interview_details', [UserChatController::class, 'view_interview_details'])->name('view_interview_details');

});
