<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function register(Request $request){
        $user = new User();
        $request->validate([
            'name' => 'required|max:15',
            'lastName' => 'required|max:15',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])/'
        ]);    
        
        $user->password = Hash::make($request->passwors);
        $user = User::create($request->only('name', 'lastName', 'email', 'password', 0, 0));
        //$user->save();

        Auth::login($user);
        return redirect(route('index'));

    }//end register

    public function login(Request $request){
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            //"active" => true
        ];
        $remember = ($request->has('remember') ? true : false);
        if(Auth::attempt($credentials, $remember)){
            return redirect()->intended(route('index'));  
        }else{
            //Session::flash('Mensaje', 'Wrong Data');
            return redirect(route('login'))->with('error', 'Incorrect credentials.'); 
        }
    }//end login

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }//end logout

    public function update(Request $request)
    {
        // Obtener el usuario autenticado
        $userData = auth()->User();
        $user = new User();

        $user->name = $request['name'];
        $user->lastName = $request['lastName'];
        $user->email = $request['email'];
        $user->longitude = $request['longitude'];
        $user->latitude = $request['latitude'];
        //echo $userData->id;
        //exit();
        //$user->save();
        $user = User::findOrFail($userData->id);
        $user->update([
            'name' => $request['name'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
            'longitude' => $request['longitude'],
            'latitude' => $request['latitude']
            // Actualiza otros campos según sea necesario
        ]); 
        //$user = User::create($request->only($user->name, $request['lastName'], $request['email'], $userData->password, $request['longitude'], $request['latitude']));
        return redirect()->route('login', $userData->id)->with('success', 'Usuario actualizado correctamente');
    }

    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Comprobar si el usuario está autenticado
        if ($user) {
            // El usuario está autenticado
            // Puedes acceder a los datos del usuario, como su ID, nombre, correo electrónico, etc.
            $id = $user->id;
            $name = $user->name;
            $lastName = $user->lastName;
            $email = $user->email;

            // Puedes pasar los datos del usuario a una vista o responder con JSON, según tus necesidades
            return view('index', compact('user'));
            // O bien, si estás construyendo una API
            // return response()->json($user);
        } else {
            // El usuario no está autenticado
            // Redirige al usuario a la página de inicio de sesión u otra página según sea necesario
            return redirect()->route('login');
        }
    }//end user
}

