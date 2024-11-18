<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profileedit');
    }

    public function postedit(Request $request)
    {   
        Profile::create(
            $request->only([
                'profile_image',
                'name',
                'post_code',
                'address',
                'building',
            ])
            );
        

        return redirect('/');
    }
}
