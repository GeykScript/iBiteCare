<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicUser;
use App\Models\ClinicUserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClinicUserAccountMail;
use Illuminate\Support\Facades\Validator;
use App\Models\ClinicUserLogs;
class ClinicUsersController extends Controller
{
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        $clinic_users = ClinicUser::all();
        [$generated_id, $default_password] = $this->generateUniqueIdAndPassword();
        

        return view('ClinicUser.user-accounts', compact('clinicUser', 'clinic_users', 'generated_id', 'default_password'));
    }


    // function to generate unique password
    private function generateUniqueIdAndPassword()
    {
        do {
            $prefix = "DrCare-" . date('Y');
            $part1 = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $part2 = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

            $id = $prefix . '-' . $part1 . '-' . $part2;
            $default_password = "DrCareABC-" . date('Y') . '-' . $part1 . '-' . $part2;

            $exists = ClinicUser::where('account_id', $id)->exists();
        } while ($exists);

        return [$id, $default_password];
    }


        // pass the value to the frontend using json
    public function generateId()
    {
        [$id, $default_password] = $this->generateUniqueIdAndPassword();

        return response()->json([
            'generated_id' => $id,
            'default_password' => $default_password
        ]);
    }



//function to create user account
    public function createUserAccount(Request $request)
    {
        $request->validate([
            'account_id'      => 'required|string|max:255|unique:users,account_id',
            'role'            => 'required|integer|in:1,2,3',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'middle_initial'  => 'nullable|string|max:10',
            'suffix'          => 'nullable|string|max:50',
            'email'           => 'required|email|max:255|unique:users,email',
            'contact_number'  => 'required|string|max:20',
            'password'        => 'required|string|min:8',
            'default_password' => 'required|string|max:255',
            'gender'          => 'required|string|in:male,female',
            'date_of_birth'   => 'required|date',
            'age'             => 'required|integer|min:0',
            'province'        => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'barangay'        => 'required|string|max:255',
            'description'     => 'nullable|string|max:500',
        ]);



        $suffix = null;
        if ($request->suffix) {
            $suffix = strtoupper($request->suffix); // convert first
            if (in_array($suffix, ['JR', 'SR'])) {
                $suffix = Str::ucfirst(Str::lower($suffix)) . '.'; // Jr. / Sr.
            } elseif (preg_match('/^[IVX]+$/', $suffix)) {
                // Roman numerals: II, III, IV, etc.
                $suffix = $suffix;
            } else {
                // Default: capitalize first letter
                $suffix = Str::ucfirst(Str::lower($suffix));
            }
        }

        $address = $request->barangay . ', ' .$request->city . ', ' . $request->province . ', ' . $request->description;


        $user = ClinicUser::create([
            'account_id'      => $request->account_id,
            'role'            => $request->role,
            'first_name' => Str::title(Str::lower($request->first_name)),
            'last_name'        => Str::title(Str::lower($request->last_name)), 
            'middle_initial'   => Str::upper($request->middle_initial),            
            'suffix'           => $suffix, 
            'email'           => $request->email,
            'password'        => bcrypt($request->password),
            'default_password' => $request->default_password,
        ]);

 

        // 2. Create user info record
        ClinicUserInfo::create([
            'user_id'        => $user->id,
            'role_id'        => $request->role,
            'contact_number' => $request->contact_number,
            'address'        => $address,
            'gender'         => $request->gender,
            'birthdate'      => $request->date_of_birth,
            'age'            => $request->age,
        ]);

        $user_account = ClinicUser::where('account_id', $request->account_id)->first();
        $user_default_password = $user_account->default_password;

        //log the creation of user account
        $clinicUser = Auth::guard('clinic_user')->user();

        ClinicUserLogs::create([
            'user_id' => $clinicUser->id,
            'role_id' => $clinicUser->role,
            'action' => 'Create User Account for ' . $user->first_name . ' ' . $user->last_name,
            'details' => 'Clinic user created a new account.',
            'date_and_time' => now(),
        ]);
        

        //mail the defualt user account and password
        Mail::to($user->email)->send(new ClinicUserAccountMail($user_account, $user_default_password));

        return redirect()->route('clinic.user-accounts')->with('success', 'User account created successfully!');
    }


    // function to update clinic user information 
    public function updateClinicUserInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'update_first_name'      => 'required|string|max:255',
            'update_last_name'       => 'required|string|max:255',
            'update_middle_initial'  => 'nullable|string|max:10',
            'update_suffix'          => 'nullable|string|max:50',
            'update_email'           => 'required|email|max:255|unique:users,email,' . $request->id,
            'update_contact_number'  => 'required|string|max:20',
            'update_province'        => 'nullable|string|max:255',
            'update_city'            => 'nullable|string|max:255',
            'update_barangay'        => 'nullable|string|max:255',
            'update_description'     => 'nullable|string|max:500',
            'is_disabled'            => 'nullable|boolean',
        ], [], [
            //  Custom attribute names here
            'update_first_name'     => 'first name',    
            'update_last_name'      => 'last name',
            'update_middle_initial' => 'middle initial',    
            'update_suffix'         => 'suffix',
            'update_email'          => 'email',
            'update_contact_number' => 'contact number',
            'update_province'       => 'province',
            'update_city'           => 'city',
            'update_barangay'       => 'barangay',
            'update_description'    => 'description',
            'is_disabled'           => 'is disabled',
        ]);


        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->with('update_errors', $validator->errors())
                ->with('update_error_id', $request->id) // or however you identify the user
                ->withInput();
        }

        // Handle suffix formatting
        $suffix = null;
        if ($request->update_suffix) {
            $suffix = strtoupper($request->update_suffix);
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
            'first_name'      => Str::title(Str::lower($request->update_first_name)),
            'last_name'       => Str::title(Str::lower($request->update_last_name)),
            'middle_initial'  => Str::upper($request->update_middle_initial),
            'suffix'          => $suffix,
            'email'           => $request->update_email,
            'is_disabled'     => $request->is_disabled ?? 0, // default to 0 if not set
        ];

        // Old user data
        $oldUserData = $clinic_user->only(array_keys($newUserData));

        // Build address
        if (
            empty($request->update_barangay) &&
            empty($request->update_city) &&
            empty($request->update_province) &&
            empty($request->update_description)
        ) {
            $address = ClinicUserInfo::where('user_id', $clinic_user->id)->value('address');
        } else {
            $address = $request->update_barangay . ', ' .
                $request->update_city . ', ' .
                $request->update_province . ', ' .
                $request->update_description;
        }

        $clinicUserInfo = ClinicUserInfo::where('user_id', $clinic_user->id)->first();
        $newInfoData = [
            'contact_number' => $request->update_contact_number,
            'address'        => $address,
        ];
        $oldInfoData = $clinicUserInfo->only(array_keys($newInfoData));

        // Check if any changes exist
        if ($oldUserData == $newUserData && $oldInfoData == $newInfoData) {
            return redirect()->route('clinic.user-accounts')->with('update-success', 'No changes made.');
        }

        // Perform updates
        $clinic_user->update($newUserData);
        $clinicUserInfo->update($newInfoData);

        //log the creation of user account
        $clinicUser = Auth::guard('clinic_user')->user();
        ClinicUserLogs::create([
            'user_id' => $clinicUser->id,
            'role_id' => $clinicUser->role,
            'action' => 'Update Information for ' . $clinic_user->first_name . ' ' . $clinic_user->last_name,
            'details' => 'Clinic user updated an account.',
            'date_and_time' => now(),
        ]);

        return redirect()->route('clinic.user-accounts')->with('update-success', 'User account updated successfully!');
    }


    //function to show user logs
    public function ClinicUserLogs()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        return view('ClinicUser.user-logs', compact('clinicUser'));
    }
}
