<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function create()
    {
        return view('uploadFile');
    }

    public function store(ImageRequest $request)
    {
        $image = $request->file('image');
        $hashName = $image->hashName();
        $image->storeAs('public/images/', $hashName);
        return redirect()->back();
    }
}
