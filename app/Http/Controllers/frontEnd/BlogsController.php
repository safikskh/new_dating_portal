<?php

namespace App\Http\Controllers\frontEnd;
use Brian2694\Toastr\Facades\Toastr;
use Response;
use App\Models\Blogs;
use App\Models\Categories;
use App\Models\Portal;
use App\Models\BlogComments;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BlogsController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      }     

      $blogs = Blogs::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
        ->where('status','1')
        ->paginate(6);

      $latestBlogs = Blogs::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))->limit(10)->get();

      $categories= Categories::all();


      return view('blogs',compact('blogs','latestBlogs','categories'));

    }

    public function search(Request $request)
    {

      $query = Blogs::query()
                    ->whereNotIn('user_id', auth()->user()->deactivateUserList())
                    ->where('status','1')
                    ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id));

          // If User Search
          if(!empty($request->search))
            {
                $query->where('title', 'LIKE', "%{$request->search}%")
                      ->orwhere('sub_title', 'LIKE', "%{$request->search}%")
                      ->orwhere('details', 'LIKE', "%{$request->search}%");
            }

      $blogs = $query->paginate(6);

      $latestBlogs = Blogs::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))->limit(10)->get();


      $categories= Categories::all();


      return view('blogs',compact('blogs','latestBlogs','categories'));

    }

    public function blogstore(Request $request)
    {

      if(auth()->user()->isDeactivate())
        {
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect('profile_security');
        }

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $this->validate($request,
              [
                'temp_image' => 'required',
                'title' => 'required',
                'sub_title' => 'required',
                'details' => 'required',
                'category_id' => 'required',
              ],
              [
                'temp_image.required' => 'Du skal uploade billede.',
                'title.required' => 'Titel input kræves',
                'sub_title.required' => 'Undertitel input kræves',
                'category_id.required' => 'Kategori input kræves',
                'details.required' => 'Detaljeret input kræves.',
              ]
            );

            //====== Blog Image Process ======>
              $current_date = Carbon::now()->toDateString();
              $image_path = "uploads/blog";
              $old_img_path = $request->temp_image;
              $new_img_path = $image_path.'/'.uniqid().'_'.$current_date.'.jpg';
              
              if(File::exists($request->temp_image))
                {
                  $image_name = $new_img_path;

                  if (!File::exists($image_path))
                  {
                    File::makeDirectory($image_path, 0777, true, true);
                  }

                  File::move($old_img_path, $new_img_path);
                }
              else
                {
                  $image_name = "uploads/event/default.jpg";
                }
            //====== Blog Image Process ======>

            $blog = new Blogs();
            $blog->user_id = Auth::user()->id;
            $blog->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
            $blog->title = $request->title;
            $blog->sub_title = $request->sub_title;
            $blog->details = $request->details;
            $blog->category_id = $request->category_id;
            $blog->image = $image_name;
            DB::beginTransaction();
              try {
                  if ($blog->save()) {
                    DB::commit();
                    Toastr::success('Blog oprettet med succes.', 'Success');
                    return redirect()->back();
                  }else{
                    DB::rollback();
                    Toastr::error('$e->getMessage()', 'Error');
                    return redirect()->back()->with('error',$e->getMessage());
                  }
              }catch (\Exception $e) {
                  DB::rollback();
                  return redirect()->back()->with('error',$e->getMessage());
              }

          }
          else
            {
              Toastr::error('Opdater medlemskab.', 'Error');
              return redirect()->route('plans.index');
            }
        }
      else
        {
          Toastr::error('Log ind på din konto.', 'Error');
          return redirect()->route('home');
        }

    
    }

    public function blogedit($id)
    {
        if(auth()->user()->isDeactivate()){
        return redirect('profile_security')->with('error','please active your account to access');
        }

        $latestBlogs = Blogs::orderBy('id','DESC')
        ->whereNotIn('user_id', auth()->user()->deactivateUserList())
        ->where('status','1')
        ->where('type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))->limit(10)->get();

        $data = Blogs::find($id);

        return view('blogedit',compact('data','latestBlogs'));
    }

    public function blogupdate(Request $request, $id)
    {

      if(auth()->user()->isDeactivate())
        {
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect('profile_security');
        }

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $this->validate($request,
              [
                'title' => 'required',
                'sub_title' => 'required',
                'details' => 'required',
              ],
              [
                'title.required' => 'Titel input kræves',
                'sub_title.required' => 'Undertitel input kræves',
                'details.required' => 'Detaljeret input kræves.',
              ]
            );

            $blog = Blogs::find($id);

            //====== blog Image Process ======>
              if($request->has('temp_image'))
                {
                  // For New Image
                    $current_date = Carbon::now()->toDateString();
                    $image_path = "uploads/blog";
                    $temp_img_path = $request->temp_image;
                    $new_img_path = $image_path.'/'.uniqid().'_'.$current_date.'.jpg';
                    
                    if(File::exists($request->temp_image))
                      {
                        $image_name = $new_img_path;

                        if (!File::exists($image_path))
                        {
                          File::makeDirectory($image_path, 0777, true, true);
                        }

                        File::move($temp_img_path, $new_img_path);
                      }
                    else
                      {
                        $image_name = "uploads/blog/default.jpg";
                      }
                  // For New Image

                  // Remove Old Image
                    if(File::exists($blog->image))
                      {
                      File::delete($blog->image);
                      }
                  // Remove Old Image

                }
              else
                {
                  $image_name = $blog->image;
                }
            //====== blog Image Process ======>

            
            $blog->title = $request->title;
            $blog->sub_title = $request->sub_title;
            $blog->details = $request->details;
            $blog->image = $image_name;
            $blog->save();

            Toastr::success('Blog opdatering vellykket.', 'Success');
            return redirect()->route('blogDetails',$id);

          }
          else
            {
              Toastr::error('Opdater medlemskab.', 'Error');
              return redirect()->route('plans.index');
            }
        }
      else
        {
          Toastr::error('Log ind på din konto.', 'Error');
          return redirect()->route('home');
        }
    
    }

    public function blogdeactive($id)
    {

      if(auth()->user()->isDeactivate())
        {
          Toastr::error('Aktivér din konto for at få adgang.', 'Error');
          return redirect('profile_security');
        }

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $blog = Blogs::find($id);
            $blog->status = "0";
            $blog->save();

            Toastr::success('Blog Blev Deaktiveret.', 'Success');
            return redirect()->back();

          }
          else
            {
              Toastr::error('Opdater medlemskab.', 'Error');
              return redirect()->route('plans.index');
            }
        }
      else
        {
          Toastr::error('Log ind på din konto.', 'Error');
          return redirect()->route('home');
        }
    
    }

    //SearchController.php
    public function autocomplete(Request $request){
       if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
        } 
        $term = $request->term;
        $results = array();
        $queries = DB::table('blogs')
        ->where('title', 'LIKE', '%'.$term.'%')
        ->take(5)->get();
        foreach ($queries as $query)
        {
          $results[] = [ 'id' => $query->id, 'value' => $query->title ];
        }
        return Response::json($results);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function poststore(Request $request)
    {
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      } 

      if(Auth::check())
        {
          if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){

            $this->validate($request, [
              'title'=>'required',
              'sub_title'=>'required',
              'details'=>'required',
              'image'=>'required',
            ]);

            //====== Blog Image Process ======>
                    $current_date = Carbon::now()->toDateString();
                    $image_file = $request->file('image');
                    $image_path = "uploads/blog";
                        
                    if (isset($image_file))
                    {
                        //make unique name for image
                        $image_name = $image_path.'/'.uniqid().'_'.$current_date.'.'.$image_file->getClientOriginalExtension();
                        //check category dir is exists
                        if (!Storage::disk('public')->exists($image_path))
                        {
                            Storage::disk('public')->makeDirectory($image_path);
                        }

                        // resize image for category and upload
                        $image_file = Image::make($image_file)->resize(400,200)->stream();
                        Storage::disk('public')->put($image_name,$image_file);
                    } else {
                        $image_name = "default.jpg";
                    }
            //====== Blog Image Process ======>

            $blog = new Blogs();
            $blog->user_id = Auth::user()->id;
            $blog->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
            $blog->title = $request->title;
            $blog->sub_title = $request->sub_title;
            $blog->details = $request->details;
            // $blog->category = $request->category_id;
            $blog->image = $image_name;

            $blog->save();
            return redirect()->route('blogs')->with('successs','Blog Created Successfull!');

            // DB::beginTransaction();
            // try {
            //     if ($blog->save()) {
            //       DB::commit();
            //       return redirect()->route('blogs')->with('successs','Blog Created Successfull!');
            //     }else{
            //       DB::rollback();
            //       return redirect()->route('blogs')->with('error',$e->getMessage());
            //     }
            // }catch (\Exception $e) {
            //     DB::rollback();
            //     return redirect()->route('blogs')->with('error',$e->getMessage());
            // }
          }
          else
            {
              return redirect()->route('plans.index')->with('error','Update membership' );
              // return redirect()->route('blogs')->with('error','For joining this group you must update membership');
            }
        }
      else
        {
          return redirect()->route('home')->with('error','Please Login Your Account');
        }
    }

    public function imagecrop(Request $request)
    {
        // $data = $request->image;

        // $image_array_1 = explode(";", $data);
        // $image_array_2 = explode(",", $image_array_1[1]);
        // $data = base64_decode($image_array_2[1]);
        // $imageName = uniqid().'.png';
        // $path = public_path() . "/uploads/temporary/" . $imageName;
        // file_put_contents($path, $data);
        return "555";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      } 

      if(Auth::check()){
        if(Auth::user()->getmembership(Auth::user()->portalJoinUser_id) != 1){
          // $this->validate($request, [
          //   'title'=>'required',
          //   'sub_title'=>'required',
          //   'details'=>'required',
          //   'image'=>'required',
          // ]);
          $data = new Blogs();
          $data->title = session()->get('blogpost')['blogTitle'];
          $data->sub_title = session()->get('blogpost')['blogSubTitle'];
          $data->details = session()->get('blogpost')['description'];
          // $data->category = session()->get('blogpost')['category'];
          $data->type = Auth::user()->getportal(Auth::user()->portalJoinUser_id);
          // if($file = $request->file('image')){
          //   $name = uniqid().$file->getClientOriginalName();
          //   $data->image = $file->move('uploads/blog', $name );
          // }
          $blogImage = session()->get('blogpost')['imageURL'];
          $old_path = 'uploads/temporary/'.$blogImage;
          $new_path = 'uploads/blog/'.$blogImage;
          File::move($old_path, $new_path);
          $data->user_id = Auth::user()->id;
          $data->image = $new_path;
          DB::beginTransaction();
          try {
              if ($data->save()) {
                DB::commit();
                return redirect()->route('blogs')->with('successs','Blog Created Successfull!');
              }else{
                DB::rollback();
                return redirect()->route('blogs')->with('error',$e->getMessage());
              }
          }catch (\Exception $e) {
              DB::rollback();
              return redirect()->route('blogs')->with('error',$e->getMessage());
          }
        }else{
          return redirect()->route('plans.index')->with('error','Update membership' );
          // return redirect()->route('blogs')->with('error','For joining this group you must update membership');
        }
      }else{
        return redirect()->route('home')->with('error','Please Login Your Account');
      }
    }


    public function blogDetails($id){
       
      if(auth()->user()->isDeactivate()){
            return redirect('profile_security')->with('error','please active your account to access');
      } 
      if(auth()->user()->isDeactivateUser(Blogs::findUserByBlog($id)->id)){
          return redirect('home');
      }
      $data = Blogs::find($id);
      if($data->type != auth()->user()->portalInfo->portal_id){
        return redirect('blogs');
      }
      $blogComment = BlogComments::where('blog_id', $id)
      ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
      ->paginate(5);

      $similarBlog = Blogs::where([['id','!=',$data->id],['type', auth()->user()->portalInfo->portal_id]])
      ->whereNotIn('user_id', auth()->user()->getBlockUserListByAuth())
      ->whereNotIn('user_id', auth()->user()->deactivateUserList())     
      ->orderBy('id','Desc')->inRandomOrder()->limit(8)->get();
      return view('blogdetails',compact('data','similarBlog','blogComment'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogs $blogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogs $blogs)
    {
        //
    }
}
