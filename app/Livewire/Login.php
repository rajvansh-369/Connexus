<?php

namespace App\Livewire;

use App\Mail\ResetPassword;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Jobs\ResestPasswordJob;

class Login extends Component
{

    #[Validate('required')]
    public $email = '';

    #[Validate('required|min:5')]
    public $password = '';
    public $remember_me = false;


    public $isForgetPage = false;

    public function submit()
    {

        $this->validate();


        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            session()->flash('message', 'Login successful!');
            return redirect()->route('chat'); // Or wherever you want
        }

        session()->flash('error', 'Invalid credentials.');
    }

    public function forgetSubmit()
    {

        $user = User::where('email', $this->email)->first();
        if (!$user) {

            session()->flash('error', "User doesn't exixt");
            return false;
        }

        $password = Str::random(10); // generates a 10-character random string
        $user->password = Hash::make($password);
        $user->save();
        $data = [
            'email' => $this->email,
            'name' => $user->name,
            'password' => $password
        ];

        ResestPasswordJob::dispatch($data);

        session()->flash('message', 'Password send successfully');

        $this->reset('email');
    }


    public function isForget(){

        $this->isForgetPage = true;
    }

    public function render()
    {

        return view('livewire.login');
    }
}
