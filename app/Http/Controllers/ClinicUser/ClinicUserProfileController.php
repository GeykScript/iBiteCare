<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ClinicUser;
use App\Models\ClinicUserLogs;
use App\Models\ClinicUserInfo;

class ClinicUserProfileController extends Controller
{
    //
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        $emails = ClinicUser::all()->pluck('email')->toArray();

        return view('ClinicUser.userprofile', compact('clinicUser', 'emails'));
    }


    public function updateUserProfileAccount(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'middle_initial'  => 'nullable|string|max:10',
            'suffix'          => 'nullable|string|max:50',
            'email'           => 'required|email|max:255|unique:users,email,' . $request->id,
            'contact_number'  => 'required|string|max:20',
            'province'        => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'barangay'        => 'nullable|string|max:255',
            'description'     => 'nullable|string|max:500',
        ]);

        // Handle suffix formatting
        $suffix = null;
        if ($request->suffix) {
            $suffix = strtoupper($request->suffix);
            if (in_array($suffix, ['JR', 'SR'])) {
                $suffix = Str::ucfirst(Str::lower($suffix)) . '.'; // Jr. / Sr.
            } elseif (preg_match('/^[IVX]+$/', $suffix)) {
                $suffix = $suffix;
            } else {
                $suffix = Str::ucfirst(Str::lower($suffix));    
            }
        }

        $clinic_user = ClinicUser::findOrFail($request->id);

        // Format new values
        $newUserData = [
            'first_name'      => Str::title(Str::lower($request->first_name)),
            'last_name'       => Str::title(Str::lower($request->last_name)),
            'middle_initial'  => Str::upper($request->middle_initial),
            'suffix'          => $suffix,
            'email'           => $request->email,
        ];

        // Old user data
        $oldUserData = $clinic_user->only(array_keys($newUserData));

        // Build address
        if (
            empty($request->barangay) &&
            empty($request->city) &&
            empty($request->province) &&
            empty($request->description)
        ) {
            $address = ClinicUserInfo::where('user_id', $clinic_user->id)->value('address');
        } else {
            $address = $request->barangay . ', ' .
                $request->city . ', ' .
                $request->province . ', ' .
                $request->description;
        }

        $clinicUserInfo = ClinicUserInfo::where('user_id', $clinic_user->id)->first();
        $newInfoData = [
            'contact_number' => $request->contact_number,
            'address'        => $address,
        ];
        $oldInfoData = $clinicUserInfo->only(array_keys($newInfoData));

        // Check if any changes exist
        if ($oldUserData == $newUserData && $oldInfoData == $newInfoData) {
            return redirect()->route('clinic.profile')->with('profile-success', 'No changes made.');
        }

        // Perform updates
        $clinic_user->update($newUserData);
        $clinicUserInfo->update($newInfoData);

        // Log the update action
        $clinicUser = Auth::guard('clinic_user')->user();
        ClinicUserLogs::create([
            'user_id' => $clinicUser->id,
            'role_id' => $clinicUser->role,
            'action' => 'Update Information for ' . $clinic_user->first_name . ' ' . $clinic_user->last_name,
            'details' => 'Clinic user updated account information.',
            'date_and_time' => now(),
        ]);

        return redirect()->route('clinic.profile')->with('profile-success', 'User account updated successfully!');
    }

    public function userManual(){
        return view('ClinicUser.manual');
    }
}
