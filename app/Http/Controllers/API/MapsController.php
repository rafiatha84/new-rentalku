<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Http;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addressToLat(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'alamat' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }



         return response()->json([
             "lat" => "30000",
             "long" => "40000"
        ],200);
    }
    
    
    public function latToAddress(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'lat' => 'required',
            'long' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }



         return response()->json([
             "address" => "Jalan. Kuy"
        ],200);
    }

    public function kendaraanTrack($id)
    {
    
        return response()->json([
            "lat" => "300000",
            "long" => "500000"
       ],200);
    }
    public function search_address(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'address' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        // $request->address = "";
        $link = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?fields=formatted_address%2Cname%2Cgeometry&input=".$request->address."&inputtype=textquery&key=AIzaSyCY3pxEXVMMycamj5ImFQW2D2yhfZ2eR3A";
        // dd($link);
        $response = Http::get($link);
        return response()->json(['result'=> $response->json()]);
        
    }
    public function update_maps(Request $request)
    {
        $id = $request->id;
        $lat = $request->lat;
        $lng = $request->lng;
        $kendaraan = Kendaraan::where('id',$id)->update([
            'lat' => $lat,
            'long' => $lng,
        ]);
        if($kendaraan){
            return response()->json('success',200);
        }else{
            return response()->json('gagal',200);
        }

    }
}
