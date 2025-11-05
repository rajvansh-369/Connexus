<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdit extends Component
{
    use WithFileUploads;
    public $first_name = "";
    public $lastName = "";
    public $email = "";
    public $phone = "";
    public $about = "";
    public $profile_image;



    public $file;

    public function upload()
    {
        dd($this->file); // Should NOT be null
    }

    public function mount()
    {
        $get_user = Auth::user();
        // dd( $get_user);
        if ($get_user) {


            if (str_contains($get_user->name, ' ')) {
                // echo "Contains space!";
                $name = explode(" ", $get_user->name);
                $this->first_name = $name[0];
                $this->lastName = $name[1];
            } else {

                $this->first_name = $get_user->name;
            }
            $this->email = $get_user->email;
            $this->phone = $get_user->phone;
            $this->about = $get_user->about;
            $this->profile_image = $get_user->profile_image;
            // dd($this->phone);
        }
    }


    public function save()
    {

        // dd($this->profile_image);
        $user = User::where("email", $this->email)->first();
        // dd($this->profile_image, $user);

        // Handle image upload (if provided)
        if ($this->profile_image) { // assuming $this->profile_image is a file input (Livewire: <input type="file" wire:model="profile_image">)
            // Store profile_image in 'storage/app/public/profile'
            $path = $this->profile_image->store('profile', 'public');

            // Optionally, delete the old image
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Save image path in DB
            $user->profile_image = $path;

            // dd($path);
        }

        // Update other user details
        $user->name = $this->first_name . " " . $this->lastName;
        $user->about = $this->about;
        $user->save();
        session()->flash('success', '✓ Profile updated successfully!');
        // dd(Auth::user());
    }



    public function render()
    {
        return view('livewire.profile-edit');
    }
}
