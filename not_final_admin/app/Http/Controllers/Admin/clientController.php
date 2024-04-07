<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as RulesPassword;

class clientController extends Controller
{
    public function index()
    {
        $clients = User::where('is_admin', '0')->get();
        return view('admin.client.index', compact('clients'));
    }
    public function create()
    {
        return view('admin.client.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'            => 'required|string|max:250',
                'email'        => 'required|email|unique:users,email',
                'phone_no'            => 'required|string|max:250',
                'password'            => ['required', 'confirmed', RulesPassword::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
            ]
        );
        $client = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->phone_no,
            'country'    => $request->country,
            'city'    => $request->city,
            'address'    => $request->address,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('client.index')->with(['type'=>'success','message'=>"Client created successfully."]);
    }
    public function edit($id)
    {
        $client = User::find($id);
        if(!$client){
            return redirect()->route('client.index')->with(['type'=>'error','message'=>"Client not found."]);
        }
        return view('admin.client.edit',compact('client'));
    }
    public function update(Request $request,$id)
    {
        $request->validate(
            [
                'name'            => 'required|string|max:250',
                'email'        => ['required','email',Rule::unique('users','email')->ignore($id)],
                'phone_no'            => 'required|string|max:250'
            ]
        );
        $client = User::find($id);
        if(!$client){
            return redirect()->route('client.index')->with(['type'=>'error','message'=>"Client not found."]);
        }
        $client->Update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->phone_no,
            'country'    => $request->country,
            'city'    => $request->city,
            'address'    => $request->address
        ]);
        return redirect()->route('client.index')->with(['type'=>'success','message'=>"Client updated successfully."]);
    }
    public function delete($id)
    {
        $client = User::find($id);
        if(!$client){
            return redirect()->route('client.index')->with(['type'=>'error','message'=>"Client not found."]);
        }
        $client->delete();
        return redirect()->route('client.index')->with(['type'=>'success','message'=>"Client deleted successfully."]);
    }
}
