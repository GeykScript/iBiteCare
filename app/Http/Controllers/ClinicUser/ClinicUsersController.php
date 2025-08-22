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



class ClinicUsersController extends Controller
{
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        $clinic_users = ClinicUser::all();
        [$generated_id, $default_password] = $this->generateUniqueIdAndPassword();

        return view('ClinicUser.user-accounts', compact('clinicUser', 'clinic_users', 'generated_id', 'default_password'));
    }

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

    public function generateId()
    {
        [$id, $default_password] = $this->generateUniqueIdAndPassword();

        return response()->json([
            'generated_id' => $id,
            'default_password' => $default_password
        ]);
    }



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
            'first_name'       => Str::ucfirst(Str::lower($request->first_name)),
            'last_name'        => Str::ucfirst(Str::lower($request->last_name)), 
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

        Mail::to($user->email)->send(new ClinicUserAccountMail($user_account, $user_default_password));

        return redirect()->route('clinic.user-accounts')->with('success', 'User account created successfully!');
    }
}
