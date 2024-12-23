<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RayEmployeeRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayEmployeeAuth extends Controller
{
    public function store(RayEmployeeRequest $request)
    {

        if($request->authenticate()){
            \Log::info('Redirecting user', ['url' => request()->fullUrl()]);

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::RAYEMPLOYEE);
        }
        return redirect()->back()->withErrors(["name"=>'ERROR']);

    }

    public function destroy(Request $request)
    {
        Auth::guard('ray_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
