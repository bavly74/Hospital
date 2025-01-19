<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LabEmployeeLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabEmployeeAuth extends Controller
{
    public function store(LabEmployeeLoginRequest $request)
    {
        if ($request->authenticate()) {

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::LABEMPLOYEE);
        }
        return redirect()->back()->withErrors(['name' => 'ERROR']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('lab_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
