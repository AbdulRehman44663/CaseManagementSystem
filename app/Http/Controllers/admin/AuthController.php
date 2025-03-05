<?php
namespace App\Http\Controllers\admin;
use DB;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Login';
        if(auth()->check()){
            return redirect(route('admin.dashboard'));
        }
        if(isset($_GET['username']) && isset($_GET['password'])){
            $credentials = ['email'=>$_GET['username'], 'password'=>$_GET['password']];
            if (Auth::attempt($credentials)) {
                return redirect(route('admin.dashboard'));
            }
        }
        return view('admin.auth.login')->with($this->data);
    }  
      
    // public function customLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
   
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $intendedUrl = Session::pull('intended_url', route('admin.dashboard'));
    //         $token = strtok($intendedUrl, '?');
    //         $modifiedintendedUrl= $token !== false ? ltrim($token, '/') : '';

    //         $routeExists = collect(Route::getRoutes())->contains(function ($route) use ($modifiedintendedUrl) {
    //             return $route->uri() === $modifiedintendedUrl;
    //         });
    //         if ($routeExists) {
    //             return redirect($intendedUrl);
    //         } else {
    //             return redirect(route('admin.dashboard'));
    //         }
    //     }
        
  
    //     return redirect("login")->withError('Your email or password is incorrect.');
    // }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Check if the user exists.
        $user = User::where('email', $request->email)->first();
        
        
        if (!$user) {
            return redirect()->back()->with('error', 'Your email or password is incorrect.');
        }

        if($user->user_type == "client")
        {
            $url = "client/login";
        }
        else
        {
            $url = "admin/login";
        }

        if ($user->status !== 'active') {
            return redirect()->back()->with('error', 'Your account is not active.');
        }

        if (Auth::attempt($credentials)) {
            $intendedUrl = Session::pull('intended_url', route('admin.dashboard'));
            $token = strtok($intendedUrl, '?');
            $modifiedIntendedUrl = $token !== false ? ltrim($token, '/') : '';

            $routeExists = collect(Route::getRoutes())->contains(function ($route) use ($modifiedIntendedUrl) {
                return $route->uri() === $modifiedIntendedUrl;
            });

            // Redirect based on user role
            if ($user->user_type === 'client') {
                 
                /// get a user client data
                $client = Client::with('clientCaseInfo')->where('id', $user->client_id)->first();
                /// also get a all casetypes of user client and put in session
               
                // Get all case types for the client
                
                $caseTypes = $client->clientCasesInfo->map(function ($caseInfo) {
                    return [
                        'id' => $caseInfo->caseType->id,
                        'name' => $caseInfo->caseType->name
                    ];
                });
                
                // Store all case types in session
                session(['all_case_types' => $caseTypes]);
                
                
                session(['client_id' => $user->client_id, 'case_type_id' => $client->clientCaseInfo->case_type_id]);
                 
                return redirect()->route('client.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
        return redirect($url)->withError('Your email or password is incorrect.');
    }


    public function registration()
    {
        $this->data['title'] = 'Register';
        return view('auth.register')->with($this->data);
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect(route('admin.dashboard'));
    }

    public function create(array $data)
    { 
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function forgotPassword()
    {
        $this->data['title'] = 'Forgot Password';
        return view('auth.forgotPassword')->with($this->data);
    }
    
    public function resetPassword ($userId)
    {
        $this->data['title'] = 'Reset Password';
        $this->data['user'] = User::find($userId);
        return view('components.auth.reset-password')->with($this->data);
    }

    public function logout(Request $request) {

        Auth::logout();
        Session::flush(); // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'You have been logged out successfully.');
    }

    public function clientLogout(Request $request)
    {
        Auth::logout();
        Session::flush(); // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/client/login')->with('success', 'You have been logged out successfully.');
    }

    // public function verifyClient($token)
    // {
    //     $user = User::where('verification_token', $token)->first();

    //     if (!$user) {
    //         return redirect()->route('client.login')->with('error', 'Invalid or expired token.');
    //     }
    //     $title = 'Set Your Password';

    //     return view('client.auth.set_password', compact('user', 'title'));
    // }

    public function verifyUser($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Invalid or expired token.');
        }
        $title = 'Set Your Password';
        if($user->user_type == "client")
        {
            return view('client.auth.set_password', compact('user', 'title'));
        }
        else
        {
            return view('admin.auth.set_password', compact('user', 'title'));
        }
    }

    public function setPassword(Request $request)
    {
        $rules = [
           'password' => 'required|string|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,}$/',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::findOrFail($request->user_id);
        
        $user->update([
            'password' => Hash::make($request->password),
            'status' => 'active',
            'verification_token' => null,
            'email_verified_at' => now(),
        ]);
        session()->flash('success', 'Account verified successfully. You can now log in.');
        if($user->user_type == 'client')
        {
            return redirect()->route('client.login');
        }
        else
        {
            return redirect()->route('admin.login');
        }
    }

    public function updatePassword(Request $request)
    {
        $rules = [
           'password' => 'required|string|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,}$/',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($request->user_id);
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        session()->flash('success', 'Password Updated successfully. You can now log in.');
        return redirect()->route('admin.login');
    }
}