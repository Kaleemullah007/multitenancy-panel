<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\BankDetail;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

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
        $bank_detail = BankDetail::where('status', 1)->latest()->first();
        $timezone = Setting::where('setting_type', 'timezone')->get();
        $dateformat = Setting::where('setting_type', 'date_format')->get();
        return view('edit-profile', compact('profile', 'timezone', 'dateformat', 'bank_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, User $profile)
    {


        $data = $request->only(['email', 'timezone', 'date_format', 'currency', 'name', 'password', 'currency']);
        $bank_details = $request->except(['email', 'timezone', 'date_format', 'currency', 'name', 'password', '_token', '_method', 'password_confirmation']);
        // dd($data, $bank_details);
        // Update password if provided
        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $profile->update($data);



        BankDetail::where('status', 1)->update(['status' => 0]);
        BankDetail::create($bank_details);
        // Optionally, you can return a response indicating success
        return to_route('profile.edit', [$profile->id])->with(['message' => 'Profile updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
