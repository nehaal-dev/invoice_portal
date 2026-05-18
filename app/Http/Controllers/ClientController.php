<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
 
 

class ClientController extends Controller
{
    
    public function index(){

        $client=Client::where('user_id', auth()->id())->get();
        // dd($client);
        return view('clients.index', compact('client')) ;
    }

    public function create(){
        return view('clients.create');


    }

    public function store(Request $req){
       // dd($req->all());
         $req->validate([

            'client_name' => 'required|string|max:200' ,
           'email' => 'nullable|email' ,
            'phone' =>'required|string|max:20' ,
            'client_address' => 'required|string|max:250' ,
            'city' => 'required|string',
            'country' => 'required|string'

         ]);

         Client::create([
      
            'user_id'  => auth()->id(),
            'client_name' => $req->client_name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->client_address ,
            'city' => $req->city,
            'country' => $req->country
         ]);
         return redirect()->route('clients.index');


    }

    public function show(Client $client){
     return view('clients.show' , compact('client')) ;

    }

    public function edit(Client $client){
         return view('clients.edit' , compact('client'));

    }

    public function update(Request $req ,Client $client){

       $client->update([
          'client_name' => $req->client_name ,
          'email'  => $req->email,
          'phone' =>$req->phone,
          'address' =>$req->client_address,
          'city' => $req->city,
          'country' => $req->country
             
        ]);
        return  redirect()->route('clients.index')  ;
       
    }


    public function destroy(Client $client){
       $client->delete('id');

       return redirect()->route('clients.index');

    }







}
