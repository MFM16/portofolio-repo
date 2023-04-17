<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Portofolio;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index ()
    {
        return view('landing');
    }

    public function show($nickname)
    {
        $profile = Profile::where('nickname', $nickname)->first();
        
        if($profile == NULL || $profile->user->role == 1)
            abort(404);

        $data = [
            'profile' => $profile,
        ];

        return view('index', $data);
    }

    public function portofolio_detail($nickname, $slug)
    {
        $user = Profile::where('nickname', $nickname)->first();
        $data = [
            'portofolio' => Portofolio::where(['profile_id' => $user->id, 'slug' => $slug])->first(),
            'portofolios' => Portofolio::where('profile_id', $user->id)->Where('slug', '!=', $slug)->get(),
            'profile' => $user
        ];

        return view('portofolio_detail', $data);
    }

    public function post_detail($nickname, $slug)
    {
        $user = Profile::where('nickname', $nickname)->first();
        $data = [
            'portofolio' => Post::where(['profile_id' => $user->id, 'slug' => $slug])->first(),
            'portofolios' => Post::where('profile_id', $user->id)->Where('slug', '!=', $slug)->get(),
            'profile' => $user
        ];

        return view('portofolio_detail', $data);
    }
}
