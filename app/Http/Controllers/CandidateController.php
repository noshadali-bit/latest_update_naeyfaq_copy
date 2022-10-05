<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;
use App\Models\User;
use App\Models\role_assign;
use App\Models\attributes;
use App\Models\jobs;
use App\Models\reviews;
use App\Models\states;
use App\Models\company;
use App\Models\config;
use App\Models\save_job;
use App\Models\job_inquiry;
use App\Models\invite_job;
use App\Models\interviews;
use App\Models\thread_messages;
use App\Models\chat_box;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\MailJobApply;
use App\Mail\MailToAdminJobApply;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailReview;
use App\Mail\MailInterstedCandidate;
use App\Mail\MailRejectCandidate;
use App\Mail\MailSuggestNew;
use Auth;
use Response;
use Session;
use \Crypt;

class CandidateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function step1_form($id = '')
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $user = Auth::user();
        $all_job = jobs::where("is_active", 1)->where("is_deleted", 0)->where("user_id", $user->id)->get();
        return view('web.dashboard.step-1')->with('title', "Get Started")->with(compact('job', "all_job"));
    }

    public function candidate_form()
    {
        $departments = attributes::where('attribute', 'departments')->where('is_active', 1)->get();
        $designations = attributes::where('attribute', 'designations')->where('is_active', 1)->get();
        $projects = attributes::where('attribute', 'project')->where('is_active', 1)->get();
        // $departments = DB::table('departments')->select('name')->get();
        // $designations = DB::table('designations')->select('name')->get();
        return view('candidate.candidate_form')->with('title', "Candidate Registration")->with(compact('departments', 'designations', 'projects'));
    }

    public function user_chat_connection()
    {

        return view('web.chat');
    }

    public function manage_resume()
    {
        $user = Auth::user();

        return view('web.dashboard.manage-resume')->with('title', "Manage Resume")->with(compact('user'));
    }

    public function step2_form($id = "")
    {


        $job = null;
        if ($id != "") {
            try {
                if (strlen($id) > 188) {
                    $id = Crypt::decrypt($id);
                    $id = Crypt::decrypt($id);
                } else {
                    $id = Crypt::decrypt($id);
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $data = array(
            "hiring_process_role" => array("Human Resources Generalist", "Owner / CEO", "Assistant or Office Manager", "Recruiter or Talent Acquisition", "Hiring Manager", "Other"),
            "hiring_budget" => array("Not Provided", "I have a budget for my role(s)", "No planned budget but I can spend if needed", "I'm not able to spend on hiring"),
            "period" => array("hour", "day", "week", "month", "year"),
            "role_location" => array("One location" => "Job is performed at a specific address", "Multiple Locations" => "Job may be performed at multiple sites", "Remote" => "Job is performed remotely No one site work is required", "On the Road" => "Job require regular travels"),
            "employment_type" => array("Full Time", "Part time", "Contractor", "Temporary", "Intern", "Volunteer", "Per diem"),
            "compensation" => array("Bonus", "Commission", "Tip"),
        );
        $data2 = array("Academic Adviser", "Academic Support Coordinator", "Administrator", "Admissions Assistant", "Admissions Representative", "Adjunct Professor", "Adviser", "After-School Program Aide", "After-School Program Coordinator", "Assistant Coach", "Assistant Dean", "Assistant Instructor", "Assistant Principal", "Assistant Preschool Teacher", "Assistant Professor", "Assistant Registrar", "Assistant Teacher", "Associate Dean", "Associate Professor", "Career Counselor", "Child Care Assistant", "Child Care Center Teacher", "Coach", "Crossing Guard", "Day Care Assistant", "Day Care Center Teacher", "Dean", "Driver Education Teacher", "Education Coordinator", "Education Specialist", "Education Technician", "Educator", "Financial Aid Administrator", "Food Service Aide", "Food Service Coordinator", "Food Service Manager", "Guidance Counselor", "Instructor", "Instructional Assistant", "Lead Teacher", "Lunch Monitor", "Preschool Assistant Teacher", "Preschool Director", "Preschool Group Leader", "Preschool Lead Teacher", "Preschool Specialist", "Preschool Teacher", "Principal", "Program Assistant", "Program Coordinator", "Registrar", "Residence Hall Manager", "Resource Development Coordinator", "School Administrator", "School Bus Driver", "School Counselor", "School Librarian", "School Nurse", "School Psychologist", "School Secretary", "School Social Worker", "Special Education Assistant", "Special Education Coordinator", "Substitute Teacher", "Superintendent", "Superintendent of Schools", "Teacher", "Teacher Aide", "Teacher Assistant", "Teaching Assistant", "Tutor", "Youth Care Worker",);
        return view('web.dashboard.create-job')->with('title', "Create Job")->with(compact('job', 'data', 'data2'));
        //return view('web.createjob')->with('title',"Create Job")->with(compact('job','data'));
    }

    public function view_all_resume()
    {

        $job_inquiry = User::where('role_type', 'Employee')->where('is_active', 1)->where('resume_privacy_setting', 1)->orderby("id", 'desc')->get();
        $states = states::where("is_active", 1)->where('is_deleted', 0)->get();
        return view('web.all-resume')->with(compact('job_inquiry', 'states'));
    }

    public function marked_interviews($id = "")
    {
        $user = Auth::user();
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
                dd($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
        } else {
            return redirect()->back()->with('message', 'No Job ID Found');
        }
        if ($user->role_type != "Employer") {
            return redirect()->back()->with('message', 'No Page Found');
        }
        if ($user) {
            $job = jobs::where("id", $id)->where("is_active", 1)->where("is_deleted", 0)->first();
            if (!$job || is_null($job)) {
                return redirect()->back()->with('message', 'No active job found');
            }
            $interviews = interviews::where("job_id", $id)->where("is_active", 1)->orderby("id", 'desc')->paginate(10);
            $open_paused_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "Open")->orWhere("status", "Paused")->where("user_id", $user->id)->count();
            $closed_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("status", "Closed")->where("user_id", $user->id)->count();
            $applied_jobs = interviews::where("is_active", 1)->where("job_id", '=', $id)->get();
            $resume = array();
            foreach ($applied_jobs as $value) {
                $result = array_push($resume, $value->resume_upload);
            }

            $final_resume = implode(',', $resume);
        } else {
            return redirect()->back()->with('message', 'Kindly Login First');
        }
        return view('web.marked-interviews')->with(compact('job', 'interviews', 'open_paused_jobs', 'closed_jobs', 'final_resume'));
    }

    public function show_marked_interviews($id, Request $request)
    {
        $data = interviews::where('id', $id)->first();
        // dd($data);
        return response()->json([
            "interviews" => $data,
        ]);
    }

    public function update_marked_interviews(Request $request)
    {
        $this->validate($request, [
            'remarks' => 'required',
        ]);

        $data = array();
        $id = $request->input('id');
        $jobid = $request->input('job_id');
        $job_id = Crypt::encrypt($jobid);
        $data['remarks'] = $request->input('remarks');
        $audio = interviews::where('id', $id)->update($data);
        return redirect()->route('marked_interviews', $job_id . '?action=review')->with('message', 'Success : Remarks Update Successfully');
    }

    public function company_profile($id = "")
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        return view('web.dashboard.company-profile')->with('title', "Company Profile")->with(compact('job'));
    }

    public function job_create_save(Request $request)
    {
        // dd($_POST);

        if (isset($_POST['job_id']) && $_POST['job_id'] != "") {
            if (strlen($_POST['job_id']) > 188) {
                $id = Crypt::decrypt($_POST['job_id']);
                $id = Crypt::decrypt($id);
            } else {
                $id = Crypt::decrypt($_POST['job_id']);
            }
            // dd($id);
            if (isset($_POST['job_schedule'])) {
                $_POST['job_schedule'] = implode(", ", $_POST['job_schedule']);
            }
            if (isset($_POST['compensation'])) {
                $_POST['compensation'] = implode(", ", $_POST['compensation']);
            }
            if (isset($_POST['benefits'])) {
                $_POST['benefits'] = implode(", ", $_POST['benefits']);
            }
            $token_ignore = ['_token' => '', 'job_id' => ''];
            $post_feilds = array_diff_key($_POST, $token_ignore);

            $jobs = jobs::where('id', $id)->update($post_feilds);
            $job_id = $_POST['job_id'];
            $job_id = $job_id;
            $resp['job_id'] = $job_id;
            $resp['status'] = 1;
            $resp['message'] = "Job details has been updated";
            if ($_POST['step_filled'] == 0) {
                $resp['location'] = route('step2_form', $job_id);
            }
            if ($_POST['step_filled'] == 1) {
                $resp['location'] = route('step3_form', $job_id);
            }
            if ($_POST['step_filled'] == 2) {
                $resp['location'] = route('step4_form', $job_id);
            }
            // if ($_POST['step_filled'] == 2) {
            //     $resp['location'] = route('step2_form',$job_id);
            // }
            if ($_POST['step_filled'] == 3) {
                // $jobs = jobs::find($id);
                // $resp['checker'] = 3;
                // $resp['title'] = $jobs->job_title;
                // $resp['email'] = Auth::user()->email;
                // $resp['company_name'] = $jobs->company_name;
                // $resp['salary'] = "Starting from (".$jobs->currency.")".$jobs->starting_salary." to ".$jobs->currency."(".$jobs->ending_salary.")";
                // $resp['summary'] = $jobs->summary;
                // $resp['skills'] = $jobs->skills;
                // $resp['company_description'] = $jobs->company_description;
                // $resp['employment_type'] = $jobs->employment_type;
                // $resp['compensation'] = $jobs->compensation;
                $resp['location'] = route('step5_form', $job_id);
            }
            if ($_POST['step_filled'] == 4) {
                $resp['location'] = route('step6_form', $job_id);
            }
            if ($_POST['step_filled'] == 5) {
                $resp['location'] = route('job_edit', $job_id . '?action=review');
            }
            if ($_POST['step_filled'] == 6 && $_POST['action'] = 'view' && isset($_POST['is_confirm']) && $_POST['is_confirm'] == 1) {
                return redirect()->route('job_display')->with('message', 'Success : Update Successfully');
            }
            if ($_POST['step_filled'] == 6 && $_POST['action'] = 'review') {
                // dd(1);
                return redirect()->route('job_edit', $job_id . '?action=review')->with('message', 'Success : Update Successfully');
            }
            if ($_POST['step_filled'] == 6 && $_POST['action'] = 'view') {
                return redirect()->route('job_display')->with('message', 'Success : Update Successfully');
            }
            if ($_POST['step_filled'] == 7) {
                $resp['message'] = "Job status has been updated";
                $resp['location'] = route('job_display');
            }
            return json_encode($resp);
        } else {
            $token_ignore = ['_token' => '', 'job_id' => ''];
            $post_feilds = array_diff_key($_POST, $token_ignore);
            $jobs = jobs::create($post_feilds);
            $job_id = Crypt::encrypt($jobs->id);
            $resp['job_id'] = $job_id;
            $resp['status'] = 1;
            $resp['message'] = "Job details has been saved";
            $resp['location'] = route('step2_form', $job_id);
            return json_encode($resp);
        }
    }

    public function step3_form($id = '')
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $data = array(
            "part_time" => array("Full-time", "Part-time", "Either full-time or part-time"),
            "employment_type" => array("Full Time", "Part time", "Contractor", "Temporary", "Internship", "Volunteer", "Per diem"),
            "job_schedule" => array("8 hour shift", "10 hour shift", "12 hour shift", "Weekend availability", "Monday to Friday", "On call", "Holidays", "Day shift", "Night shift", "Overtime", "Other"),
            "need_to_hire" => array("1 to 3 days", "3 to 7 days", "1 to 2 weeks", "2 to 4 weeks", "More than 4 weeks"),
        );
        return view('web.dashboard.step-3')->with('title', "Include Details")->with(compact('job', 'data'));
    }

    public function step4_form($id = '')
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $data = array(
            "compensation" => array("Bonus", "Commission", "Signing bonus", "Tip", "Other"),
            "benefits" => array("Health insurance", "Paid time off", "Dental insurance", "401(k)", "Vision insurance", "Flexible schedule", "Tuition reimbursement", "Life insurance", "401(k) matching", "Retirement plan", "Referral program", "Employee discount", "Flexible spending account", "Health savings account", "Relocation assistance", "Parental leave", "Professional development assistance", "Employee assistance program", "Other"),
            "period" => array("hour", "day", "week", "month", "year"),
        );
        return view('web.dashboard.step-4')->with('title', "Compensation Details")->with(compact('job', 'data'));
    }

    public function step5_form($id = '')
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $data = array(
            "compensation" => array("Bonus", "Commission", "Signing bonus", "Tip", "Other"),
            "benefits" => array("Health insurance", "Paid time off", "Dental insurance", "401(k)", "Vision insurance", "Flexible schedule", "Tuition reimbursement", "Life insurance", "401(k) matching", "Retirement plan", "Referral program", "Employee discount", "Flexible spending account", "Health savings account", "Relocation assistance", "Parental leave", "Professional development assistance", "Employee assistance program", "Other"),
            "period" => array("hour", "day", "week", "month", "year"),
        );
        // dd(1);
        return view('web.dashboard.step-5')->with('title', "Describe The Job")->with(compact('job', 'data'));
    }

    public function step6_form($id = '')
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $data = array(
            "receive_applications" => array("Email" => "Screen applications individually, received by email.", "Walk In" => "Add a street address where people can drop off applications.")
        );
        $data2 = array("submit_resume" => array("Yes" => "People will be required to include a resume.", "No" => "People will not be required to include a resume.", "Optional" => "People can choose whether to include a resume."));
        return view('web.dashboard.step-6')->with('title', "Set Application Preferences")->with(compact('job', 'data', 'data2'));
    }

    public function all_candidates_display(Request $request)
    {

        $job_inquiry = job_inquiry::where('id', $request->id)->get();
        $user = Auth::User();

        if ($job_inquiry) {
            $body = " ";
            $mystatus = "";
            $userresponse = "";
            $myinfo = "";
            $resume_download = "";
            $hidden_input = "";
            $application_detail = "";
            $notes = "";

            foreach ($job_inquiry as $key => $value) {

                if ($value->is_interested == 1) {
                    $myclass = "<li><a href='#' class='first-element green'><i class='fa fa-check' aria-hidden='true'></i></a></li>
                    <li><a href='#' class='last-element'><i class='fa fa-times' aria-hidden='true'></i></a></li>
                    <li><a href='#' class='last-element'><i class='fa fa-times' aria-hidden='true'></i></a></li>";
                } elseif ($value->is_interested == 2) {

                    $myclass = "<li><a href='#' class='first-element'><i class='fa fa-check' aria-hidden='true'></i></a></li>
                  <li><a href='#' class='first-element '><i class='fa fa-check' aria-hidden='true'></i></a></li>

                   <li><a href='#' class='last-element red'><i class='fa fa-times' aria-hidden='true'></i></a></li>";
                } else {

                    $myclass = "
                  <li><a href='#' class='first-element'><i class='fa fa-check' aria-hidden='true'></i></a></li>
                  <li><a href='#' class='first-element red'><i class='fa fa-check' aria-hidden='true'></i></a></li>

                   <li><a href='#' class='last-element'><i class='fa fa-times' aria-hidden='true'></i></a></li>
                  ";
                }
                $mystatus .= " " . $myclass . "
                                   
                                 ";
                $userresponse .= " " . $value->status . "
               <input type='hidden' name='emp_id' id='emp_id' value='" . $value->id . "'>
                                   
                                 ";
                $resume_download .= "public/uploads/resume/" . $value->resume_upload . "
                                   
                                 ";


                $myinfo .= "<h6>" . date('d M Y', strtotime($value->created_at)) . "</h6>
                <p>" . $value->first_name . " " . $value->last_name . " applied to " . $value->jobs->job_title . ".</p> ";



                $hidden_input .= " <input type='hidden' id='job_id' name='job_id'
                                                        value='" . $value->job_id . "'>
                                                    <input type='hidden' name='user_id'
                                                       value='" . $value->user_id . "'  id='user_id'>
                                                    <input type='hidden' name='user_post_id'
                                                        value='" . $value->user_post_id . "' id='user_post_id'>
                                                    <input type='hidden' name='email_address'
                                                        value='" . $value->email . "' id='email_address'>
                                                    <input type='hidden' name='first_name'
                                                        value='" . $value->first_name . "' id='first_name'>
                                                    <input type='hidden' name='last_name'
                                                        value='" . $value->last_name . "' id='last_name'>";

                $application_detail .= "<h3>Applicant qualifications</h3>
                    <p>What is the highest level of education you have completed?</p>
                    <button><span><i class='fa fa-check' aria-hidden='true'></i></span>" . $user->eduaction . "</button><span>Your requirement: High school or equivalent</span>

                    <div class='teaching'>
                        
                        <h3>How many years of Teaching experience do you have?</h3>
                        <div class='tag'>
                        <span><i class='fa fa-times' aria-hidden='true'></i>" . $user->experience . "</span><small>Your requirement: 1 year</small>
                    </div>
                    </div>

                    <div class='teaching'>
                        <h3>How many years of Childcare experience do you have?</h3>
                        <div class='tag1'>
                        <span><i class='fa fa-check' aria-hidden='true'></i>No</span><small>Your requirement: 1 year</small>
                    </div>
                    </div>
                    

                    <div class='teaching'>
                        <h3>Do you have a valid CPR Certification?</h3>
                        <div class='tag2'>
                        <span><i class='fa fa-times' aria-hidden='true'></i>" . $user->certifications . "</span><small>Your requirement: 1 year</small>
                    </div>
                    </div>

                    <div class='teaching'>
                        <h3>Do you have a valid 40 DCF clock hours?</h3>
                        <div class='tag3'>
                    <span><i class='fa fa-times' aria-hidden='true'></i>No</span><small>Your requirement: 1 year</small>
                    </div>
                    </div>
                    <div class='teaching last'>
                        <h3>Please list2-3 dates and time ranges that you could do an interview.</h3>
                        <p>Monday 3/14 11-9pm Tuesday 3/15 11-9pm Wednesday 3/16 11-9pm</p>
                    </div>

                    <div class='skill'>
                        <h3>Skills test</h3>
                        <a href='#'>Send assessment</a>
                    </div>

                    <div class='resume'>
                        <h3>Skills test</h3>
                        <a href='public/uploads/resume/" . $value->resume_upload . "' download>Download resume</a>
                    </div>";
                $notes .= "" . $value->notes . "";



                $body .= "
                <h2>" . $value->first_name . " " . $value->last_name . "</h2>
            <p>" . $value->jobs->job_title . "</p>
            <a href='#'>" . $value->email . "</a> <span>" . $value->city . "</span>
            <p>Applied to " . $value->jobs->job_title . " - " . $value->city . "</p>
           ";
            }
            $status = 1;
        } else {
            $status = 0;
        }
        return response()->json(['body' => $body, 'status' => $status, 'mystatus' => $mystatus, 'userresponse' => $userresponse, 'myinfo' => $myinfo, 'resume_download' => $resume_download, 'hidden_input' => $hidden_input, 'application_detail' => $application_detail, 'notes' => $notes]);
    }

    public function remove_candidate()
    {

        $id = isset($_POST['id']) ? $_POST['id'] : '';

        $affected = DB::table('job_inquiry')
            ->where('id', $id)
            ->update(['is_active' => 0, 'is_deleted' => 1]);
        if ($affected) {
            return redirect()->back()->with('message', 'Successfully candidate removed ');
        } else {
            return redirect()->back()->with('message', 'Error : Candidate not removed');
        }
    }

    public function job_display($sort_by = null, $order_by = null)
    {
        // dd(1);

        $user = Auth::user();

        $sort_by_ = (string)(isset($sort_by) ? $sort_by : 'id');

        $order_by_ =  (string)(isset($order_by) ? $order_by : 'desc');

        //dd($sort_by_);

        $getUserForJob = [];

        $data = [];

        if ($user) {

            $jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->orderBy($sort_by_, $order_by_)->paginate(200);
            $date = date('Y-m-d', strtotime(' +1 day'));
            $interviews_count = interviews::where("date", '>=', $date)->count();

            $interviews = interviews::with('job')->where("date", '>=', $date)->where('user_post_id', $user->id)->get();



            $open_paused_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "!=", "Closed")->where("user_id", $user->id)->count();

            $closed_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("status", "Closed")->where("user_id", $user->id)->count();


            // Resumes
            $job_inquiry = User::where('role_type', 'Employee')->where('is_active', 1)->where('resume_privacy_setting', 1)->orderby("id", 'desc')->get();

            $states = states::where("is_active", 1)->where('is_deleted', 0)->get();

            // Messages
            $job_messages =  job_inquiry::where("user_post_id", $user->id)->where("is_active", 1)->get();

            $open_jobs    = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "Open")->count();
            $pending_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "Pending")->count();
            $paused_jobs  = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "Paused")->count();
            //$closed_jobs_  = jobs::where("is_confirm", 1)->where("is_active", 1)->where("status", "Closed")->count();

            $get_job_title = jobs::where("is_active", 1)->where("user_id", $user->id)->orderby("id", 'desc')->first();

            if ($get_job_title) {
                $getUserForJob = DB::table('users')->Where('skill', 'LIKE', '%' . $get_job_title->job_title . '%')->where('role_type', 'Employee')->limit(6)->get();
            }

            // echo "<pre>";
            // print_r($getUserForJob);
            // echo "</pre>";

        } else {

            return redirect()->back()->with('notify_error', 'Kindly Login First');
        }

        return view('web.jobs')->with(compact('user', 'jobs', 'open_paused_jobs', 'closed_jobs', 'job_inquiry', 'states', 'job_messages', 'open_jobs', 'pending_jobs', 'paused_jobs', 'closed_jobs', 'getUserForJob', 'interviews_count', 'interviews'));
    }

    public function company_data(Request $request)
    {

        $data = array();
        $data2 = array();

        //dd($request->id);
        $job_inquiry = job_inquiry::where("job_id", $request->id)->where("is_active", 1)->orderby("id", 'desc')->get();

        $Contacting = job_inquiry::where("job_id", $request->id)->where("status", "Contacting")->where("is_active", 1)->count();
        $Awaiting_review = job_inquiry::where("job_id", $request->id)->where("status", "Awaiting Review")->where("is_active", 1)->count();
        $Reviewed = job_inquiry::where("job_id", $request->id)->where("status", "Reviewed")->where("is_active", 1)->count();
        $Hired = job_inquiry::where("job_id", $request->id)->where("status", "Hired")->where("is_active", 1)->count();
        $Pending = job_inquiry::where("job_id", $request->id)->where("status", "Pending")->where("is_active", 1)->count();
        $Rejected = job_inquiry::where("job_id", $request->id)->where("status", "Rejected")->where("is_active", 1)->count();

        $user = Auth::User();
        $apply_job_active_candidate = job_inquiry::where('job_id', $_POST['id'])->count();
        foreach ($job_inquiry as $key => $val) {

            $job_post = $val->job_post($val->job_id);

            $messages_count = $job_post->messages_count($job_post->id, Auth::user()->id, $val->user_id);

            $parameter = Crypt::encrypt($val->id);

            //$hiring = $val->job_post($val->id);

            $data[$key]['messages_count'] = $messages_count;
            $data[$key]['apply_job_active_candidate'] = $apply_job_active_candidate;
            $data[$key]['city'] = $val->city;
            $data[$key]['created_at'] = date('d M y', strtotime($val->created_at));
            $data[$key]['email'] = $val->email;
            $data[$key]['first_name'] = $val->first_name;
            $data[$key]['id'] = $val->id;
            $data[$key]['is_active'] = $val->is_active;
            $data[$key]['is_deleted'] = $val->is_deleted;
            $data[$key]['is_interested'] = $val->is_interested;
            $data[$key]['job_id'] = $val->job_id;
            $data[$key]['last_name'] = $val->last_name;
            $data[$key]['phonenumber'] = $val->phonenumber;
            $data[$key]['resume_upload'] = $val->resume_upload;
            $data[$key]['status'] = $val->status;
            $data[$key]['user_id'] = $val->user_id;
            $data[$key]['user_post_id'] = $val->user_post_id;
            $data[$key]['hiring_process_role'] = $job_post->hiring_process_role;

            $data[$key]['job_post_id'] = Crypt::encrypt($val->job_id);
            $data[$key]['href_resume_upload'] = asset('/uploads/resume/' . $val->resume_upload);
            $data[$key]['set_up_interview'] = route('set_interview', Crypt::encrypt($val->id));
            $data[$key]['job_candidate'] = route('job_candidate', Crypt::encrypt($val->id));
            $data[$key]['auth_user_id'] = Auth::user()->id;

            $data[$key]['user_id_encrypt'] =  Crypt::encrypt($val->user_id);

            $data[$key]['parameter'] = $parameter;
            $data[$key]['contact_this_person'] = route('user_chat_now', $parameter);
        }

        $data2['candidates'] =  $data;
        $job = jobs::where("id", $request->id)->where("is_active", 1)->orderby("id", 'desc')->first();
        $job_title = $job->job_title;
        $baseQuery = DB::table('users');
        if (!empty($job_title))

            $baseQuery =  $baseQuery->Where('skill', 'LIKE', '%' . $job_title . '%')->where('role_type', 'Employee');

        $data2['getUser'] = $baseQuery->get();

        //$data2['getlimitUser'] = $baseQuery->limit(6)->get();

        $data2['getlimitUser'] = $baseQuery->offset(0)->limit(6)->get();

        $data2['Contacting'] = $Contacting;
        $data2['Awaiting_review'] = $Awaiting_review;
        $data2['Reviewed'] = $Reviewed;
        $data2['Hired'] = $Hired;
        $data2['Pending'] = $Pending;
        $data2['Rejected'] = $Rejected;
        $data2['Active'] = ($Contacting + $Awaiting_review + $Reviewed + $Hired + $Pending + $Rejected);
        $data2['link_active_candidate'] = route('candidates_display', Crypt::encrypt($request->id) . '?action=active');


        $data2['totalCandidate'] = $Contacting + $Awaiting_review + $Reviewed + $Hired + $Pending + $Rejected;
        $data2['totalInvite'] = $baseQuery->count();

        return json_encode($data2);
    }

    public function show_employee($id = '', $job_id = '')
    {

        if ($id != "") {
            try {

                $id = Crypt::decrypt($id);

                $job_id = Crypt::decrypt($job_id);
            } catch (\Throwable $th) {

                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
        }

        $user = User::where('id', $id)->first();
        $job_inquiry = job_inquiry::where('user_id', $id)->where("job_id", $job_id)->first();

        $jobs =  jobs::where('id', $job_inquiry->job_id)->first();

        //dd($job_inquiry);

        return view('web.candidateDetail')->with(compact('user', 'job_inquiry', 'jobs'));
    }

    public function candidates_display($id = '')
    {

        // dd(1);
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $job = jobs::findOrFail($id);
        }
        $user = Auth::user();
        if ($user) {
            if (isset($_GET['action']) && ($_GET['action'] == "active")) {
                $job_inquiry = job_inquiry::where('is_active', 1)->where('job_id', $id)->orderby("id", 'desc')->get();
            } else if (isset($_GET['action']) && ($_GET['action'] == "new")) {
                $job_inquiry = job_inquiry::where('is_active', 1)->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->where('job_id', $id)->orderby("id", 'desc')->get();
            } else if (isset($_GET['action']) && ($_GET['action'] == "contacting")) {
                $job_inquiry = job_inquiry::where('is_active', 1)->where('status', 'Contacting')->where('job_id', $id)->orderby("id", 'desc')->get();
            } else if (isset($_GET['action']) && ($_GET['action'] == "hired")) {
                $job_inquiry = job_inquiry::where('is_active', 1)->where('status', 'Hired')->where('job_id', $id)->orderby("id", 'desc')->get();
            } else {
                $job_inquiry = job_inquiry::where('is_active', 1)->where('job_id', $id)->orderby("id", 'desc')->get();
            }
            return view('web.candidates')->with(compact('job_inquiry'));
        } else {
            return redirect()->back()->with('notify_error', 'Kindly Login First');
        }
    }

    public function job_response($id = 0)
    {
        $user = Auth::user();
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
        } else {
            return redirect()->back()->with('message', 'No Job ID Found');
        }
        if ($user->role_type != "Employer") {
            return redirect()->back()->with('message', 'No Page Found');
        }
        if ($user) {
            $job = jobs::where("id", $id)->where("is_active", 1)->where("is_deleted", 0)->first();
            if (!$job || is_null($job)) {
                return redirect()->back()->with('message', 'No active job found');
            }
            $job_inquiry = job_inquiry::where("job_id", $id)->where("is_active", 1)->orderby("id", 'desc')->paginate(10);
            $open_paused_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "Open")->orWhere("status", "Paused")->where("user_id", $user->id)->count();
            $closed_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("status", "Closed")->where("user_id", $user->id)->count();
            $applied_jobs = job_inquiry::where("is_active", 1)->where("job_id", '=', $id)->get();

            $resume = array();
            foreach ($applied_jobs as $value) {
                $result = array_push($resume, $value->resume_upload);
            }

            $final_resume = implode(',', $resume);
        } else {
            return redirect()->back()->with('message', 'Kindly Login First');
        }
        return view('web.dashboard.job-response')->with(compact('job', 'job_inquiry', 'open_paused_jobs', 'closed_jobs', 'final_resume'));
    }

    public function job_candidate($id = 0)
    {
        $user = Auth::user();
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
        } else {
            return redirect()->back()->with('message', 'No Job ID Found');
        }
        if ($user->role_type != "Employer") {
            return redirect()->back()->with('message', 'No Page Found');
        }
        if ($user) {
            $job = jobs::where("id", $id)->where("is_active", 1)->where("is_deleted", 0)->first();
            if (!$job || is_null($job)) {
                return redirect()->back()->with('message', 'No active job found');
            }
            $job_inquiry = job_inquiry::where("id", $id)->where("is_active", 1)->get();
        } else {
            return redirect()->back()->with('message', 'Kindly Login First');
        }
        return view('web.dashboard.job_candidate')->with(compact('job', 'job_inquiry'));
    }

    public function get_download(Request $request)
    {

        $file = public_path() . "/uploads/resume/" . $_POST['files'] . "";
        $headers = array('Content-Type: application/pdf',);
        return Response::download($file, "" . $_POST['files'] . "", $headers);
    }

    public function save_job(Request $request)
    {

        if (!Auth::User()) {
            return response()->json(['error' => true, 'message' => 'Kindly Login First']);
        } else {
            $user = Auth::User();
            $jobs = jobs::where('id', $request->job_id)->first();

            $save_job = save_job::where('user_id', $user->id)->where('job_id', $jobs->id)->first();
            if ($save_job == "") {
                $saved_job = new save_job;
                $saved_job->user_id = $user->id;
                $saved_job->job_id = $request->job_id;
                $saved_job->save();
                return response()->json(['success' => true, 'message' => 'Job Saved Successfully']);
            } else {
                return response()->json(['error' => false, 'message' => 'Job Already Exists In Saved Jobs']);
            }
        }
    }

    public function job_Edit($id = '')
    {
        $user = Auth::user();
        if ($user) {
            $job = null;
            if ($id != "") {
                try {
                    $id = Crypt::decrypt($id);
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
                }
                $job = jobs::where("is_active", 1)->where("id", $id)->where("user_id", $user->id)->where("is_deleted", 0)->first();
            }
        } else {
            return redirect()->back()->with('notify_error', 'Kindly Login First');
        }
        $data = array(
            "hiring_process_role" => array("Human Resources Generalist", "Owner / CEO", "Assistant or Office Manager", "Recruiter or Talent Acquisition", "Hiring Manager", "Other"),
            "hiring_budget" => array("Not Provided", "I have a budget for my role(s)", "No planned budget but I can spend if needed", "I'm not able to spend on hiring"),
            "period" => array("hour", "day", "week", "month", "year"),
            "role_location" => array("One location" => "Job is performed at a specific address", "Multiple Locations" => "Job may be performed at multiple sites", "Remote" => "Job is performed remotely No one site work is required", "On the Road" => "Job require regular travels"),
            "employment_type" => array("Full Time", "Part time", "Contractor", "Temporary", "Intern", "Volunteer", "Per diem"),
            "compensation" => array("Bonus", "Commission", "Tip"),
        );
        $data2 = array(
            "part_time" => array("Full-time", "Part-time", "Either full-time or part-time"),
            "employment_type" => array("Full Time", "Part time", "Contractor", "Temporary", "Internship", "Volunteer", "Per diem"),
            "job_schedule" => array("8 hour shift", "10 hour shift", "12 hour shift", "Weekend availability", "Monday to Friday", "On call", "Holidays", "Day shift", "Night shift", "Overtime", "Other"),
            "need_to_hire" => array("1 to 3 days", "3 to 7 days", "1 to 2 weeks", "2 to 4 weeks", "More than 4 weeks"),
        );
        $data3 = array(
            "compensation" => array("Bonus", "Commission", "Signing bonus", "Tip", "Other"),
            "benefits" => array("Health insurance", "Paid time off", "Dental insurance", "401(k)", "Vision insurance", "Flexible schedule", "Tuition reimbursement", "Life insurance", "401(k) matching", "Retirement plan", "Referral program", "Employee discount", "Flexible spending account", "Health savings account", "Relocation assistance", "Parental leave", "Professional development assistance", "Employee assistance program", "Other"),
            "period" => array("hour", "day", "week", "month", "year"),
        );

        $data4 = array(
            "receive_applications" => array("Email" => "Screen applications individually, received by email.", "Walk In" => "Add a street address where people can drop off applications.")
        );

        $data5 = array("submit_resume" => array("Yes" => "People will be required to include a resume.", "No" => "People will not be required to include a resume.", "Optional" => "People can choose whether to include a resume."));
        $data6 = array("message_setting" => array("Yes" => "yes", "No" => "no"));
        return view('web.job-edit')->with('title', "Review The Job Post")->with(compact('job', 'data', 'data2', 'data3', 'data4', 'data5', 'data6'));
    }

    public function company_create_save(Request $request)
    {
        $token_ignore = ['_token' => '', 'job_id' => '', 'full_name' => '', 'hear_about' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $company = company::create($post_feilds);
        $job = jobs::where('id', $_POST['job_id'])->update(['hear_about' => $_POST['hear_about'], 'company_name' => $company->id]);
        return redirect()->route('welcome')->with('message', 'Post submitted');
    }

    public function companylogo_submit(Request $request)
    {
        if (!empty($_FILES)) {
            $file = $request->file('file');
            $file_name = $request->file('file')->getClientOriginalName();
            $file_name = substr($file_name, 0, strpos($file_name, "."));
            $name = $file_name . "_" . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/company_logo/';
            $share = $request->file('file')->move($destinationPath, $name);
            return $name;
        }
    }

    public function upload_resume()
    {

        if (!Auth::check()) {
            return redirect()->back()->with('error', "Kindly login first to upload your resume");
        }

        $user = Auth::user();

        return view('web.upload-resume')->with(compact('user'));
    }

    public function upload_resume_submit(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if (isset($_POST['file_content']) && $_POST['file_content'] != "") {
            if (isset($_POST['file_from']) && $_POST['file_from'] == "google") {
                $main = explode("&", $_POST['file_content']);
                $url = explode("url=", $main[0]);
                $url = $url[1];
                $token = explode("token=", $main[4]);
                $token = $token[1];
                $filename = explode("name=", $main[1]);
                $filename = $filename[1];
                $filename_data = explode(".", $filename);
                $filename = $filename_data[0];
                $file_ext = $filename_data[count($filename_data) - 1];
                $mimetype = explode("mimeType=", $main[2]);
                $mimetype = $mimetype[1];
                $fileId = explode("fileId=", $main[3]);
                $fileId = $fileId[1];
                $oAuthToken = $token;
                $fileId = $fileId;
                $getUrl = 'https://www.googleapis.com/drive/v3/files/' . $fileId . '?alt=media';
                $authHeader = 'Authorization: Bearer ' . $oAuthToken;
                $ch = curl_init($getUrl);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [$authHeader]);
                $data = curl_exec($ch);
                $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $error = curl_errno($ch);
                $data = curl_exec($ch);
                $error = curl_error($ch);
                curl_close($ch);
                //$path = asset('uploads/resume/'.$filename);
                $path = 'uploads/resume/' . $filename . "_" . time() . "." . $file_ext;
                file_put_contents("public/" . $path, $data);
                $user->resume_doc = $path;
                $save = $user->save();
                if ($save) {

                    return redirect()->route('thank_you_for_upload');
                } else {

                    return redirect()->back()->with('error', 'Format not allowed');
                }
            } elseif (isset($_POST['file_from']) && $_POST['file_from'] == "dropbox") {
                $main = explode("&", $_POST['file_content']);
                $url = explode("url=", $main[0]);
                $url = $url[1];
                $filename = explode("name=", $main[1]);
                $filename = $filename[1];
                $filename_data = explode(".", $filename);
                $filename = $filename_data[0];
                $file_ext = $filename_data[count($filename_data) - 1];
                $curlSession = curl_init();
                curl_setopt($curlSession, CURLOPT_URL, $url);
                curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
                $jsonData = curl_exec($curlSession);
                curl_close($curlSession);
                $path = 'uploads/resume/' . $filename . "_" . time() . "." . $file_ext;
                file_put_contents("public/" . $path, $jsonData);
                $user->resume_doc = $path;
                $save = $user->save();
            }
            if ($save) {
                return redirect()->route('thank_you_for_upload');
            } else {
                return redirect()->back()->with('error', 'Format not allowed');
            }
        }
        //$user->resume_doc=$request->hasFile('myFile');
        if ($request->hasFile('myFile')) {
            $filename = $request->myFile->getClientOriginalName();
            $path = $request->myFile->storeAs('uploads/resume', $filename, 'public');
            $user->resume_doc = $path;
            $user->resume_privacy_setting = $request->resume_privacy_setting;
            $save = $user->save();
        } else {
            return redirect()->back()->with('error', 'Please attached the file first');
        }
        if ($save) {
            return redirect()->route('thank_you_for_upload');
        } else {
            return redirect()->back()->with('error', 'Format not allowed');
        }
    }

    public function apply_job($id = '')
    {
        $job = null;
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
            $user = Auth::User();
            $user_reume = $user->resume_doc;
            $job = jobs::where("is_active", 1)->where("id", $id)->first();
            // dd($job);
            if (!$job) {
                return redirect()->back()->with('notify_error', 'No record Found');
            }
            return view('web.apply-job')->with(compact('job', 'user_reume'));
        } else {
            return redirect()->back()->with('notify_error', 'No record Found');
        }
    }

    public function job_applied(Request $request)
    {

        $job_inquiry = job_inquiry::where("user_id", $_POST['user_id'])->where("job_id", $_POST['job_id'])->first();
        if ($job_inquiry) {
            $resp['status'] = 0;
            $resp['message'] = "You have already applied for this job";
            $resp['location'] = route('job_details', Crypt::encrypt($_POST['job_id']));
            return json_encode($resp);
        }
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $job_inquiry = job_inquiry::create($post_feilds);
        $apply_id = $job_inquiry->id;
        $jobs = jobs::where("id", $_POST['job_id'])->first();
        $user = Auth::User();
        $user_email = User::where('id', $jobs->user_id)->first();
        $details = [

            'user' => $user,
            'company_name' => $jobs->company_name,
            'job_title' => $jobs->job_title,
            'employment_type' => $jobs->employment_type,
            'role_location' => $jobs->role_location,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),

        ];

        $admin = [

            'user' => $user,
            'company_name' => $jobs->company_name,
            'job_title' => $jobs->job_title,
            'employment_type' => $jobs->employment_type,
            'role_location' => $jobs->role_location,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),

        ];
        Mail::to($_POST['email'])->send(new MailJobApply($details));
        Mail::to($user_email->email)->send(new MailToAdminJobApply($admin));
        $resp['status'] = 1;
        $resp['message'] = "Job Applied";
        $resp['location'] = route('applied_job_edit', ['id' => $apply_id]);
        return json_encode($resp);
    }

    public function applied_job_edit($id = "")
    {
        $job_inquiry = job_inquiry::where('id', $id)->first();
        return view('web.apply-edit-job')->with(compact('job_inquiry'));
    }

    public function applied_job_thank_you($id = "")
    {
        if ($id != "") {
            $id = Crypt::decrypt($id);
            $job_inquiry = job_inquiry::where('id', $id)->first();
            return view('web.thank-you-applied-job')->with(compact('job_inquiry'));
        } else {

            return redirect()->back()->with('error', 'No record Found');
        }
    }

    public function applied_job_update(Request $request)
    {
        $job_inquiry = job_inquiry::where('id', $request->id)->first();
        $job_inquiry->first_name = $request->first_name;
        $job_inquiry->last_name = $request->last_name;
        $job_inquiry->email = $request->email;
        $job_inquiry->city = $request->city;
        if ($request->hasFile('resume_upload')) {
            $filename = $request->resume_upload->getClientOriginalName();

            $path = $request->resume_upload->storeAs('uploads/resume', $filename, 'Public');
            $job_inquiry->resume_upload = $path;
        }
        $job_inquiry->save();
        return response()->json(['success' => true, 'message' => 'Aplication Updated Successfully']);
    }

    public function job_applied_status(Request $request)
    {

        if (isset($_POST['job_get'])) {
            $job_get_url = "?action=" . $_POST['job_get'];
        } else {
            $job_get_url = "";
        }
        $job_post_id = Crypt::decrypt($_POST['job_post_id']);
        $job_inquiry = job_inquiry::find($request->job_id);
        $job_inquirys = job_inquiry::where('is_active', 1)->where('job_id', $job_post_id)->get();
        $hired = 0;

        foreach ($job_inquirys as $key => $value) {

            if ($value->status == 'Hired') {
                $hired++;
            }
        }
        $jobs = jobs::find($job_post_id);
        if ($jobs->hire_open == $hired && $request->status == 'Hired') {
            $resp['status'] = 0;
            $resp['message'] = "Only " . $hired . "person hired for this job";
            $resp['location'] = $job_get_url;
            return json_encode($resp);
        }
        $job_inquiry->status = $request->status;
        $job_inquiry->save();
        if ($job_inquiry) {
            $resp['status'] = 1;
            $resp['message'] = "Status has been updated";
            $resp['status_'] = $request->status;
            // $resp['location'] = route('candidates_display',$_POST['job_post_id'].$job_get_url);
            $resp['location'] = $job_get_url;
            return json_encode($resp);
        } else {
            return redirect()->back()->with('error', 'due to error status has been not change');
        }
    }

    public function applicant_change_status(Request $request)
    {
        $jobs_inquiry = job_inquiry::where('id', $request->id)->first();
        $jobs_inquiry->applicant_status = $request->applicant_status;
        $jobs_inquiry->save();
        return response()->json(['success' => true, 'message' => 'status Update successfully']);
    }

    public function archied_status(Request $request)
    {

        $jobs_inquiry = job_inquiry::where('id', $request->id)->first();
        $jobs_inquiry->is_active = 0;
        $jobs_inquiry->is_deleted = 1;
        $jobs_inquiry->save();
        return response()->json(['success' => true, 'message' => 'status Update successfully']);
    }

    public function unarchied_status(Request $request)
    {
        $jobs_inquiry = job_inquiry::where('id', $request->id)->first();
        $jobs_inquiry->is_active = 1;
        $jobs_inquiry->is_deleted = 0;
        $jobs_inquiry->save();
        return response()->json(['success' => true, 'message' => 'status Update successfully']);
    }

    public function report_job_status(Request $request)
    {

        $jobs_inquiry = job_inquiry::where('id', $request->id)->first();

        $jobs_inquiry->reported_job = 1;
        $jobs_inquiry->reported_problem = $request->reported_problem;
        $jobs_inquiry->reported_description = $request->reported_description;
        $jobs_inquiry->save();
        return redirect()->back()->with('message', 'Report Added successfully ');
    }

    public function withdraw_status(Request $request)
    {
        $jobs_inquiry = job_inquiry::where('id', $request->id)->first();
        $jobs_inquiry->withdraw_application = 1;
        $jobs_inquiry->save();
        return response()->json(['success' => true, 'message' => 'status Update successfully']);
    }

    public function reviewd_application(Request $request)
    {
        $jobs_inquiry = job_inquiry::where('id', $request->id)->first();
        return response()->json(['jobs_inquiry' => $jobs_inquiry]);
    }

    public function job_mark_status(Request $request)
    {
        if (isset($_POST['job_get'])) {
            $job_get_url = "?action=" . $_POST['job_get'];
        } else {
            $job_get_url = "";
        }
        $job_id = Crypt::decrypt($_POST['job_id']);
        $job_post_id = Crypt::decrypt($_POST['job_post_id']);
        $interviews = interviews::find($job_id);
        $interviews->status = $request->status;
        $interviews->save();
        if ($interviews) {
            $resp['status'] = 1;
            $resp['message'] = "Status Has Been Updated";
            // $resp['location'] = route('candidates_display',$_POST['job_post_id'].$job_get_url);
            $resp['location'] = $job_get_url;
            return json_encode($resp);
        } else {
            return redirect()->back()->with('error', 'Due To Error Status Has Been Not Change');
        }
    }

    public function job_applied_delete(Request $request)
    {
        // dd($_POST);
        if (isset($_POST['job_get'])) {
            $job_get_url = "?action=" . $_POST['job_get'];
        } else {
            $job_get_url = "";
        }
        $job_inquiry = job_inquiry::find($request->job_id);
        $job_inquiry->is_active = 0;
        $job_inquiry->save();
        if ($job_inquiry) {
            $resp['message'] = "Record Has Been Deleted";
            $resp['location'] = route('candidates_display', $_POST['job_post_id'] . $job_get_url);
            return json_encode($resp);
        } else {
            return redirect()->back()->with('error', 'Due To Error Status Has Been Not Change');
        }
    }

    public function job_status_edit(Request $request)
    {
        $jobs = jobs::find($request->id);
        return response()->json($jobs);
    }

    public function job_status_update(Request $request)
    {
        $jobs = jobs::find($request->id);
        if ($request->action == "Yes") {
            $jobs->status = "Paused";
        } else if ($request->action == "Closed") {
            if ($request->reference_code == "I hired someone!") {
                $jobs->status = "Closed";
            } else {
                $jobs->status = "Closed";
            }
        } else {
            if ($request->reference_code == "Yes, I did") {
                $jobs->status = "Open";
                $jobs->hire_open = $jobs->hire_open + 1;
            } else {
                $jobs->status = "Paused";
            }
        }
        $jobs->reference_code = $request->reference_code;
        $jobs->save();
        return redirect()->back()->with('message', 'Job Status Has Been Changed');
    }

    public function job_applied_interested(Request $request)
    {

        // if (isset($_POST['job_get'])) {
        //     $job_get_url = "?action=" . $_POST['job_get'];

        // } else {
        //     $job_get_url = "";
        // }
        $job_post_id = Crypt::decrypt($_POST['job_post_id']);
        $job_inquiry = job_inquiry::find($request->job_id);
        $job_inquiry->is_interested = $request->status;
        $job_inquiry->save();
        $jobs = jobs::find($job_post_id);

        if ($job_inquiry) {
            if ($job_inquiry->is_interested == 1) {
                $message = "Hi " . $job_inquiry->first_name . ", Thank you very much for offering me the position of " . $job_inquiry->job_title . " at " . $job_inquiry->company_name . ".I have decided to accept the position, as it is the right fit for me at this time. I truly appreciate the offer and your consideration. 
              To make sure our emails reach your inbox, please add info@the-education-team.com to your safe list or address book.
                ";
                $details = ['message' => $message,];
                Mail::to($job_inquiry->email)->send(new MailInterstedCandidate($details));
            } else {
                $message = "Hi  " . $job_inquiry->first_name . " " . $job_inquiry->last_name . ", Thank you very much for offering me the position of " . $jobs->job_title . " at " . $jobs->company_name . " Unfortunately, I have decided not to accept the position, as it is not the right fit for me at this time. I truly appreciate the offer and your consideration.";
                $details = ['message' => $message,];
                Mail::to($job_inquiry->email)->send(new MailRejectCandidate($details));
            }
            $resp['status'] = 1;
            $resp['message'] = "Interested Record has Been Updated";

            if (isset($_POST['action'])) {

                //$resp['location'] = route('job_display');
            } else {

                //$resp['location'] = route('candidates_display', $_POST['job_post_id'] . $job_get_url);
            }

            return json_encode($resp);
        } else {
            return redirect()->back()->with('error', 'Due To Error Record Has Been Not Interested');
        }
    }

    // public function job_applied_interested(Request $request)
    //     {
    //    if (isset($_POST['job_get'])) {
    //         $job_get_url = "?action=" . $_POST['job_get'];
    //     } else {
    //         $job_get_url = "";
    //     }
    //     $job_post_id = Crypt::decrypt($_POST['job_post_id']);
    //     //dd($request->status);
    //     $job_inquiry = job_inquiry::find($request->job_id);
    //     $job_inquiry->is_interested = $request->status;
    //     $job_inquiry->save();
    //     $jobs = jobs::find($job_post_id);
    //     if ($job_inquiry) {
    //         if ($job_inquiry->is_interested == 1) {
    //             $email_message = 'Hi ' . $job_inquiry->first_name . ' ' . $job_inquiry->last_name . ', Thank you very much for offering me the position of ' . $jobs->job_title . ' at ' . $jobs->company_name . '.I have decided to accept the position, as it is the right fit for me at this time. I truly appreciate the offer and your consideration.';
    //     }else{
    //             $email_message = 'Hi ' . $job_inquiry->first_name . ' ' . $job_inquiry->last_name . ', Thank you very much for offering me the position of ' . $jobs->job_title . ' at ' . $jobs->company_name . ' Unfortunately, I have decided not to accept the position, as it is not the right fit for me at this time. I truly appreciate the offer and your consideration.';
    //         }
    //         // logo
    //         $logo = 'web/images/logo.jpg';
    //         $config = config::find(2);
    //         // User
    //         $user_body = "  <html>
    //                             <head>
    //                                 <title>Order Confirmation</title>
    //                             </head>
    //                             <style>
    //                                 table tr:first-child > td > center{
    //                                     /*background: #ff0000;*/
    //                                 }
    //                             </style>
    //                             <body>
    //                             <table style='background:#000; border:#000 1px solid;' width='622' cellspacing='0' cellpadding='0' border='0'
    //                                 align='center'>
    //                                 <tbody>
    //                                 <tr class='first'>
    //                                     <td>
    //                                         <center>
    //                                             <img src='" . asset($logo) . "' style='padding: 15px;width: 150px;'>
    //                                         </center>
    //                                     </td>
    //                                 </tr>
    //                                 <tr>
    //                                     <td height='1'></td>
    //                                 </tr>
    //                                 <tr>
    //                                     <td style='font-family:Arial, Helvetica, sans-serif;' bgcolor='#f5f9f6'>
    //                                         <table width='622' cellspacing='0' cellpadding='0' border='0' align='center'>
    //                                             <tbody>
    //                                             <tr>
    //                                                 <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
    //                                                     " . $email_message . "
    //                                                 </td>
    //                                             </tr>
    //                                             <tr>
    //                                                 <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;'>
    //                                                     To make sure our emails reach your inbox, please add <a
    //                                                         href='mailto:" . $config['value'] . "'>" . $config['value'] . "</a> to your safe
    //                                                     list or address book.<br>
    //                                                     <!-- Please note that there will be a delivery charge for re-sending returned items if an incorrect address has been provided. <br /> -->
    //                                                 </td>
    //                                             </tr>
    //                                             </tbody>
    //                                         </table>
    //                                     </td>
    //                                 </tr>
    //                                 </tbody>
    //                             </table>
    //                             </body>
    //                         </html>";
    //         $headers = "MIME-Version: 1.0" . "\r\n";
    //         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    //         $headers .= 'From: <no-reply@the-educate-team.com>' . "\r\n";
    //         $subject = 'The Educate Team Interest job Inquiry';
    //         // dd($user_body);
    //         // User email
    //         $user_email = $job_inquiry->email;
    //         // $user_email = 'digitonics.developer.454@gmail.com';
    //         // dd($user_email,$subject,$user_body);
    //         $UserMailSent = mail($user_email, $subject, $user_body, $headers);
    //         // dd($UserMailSent);
    //         $resp['status'] = 1;
    //         $resp['message'] = "Interested Record has been updated";
    //         if (isset($_POST['action'])) {
    //             $resp['location'] = route('job_display');
    //         } else {
    //             $resp['location'] = route('candidates_display', $_POST['job_post_id'] . $job_get_url);
    //         }
    //         return json_encode($resp);
    //     } else {
    //         return redirect()->back()->with('error', 'due to error record has been not interested');
    //     }
    //  }

    public function resume_upload_submit(Request $request)
    {

        if (!empty($_FILES)) {
            $file = $request->file('file');
            $file_name = $request->file('file')->getClientOriginalName();
            $file_name = substr($file_name, 0, strpos($file_name, "."));
            $name = $file_name . "_" . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/resume/';
            $share = $request->file('file')->move($destinationPath, $name);
            return $name;
        } else {
            return 'false';
        }
    }

    public function reviews_save2(Request $request)
    {
        // dd(1);
        if (isset($_POST['review_id']) && $_POST['review_id'] != "") {
            $id = Crypt::decrypt($_POST['review_id']);
            $token_ignore = ['_token' => '', 'review_id' => ''];
            $post_feilds = array_diff_key($_POST, $token_ignore);
            $reviews = reviews::where('id', $id)->update($post_feilds);
            $review_id = $_POST['review_id'];
            $review_id = $review_id;
            $resp['review_id'] = $review_id;
            $resp['status'] = 0;
            $resp['message'] = "review details has been updated";
            if ($_POST['step_filled'] == 1) {
                $resp['location'] = route('company_reviews_step2', $review_id);
            }
            if ($_POST['step_filled'] == 2) {
                $resp['location'] = route('company_reviews_step3', $review_id);
            }
            if ($_POST['step_filled'] == 3) {
                // $resp['location'] = route('welcome');
                Session::forget('review_id');
                // Send Mail
                $reviews_data = reviews::where('id', $id)->first();

                $rev_id = Crypt::encrypt($review_id);

                $redirect_link = route('confirm_review', [$id, $rev_id]);
                $details = [
                    'company_name' => $reviews_data->company_name,
                    'review_summary' => $reviews_data->review_summary,
                    'your_review' => $reviews_data->your_review,
                    'pros' => $reviews_data->pros,
                    'cons' => $reviews_data->cons,
                    'redirect_link' => $redirect_link,
                ];
                // admin email
                $config = config::find(2);
                // dd($details,$config['value']);
                $data = Mail::to($config['value'])->send(new MailReview($details));

                //Mail::to('digitonics.developer.454@gmail.com')->send(new MailReview($details));
                // Send Mail

                return redirect()->route('thank_you_review');
            }
            return json_encode($resp);
        } else {
            return redirect()->route('welcome')->with('error', 'due to error Review has been not saved');
        }
    }

    public function userprofile()
    {
        $user = Auth::user();
        $states = states::where("is_active", 1)->where('is_deleted', 0)->get();
        if ($user) {
            //return view('web.dashboard.user-profile')->with('title', "User Profile")->with(compact('user', 'states'));
            return view('user-profile')->with('title', "User Profile")->with(compact('user', 'states'));
        } else {
            return redirect()->route("welcome");
        }
    }

    public function resume_privacy_setting(Request $request)
    {
        $user = Auth::user();
        if (isset($user) && $user->id != "") {
            $user->resume_privacy_setting = $request->status;
            $user->save();
            $resp['status'] = 1;
            $resp['message'] = "Resume Privacy Settings has been updated";
            $resp['location'] = route('manage_resume');
        } else {
            $resp['status'] = 0;
            $resp['message'] = "Resume Privacy Settings has been not updated";
            $resp['location'] = route('manage_resume');
        }
        return json_encode($resp);
    }

    public function ajx_candidate()
    {
        $id = $_POST['jobid'];
        $user = Auth::user();
        if ($id != "") {
            try {
                $id = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', 'Error : ' . $th->getMessage());
            }
        } else {
            return redirect()->back()->with('message', 'No Job ID Found');
        }
        if ($user->role_type != "Employer") {
            return redirect()->back()->with('message', 'No Page Found');
        }
        if ($user) {
            $job = jobs::where("id", $id)->where("is_active", 1)->where("is_deleted", 0)->first();
            if (!$job || is_null($job)) {
                return redirect()->back()->with('message', 'No active job found');
            }
            $job_inquiry = job_inquiry::where("job_id", $id)->where("is_active", 1)->orderby("id", 'desc')->paginate(10);
            $open_paused_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("user_id", $user->id)->where("status", "Open")->orWhere("status", "Paused")->where("user_id", $user->id)->count();
            $closed_jobs = jobs::where("is_confirm", 1)->where("is_active", 1)->where("status", "Closed")->where("user_id", $user->id)->count();
            $applied_jobs = job_inquiry::where("is_active", 1)->where("job_id", '=', $id)->get();
            $resume = array();
            foreach ($applied_jobs as $value) {
                $result = array_push($resume, $value->resume_upload);
            }

            $final_resume = implode(',', $resume);
        } else {
            return redirect()->back()->with('message', 'Kindly Login First');
        }
        $options = '';
        if (!$job_inquiry->isEmpty()) {
            foreach ($job_inquiry as $job) {
                $job_post = $job->job_post($job->job_id);
                $messages_count = $job_post->messages_count($job_post->id, Auth::user()->id, $job->user_id);
                $job_date = date("d M y", strtotime($job->created_at));
                $set_interview = route('set_interview', Crypt::encrypt($job->id));
                $resume_uploads = asset('/uploads/resume/' . $job->resume_upload);
                $parameter = Crypt::encrypt($job->id);
                $user_chat_now = route('user_chat_now', $parameter);
                if ($job->status == "Awaiting Review") {
                    $color = 'gray';
                } elseif ($job->status == "Reviewed") {
                    $color = 'aqua';
                } elseif ($job->status == "Contacting") {
                    $color = 'orng';
                } elseif ($job->status == "Rejected") {
                    $color = 'red';
                } else {
                    $color = 'green';
                }
                $options .= '
                               <tr>
                                <td>
 
                                   <h4>' . $job->first_name . ' ' . $job->last_name . '</h4>
                                    <p>' . $job->email . '</p>
                                    <p>' . $job->city . '<br>Created:' . $job_date . '</p>
                                </td>
                                 <td class="job-view"><a href="tel:"' . $job->phonenumber . '">' . $job->phonenumber . '</a></td><td>
                                
                              <a class="btn btn-primary" href="' . $set_interview . '" target="_blank">
                                Set Up Interview
                              </td>
                                <td>
                                 <a  class="btn btn-primary" href="' . $resume_uploads . '" download><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                  </td>
                                   <td>
                                    <div class="dropdown open-job">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            
                                            <span class="' . $color . '"></span> ' . $job->status . ' 
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item status_dropdown_candidate" data-id="Awaiting Review" data-job_id="' . $job->id . '" data-job_post_id="' . Crypt::encrypt($job->job_id) . '" data-user_id="' . Auth::user()->id . '" href="javascript:void(0);">
                                                <span class="gray"></span>Awaiting Review
                                            </a>
                                            <a class="dropdown-item status_dropdown_candidate" data-job_id="' . $job->id . '" data-job_post_id="' . Crypt::encrypt($job->job_id) . '" data-user_id="' . Auth::user()->id . '" data-id="Reviewed" href="javascript:void(0);">
                                                <span class="aqua"></span>Reviewed
                                            </a>
                                            <a class="dropdown-item status_dropdown_candidate" data-id="Contacting" data-job_id="' . $job->id . '" data-job_post_id="' . Crypt::encrypt($job->job_id) . '" data-user_id="' . Auth::user()->id . '" href="javascript:void(0);">
                                                <span class="orng"></span>Contacting
                                            </a>
                                            <a class="dropdown-item status_dropdown_candidate" data-id="Rejected" data-job_id="' . $job->id . '" data-job_post_id="' . Crypt::encrypt($job->job_id) . '" data-user_id="' . Auth::user()->id . '" href="javascript:void(0);">
                                                <span class="red"></span>Rejected
                                            </a>
                                            <a class="dropdown-item status_dropdown_candidate" data-id="Hired" data-job_id="' . $job->id . '" data-job_post_id="' . Crypt::encrypt($job->job_id) . '" data-user_id="' . Auth::user()->id . '" href="javascript:void(0);">
                                                <span class="green"></span>Hired
                                            </a>
                                        </div>
                                          
                                    </div>
                                </td>
                                <td>
                              
                              <div class="noti-count">
                              <i class="fa fa-comments"><strong> ' . $messages_count . '</strong></i>
                                  
                              </div>
                               <a class="btn btn-primary" href="' . $user_chat_now . '" target="_blank">Contact this Person </a>

                            </td>

                            </tr>';
            }
        } else {
            $options .= '<tr>
                                <td colspan="6"><div class="col-md-12">
                            <div class="alert alert-warning" style="margin:15% 0;text-align: center;">
                                                <strong>No Records Found</strong>
                            </div>
                            </div><td></td>';
        }
        // dd($action);
        echo json_encode(array(
            "success" => 1,
            "html" => $options
        ));
    }

    public function candidate_invite(Request $request)
    {
        $invitejob = invite_job::where('user_id', $request->id)->where('job_id', $request->job_id)->first();
        if ($invitejob) {
            $resp['status'] = 0;
            $resp['message'] = "Already invite this user.";
            return json_encode($resp);
        } else {

            $invite_job = new invite_job;
            $invite_job->user_id = $request->id;
            $invite_job->job_id = $request->job_id;
            $invite_job->save();
            if ($invite_job) {
                $resp['status'] = 1;
                $resp['message'] = "This candidate successfully invite.";
                // $resp['location'] = $job_get_url;
                return json_encode($resp);
            } else {
                $resp['status'] = 0;
                $resp['message'] = "due to error candidate has been not invite";
                return json_encode($resp);
            }
        }
    }

    public function change_job_status(Request $request)
    {

        $resp = array();

        $changeStatus = $request->change_status;
        $getArray = $request->getArray;

        if (!empty($getArray)) {

            foreach ($getArray as $value) {

                jobs::where('id', $value)->update(['status' => $changeStatus]);
            }
        }

        return json_encode($resp);
    }

    public function candidate_message(Request $request)
    {

        $resp = array();

        $inq_id = $request->inq_id;

        $user = Auth::user();

        //dd($inq_id);

        $job_inquiry =  job_inquiry::where("id", $inq_id)->where("is_active", 1)->first();

        //dd($job_inquiry->job_id);

        $thread_messages = thread_messages::select('message', 'sender_id', 'receiver_id', 'created_at', 'has_file')->where('is_active', 1)->where('order_id', $inq_id)->get();

        $msg_body = "";
        $reserved_info = "";

        if ($user) {

            //dd($thread_messages);

            foreach ($thread_messages as $value) {


                if ($value->sender_id == $user->id) {

                    $name = $value->sender->name;

                    if ($user->profile_pic != "") {

                        $logo = asset($user->profile_pic);
                    } else {

                        $logo = asset('images/no-img.png');
                    }
                    //Sender Member
                    $msg_body = $msg_body . '<div class="d-flex mb-4">';
                    $msg_body = $msg_body . '<div class="message flex-grow-1">';
                    $msg_body = $msg_body . '<div class="d-flex">';
                    $msg_body = $msg_body . '<p class="mb-1 text-title text-16 flex-grow-1">' . $name . '</p><span class="text-small text-muted">' . $value->created_at->diffForHumans() . '</span>
                                            </div>';


                    if ($value->has_file == 0) {
                        $msg_body = $msg_body . '<p class="m-0">' . $value->message . '</p>
                                        </div>';
                    } else {
                        // $path = asset('/Uploads/user_chat_attachment/'.$value->message);
                        // $msg_body = $msg_body . '<p class="m-0"><a href="'.$path.'" target="_blank">Open attached file : '.$value->message.'</a></p>
                        // </div>';
                    }
                    //$msg_body = $msg_body . "<p class='profilePicture' data-letters='' ><span style='display: none;' id='userName' class='dropdown-toggle userName'>".$name."</span></p>";
                    $msg_body = $msg_body . "<img class='avatar-sm rounded-circle ml-3' src='" . $logo . "' alt='alt' style='width: 36px; height: 36px;'/>";
                    $msg_body = $msg_body . '</div>';
                } else {
                    // if ($value->sender->profile_pic != "") {
                    //     $logo = asset($value->sender->profile_pic);
                    // } else {
                    //     $logo = asset('images/no-img.png');
                    // }
                    // Receiver Member
                    if ($value->sender->profile_pic != "") {
                        $logo = asset($value->sender->profile_pic);
                    } else {
                        $logo = asset('images/no-img.png');
                    }
                    $name = $value->sender->name;
                    $msg_body = $msg_body . "<div class='d-flex mb-4 user'>";
                    //if($value->sender->type == 2){
                    $msg_body = $msg_body . "<img class='avatar-sm rounded-circle ml-3' src='" . $logo . "' alt='alt' style='width: 36px; height: 36px;'/>";
                    // }else{
                    //     $msg_body = $msg_body . "<p class='profilePicture' data-letters='' ><span style='display: none;' id='userName' class='dropdown-toggle userName'>".$name."</span></p>";
                    // }
                    $msg_body = $msg_body . "<div class='message flex-grow-1'>
                                            <div class='d-flex'>
                                                <p class='mb-1 text-title text-16 flex-grow-1'>" . $name . "</p><span class='text-small text-muted'>" . $value->created_at->diffForHumans() . "</span>
                                            </div>";

                    if ($value->has_file == 0) {
                        $msg_body = $msg_body . '<p class="m-0">' . $value->message . '</p>';
                    } else {
                        // $path = asset('/Uploads/user_chat_attachment/'.$value->message);
                        // $msg_body = $msg_body . '<p class="m-0"><a href="'.$path.'" target="_blank">Open attached file : '.$value->message.'</a></p>';
                    }
                    $msg_body = $msg_body . "</div>
                                    </div>";
                }
            }
        }

        $resp['user'] = $user;

        $resp['thread_messages'] = $thread_messages;


        $resp['msg_body'] = $msg_body;

        $html = view('web.chatCss')->render();

        $resp['html'] = $html;

        return json_encode($resp);
    }

    public function candidate_message_tab(Request $request)
    {

        $resp = array();

        $inq_id = $request->inq_id;

        $other_user_id = $request->other_user_id;

        $user = Auth::user();

        $check_chat_box = chat_box::where('user_id', $user->id)->where('order_id', $inq_id)->where('receiver_id', $other_user_id);

        if($check_chat_box->count() > 0){

            $get_data = $check_chat_box->first();

            $get_old_data = $get_data->id;

            chat_box::where('id', $get_data->id)->update(['tab_status' => 1]);

        }else{

           $get_chat_box = chat_box::insertGetId(['user_id' => $user->id, 'order_id' => $inq_id, 'receiver_id' => $other_user_id]);

        }

        //dd($inq_id);

        $job_inquiry = job_inquiry::where("id", $inq_id)->where("is_active", 1)->first();

        $user_detail = User::where("id", $other_user_id)->where("is_active", 1)->first();

        // dd($job_inquiry->job_id);

        $thread_messages = thread_messages::select('message', 'sender_id', 'receiver_id', 'created_at', 'has_file')->where('is_active', 1)->where('order_id', $inq_id)->get();

        $unread_messages_count = thread_messages::select('message', 'sender_id', 'receiver_id', 'created_at', 'has_file')
        ->where('is_active', 1)
        ->where('is_read','=', 1)
        ->where('receiver_id','=', $user->id)
        ->where('order_id','=', $inq_id)
        ->count();

        $msg_body = "";

        $reserved_info = "";

        if ($user) {

            foreach ($thread_messages as $value) {

                if ($value->sender_id == $user->id) {

                    $name = $value->sender->name;

                    if ($user->profile_pic != "") {

                        $logo = asset($user->profile_pic);

                    } else {

                        $logo = asset('images/default2-1-1.jpg');
                    }

                    

                    $msg_body = $msg_body ."<div class='message-box-holder'>";
                            $msg_body = $msg_body ."<div class='message-box'>";
                            
                            if ($value->has_file == 0) {
                            
                                $msg_body = $msg_body . '<p class="m-0">' . $value->message . '</p>';
                            
                            }
                            
                            $msg_body = $msg_body ."</div>";
                        $msg_body = $msg_body ."</div>";


                
                }else{

                    $name = $value->sender->name;

                    if ($value->sender->profile_pic != "") {

                        $logo = asset($value->sender->profile_pic);

                    } else {

                        $logo = asset('images/default2-1-1.jpg');
                    }

                    $msg_body = $msg_body . '<div class="message-box-holder">';

                    $msg_body = $msg_body . '<div class="message-sender">'. $name . '</div>';

                    $msg_body = $msg_body . '<div class="message-box message-partner">'. $value->message   .'</div>';

                    $msg_body = $msg_body . '</div>';

                }

            }

        }

        if ($user_detail->profile_pic != "") {

            $logo_2 = asset($user_detail->profile_pic);

        } else {

            $logo_2 = asset('images/default2-1-1.jpg');
        }

        $resp['user'] = $user;

        $resp['thread_messages'] = $thread_messages;

        $resp['msg_body'] = $msg_body;
        
        $resp['user_detail'] = $user_detail;

        $resp['chat_box_id'] = isset($get_chat_box) ? $get_chat_box : $get_old_data;

        $resp['unread_messages_count'] = $unread_messages_count;

        $resp['logo_2'] = $logo_2;

        return json_encode($resp);

    }

    public function message_tab_close(Request $request)
    {
        $resp = array();

        $get_chat_box = $request->get_chat_box;

        chat_box::where('id',$get_chat_box)->delete();

        $resp['success'] = "Tab Close";
        
        return json_encode($resp);
    }

    public function job_status_change(Request $request)
    {

        $resp = array();
        $jobs_inqui = job_inquiry::where('id', $request->inq_id)->first();
        $jobs_inqui->status = $request->status;
        $jobs_inqui->save();

        $job_inquiry = job_inquiry::where('id', $request->inq_id)->first();

        $resp['inquiry'] = $job_inquiry;

        return json_encode($resp);
    }

    public function all_candidate_details(Request $request)
    {

        $user = Auth::User();
        $job_messages = job_inquiry::where("user_post_id", $user->id)->where("is_active", 1)->get();
        return view('web.all-candidates')->with(compact('job_messages'));
    }

    public function candidate_delete(Request  $request)
    {

        $job_inquiry = job_inquiry::find($request->id);
        $job_inquiry->is_active = 0;
        $job_inquiry->is_deleted = 1;
        $job_inquiry->save();
        $job_inquiry->delete();
        if ($job_inquiry) {
            return response()->json(['success' => true, 'message' => 'Candidate Delete Successfully']);
        } else {
            return response()->json(['error' => false, 'message' => 'Please Try Again']);
        }
    }

    public function candidate_interview_status(Request  $request)
    {

        $user = Auth::User();
        $interviews = interviews::find($request->id);

        if ($interviews->employee_interview_status != 'suggest new time') {
            $interviews->employee_interview_status = "suggest new time";
            $interviews->save();
            $jobs = jobs::where('id', $interviews->job->id)->first();
            $details = [

                'name' => $user->name,
                'email' => $user->name,
                'job_title' => $jobs->job_title,
                'start_time' => $interviews->start_time,
                'end_time' => $interviews->end_time,
                'date' => $interviews->date,

            ];
            Mail::to('info@the-education-team.com')->send(new MailSuggestNew($details));
            return response()->json(['success' => true, 'message' => 'Suggest New Time Request Sent']);
        } else {
            return response()->json(['error' => false, 'message' => 'Already Suggest A new Time request sent']);
        }
    }

    public function sechedule_interview(Request  $request)
    {
        $user = Auth::User();
        $interviews = interviews::find($request->id);
        if ($interviews->employee_interview_status != 'sechedule Interview') {
            $interviews->employee_interview_status = "sechedule Interview";
            $interviews->save();
            return response()->json(['success' => true, 'message' => 'Your Interview On sechedule']);
        } else {
            return response()->json(['error' => false, 'message' => 'Already sechedule Interview']);
        }
    }

    public function save_notes(Request  $request)
    {

        $job_inquiry = job_inquiry::find($request->employee_id);
        $job_inquiry->notes = $request->notes;
        $job_inquiry->save();
        return redirect()->back()->with('message', 'Notes Save Successfully');
    }

    public function employee_seen_message(Request  $request)
    {

        $thread_messages = thread_messages::find($request->id);
        $thread_messages->is_read = 1;
        $thread_messages->save();
        return response()->json(['success' => true]);
    }
    
}
