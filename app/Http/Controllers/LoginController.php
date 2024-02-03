<?php


namespace App\Http\Controllers;



use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function login(LoginRequest $loginRequest)
    {
        $loginRequest->authenticate();
        $bool = $loginRequest->authorize();
      /*  if (!Auth::user()->activate){
         return  redirect()->route('deposit');
        }*/
        $loginRequest->session()->regenerate();
        return redirect()->route('deposit');

    }
    public function register(Request $request)
    {
        if ($request->method()=="POST"){
            $user=new User();
            $user->name=$request->name;
            $user->phone=$request->phone;
            $user->parrain_id=isset($request->parrain_id)?$request->parrain_id:1;
            $user->user_type=1;
            $user->password=bcrypt($request->get('password'));
            $user->save();
            Session::put('register_id',$user->id);
        }
        return redirect()->route('sign_in');

    }
}
