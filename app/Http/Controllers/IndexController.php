<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

use App\Models\category;
use App\Models\product;
use App\Models\page_image;
use App\Models\order;
use App\Models\order_item;
use App\Models\banner;
use App\Models\blogs;
use App\Models\blog_comment;
use App\Models\blog;
use App\Models\attributes;
use App\Models\book;
use Illuminate\Support\Str;
use Session;
use View;
use Helper;
use Response;
use App\Models\config;
use App\Models\newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNewsLetter;
use App\Mail\MailContact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use \Crypt;

class IndexController extends Controller
 {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = category::select('categories.id','categories.name', 'categories.name_urdu')->join('products','products.cat_id','=','categories.id')->distinct('categories.id')->where("categories.is_active", 1)->get();
        $category = category::orderBy('id', 'desc')->where("is_active", 1)->where('is_deleted', 0)->get();
        $product = product::where("is_active", 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $img = page_image::where("is_active", 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $banner = banner::where('is_active' , 1)->get();

        return view('web.pages.index')->with(compact('category', 'product', 'img', 'categories', 'banner'));
    }

    public function novel()
    {
        $novel = product::where("cat_id", 8)->where("is_active", 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $banner = banner::where('is_active' , 1)->orderBy('id', 'DESC')->get();

        return view("web.pages.novel")->with(compact("novel", "banner"));
    }

    public function product_detail()
    {
        return view("web.pages.product-detail");
    }

    public function about_us()
    {
        $categories = category::where('id',8)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        $novel = product::where('cat_id', 8)->where('is_active', 1)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        return view("web.pages.about-us")->with(compact('novel', 'categories'));
    }

    public function checkout($id)
    {
        $id = Crypt::decrypt($id);
        if($id !== null){
            $charges = config::where('id', 8)->get();
            $shipping_charges = $charges[0]->value;
            $product = product::where('id', $id)->get();
            return view("web.pages.checkout")->with(compact("product", "shipping_charges"));
        }else{
            // return redirect()->route('welcome');
        }
    }

    public function categories($id)
    {
        $product_year = [];
        $id = Crypt::decrypt($id);
        $category = category::where('id',$id)->where('is_active', 1)->where('is_deleted',0)->get();
        $products = product::where('cat_id', $id)->where('is_active', 1)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        $product_year = product::select('year')->groupBy('year')->where('cat_id', $id)->where('is_active', 1)->where('is_deleted',0)->get();
        $categories = category::where('id',8)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        $novel = product::where('cat_id', 8)->where('is_active', 1)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        return view("web.pages.categories")->with(compact('category', 'products', 'novel', 'categories', 'product_year'));
    }

    public function search_on_year(Request $request)
    {
        $search = explode(" ", $request->search);
        $products = product::where('cat_id', $request->cat_id)->where('year', $search[1])->where('is_active', 1)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        return json_encode(['products'=>$products]);
    
    }
    
    public function user_dashboard()
    {
        if(Auth::User()){
            $order_item = order_item::where('user_id',Auth::User()->id)->get('product_id');
            $product = product::whereIn('id', $order_item)->where("is_active", 1)->get();
            $page_image = page_image::where("is_active", 1)->get();
            return view("user-dashboard")->with(compact('order_item', 'product', 'page_image'));
        }else{
            return redirect()->route('login');
        }
    }

    public function newsletter_submit(Request $request)
    {
        $newsletter = newsletter::where("email", $_POST['email'])->first();
        if ($newsletter) {
            return redirect()->route('welcome')->with('error', "This email is already registered!");
        }
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $newsletter = newsletter::create($post_feilds);
        $details = [
            'type' => 'user',
            'body' => $_POST['email']
        ];
        //Mail::to($_POST['email'])->send(new MailNewsLetter($details));
        $details = [
            'type' => 'admin',
            'body' => $_POST['email']
        ];
        //Mail::to(Helper::config('emailaddress'))->send(new MailNewsLetter($details));
        return redirect()->route('welcome')->with('message', "Congratulations, You’re Now on the list!");
    }

    public function search_detail(Request $request)
    {
        $search = $request->dInput;
        $product = product::where("is_active", 1)->where('name', 'LIKE', "%$search%")->get();
        $category = category::where("is_active", 1)->where('name', 'LIKE', "%$search%")->get();
        $msg_body = [$product, $category];
        $response = json_encode($msg_body);
        return $response;
    }

    public function blogs()
    {
        $blog = blog::where('is_active', 1)->where('is_approved', 1)->orderBy('id', 'DESC')->get();
        $blog_comment = blog_comment::where("is_active", 1)->where('is_approved', 1)->orderBy('id', 'DESC')->get();
        return view("web.pages.blogs")->with(compact('blog', 'blog_comment'));
    }

    public function blogs_detail($id)
    {
        $id = Crypt::decrypt($id);
        $blog = blog::where("id", $id)->where("is_active", 1)->where('is_approved', 1)->get();
        $blog_comment = blog_comment::where("id", $id)->where("is_active", 1)->where('is_approved', 1)->get();
        return view("web.pages.blogs-detail")->with(compact("blog", "blog_comment"));
    }

    public function view_books($id, $pro=null)
    {
        if($pro != null){
            $id = $pro;
        }else{
            $id = Crypt::decrypt($id);
        }
        
        $book = book::where('product_id', $id)->where('is_active', 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $novel = product::where('cat_id', 8)->where('is_active', 1)->where('is_deleted',0)->orderBy('id', 'DESC')->get();
        return view('web.pages.view_book')->with(compact('book', 'novel'));
    }

    public function career()
    {
        if (isset($_GET) && $_GET != []) {
            $blogs = blogs::where("is_active", 1)->where('name', 'LIKE', '%' . $_GET['search'] . '%')->get();
            $search = $_GET['search'];
            return view('web.career')->with(compact('blogs', 'search'));
        } else {
            $blogs = blogs::where("is_active", 1)->orderBy('id', 'desc')->get();
        }
        return view('web.career')->with(compact('blogs'));
    }

    public function matches()
    {

        return view('web.matches');
    }

    public function contact_us()
    {
        return view('web.contact_us');
    }

    public function thank_you_review()
    {
        return view('web.thankyou');
    }

    public function thank_you_for_upload()
    {
        return view('web.thank-you-for-upload');
    }

    public function signup_login()
    {
        if (Auth::check()){
            return redirect()->back()->with('error', "You're already logged In");
        }
        return view('web.signup-login');
    }

    public function signup()
    {
        if (Auth::check()) {
            return redirect()->route('welcome')->with('error', "You're already logged In");
        }
        $states = states::where("is_active", 1)->where('is_deleted', 0)->get();
        return view('web.signup')->with(compact('states'));
    }

    public function steps()
    {
        if (Auth::user()->role_id == 1) {
            $projects = attributes::where('attribute', 'project')->where('is_active', 1)->get();
            return view('steps')->with(compact('projects'));
        } else {
            return redirect()->back()->with('error', 'No Page Found');
        }
    }

    public function user_infoupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->personal_email = $request->personal_email;
        $user->phonenumber = $request->phonenumber;
        $user->emergency_number = $request->emergency_number;
        $user->cnic = $request->cnic;
        $user->residential_address = $request->residential_address;
        $user->blood_group = $request->blood_group;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->save();
        return redirect()->back()->with('message', 'Information updated successfully');
    }

    public function user_search(Request $request)
    {
        $user = User::where("email", $_POST['email'])->first();
        if ($user) {
            // Sign In
            Auth::login($user, true);
            $url = route('welcome');
            $body['status'] = 1;
            $body['message'] = 'Welcome ' . $user->name . ' to The Education Team';
            $body['stat'] = 1;
            $body['url'] = $url;
            return json_encode($body);
        } else{


            //Create User
            $user =  new User;
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->profile_pic = $_POST['picture'];
            $user->google_id = $_POST['google_id'];
            $user->token = $_POST['token'];
            $user->password = Hash::make($_POST['google_id']);
            if ($_POST['user_type'] == "Employee") {
                $user->role_type = 'Job seeker';
            } else {
                $user->role_type = 'Employer';
            }
            $user->save();


            try {
                $attempt = Auth::attempt(['email' => $_POST['email'], 'password' => $_POST['google_id']]);
                $url = route('welcome');
                $body['message'] = 'Welcome ' . $user->name . ' to The Education Team';
                $body['stat'] = 1;
                $body['url'] = $url;
                return json_encode($body);
            } catch (\Throwable $th) {
                $body['message'] = 'Error : ' . $th;
                $body['stat'] = 0;
                return json_encode($body);
            }
        }
    }

    public function user_office_infoupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->bank_account_number = $request->bank_account_number;
        $user->v_model_name = $request->v_model_name;
        $user->v_model_year = $request->v_model_year;
        $user->v_number_plate = $request->v_number_plate;
        $user->save();
        // Session::flash('message', 'This is a message!');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back()->with('message', 'Information updated successfully');
    }

    public function profile_submit(Request $request)
    {
        $user = User::find(Auth::user()->id);
        // Avatar Upload
        if ($request->has('avatar')) {
            if ($request->file('avatar') != '') {
                $request->validate([
                    'avatar' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']
                ]);
                $path_a = ($request->file('avatar'))->store('uploads/avatar/' . md5(Str::random(20)), 'public');
                $user->profile_pic = $path_a;
                $user->save();
                return redirect()->back()->with('message', 'Profile Picture been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your Profile Picture');
            }
        }
        // Resume Upload
        if ($request->has('cnic_file')) {
            if ($request->file('cnic_file') != '') {
                $request->validate([
                    'cnic_file' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']
                ]);
                $path_c = ($request->file('cnic_file'))->store('uploads/cnic/' . md5(Str::random(20)), 'public');
                $user->cnic_doc = $path_c;
                $user->save();
                return redirect()->back()->with('message', 'NIC Picture has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your NIC Picture');
            }
        }
        // // CNIC Upload
        if ($request->has('cv_file')) {
            if ($request->file('cv_file') != '') {
                $request->validate([
                    'cv_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']
                ]);
                $path_r = ($request->file('cv_file'))->store('uploads/resume/' . md5(Str::random(20)), 'public');
                $user->resume_doc = $path_r;
                $user->save();
                return redirect()->back()->with('message', 'Resume/CV Document has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your Resume/CV Document');
            }
        }
        // // Education Upload
        if ($request->has('education_file')) {
            if ($request->file('education_file') != '') {
                $request->validate([
                    'education_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']
                ]);
                $path_e = ($request->file('education_file'))->store('uploads/education/' . md5(Str::random(20)), 'public');
                $user->education_doc = $path_e;
                $user->save();
                return redirect()->back()->with('message', 'Education Document has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your Education Document');
            }
        }
    }

    public function check_login($email, $name)
    {

        $user = User::where('email', $email)->first();
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('welcome');
        } else {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $password = Hash::make("123456");
            $user->password = $password;
            $user->save();
            Auth::login($user, true);
            return redirect()->route('welcome');
        }
    }


}
