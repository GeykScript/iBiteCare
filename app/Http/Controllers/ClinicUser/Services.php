<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicServices;
use App\Models\ClinicServicesSchedules;

class Services extends Controller
{
    //
   public function index(){

      $clinicUser = Auth::guard('clinic_user')->user();

      return view('ClinicUser.services', compact('clinicUser'));   
   }   


   public function update($id){
      $clinicUser = Auth::guard('clinic_user')->user();
      $service = ClinicServices::findOrFail($id);

      return view('ClinicUser.services-update', compact('clinicUser', 'service'));
   }


   public function updateServiceDetails(Request $request){

         $request->validate([
               'service_id' => 'required|exists:services,id',
               'name' => 'required|string|max:255',
               'description' => 'nullable|string',
               'service_fee' => 'required|numeric|min:0',
         ]);
   
         $service = ClinicServices::find($request->input('service_id'));
   
         if (!$service) {
               return redirect()->back()->with('error', 'Service not found.');
         }
   
         $service->name = $request->input('name');
         $service->description = $request->input('description');
         $service->service_fee = $request->input('service_fee');
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
}
