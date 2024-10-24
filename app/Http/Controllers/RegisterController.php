<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\preferenciasLista;

class RegisterController extends Controller
{
    //
    public function showForm()
    {
        return view('register');
    }

    public function showLoginForm()
{
    return view('login');
}

public function showPostagens()
{
    return view('postagens');
}

public function showHome(Request $request)
{
    $preferenciasLista = PreferenciasLista::all();
    if ($request->has('s')) {
        $posts = Post::search($request->input('s'));
    } else {
        $posts = Post::with('user')->where('status', 1)->orderBy('created_at', 'desc')->get();
    }
    $user = Auth::user();
    return view('home', compact('user', 'posts', 'preferenciasLista'));
}



    public function register(Request $request)

    {
        if (!str_contains($request->input('email'), 'etec')) {
            return redirect()->back()->withErrors([
                'email' => 'O email precisa conter "etec".',
            ]);
        }

        $profilePhotoUrl = 'img/default.jpg';

        if ($request->hasFile('urlDaFoto')) {
            $file = $request->file('urlDaFoto');
            $profilePhotoUrl = $file->store('urlDaFoto', 'public');
        } 
            

        User::create([
            'name' => $request->input('name'),
            'arroba' => $request->input('arroba'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'urlDaFoto' => $profilePhotoUrl,
            'modulo' => $request->input('module'),
            'perfil' => $request->input('role'),
            'bio' => $request->input('bio'), // Adiciona o campo bio

           
        ]);

        return redirect()->route('login')->with([
            'status' => 'Usuário registrado com sucesso',
            'showModal' => true,
        ]);

    }




   public function login(Request $request){

    

     $credentials = $request->only('email','password');
     $autenticado =Auth::attempt($credentials);
        if(!$autenticado){
            return redirect()->route('login')->withErrors(['error' =>'Email ou senha errada']);

        }
        $user = Auth::user();

        // Verificando o status do usuário
        if ($user->status === 'Off') {
            Auth::logout(); // Deslogar o usuário
            return redirect()->route('login')->withErrors(['error' => 'Sua conta está desativada.']);
        }
        
        return redirect()->route('home', )->with(['success' =>'Logou']);
       
    }


    public function logout(Request $request)
    {
        Auth::guard()->logout();

        // Invalida a sessão atual e regenera o token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redireciona para a página de login
        return redirect('/login');
    }






}