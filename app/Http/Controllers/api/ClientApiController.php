<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientApiController extends Controller
{


    public function index(){
        $client_api=Client::where('user_id' , auth()->id())->get();
        return response()->json($client_api);

    }


    public function store(Request $request){

        $client_api_store=Client::create([

            'user_id' => $request->auth()->id ,
            'client_name' => $request->client_name ,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' =>$request->address,
            'city' => $request->city,
            'country' => $request->country 

        ]);

        return response()->json([
            'message ' => 'client data stored successfully' ,
            'client' =>$client_api_store 

        ] , 201 );

    }
}
