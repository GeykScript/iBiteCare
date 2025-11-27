<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicServices;
use App\Models\ClinicServicesSchedules;
use Illuminate\Support\Facades\Crypt;

class Services extends Controller
{
    //
   public function index(){

      $clinicUser = Auth::guard('clinic_user')->user();

      return view('ClinicUser.services', compact('clinicUser'));   
   }   

   //function to redirect to update service page
   public function update($id){
      $id = Crypt::decrypt($id);
      $clinicUser = Auth::guard('clinic_user')->user();
      $service = ClinicServices::findOrFail($id);

      return view('ClinicUser.services-update', compact('clinicUser', 'service'));
   }

   //function to handle update service details
   public function updateServiceDetails(Request $request){


         $request->validate([
               'service_id' => 'required|exists:services,id',
               'name' => 'required|string|max:255',
               'description' => 'nullable|string',
               'service_fee' => 'required|numeric|min:0',
               'discount' => 'nullable|numeric|min:0',
               'discounted_service_fee' => 'nullable|numeric|min:0',
               'rig_fee_input' => 'nullable|numeric|min:0',
               'discounted_rig' => 'nullable|numeric|min:0',
         ]);

   
         $service = ClinicServices::find($request->input('service_id'));
   
         if (!$service) {
               return redirect()->back()->with('error', 'Service not found.');
         }
   
         $service->name = $request->input('name');
         $service->description = $request->input('description');
         $service->service_fee = $request->input('service_fee');
         $service->discount = $request->input('discount', 0);
         $service->discounted_service_fee = $request->input('discounted_service_fee', 0);
         $service->rig_fee = $request->input('rig_fee_input', 0);
         $service->discounted_rig = $request->input('discounted_rig', 0);
         $service->save();

      // --- Handle Schedules ---

      // 1. Delete removed schedules
      if ($request->has('deleted_schedules')) {
         ClinicServicesSchedules::whereIn('id', $request->input('deleted_schedules'))
            ->where('service_id', $service->id)
            ->delete();
      }

      // 2. Update remaining schedules (only those that came back in the request)
      if ($request->has('schedules')) {
         foreach ($request->input('schedules') as $index => $scheduleData) {
            if (!empty($scheduleData['id'])) {
               ClinicServicesSchedules::where('id', $scheduleData['id'])
                  ->where('service_id', $service->id)
                  ->update([
                     'day_offset' => $request->input("day.$index"),
                     'label'      => $request->input("label.$index"),
                  ]);
            }
         }
      }

      // 3. Insert new schedules
      if ($request->has('newDay') && $request->has('newLabel')) {
         foreach ($request->input('newDay') as $i => $day) {
            $label = $request->input("newLabel.$i");

            // Skip empty inputs
            if (!empty($day) || !empty($label)) {
               ClinicServicesSchedules::create([
                  'service_id' => $service->id,
                  'day_offset' => $day,
                  'label'      => $label,
               ]);
            }
         }
      }


      return redirect()->route('clinic.services')->with('success', 'Service Details updated successfully.');
   }

   //function to handle adding new service
   // function to handle adding new service
   public function addNewService(Request $request)
   {
      // Validate input
      $validated = $request->validate([
         'service_name' => 'required|string|max:255',
         'service_fee'  => 'required|numeric|min:0',
         'description'  => 'required|string|max:1000',
         'discount'     => 'nullable|numeric|min:0',
         // 'newDay'       => 'array|nullable',
         // 'newDay.*'     => 'nullable|integer|min:0',
         // 'newLabel'     => 'array|nullable',
         // 'newLabel.*'   => 'nullable|string|max:255',
      ]);

      // Save service
      $service = ClinicServices::create([
         'name' => $validated['service_name'],
         'service_fee'  => $validated['service_fee'],
         'description'  => $validated['description'],
         'discount'     => $validated['discount'] ?? 0,
         'discounted_service_fee' => $validated['service_fee'] - ($validated['service_fee'] * ($validated['discount'] ?? 0) / 100),
      ]);

      // If schedules were added
      // if (!empty($validated['newDay']) && !empty($validated['newLabel'])) {
      //    foreach ($validated['newDay'] as $index => $dayOffset) {
      //       if ($dayOffset !== null && !empty($validated['newLabel'][$index])) {
      //          ClinicServicesSchedules::create([
      //             'service_id' => $service->id,
      //             'day_offset' => $dayOffset,
      //             'label'      => $validated['newLabel'][$index],
      //          ]);
      //       }
      //    }
      // }

      return redirect()->back()->with('success', 'New service added successfully!');
   }
}
