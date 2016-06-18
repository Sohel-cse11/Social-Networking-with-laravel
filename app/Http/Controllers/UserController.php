<?php
namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
	

	public function postSignUp(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|unique:users',
			'fname' => 'required|max:120',
			'password' => 'required|min:6'
			]);
		//get data from view through controller
		$email = $request['email'];
		$fname = $request['fname'];
		$password = bcrypt($request['password']);

		//create object for User model 
		$user = new User();
		$user->email = $email;
		$user->fname = $fname;
		$user->password = $password;

		//save data to the database
		$user->save();

		//return to view
		Auth::login($user);
		return redirect()->route('dashboard');
	}

	public function postSignIn(Request $request)
	{

		$this->validate($request,[
			'email' => 'required',
			'password' => 'required'
			]);
		$email = $request['email'];
		$password = $request['password'];
		if (Auth::attempt(['email' => $email, 'password' => $password ])) {
		   return redirect()->route('dashboard');
		}
		 
		return redirect()->back();
	}

	public function getLogout(){
		Auth::logout();
		return redirect()->route('home');
	}

	public function getAccount(){
		$user = Auth::user();
		return view('acc', ['user' => $user]);
	}

	public function postSaveAccount(Request $request){
		$this->validate($request,[
			'fname' => 'required'
			
			]);
		$user = Auth::user();
		$user->fname = $request['fname'];
		$user->update();
		$file = $request->file('image');
		$filename = $request['fname'].'_'.$user->id.'.jpg';
		if($file){
			Storage::disk('local')->put($filename, File::get($file));
		}
		return redirect()->route('account');
	}

	public function getUserImage($filename){
		$file = Storage::disk('local')->get($filename);
		return new Response($file, 200);
	}
}