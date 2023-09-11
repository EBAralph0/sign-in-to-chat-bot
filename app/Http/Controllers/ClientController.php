<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            "firstName"=>"required|string",
            "lastName"=>"required|string",
            "typeAuth"=>"required|string",
            "sex"=>"required|string",
            "telephone"=>"required|string",
            "whatsapp"=>"required|string",
            "accountNumber"=>"required|string",
        ]);

        $client=new Client();
        $client->fill($request->all());
        $client->status = "waiting";

        try {
            $client->save();
            flash()->addSuccess("La demande du client <span class='badge badge-dark'>$client->firstName</span> est en attente");
            //return response()->json($client, 200);
            $clients = Client::paginate(10);
            return view('liste',compact('clients'));

        } catch (Exception $e) {
            response()->json($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        $clients = Client::sortable()->paginate(10);
        return view('liste', compact('clients'));
    }

    public function create()
    {
        return view('home');
    }


    public function show($id) 
    {
        $client = Client::findOrFail($id);
        return view('detail', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'typeAuth' => 'required',
            'sex' => 'required',
            'telephone' => 'required',
            'whatsapp' => 'required',
            'accountNumber' => 'required',
        ]);

        $client = Client::findOrFail($id);
        $client->update($validatedData);

        return redirect()->route('client.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        flash()->addSuccess("La demande du client $id a ete supprime avec succes.");
        $clients = Client::paginate(10);
        return view('liste',compact('clients'));
    }

    public function setToValidate(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        // Mettez à jour le statut du client à "valid"
        $client->status = "valid";

        try {
            $client->save();
            flash()->addSuccess("La demande du client <span class='badge badge-dark'>$client->id</span> est valide");
            return view('detail', compact('client'));
        } catch (Exception $e) {
            flash()->addError("Impossible de valider cette demande.");
            //return redirect()->route('clients.index')->with('error', 'Erreur lors de la mise à jour du statut du client.');
        }
    }

    public function reject(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        // Mettez à jour le statut du client à "valid"
        $client->status = "reject";

        try {
            $client->save();
            flash()->addSuccess("La demande du client <span class='badge badge-dark'>$client->id</span> est rejetee");
            return view('detail', compact('client'));
        } catch (Exception $e) {
            flash()->addError("Impossible de rejeter cette demande.");
            //return redirect()->route('clients.index')->with('error', 'Erreur lors de la mise à jour du statut du client.');
        }
    }

}
