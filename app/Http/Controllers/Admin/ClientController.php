<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function show(User $client)
    {
        return view('admin.clients.show', compact('client'));
    }
}
