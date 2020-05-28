<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        // 以下を追記
        // Varidationを行う
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        unset($form['_token']);
        $profile->fill($form);
        $profile->save();
        return redirect('admin/profile/create');
    }
    
    //以下を追記
  public function index(Request $request)
  {
    $cond_title = $request->cond_title;
    if ($cond_title != '') {
      //検索されたら検索結果を取得する
      $posts = News::where('title, $cond_title')->get();
    } else {
      //それ以外は全てのニュースを取得する
      $posts = News::all();
    }
    return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
 //以下を追記
    public function edit(Request $request)
    {  
        
        $profile = Profile::find($request->id);
        if (empty($profile)){
            abort(404);
    }
        return view('admin/profile/edit',['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        
        if(isset($profile_form['image'])) {
            $path =$request->file('image')->store('public/image');
            $profile->imege_path = basename($path);
            unset($profile_form['imege']);
        }   elseif (isset($request->remove)) {
            $profile->image_path = null;
            unset($profile_form['remove']);
        }
        unset($profile_form['_token']);
        
        $profile->fill($profile_form)->save();
        
        return redirect('admin/profile');
    }
    
    public function delete(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->delete();
        return redirect('admin/profile');
    }
}