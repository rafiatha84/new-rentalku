<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Validator;

class AdminSliderController extends Controller
{
    public function index(){
        $sliders= Slider::get();
        return view('admin.slider',[
            'sliders' => $sliders
        ]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('admin.slider');
        }
        $uploadFolder = "image/slider/";
        $image = $request->file('image');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;

        $slider = Slider::create([
            'image' => $image_link
        ]);

        if($slider){
            return redirect()->route('admin.slider');
        }else{
            return redirect()->route('admin.slider');
        }

    }
    public function destroy($id){
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect()->route('admin.slider');
    }
}
