<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class ProfileController extends Controller
{
    public function showprofile()
    {
        $post = Post::where('user_id',Auth::user()->id)->get();
        return view('profile.index',compact('post'));
    }

    public function logout(Request $req)
    {
        Auth::logout();
        return redirect('/');
    }

    public function create(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'desc' => 'required',
            'image' => 'required',
         ]);

         $filename = $this->saveimage($req);

         $post = new Post();
         $post->title = $req->title;
         $post->desc = $req->desc;
         $post->image = $filename;
         $post->user_id = Auth::user()->id;
         $post->save();

         
        $req->session()->flash('message',"Saved The Data");
        return redirect()->back();
    }

    public function update(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'desc' => 'required',
         ]);

         if($req->file('image'))
         {
            $filename = $this->saveimage($req);

            Post::where('id',$req->id)->update([
               'title' => $req->title,
               'desc' => $req->desc,
               'image' => $filename
            ]);
         }
         else
         {
            Post::where('id',$req->id)->update([
                'title' => $req->title,
                'desc' => $req->desc,
             ]);
         }
         

         $req->session()->flash('message',"Updated the Data");
         return redirect()->back();
         
    }

    public function delete(Request $req)
    {
        $req->validate([
            'id' => 'required',
         ]);
        Post::where('id',$req->id)->delete();

        $req->session()->flash('message',"Deleted the Data");
        return redirect()->back();
    }

    public function show(Request $req)
    {
        $post = Post::where('id',Auth::user()->id)->get();
        return view('profile.index',compact('post'));
    }

    public function saveimage(Request $req)
    {
        $filename = time().".".$req->file('image')->getClientOriginalExtension();
        $req->file('image')->move('posts',$filename);
        return $filename;
    }
}
