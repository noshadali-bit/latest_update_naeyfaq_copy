<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Helper;
use App\Models\User;
use App\Models\attributes;
use App\Models\category;
use App\Models\banner;
use App\Models\product;
use App\Models\book;
use App\Models\blog;
use App\Models\blog_comment;
use App\Models\page_image;
use App\Models\order_item;
use App\Models\shipping_address;
use App\Models\leave_application;
use App\Imports\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manage_category()
    {
        $category = category::where('is_deleted' , 0)->get();
        return view('reports/manage_category')->with(compact('category'));
    }
    public function manage_product()
    {
        $product = product::where('is_deleted' , 0)->get();
        $category = category::where('is_deleted' , 0)->get();
        return view('reports/manage_product')->with(compact('product','category'));
    }

    public function manage_book()
    {
        $book = book::select('categories.name as cat_name', 'products.name as pro_name', 'books.*' )
        ->leftjoin('products', 'books.product_id', 'products.id')
        ->leftjoin('categories', 'products.cat_id', 'categories.id')->where('books.is_deleted' , 0)->get();

        //dd($book);
        $product = product::where('is_deleted' , 0)->get();
        $category = category::where('is_deleted' , 0)->get();
        return view('reports/manage_book')->with(compact('product','category','book'));
    }

    public function add_product(){
        $product = product::where('is_deleted' , 0)->get();
        $category = category::where('is_deleted' , 0)->get();
        return view('reports/add_product')->with(compact('product','category'));
    }

    public function edit_product($id){
        $product = product::where('id',$id)->where('is_deleted' , 0)->get();
        $images = page_image::where("product_id", $product[0]->id)->where('is_deleted' , 0)->get();
        $category = category::where('is_deleted' , 0)->get();
        return view('reports/edit_product')->with(compact('product','images','category'));
    }

    public function manage_orders()
    {
        $order_item = order_item::join('users', 'users.id', 'orders_items.user_id')->join('products', 'products.id', 'orders_items.product_id')->select("users.f_name", "users.l_name", "products.name", "products.price", "orders_items.id", "orders_items.qty", "orders_items.amount", "orders_items.status")->where('orders_items.is_deleted' , 0)->get();
        $shipping_address = shipping_address::all();
        return view('reports/manage_orders')->with(compact('order_item', 'shipping_address'));
    }

    public function manage_banner()
    {
        $banner = banner::where('is_deleted' , 0)->get();

        return view('reports/manage_banner')->with(compact('banner'));
    }

    public function manage_blog()
    {

        $blog = blog::where('is_approved' , 1)->orderBy('id', 'DESC')->get();

        return view('reports/manage_blog')->with(compact('blog'));
    }

    public function manage_blog_comment()
    {
        $blog = blog_comment::where('is_approved' , 1)->orderBy('id', 'DESC')->get();

        return view('reports/manage_blog_comment')->with(compact('blog'));
    }

    public function purchased_product()
    {
        $order_item = order_item::where('orders_items.status' , "Delivered")->where('orders_items.is_active' , 1)->where('orders_items.user_id' , Auth::user()->id)->join('products','products.id','orders_items.id')->select("orders_items.id", "orders_items.product_id", "orders_items.qty", "orders_items.amount", "orders_items.created_at", "products.cat_id", "products.name", "products.description", "products.file", "products.year", "products.month", "products.price")->get();
    // dd($order_item);
        $img = page_image::where('is_deleted' , 0)->get();
        return view('reports/manage_order-items')->with(compact('img','order_item'));
    }

    public function registered_user_report()
    {

    	$user = Auth::user();

    	if ($user->role_id != 1 && Auth::user()->role_id != 36) {
    		return redirect()->back()->with('error', 'No Page Found');
    	}

        $all_user = User::where('is_deleted' , 0)->where('id' ,"!=", 1)->get();
    	$designation = attributes::where("is_active" , 1)->get();

    	return view('reports/registered-user-report')->with(compact('all_user','user','designation'));
    }

    public function all_registered_user_report($slug = '')
    {

        $user = Auth::user();

        if ($user->role_id != 1 && Auth::user()->role_id != 36) {
            return redirect()->back()->with('error', 'No Page Found');
        }
        $project_id = Session::get("project_id");
        $all_user = User::where('is_deleted' , 0)->where('project_id' , $project_id)->get();

        $designation = attributes::where("is_active" , 1)->get();

        return view('reports/all-registered-user-report')->with(compact('all_user','user','designation','slug'));

    }


    public function attendance_sheet_import()
    {
        $user = Auth::user();
        if ($user->role_id != 1 && Auth::user()->role_id != 36) {
            return redirect()->back()->with('error', 'No Page Found');
        }

        return view('reports/attendance-sheet-import')->with(compact('user'));
    }

    /*
    public function attendance_import_submit(Request $request)
    {
        if (!$request->has('file')) {
            return redirect()->back()->with('error', 'No file is attached.');
        }
        $extensions = array("xls","xlsx");
        $result = array($request->file('file')->getClientOriginalExtension());

        if(in_array($result[0],$extensions)){
            Excel::import(new AttendanceImport,request()->file('file'));
            return redirect()->back()->with('message', 'Attendance Sheet has been uploaded successfully');
        }else{
           return redirect()->back()->with('error', 'Only xlsx extension is allowed.');
        }
    }

    public function all_leave_application_report()
    {
        $project_id = Session::get("project_id");
        $leave_application = leave_application::where("project_id" ,$project_id)->where("is_active" ,1)->where("is_deleted" ,0)->get();
        return view('reports/all-leave-application-report')->with(compact('leave_application'));
    }
    */

    public function birthday_list()
    {
        $project_id = Session::get("project_id");
        $bday_currentmonth = User::whereMonth('dob', '=', Carbon::now()->format('m'))->whereDay('dob', '>=', Carbon::now()->format('d'))->where("project_id" ,$project_id)->where("is_active" ,1)->where("is_deleted" ,0)->get();
        $bday_upcoming = User::whereMonth('dob', '>=', Carbon::now()->format('m'))->whereDay('dob', '>=', Carbon::now()->format('d'))->where("project_id" ,$project_id)->where("is_active" ,1)->where("is_deleted" ,0)->get();
        $departments = attributes::where("is_active" , 1)->where('attribute',"departments")->get();
        return view('reports/birthday-list')->with(compact('bday_currentmonth','bday_upcoming','departments'));
    }


}
