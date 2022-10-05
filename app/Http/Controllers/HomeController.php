<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Rules\MatchOldPassword;
use Auth;
use App\Models\page_image;
use App\Models\category;
use App\Models\product;
use App\Models\banner;
use App\Models\order;
use App\Models\blog;
use App\Models\blog_comment;
use App\Models\order_item;
use App\Models\shipping_address;
use App\Models\User;
use App\Models\attributes;
// use App\Models\inquiry;
use App\Models\product_file;
use App\Models\config;
use App\Models\book;

use App\Mail\MailSentpassword;
use App\Mail\MailVerification;

use \Crypt;
use File;
use Session;
use Helper;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class HomeController extends Controller

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
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->route("welcome");
        }
        return view('welcome');
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

    public function switch_project($project_id)
    {
        if (Auth::user()->role_id == 1) {
            $project = attributes::where('id', $project_id)->where('is_active', 1)->first();
            $data['project_id'] = $project_id;
            Session::put("project_id", $project_id);
            Helper::activity_log("login", $data);
            return redirect()->route('user_profile')->with('message', "Welcome to " . $project->name);
        } else {
            return redirect()->back()->with('error', 'No Page Found');
        }
    }

    public function user_profile()
    {
        $user = Auth::user();

        if ($user->role_id == 1 || $user->role_id == 4) {
            return view('user-profile')->with('title', "Home Page")->with(compact('user'));
        }

        return redirect()->route("welcome");
    }

    public function inquiry_manage()
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->route("welcome");
        }

        $inquiry = inquiry::where("is_active", 1)->where('is_deleted', 0)->get();

        return view('inquiry-manage')->with('title', "Inquiry Management")->with(compact('user', 'inquiry'));
    }

    public function user_rights()
    {
        $user = Auth::user();
        $roles = attributes::where("is_active", 1)->where('is_deleted', 0)->get();

        return view('user-rights')->with('title', "User Rights")->with(compact('user', 'roles'));
    }

    public function user_infoupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->personal_email = isset($request->personal_email) ? $request->personal_email : '';
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->emergency_number = isset($request->emergency_number) ? $request->emergency_number : '';
        $user->residential_address = isset($request->residential_address) ? $request->residential_address : '';
        $user->dob = isset($request->dob) ? $request->dob : '';
        $user->country = isset($request->country) ? $request->country : '';
        $user->zipcode = isset($request->zipcode) ? $request->zipcode : '';
        $user->gender = isset($request->gender) ? $request->gender : '';
        $user->education = isset($request->education) ? implode(',', $request->education) : '';
        $user->experience = isset($request->experience) ? implode(',', $request->experience) : '';
        $user->skill = isset($request->skill) ? implode(',', $request->skill) : '';
        $user->certifications = isset($request->certifications) ? implode(',', $request->certifications) : '';
        $user->marital_status = isset($request->marital_status) ? $request->marital_status : '';
        $user->blood_group = isset($request->blood_group) ? $request->blood_group : '';
        $user->save();
        return redirect()->back()->with('message', 'Information updated successfully');
    }

    public function password_update(Request $request)
    {
        $user = Auth::user();
        $userPassword = $user->password;

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password' => 'Password not match']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password successfully updated');
    }

    /**
     * Change the current password
     * @param Request $request
     * @return Renderable
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password' => 'password not match']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success', 'password successfully updated');
    }

    public function user_updates(Request $request)
    {

        $user = User::find($_POST['user_id']);
        if (!is_null($request->emp_id) && $request->emp_id != "") {
            $user->emp_id = $request->emp_id;
        }

        if (!is_null($request->role_id) && $request->role_id != "") {
            $user->role_id = $request->role_id;
        }

        if (!is_null($request->f_name) && $request->f_name != "") {
            $user->f_name = $request->f_name;
        }

        if (!is_null($request->l_name) && $request->l_name != "") {
            $user->l_name = $request->l_name;
        }

        if (!is_null($request->email) && $request->email != "") {
            $user->email = $request->email;
        }

        if (!is_null($request->phonenumber) && $request->phonenumber != "") {
            $user->phonenumber = $request->phonenumber;
        }

        if (!is_null($request->gender) && $request->gender != "") {
            $user->gender = $request->gender;
        }

        if (!is_null($request->status) && $request->status != "") {
            $user->is_active = $request->status;
        }

        $user->save();

        return redirect()->back()->with('message', 'Information updated successfully');
    }

    public function add_category(Request $request){

        if(isset($request->edit_id)){
            if(request()->file('file') && request()->file('logo')){

                $fileName = null;
                $file = request()->file('file');
                $file->move('./public/uploads/pages/', $file->getClientOriginalName());

                $logo = request()->file('logo');
                $logo->move('./public/uploads/pages/', $file->getClientOriginalName());

                $result = category::where('id',$request->edit_id)->update(['name'=>$request->name, 'name_urdu'=>$request->name_urdu, 'description'=>$request->desc, 'file' => $file->getClientOriginalName(),
                'logo' => $logo->getClientOriginalName(), 'is_active'=>$request->status]);

            }else if(request()->file('file')){
                $fileName = null;
                $file = request()->file('file');
                $file->move('./public/uploads/pages/', $file->getClientOriginalName());

                $result = category::where('id',$request->edit_id)->update(['name'=>$request->name, 'name_urdu'=>$request->name_urdu, 'description'=>$request->desc, 'file' => $file->getClientOriginalName(), 'is_active'=>$request->status]);
            }else if(request()->file('logo')){

                $fileName = null;
                $logo = request()->file('logo');
                $logo->move('./public/uploads/pages/', $logo->getClientOriginalName());

                $result = category::where('id',$request->edit_id)->update(['name'=>$request->name, 'name_urdu'=>$request->name_urdu, 'description'=>$request->desc, 'logo' => $logo->getClientOriginalName(), 'is_active'=>$request->status]);
            }else{
                $result = category::where('id',$request->edit_id)->update(['name'=>$request->name, 'name_urdu'=>$request->name_urdu, 'description'=>$request->desc, 'is_active'=>$request->status]);
            }
        }else{
            $file = request()->file('file');
            $logo = request()->file('logo');
            $fileName = $file->getClientOriginalName();
            $logoName = $logo->getClientOriginalName();

            $file->move('./public/uploads/pages/', $file->getClientOriginalName());
            $logo->move('./public/uploads/pages/', $logo->getClientOriginalName());

            $result = category::create([
                'name' => request()->get('name'),
                'name_urdu'=>request()->get('name_urdu'),
                'description' => request()->get('desc'),
                'logo' => $logoName,
                'file' => $fileName,
            ]);

        }
        if($result){
            return redirect()->route('manage_category');
        }
    }

    public function add_banner(Request $request){

        if(isset($request->edit_id)){
            if(request()->file('file')){

                $fileName = null;
                $file = request()->file('file');
                $file->move('./public/uploads/pages/', $file->getClientOriginalName());

                $result = banner::where('id',$request->edit_id)->update(['file' => $file->getClientOriginalName(), 'is_active'=>$request->is_active]);

            }else{
                $result = banner::where('id',$request->edit_id)->update(['is_active'=>$request->is_active]);
            }
        }else{
            $file = request()->file('file');
            $fileName = $file->getClientOriginalName();

            $file->move('./public/uploads/pages/', $file->getClientOriginalName());

            $result = banner::create([
                'file' => $fileName,
            ]);

        }
        if($result){
            return redirect()->route('manage_banner');
        }
    }

    public function add_product(Request $request)
    {

        if (request()->get('month') == "Jan") {
            $Urdu_month = "جنوری";
        } elseif (request()->get('month') == "Feb") {
            $Urdu_month = "فروری";
        } elseif (request()->get('month') == "Mar") {
            $Urdu_month = "مارچ";
        } elseif (request()->get('month') == "Apr") {
            $Urdu_month = "اپریل";
        } elseif (request()->get('month') == "May") {
            $Urdu_month = "مئی";
        } elseif (request()->get('month') == "Jun") {
            $Urdu_month = "جون";
        } elseif (request()->get('month') == "Jul") {
            $Urdu_month = "جولائی";
        } elseif (request()->get('month') == "Aug") {
            $Urdu_month = "اگست";
        } elseif (request()->get('month') == "Sep") {
            $Urdu_month = "ستمبر";
        } elseif (request()->get('month') == "Oct") {
            $Urdu_month = "اکتوبر";
        } elseif (request()->get('month') == "Nov") {
            $Urdu_month = "نومبر";
        } elseif (request()->get('month') == "Dec") {
            $Urdu_month = "دسمبر";
        }


        $fileName = null;
        $file = request()->file('product_img_1');
        $file->move('./public/uploads/pages/', $file->getClientOriginalName());

        $cat = category::where('id', $request->cat_id)->first();
        $result = product::create([
            'name' => $cat->name." ".request()->get('month')." ".request()->get('year') ,
            'name_urdu' => $cat->name_urdu." ".$Urdu_month." ".request()->get('year'),
            'cat_id' => request()->get('cat_id'),
            'file' => $file->getClientOriginalName(),
            'year' => request()->get('year'),
            'month' => request()->get('month'),
            'price' => request()->get('price'),
        ]);

        if ($result->id) {
            if (request()->file('product_img_2')) {
                for ($a = 2; request()->file("product_img_" . $a); $a++) {
                    $fileName = null;
                    $file = request()->file('product_img_' . $a);
                    $file->move('./public/uploads/pages/', $file->getClientOriginalName());

                    $res = page_image::create([
                        'product_id' => $result->id,
                        'file' => $file->getClientOriginalName()
                    ]);
                }
            }
        }
        if ($result) {
            return redirect()->route('manage_product');
        }
    }

    public function update_book(Request $request)
    {
        $book = book::find($request->edit_id);
        $book->post_title = $request->post_title;
        $book->post_title_urdu = $request->post_title_urdu;
        $book->writer_name = $request->writer_name;
        $book->price = $request->price;
        $book->save();

        if (isset($request->watermark)) {
            $mark = 1;
        } else {
            $mark = 0;
        }

        $file = request()->file('file');

        if ($file && $book) {
            if ($request->file_type == 'pdf') {
                $path = 'public/uploads/products/' . $book->id;

                if (File::exists(public_path('uploads/products/' . $book->id))) {
                    File::deleteDirectory(public_path('uploads/products/' . $book->id));
                    $remove = product_file::where('product_id', $book->id)->delete();
                }

                $fileName = null;

                $file->move(base_path($path), $file->getClientOriginalName());

                $product_file = product_file::create([
                    'product_id' => $book->id,
                    'file_type' => $request->file_type,
                    'file' => $file->getClientOriginalName(),
                    'watermark' => $mark
                ]);
            } else if ($request->file_type == 'images') {

                $path = 'public/uploads/products/' . $book->id;
                $path2 = 'public/uploads/products/' . $book->id ."/";
                $path3 = 'public/images/';

                if (public_path('uploads/products/' . $book->id)) {
                    File::deleteDirectory(public_path('uploads/products/' . $book->id));
                    $remove = product_file::where('product_id', $book->id)->delete();
                }

                $fileName = null;
                $a = 0;

                foreach ($file as $value) {
                    $a++;
                    if (!empty($value)) {
                        $value->move(base_path($path2), $value->getClientOriginalName());

                        $w_mark = base_path($path3) . "watermark.png";
                        $explode = explode('.', $value->getClientOriginalName());
                        $uploadimage = base_path($path2) . $value->getClientOriginalName();
                        $upload_file = $value->getClientOriginalName() . "_thumbnail.png";

                        $thumbnail = $uploadimage . "_thumbnail.png";

                        if ($explode[1] == 'png') {
                            $source = imagecreatefrompng($uploadimage);
                        } else if ($explode[1] == 'gif') {

                            $im = imagecreatefromgif($uploadimage);
                            $tmp = imagecreatetruecolor(imagesx($im), imagesy($im));
                            $bg = imagecolorallocate($tmp, 255, 255, 255);
                            imagefill($tmp, 0, 0, $bg);
                            imagecopy($tmp, $im, 0, 0, 0, 0, imagesx($im), imagesy($im));
                            $source = $tmp;
                        } else if ($explode[1] == 'jpg' || $explode[1] == 'jpeg') {
                            $source = imagecreatefromjpeg($uploadimage);
                        }

                        if ($mark) {
                            $watermark = imagecreatefrompng($w_mark);
                            $water_width = imagesx($watermark);
                            $water_height = imagesy($watermark);

                            $main_width = imagesx($source);
                            $main_height = imagesy($source);

                            $dime_x = 0;
                            $dime_y = 0;

                            $copy = imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);

                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            $change = imagepng($source, $thumbnail);
                        } else {
                            $upload_file = $value->getClientOriginalName();
                        }

                        $product_file = product_file::create([
                            'product_id' => $book->id,
                            'file_type' => $request->file_type,
                            'file' => $upload_file,
                            'watermark' => $mark
                        ]);
                    }
                }
                    // dd($a);
            }
        }
        return redirect()->route('manage_book');
    }

    public function add_book(Request $request)
    {
        $product_id = product::find($request->edit_id);
        $product = book::create([
            'product_id' => $product_id->id,
            'post_title' => $request->post_title,
            'post_title_urdu' => $request->post_title_urdu,
            'writer_name' => $request->writer_name,
            'price' => $request->price,
            'file_type' => $request->file_type
        ]);

        if (isset($request->watermark)) {
            $mark = 1;
        } else {
            $mark = 0;
        }
        if ($product) {
            if ($request->file_type == 'pdf') {
                $path = 'public/uploads/products/' . $product_id->id;

                if (File::exists(public_path('uploads/products/' . $product->id))) {
                    File::deleteDirectory(public_path('uploads/products/' . $product->id));
                    $remove = product_file::where('product_id', $product->id)->delete();
                }

                $fileName = null;

                $file = request()->file('file');

                $file->move(base_path($path), $file->getClientOriginalName());

                $product_file = product_file::create([
                    'product_id' => $product->id,
                    'file_type' => $request->file_type,
                    'file' => $file->getClientOriginalName(),
                    'watermark' => $mark
                ]);
            } else if ($request->file_type == 'images') {

                $path = 'public/uploads/products/' . $product->id;
                $path2 = 'public/uploads/products/' . $product->id ."/";
                $path3 = 'public/images/';

                if (public_path('uploads/products/' . $product->id)) {
                    File::deleteDirectory(public_path('uploads/products/' . $product->id));
                    $remove = product_file::where('product_id', $product->id)->delete();
                }

                $fileName = null;

                $file = request()->file('file');


                foreach ($file as $value) {
                    if (!empty($value)) {
                        $value->move(base_path($path2), $value->getClientOriginalName());

                        // ini_set("memory_limit", "256M");
                        $w_mark = base_path($path3) . "watermark.png";
                        $explode = explode('.', $value->getClientOriginalName());
                        $uploadimage = base_path($path2) . $value->getClientOriginalName();
                        $upload_file = $value->getClientOriginalName() . "_thumbnail.png";

                        $thumbnail = $uploadimage . "_thumbnail.png";

                        if ($explode[1] == 'png') {
                            $source = imagecreatefrompng($uploadimage);
                        } else if ($explode[1] == 'gif') {

                            $im = imagecreatefromgif($uploadimage);
                            $tmp = imagecreatetruecolor(imagesx($im), imagesy($im));
                            $bg = imagecolorallocate($tmp, 255, 255, 255);
                            imagefill($tmp, 0, 0, $bg);
                            imagecopy($tmp, $im, 0, 0, 0, 0, imagesx($im), imagesy($im));
                            $source = $tmp;
                        } else if ($explode[1] == 'jpg' || $explode[1] == 'jpeg') {
                            $source = imagecreatefromjpeg($uploadimage);
                        }

                        if ($mark) {
                            $watermark = imagecreatefrompng($w_mark);
                            $water_width = imagesx($watermark);
                            $water_height = imagesy($watermark);

                            $main_width = imagesx($source);
                            $main_height = imagesy($source);

                            $dime_x = 0;
                            $dime_y = 0;


                            $copy = imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);

                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            $change = imagepng($source, $thumbnail);
                        } else {
                            $upload_file = $value->getClientOriginalName();
                        }

                        $product_file = product_file::create([
                            'product_id' => $product->id,
                            'file_type' => $request->file_type,
                            'file' => $upload_file,
                            'watermark' => $mark
                        ]);
                    }
                }
            }
        }
        return redirect()->route('manage_product');
    }

    public function readBook(Request $request){
        $product = product_file::where('product_id', $request->pro_id)->where('is_active', 1)->get();
        return $product;
    }

    public function edit_product(Request $request){

        if($request->month != null){

            $date = explode("-",request()->get('month'));

            if($date[1] == 1){
                $month = "Jan";
            }elseif($date[1] == 2){
                $month = "Feb";
            }elseif($date[1] == 3){
                $month = "Mar";
            }elseif($date[1] == 4){
                $month = "Apr";
            }elseif($date[1] == 5){
                $month = "May";
            }elseif($date[1] == 6){
                $month = "Jun";
            }elseif($date[1] == 7){
                $month = "Jul";
            }elseif($date[1] == 8){
                $month = "Aug";
            }elseif($date[1] == 9){
                $month = "Sep";
            }elseif($date[1] == 10){
                $month = "Oct";
            }elseif($date[1] == 11){
                $month = "Nov";
            }elseif($date[1] == 12){
                $month = "Dec";
            }

            $result = product::where('id',$request->prod_id)->update([
                'year' => $date[0],
                'month' => $month,
            ]);
        }

        if(request()->file('file')){
            $fileName = null;
            $file = request()->file('file');
            $file->move('./public/uploads/pages/', $file->getClientOriginalName());

            $result = product::where('id',$request->prod_id)->update([
                'name'=>$request->name,
                'name_urdu'=>$request->name_urdu,
                'description'=>$request->description,
                'cat_id'=>$request->cat_id,
                'file' => $file->getClientOriginalName(),
                'price' => request()->get('price'),
                'is_active' => request()->get('is_active'),
            ]);
        }else{
            $result = product::where('id',$request->prod_id)->update([
                'name'=>$request->name,
                'name_urdu'=>$request->name_urdu,
                'description'=>$request->description,
                'cat_id'=>$request->cat_id,
                'price' => request()->get('price'),
                'is_active' => request()->get('is_active'),
            ]);
        }
        $imgagess = page_image::where("is_active",1)->get();
        foreach($imgagess as $img){
            if(request()->file("product_img_".$img->id)){
                $fileName = null;
                $file = request()->file('product_img_'.$img->id);
                $file->move('./public/uploads/pages/', $file->getClientOriginalName());

                $res = page_image::where('id',$img->id)->update([
                    'file' => $file->getClientOriginalName()
                ]);
            }
        }
        return redirect()->route('manage_product');

    }

    public function pro_img_destroy(page_image $id)
    {
        $id->delete();
        return redirect()->route('manage_product')
        ->with('success','Image deleted successfully');
    }

    public function add_to_cart($id){

        $id = Crypt::decrypt($id);
        $product = book::where('books.id', $id)->join('products', 'books.product_id', 'products.id')->select('products.file', 'products.year', 'products.month', 'books.*')->get();
        $categories = category::where('id', 8)->where('is_deleted', 0)->get();
        $novel = product::where('cat_id', 8)->where('is_active', 1)->where('is_deleted', 0)->get();

        return view("web.pages.add_to_cart")->with(compact('product', 'categories', 'novel'));

    }

    public function place_order(Request $request){

        $password = Str::random(10);
        if(Auth::user()){
            $result = Auth::user();
        }else{

            $result = User::create([
                'f_name' => $request->get('f_name'),
                'l_name' => $request->get('l_name'),
                'gender' => $request->get('gender'),
                'email' => $request->get('email'),
                'number' => $request->get('number'),
                'password' => Hash::make($password),
                'role_id' => 4,
                'is_active' => 1,
            ]);

            $details = [
                'email' => $request->get('email'),
                'password' => $password,
                'msg' => "You have successfuly place order plese login from these crediantials"
            ];
        }

        $order = order::create([
            'user_id' => $result->id,
            'amount' => $request->get('qty')*$request->get('amount')+$request->get('shipping_charges'),
            'status' => "Pending",
        ]);

        $order_items = order_item::create([
            'order_id' => $order->id,
            'user_id' => $result->id,
            'product_id' => $request->get('product_id'),
            'qty' => $request->get('qty'),
            'amount' => $request->get('qty')*$request->get('amount')+$request->get('shipping_charges'),
        ]);

        $shipping_address = shipping_address::create([
            'user_id' => $result->id,
            'order_id' => $order_items->id,
            'shipping_f_name' => $request->get('shipping_f_name'),
            'shipping_l_name' => $request->get('shipping_l_name'),
            'shipping_country' => $request->get('shipping_country'),
            'shipping_gender' => $request->get('shipping_gender'),
            'shipping_address' => $request->get('shipping_address'),
            'shipping_city' => $request->get('shipping_city'),
            'shipping_email' => $request->get('shipping_email'),
            'shipping_phonenumber' => $request->get('shipping_phonenumber'),
            'shipping_charges' => $request->get('shipping_charges')
        ]);

        if(!Auth::user()){
            $ab = Mail::to($_POST['email'])->send(new MailSentpassword($details));
        }
        return redirect()->route('welcome');

    }

    public function order_status_change(Request $request){
        $result = order_item::where('id',$request->edit_id)->update(['status' => $request->status]);
        return redirect()->route('manage_orders');
    }

    public function add_page_images(Request $request){
        // dd($request);
        if(isset($request->edit_id)){
            if(request()->file('img')){
                $fileName = null;
                $file = request()->file('img');
                $file->move('./public/uploads/pages/', $file->getClientOriginalName());
                $result = page_image::where('id',$request->edit_id)->update(['file' => $file->getClientOriginalName(), 'product_id'=>$request->product_id, 'is_active'=>$request->status]);
            }else{
                $result = page_image::where('id',$request->edit_id)->update(['product_id'=>$request->product_id, 'is_active'=>$request->status]);
            }
        }else{
            $fileName = null;
            $file = request()->file('img');
            $file->move('./public/uploads/pages/', $file->getClientOriginalName());

            $result = page_image::create([
                'name' => request()->get('name'),
                'desc' => request()->get('desc'),
                'product_id' => request()->get('product_id'),
                'file' => $file->getClientOriginalName()
            ]);
        }
        if($result){
            return redirect()->route('manage_images');
        }
    }

    public function select_category(Request $request)
    {
        $year = product::where('cat_id', $request->cat_id)->distinct()->get(['year']);

        if ($year) {
            $msg_body = "<option >Select Any Year</option>";
            foreach ($year as $value) {
                $msg_body .= "<option value='".$value['year']."'>".$value['year']."</option>";
            }
        }
        return $msg_body;
    }

    public function select_year(Request $request)
    {
        $month = product::where('cat_id', $request->cat_id)->where('year', $request->year)->distinct()->get(['month']);

        if ($month) {
            $msg_body = "<option >Select Any Month </option>";
            foreach ($month as $value) {
                $msg_body .= "<option value='".$value['month']."'>".$value['month']."</option>";
            }
        }
        return $msg_body;
    }

    public function select_month(Request $request)
    {
        $products = product::where('cat_id', $request->cat_id)->where('year', $request->year)->where('month', $request->month)->get();
        if ($products) {
            $msg_body = "<div class='row'>";
            foreach ($products as $value) {
                $msg_body .= "<div class='col-lg-3'>".$value['name']."</div>";
                $msg_body .= "<div class='col-lg-3'>".$value['month']."</div>";
                $msg_body .= "<div class='col-lg-3'>".$value['year']."</div>";
                $msg_body .= "<div class='col-lg-3'> <a href='".route('add_to_cart',$value['id'])."' class='cta-btn'> Details </a> </div>";
            }
            $msg_body .= "</div>";
            $msg_body = "<a href='".route('view_books',Crypt::encrypt($products[0]['id']))."' class='get-a-quote cta-btn search_btn'> Search </a>";
        }

        return $msg_body;
    }

    public function add_blog(Request $request){

        $fileName = null;
        $file = request()->file('file');
        $file->move('./public/uploads/pages/', $file->getClientOriginalName());

        $result = blog::create([
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'title' => request()->get('title'),
            'description' => request()->get('description'),
            'file' => $file->getClientOriginalName(),
            'is_active' => 0
        ]);

        if($result){

            $details = [
                'id' => Crypt::encrypt($result->id),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'type' => "blog",
            ];
            $ab = Mail::to($_POST['email'])->send(new MailVerification($details));

            return redirect()->route('blogs');
        }
    }

    public function active_blog(Request $request){

        $blog = blog::find($request->id);
        $blog->is_active = $request->is_active;
        $blog->save();

        return redirect()->route('manage_blog');

    }

    public function active_book(Request $request)
    {

        $blog = book::find($request->id);
        $blog->is_active = $request->is_active;
        $blog->save();

        return redirect()->route('manage_blog');
    }

    public function active_comment(Request $request){

        $blog = blog_comment::find($request->id);
        $blog->is_active = $request->is_active;
        $blog->save();

        return redirect()->route('manage_blog_comment');

    }

    public function email_verify($id){

        $blog = blog::find(Crypt::decrypt($id));
        $blog->is_approved = 1;
        $blog->save();

        return redirect()->route('blogs');

    }

    public function email_verify_for_comment($id){

        $blog = blog_comment::find(Crypt::decrypt($id));
        $blog->is_approved = 1;
        $blog->save();

        return redirect()->route('blogs');

    }

    public function send_comment(Request $request){

        $result = blog_comment::create([
            'comment' => request()->get('comment'),
            'blog_id' => request()->get('blog_id'),
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'is_active' => 0
        ]);
        if($result){
            $details = [
                'id' => Crypt::encrypt($result->id),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'type' => "blog_comment",
            ];
            $ab = Mail::to($_POST['email'])->send(new MailVerification($details));

            return redirect()->route('blogs_detail',request()->get('blog_id'));
        }
    }

    public function shift_change()
    {


    }

// office details start

    public function user_office_details()
    {
        $user = Auth::user();

        if ($user->role_id != 1) {

            return redirect()->route("welcome");

        }

        return view('user-office-details')->with('title',"Office Details")->with(compact('user'));

    }

    public function user_office_infoupdate(Request $request)
    {

        $user = User::find(Auth::user()->id);



        // $user->emp_id = $request->emp_id;

        // $user->email = $request->email;

        // $user->designation = $request->designation;

        // $user->department = $request->department;

        // $user->join_date = $request->join_date;

        // $user->reporting_line = $request->reporting_line;

        $user->bank_account_number = $request->bank_account_number;

        $user->v_model_name = $request->v_model_name;

        $user->v_model_year = $request->v_model_year;

        $user->v_number_plate = $request->v_number_plate;



        $user->save();

        // Session::flash('message', 'This is a message!');

         Session::flash('alert-class', 'alert-danger');

        return redirect()->back()->with('message', 'Information updated successfully');

    }

// office details end

// file details start

    public function user_file_details()
    {

        $user = Auth::user();

        return view('user-file-details')->with('title',"file Details")->with(compact('user'));

    }

    public function user_file_infoupdate(Request $request)
    {

        // $user = User::find(Auth::user()->id);



        // $user->emp_id = $request->emp_id;

        // $user->email = $request->email;

        // $user->designation = $request->designation;

        // $user->department = $request->department;

        // $user->join_date = $request->join_date;

        // $user->reporting_line = $request->reporting_line;

        // $user->bank_account_number = $request->bank_account_number;

        // $user->v_model_name = $request->v_model_name;

        // $user->v_model_year = $request->v_model_year;

        // $user->v_number_plate = $request->v_number_plate;



        // $user->save();

        // Session::flash('message', 'This is a message!');

        // Session::flash('alert-class', 'alert-danger');

        // return redirect()->back()->with('success', 'Information updated successfully');

    }

// file details end

    public function upload_image(Request $request)
    {

        $user = User::find(Auth::user()->id);

        $path = "";

        if ($request->file('pic_attach') != '') {

            $path = ($request->file('pic_attach'))->store('public/uploads/avatar/'.md5(Str::random(20)), 'public');

        }

        $user->profile_pic = $path;

        $user->save();

        return redirect()->back()->with('success', 'Image has been successfully updated');

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

                $path_a = ($request->file('avatar'))->store('public/uploads/avatar/'.md5(Str::random(20)), 'public');

                $user->profile_pic = $path_a;

                $user->save();

                return redirect()->back()->with('message', 'Profile Picture been updated successfully');

            }

            else{

                 return redirect()->back()->with('error', 'File not found, please update your Profile Picture');

            }

        }

        // Resume Upload

        if ($request->has('cnic_file')) {

            if ($request->file('cnic_file') != '') {

            $request->validate([

             'cnic_file' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']

            ]);

            $path_c = ($request->file('cnic_file'))->store('public/uploads/cnic/'.md5(Str::random(20)), 'public');

            $user->cnic_doc = $path_c;

            $user->save();

            return redirect()->back()->with('message', 'NIC Picture has been updated successfully');

        }

            else{

                 return redirect()->back()->with('error', 'File not found, please update your NIC Picture');

            }

        }

        // // CNIC Upload

        if ($request->has('cv_file')) {

            if ($request->file('cv_file') != '') {

            $request->validate([

             'cv_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']

            ]);

            $path_r = ($request->file('cv_file'))->store('public/uploads/resume/'.md5(Str::random(20)), 'public');

            $user->resume_doc = $path_r;

            $user->save();

            return redirect()->back()->with('message', 'Resume/CV Document has been updated successfully');

        }

            else{

                 return redirect()->back()->with('error', 'File not found, please update your Resume/CV Document');

            }

        }

       // // Education Upload

        if ($request->has('education_file')) {

            if ($request->file('education_file') != '') {

            $request->validate([

             'education_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']

            ]);

            $path_e = ($request->file('education_file'))->store('public/uploads/education/'.md5(Str::random(20)), 'public');

            $user->education_doc = $path_e;

            $user->save();

            return redirect()->back()->with('message', 'Education Document has been updated successfully');

        }

            else{

                 return redirect()->back()->with('error', 'File not found, please update your Education Document');

            }

        }

    }

    public function add_applicant()
    {
        return view('web.add-applicant')->with('title', "Add Applicant");
    }

    public function config()
    {

        $user = Auth::user();

        if ($user->role_id != 1) {

            return redirect()->route("welcome");

        }

        $config = config::all();

        return view('config')->with('title', "System Configuration")->with(compact('user', 'config'));

    }

    public function config_update(Request $request)
    {

        $token_ignore = ['_token' => ''];

        $post_feilds = array_diff_key($_POST, $token_ignore);

        foreach ($post_feilds as $key => $value) {

            $config = config::where("type", $key)->first();

            $config->value = $value;

            $config->save();

        }

        return redirect()->back()->with('message', 'Setting has been updated.');
    }

}

