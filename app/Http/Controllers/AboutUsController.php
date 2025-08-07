<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use BaconQrCode\Renderer\Color\Cmyk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    //
    public function index()
    {
        $aboutUs = AboutUs::first();
        // Logic to retrieve and display the "About Us" information
        return view('user.AboutUs.AboutUs', compact('aboutUs'));

    }

    public function show()
    {
        $aboutUs = AboutUs::first();
        return view('admin.AboutUs.showAboutUs', compact('aboutUs'));
    }



    public function edit($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.AboutUs.updataAboutUs', compact('aboutUs'));
    }

    public function update(Request $request,$id){

        $data = $request->validate([
            'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'whatsapp' => 'nullable|string|max:20',

        ]);

         $aboutUs = AboutUs::findOrFail($id);
         $path = $aboutUs->image;
         if($request->hasFile('image')){
            if($aboutUs->image){
                Storage::disk('public')->delete($aboutUs->image);
            }
            $imagePath = $request->file('image')->store('aboutUs', 'public');
            $data['image'] = $imagePath; // Store the path in the data array
         }else{
            $data['image']= $aboutUs->image;
         }

         $aboutUs->update($data);
        session()->flash('success', 'About Us updated successfully.');
        return redirect()->route('showAboutUs',compact('aboutUs'));



    }




}
