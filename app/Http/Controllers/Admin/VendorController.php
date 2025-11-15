<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function show(User $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }
}
