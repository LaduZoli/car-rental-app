<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        $user = $request->user;

        if ($user && $user['admin']) {
            return view('admin.dashboard');
        } else {
            return redirect('/');
        }

    }
}
