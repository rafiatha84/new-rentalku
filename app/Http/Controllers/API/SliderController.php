<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::get();

        if(count($slider) > 0 ){
            $response = [
                "status" => "success",
                "message" => 'Data slider Ditemukan',
                "errors" => null,
                "content" => $slider,
            ];
            return response($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => 'Data slider tidak Ditemukan',
                "errors" => null,
                "content" => $slider,
            ];
            return response($response, 200);
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'image' =>  'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            $response = [
                "status" => "error",
                "message" => 'Mohon masukkan image',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,200);
        }
            $uploadFolder = "image/slider/";
            $image = $request->file('image');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;

            $slider = Slider::create([
                'image' => $image_link
            ]);

            if ($slider) {
                //Jika ada image
                $slider->image = URL::to($slider->image);
                $response = [
                    "status" => "success",
                    "message" => 'Berhasil Menambah Slider image',
                    "errors" => null,
                    "content" => $slider,
                ];
                return response()->json($response,201);
            } else {
                $response = [
                    "status" => "error",
                    "message" => 'Gagal Menambah slider image',
                    "errors" => null,
                    "content" => $slider,
                ];
                return response()->json($response,200);
            }
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
            'image' =>  'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            $response = [
                "status" => "error",
                "message" => 'Mohon masukkan image',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,200);
        }
            $uploadFolder = "image/slider/";
            $image = $request->file('image');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;

            $slider = Slider::where('id', $id)->update(['image' => $image_link]);



            if ($slider) {
                //Jika ada image
                $slider_data = Slider::where('id', $id)->get();
                
                $response = [
                    "status" => "success",
                    "message" => 'Berhasil update Slider image',
                    "errors" => null,
                    "content" => $slider_data,
                ];
                return response()->json([
                    "response" => $response,
                    "image" => URL::to($image_link)
                ], 201);
            } else {
                $response = [
                    "status" => "error",
                    "message" => 'Gagal update slider image',
                    "errors" => null,
                    "content" => $slider,
                ];
                return response()->json($response,201);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::first($id);

            $response = [
                "status" => "deleted",
                "message" => 'Slider berhasil dihapus',
                "errors" => null,
                "content" => $slider
            ];

            
            if ($response) {
                $slider->delete();
                return response()->json($response, 200);
            } else {
                $response = [
                    "status" => "failed",
                    "message" => 'Slider gagal dihapus',
                    "errors" => null,
                    "content" => $slider,
                ];
                return response()->json($response, 200);
            }
            
    }
}
