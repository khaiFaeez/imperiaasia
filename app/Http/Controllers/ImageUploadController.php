<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = request()->invoice_id.'-'.time().'.'.$request->image->extension();
        $request->image->move(public_path(request()->portfolio), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        return ['image' => $imageName, 'path' => '/'.request()->portfolio.'/'.$imageName];
    }
}
