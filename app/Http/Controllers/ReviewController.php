<?php
namespace App\Http\Controllers;
use App\Models\reviews;
use Illuminate\Http\Request;
// use Request;
use Illuminate\Support\Facades\DB;
use Helper;
use Auth;
class ReviewController extends Controller
{
    
    public function reviews_index()
    {
        $menu='reviews';
        // $reviews = reviews::where('user_id',Auth::user()->id)->latest()->paginate(10);
        $reviews = reviews::latest()->paginate(10);
        // dd($reviews);
        return view('reviews.index',compact('reviews',"menu"))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function reviews_store(Request $request)
    {
        $this->validate($request,[
            // 'type'=> 'required',
            'name'=> 'required',
            'slug'=> 'required',
            'details'=> 'required',
            'post_by'=> 'required',
            'created_at'=> 'required',
            'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:50000',
            // 'file'=> 'required|mimes:mp4,ppx,pdf,ogv,jpg,webm|max:100000',
        ]);
        if($request->hasFile('img')){
            $imgnumber=rand();
            $img = $request->file('img');
            $img->move(base_path('public/uploads/reviews'),'_'.$imgnumber.'.'.$img->getClientOriginalName());
            $imgNameToStore = 'uploads/reviews/'.'_'.$imgnumber.'.'.$img->getClientOriginalName();
            // dd($imgNameToStore);
        }else{
            $imgNameToStore = 'no-img-avalible.png';
        }
        if($request->hasFile('file')){
            $filenumber=rand();
            $file = $request->file('file');
            $file->move(base_path('public/uploads/reviews'),'_'.$filenumber.'.'.$file->getClientOriginalName());
            $fileNameToStore = 'uploads/reviews/'.'_'.$filenumber.'.'.$file->getClientOriginalName();
        }else{
            $fileNameToStore = 'no-img-avalible.png';
        }
        $reviews = new reviews;
        $reviews->name = $request->input('name');
        $reviews->slug = $request->input('slug');
        $reviews->details = $request->input('details');
        $reviews->user_id = $request->input('user_id');
        $reviews->post_by = $request->input('post_by');
        $reviews->created_at = $request->input('created_at');
        // $reviews->file = $fileNameToStore;
        $reviews->img = $imgNameToStore;
        $reviews->save();
        return redirect()->route('reviews_index')
                        ->with('success','Review created successfully.');
    }
    public function reviews_edit($id, Request $request)
    {
            $data = DB::table('reviews')->where('id', $id)->first();
            return response()->json($data);
     }
         public function reviews_show($id, Request $request)
    {
            $data = DB::table('reviews')->where('id', $id)->first();
            return response()->json($data);
     }
    public function reviews_update(Request $request)
    {
        if(($request->img)&&($request->file)){
           $this->validate($request,[
            // 'type'=> 'required',
            'name'=> 'required',
            'slug'=> 'required',
            'details'=> 'required',
            'post_by'=> 'required',
            'created_at'=> 'required',
            'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:50000',
            // 'file'=> 'required|mimes:mp4,ppx,pdf,ogv,jpg,webm|max:100000',
        ]); 
        }elseif($request->img){
         $this->validate($request,[
            // 'type'=> 'required',
            'name'=> 'required',
            'slug'=> 'required',
            'details'=> 'required',
            'post_by'=> 'required',
            'created_at'=> 'required',
            'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:50000',
        ]);   
       }elseif($request->file){
           $this->validate($request,[
            // 'type'=> 'required',
            'name'=> 'required',
            'slug'=> 'required',
            'details'=> 'required',
            'post_by'=> 'required',
            'created_at'=> 'required',
            // 'file'=> 'required|mimes:mp4,ppx,pdf,ogv,jpg,webm|max:100000',
        ]);   
        }else{
            $this->validate($request,[
            // 'type'=> 'required',
            'name'=> 'required',
            'slug'=> 'required',
            'details'=> 'required',
            'post_by'=> 'required',
            'created_at'=> 'required',
        ]); 
        }
        $data = array();
        $id = $request->input('id');
        // $data['type'] = $request->input('type');
        $data['name'] = $request->input('name');
        $data['slug'] = $request->input('slug');
        $data['details'] = $request->input('details');
        $data['user_id'] = $request->input('user_id');
        $data['post_by'] = $request->input('post_by');
        $data['created_at'] = $request->input('created_at');
        if($request->img){
            $imgnumber=rand();
            // dd($imgnumber);
            $img = $request->file('img');
            $img->move(base_path('public/uploads/reviews'),'_'.$imgnumber.'.'.$img->getClientOriginalName());
            $imgNameToStore = 'uploads/reviews/'.'_'.$imgnumber.'.'.$img->getClientOriginalName();
            $data['img'] = $imgNameToStore;
        }else{
            $imgNameToStore = 'no-img-avalible.png';
        }
        if($request->file){
            $filenumber=rand();
            $file = $request->file('file');
            $file->move(base_path('public/uploads/reviews'),'_'.$filenumber.'.'.$file->getClientOriginalName());
            $fileNameToStore = 'uploads/reviews/'.'_'.$filenumber.'.'.$file->getClientOriginalName();
            $data['file'] = $fileNameToStore;
        }else{
            $fileNameToStore = 'no-img-avalible.png';
        }
        $review = reviews::where('id', $id)->update($data);
        return redirect()->route('reviews_index')
                        ->with('success','Review updated successfully');
    }
    public function reviews_destroy(reviews $id)
    {
        $id->delete();
        return redirect()->route('reviews_index')
                        ->with('success','Review deleted successfully');
    }
    public function reviews_status(Request $request)
    {
        $reviews = reviews::find($request->id);
        $reviews->is_confirm = $request->is_confirm;
        $reviews->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}