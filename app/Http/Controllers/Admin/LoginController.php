<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.login.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=[
            'status'=>false,
        ];

        $user = User::query()
            ->where('email',$request->email)
            ->first();

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user->createToken('DATAHAN_PANEL')->plainTextToken;

            $rememberMe=$request->has('rememberMe') ? true : false;
            Auth::login($user, $rememberMe);
            $request->session()->regenerate();

            $data['status']=true;
            $data['message']='Bilgiler doğru, yönlendiriliyorsunuz...';
            $data['url']=route('panel.dashboard');
        }else{
            $data['message']='E-posta veya parola hatalı!';
        }

        return response()->json($data);
    }
}
