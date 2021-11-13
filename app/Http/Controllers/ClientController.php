<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Validator;

use function GuzzleHttp\Promise\all;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view("client.index", ["clients"=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("client.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = [
                'clientName' => $request->clientName,
                'clientSurname' => $request->clientSurname,
                'clientDescription' => $request->clientDescription
            ];

            $rules = [
                'clientName' => 'required|min:3',
                'clientSurname' => 'required|min:3',
                'clientDescription' => 'min:8'
            ];

            $validator = Validator::make($input, $rules);

            if($validator->passes()) {
                $client = new Client;
                $client->name = $request->clientName;
                $client->surname = $request->clientSurname;
                $client->description = $request->clientDescription;
                $client->save();

                $success = [
                    'message' => '[Back-End] Client added successfully',
                    'clientID' => $client->id,
                    'clientName' => $client->name,
                    'clientSurname' => $client->surname,
                    'clientDescription' => $client->description
                ];

                $success_json = response()->json($success);

                return $success_json;
            }

            $error = [
                'error' => $validator->messages()->get("*")
            ];

            $error_json = response()->json($error);

            return $error_json;

            // return "Clients added successfully";

        }



    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return "Deleted";
    }

    public function validationcreate()
    {
        return view ("client.validationcreate");
    }

    public function validationstore(Request $request)
    {

        $client= new Client;

        //visi kintamieji turi buti masyvas
        $input=[
            "name"=>$request->name, // inputo pavadinimas ir kas validuojama
            "surname"=>$request->surname
        ];

        $rules=[
            "name"=>"required|alpha", // vadinasi vardas privalomas
            "surname"=>"numeric|max:33"
        ];

        // neprivaloma
        $messages=[
            "required"=>"this name field is required", // isvedama
            "alpha"=>"please enter only letters"
        ];

        $validator=Validator::make($input, $rules,$messages); // reikia ir virsuje uzrasyti kas naudojama use

            // jeigu validatorius praejo:
            if($validator->passes()) {
                $success=[
                    "success"=>"name validated successfully"
                ];

                $success_json = response()->json($success);
                return $success_json; // nutraukiamas funkcijos veikimas-po jos veiksmai neatliekami
                // kai yra return- galima nenaudoti else
            }

            //nesekmes/ klaidu masyvas
            $error= [
                //"error" => $validator->errors()->all() // validatorius grazina visas (all) klidas- vieno atveju

                // keliciamas klaidos masyvas su nurodomais errorais
                "error" => $validator->messages()->get("*")

            ];

            $error_json = response()->json($error);
            return $error_json;

            // ankciau naudojamas validacijos modelis
            //$request->validate([
            //"name"=> "required"
            //]);

        //$client->name=$request->name;
        //$client->save();
        //return redirect()->route("client.index");


    }
}
