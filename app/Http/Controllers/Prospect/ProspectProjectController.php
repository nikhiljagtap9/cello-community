<?php

namespace App\Http\Controllers\Prospect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Plot;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Project;
use App\Models\ProjectFreelancerAssignment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class ProspectProjectController extends Controller
{

    // add freelancer form
    public function add(){
       return view('prospect.add');
    }

    public function addFreelancer(Request $request)
    {
        $mainUser  = auth()->user();       // logged in main user

        // Check how many sub-freelancers are already assigned
        $existingSubs = $mainUser->children()->count();
        if ($existingSubs >= 2) {
            return redirect()->back()->with('error', 'Prospect already has max 2 sub-freelancers.');
        }

        // ✅ Validation (at least one email required)
        if (empty($request->freelancer_a_email) && empty($request->freelancer_b_email)) {
            return redirect()->back()->with('error', 'Please enter at least one freelancer.');
        }

        // You can also add field-level validation
        $request->validate([
            'freelancer_a_email' => 'nullable|email|unique:users,email',
            'freelancer_b_email' => 'nullable|email|unique:users,email',
            'freelancer_a_first_name' => 'nullable|required_with:freelancer_a_email',
            'freelancer_b_first_name' => 'nullable|required_with:freelancer_b_email',
        ]);

        DB::transaction(function () use ($request,$mainUser) {

           // $projectId = $request->project_id; // coming from form
           

            // --- Create Freelancer A ---
            if ($request->freelancer_a_email) {
                $password = Str::random(8);
                $password = '12345678'; // static or generate random
                $freelancerA = $mainUser->addChild([
                    'email'     => $request->freelancer_a_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'sub_freelancer',
                ]);

                $freelancerA->details()->create([
                    'first_name' => $request->freelancer_a_first_name,
                    'last_name'  => $request->freelancer_a_last_name,
                    'phone'      => $request->freelancer_a_phone,
                ]);

                // Save assignment
                // ProjectFreelancerAssignment::create([
                //     'project_id'    => $projectId,
                //     'freelancer_id' => $freelancerA->id,
                //     'plot_id'       => $request->plot_id,
                //     'status'        => 'ongoing',
                //     'role'          => 'A'
                // ]);
                //  Mail::to($freelancerA->email)->send(new TempPasswordMail($password));
            }

            // --- Create Freelancer B ---
            if ($request->freelancer_b_email) {
                $password = Str::random(8);
                $password = '12345678';
                $freelancerB = $mainUser->addChild([
                    'email'     => $request->freelancer_b_email,
                    'password'  => bcrypt($password),
                    'user_type' => 'sub_freelancer',
                ]);

                $freelancerB->details()->create([
                    'first_name' => $request->freelancer_b_first_name,
                    'last_name'  => $request->freelancer_b_last_name,
                    'phone'      => $request->freelancer_b_phone,
                ]);

                // ProjectFreelancerAssignment::create([
                //     'project_id'    => $projectId,
                //     'freelancer_id' => $freelancerB->id,
                //     'plot_id'       => $request->plot_id,
                //     'status'        => 'ongoing',
                //     'role'          => 'B',
                // ]);

                //  Mail::to($freelancerB->email)->send(new TempPasswordMail($password));
            }
        });

        return redirect()->back()->with('success', 'Freelancers added successfully!');
    }
    
    public function allProspects($subFreelancerId)
    {
        $subFreelancer = User::with('prospects.details') // eager load
            ->findOrFail($subFreelancerId);

        $prospects = $subFreelancer->subProspects; // collection of subProspects    
        return view('prospect.all-prospects', compact('prospects'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
