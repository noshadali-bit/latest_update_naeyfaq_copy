<?php
namespace App\Http\Controllers;
use App\Models\blogs;
use Illuminate\Http\Request;
// use Request;
use Illuminate\Support\Facades\DB;
use Helper;
use Auth;
class BlogController extends Controller
{
    
    public function blogs_index()
    {
        $menu='blogs';
        // $blogs = blogs::where('user_id',Auth::user()->id)->latest()->paginate(10);
        $blogs = blogs::latest()->paginate(10);
        // dd($blogs);
        return view('blogs.index',compact('blogs',"menu"))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function blogs_store(Request $request)
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
            $img->move(base_path('public/uploads/blogs'),'_'.$imgnumber.'.'.$img->getClientOriginalName());
            $imgNameToStore = 'uploads/blogs/'.'_'.$imgnumber.'.'.$img->getClientOriginalName();
            // dd($imgNameToStore);
        }else{
            $imgNameToStore = 'no-img-avalible.png';
        }
        if($request->hasFile('file')){
            $filenumber=rand();
            $file = $request->file('file');
            $file->move(base_path('public/uploads/blogs'),'_'.$filenumber.'.'.$file->getClientOriginalName());
            $fileNameToStore = 'uploads/blogs/'.'_'.$filenumber.'.'.$file->getClientOriginalName();
        }else{
            $fileNameToStore = 'no-img-avalible.png';
        }
        $blogs = new blogs;
        $blogs->name = $request->input('name');
        $blogs->slug = $request->input('slug');
        $blogs->details = $request->input('details');
        $blogs->user_id = $request->input('user_id');
        $blogs->post_by = $request->input('post_by');
        $blogs->created_at = $request->input('created_at');
        // $blogs->file = $fileNameToStore;
        $blogs->img = $imgNameToStore;
        $blogs->save();
        return redirect()->route('blogs_index')
                        ->with('success','blog created successfully.');
    }
    public function blogs_edit($id, Request $request)
    {
            $data = DB::table('blogs')->where('id', $id)->first();
            return response()->json($data);
     }
         public function blogs_show($id, Request $request)
    {
            $data = DB::table('blogs')->where('id', $id)->first();
            return response()->json($data);
     }
    public function blogs_update(Request $request)
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
            $img->move(base_path('public/uploads/blogs'),'_'.$imgnumber.'.'.$img->getClientOriginalName());
            $imgNameToStore = 'uploads/blogs/'.'_'.$imgnumber.'.'.$img->getClientOriginalName();
            $data['img'] = $imgNameToStore;
        }else{
            $imgNameToStore = 'no-img-avalible.png';
        }
        if($request->file){
            $filenumber=rand();
            $file = $request->file('file');
            $file->move(base_path('public/uploads/blogs'),'_'.$filenumber.'.'.$file->getClientOriginalName());
            $fileNameToStore = 'uploads/blogs/'.'_'.$filenumber.'.'.$file->getClientOriginalName();
            $data['file'] = $fileNameToStore;
        }else{
            $fileNameToStore = 'no-img-avalible.png';
        }
        $blog = blogs::where('id', $id)->update($data);
        return redirect()->route('blogs_index')
                        ->with('success','blog updated successfully');
    }
    public function blogs_destroy(blogs $id)
    {
        $id->delete();
        return redirect()->route('blogs_index')
                        ->with('success','blog deleted successfully');
    }
     public function blogs_status(Request $request)
    {
        $blogs = blogs::find($request->id);
        $blogs->is_active = $request->is_active;
        $blogs->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}