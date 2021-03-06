<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'tel' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }



    public function actualizar (Request $request)
    {
        $user = User::find($request->id);
        // echo $user;
        // echo "<br>";
        // echo $user->image->src;
        // echo "<br>";
        if ($request->file) {
          // Borrar avatar
          //dd($request->file);
          //dd(\Auth::user()->image->src);
          \Storage::delete($user->image->src);
          //borrar las filas imagen
          $user->image->delete();

          $file = request()->file('file');
          $extension = strtolower($file->extension());
          $fileName = uniqid().'.'.$extension;
          $file->storeAs('images/users-'.$user->id, $fileName);

          // Guardar avatar nuevo
          $image= Image::create([
            'src' =>  'images/users-'.$user->id.'/'.$fileName,
            'user_id' => $user->id
          ]);
          $user->image($request->input('file'),$request->user_id);
      }
      //  $user = \Auth::user()->update($request->all());
      // $user = \Auth::user()->update([
      //     'name' => $request['name'],
      //     'email' => $request['email'],
      //     'password' => bcrypt($request['password']),
      //     'fecha_de_nacimiento'=>$request['fecha_de_nacimiento'],
      //     'genero'=>$request['genero'],
      // ]);
      //$user->update($request->all());
      return redirect('/profile');
    }
}
