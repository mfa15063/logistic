<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class clientController extends Controller
{
    public function index()
    {
        $clients = User::where('is_admin','0')->get();
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
            ]
        );
        $client = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'contact_no'=>$request->phone_no
        ]);
        return redirect()->route('client.index');
    }
    public function delete($id)
    {
        $client = User::find($id);
        if ($client) {
            $client->delete();
        }
        return redirect()->route('client.index');
    }
}
