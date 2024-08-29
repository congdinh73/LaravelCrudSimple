<?php

namespace App\Http\Controllers\accounts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //This method shows the list of accounts
    public function index()
    {
        $account = User::orderBy('created_at', 'desc')->get();

        return view('accounts.list', ['accounts' => $account]);   
    }


    ///This method will show edit form
    public function edit($id)
    {
        $account = User::findorFail($id);

        return view('accounts.edit', ['account' => $account]);
    }

    //This method will update account data
    public function update($id, Request $request) {
        $account = User::findorFail($id);
        $account->name = $request->name;
        $account->email = $request->email;
        $account->save();

        return redirect()->route('accounts.index')->with('success', 'User updated successfully.');
    }

    //This method show delete account data
    public function destroy($id)
    {
        $account = User::findorFail($id);
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'User deleted successfully.');
    }
}
