<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Role;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        try {            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        } catch (\RuntimeException $e) {
            // Tangkap error jika password bukan bcrypt, biarkan eksekusi berlanjut
            // ke pengecekan manual di bawah.
        }

        $credentials = $this->credentials($request);
        $user = User::where($this->username(), $credentials[$this->username()])->first();

        if ($user && $user->password === $credentials['password']) {
            $user->password = Hash::make($credentials['password']);
            $user->save();
            $this->guard()->login($user, $request->boolean('remember'));
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        $user->load('roleUser.role');

        $activeRoleUser = $user->roleUser->where('status', 1)->first();

        if (!$activeRoleUser) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'User tidak memiliki role yang aktif.']);
        }

        $role = $activeRoleUser->role;

        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $activeRoleUser->idrole,
            'user_role_name' => $role ? $role->nama_role : 'User',
            'user_status' => $activeRoleUser->status
        ]);

        Log::info('User ' . $user->email . ' logged in with role ID: ' . $activeRoleUser->idrole . ' and role name: ' . ($role ? $role->nama_role : 'N/A'));

        switch ($activeRoleUser->idrole) {
            case 1:
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case 2:
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case 3:
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case 4:
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            case 5:
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect()->route('home')->with('warning', 'Login berhasil, namun role Anda tidak memiliki halaman dashboard khusus. Silakan hubungi administrator.');
        }
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}