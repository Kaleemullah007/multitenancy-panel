<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateTenantProfileRequest;
use App\Models\BankDetail;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {

        
        return view('edit-profile-owner', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     * Update photo
     * Password
     * Remove photo if new uploaded
     */
    public function update(UpdateTenantProfileRequest $request, User $profile)
    {


       
        $data = $request->only(['email', 'name', 'password', 'photo']);

        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // dd($profile);
        if ($request->has('photo')) {
            $user = $profile;

            if (!is_Null($user->file)) {
                $file_path = storage_path() . '/app/public/' . $user->file;
                // dd($file_path);
                //You can also check existance of the file in storage.
                if (File::exists($file_path)) {
                    unlink($file_path); //delete from storage
                }
            }


            $path = Storage::disk('public')->putFile('photos', $request->file('photo'));
            $data['file'] = $path;
        } else {
            unset($data['file']);
        }

        $profile->update($data);


        // Optionally, you can return a response indicating success
        return to_route('profile.edit', [$profile->id])->with(['message' => __('user.message.update-message')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
