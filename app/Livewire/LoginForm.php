<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class LoginForm extends Component
{
    use WithFileUploads;

    public $avatar;
    public $name;
    public $email;
    public $password;

    public $isLogin = false;

    public function setIsLogin()
    {
        $this->isLogin = !$this->isLogin;
    }

    public function register()
    {
        $this->validate([
            'avatar' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $avatarPath = '';
        if ($this->avatar) {
            $avatarPath = 'storage/' . $this->avatar->store('img/users', 'public');
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => $avatarPath,
        ]);

        auth()->login($user);
        $this->reset('name', 'email', 'password', 'avatar');
        $this->redirectRoute('home.index', navigate: true);
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $this->email)->first();

        // check if user exists
        if (!$user) {
            toastr()->error('Akun tidak terdaftar.');
            $this->reset('password');
            return;
        }

        // check if password matched
        if (!Hash::check($this->password, $user->password)) {
            toastr()->error('Username atau password salah.');
            $this->reset('password');
            return;
        }

        // login and redirect
        auth()->login($user);
        $this->reset('name', 'email', 'password', 'avatar');
        $this->redirectRoute('home.index', navigate: true);
    }


    public function render()
    {
        return view('livewire.login-form');
    }
}
