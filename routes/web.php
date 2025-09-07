<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlotController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProjectController;
use App\Http\Controllers\Freelance\FreelanceDashboardController;
use App\Http\Controllers\Freelance\FreelanceProjectController;
use App\Http\Controllers\Prospect\ProspectDashboardController;
use App\Http\Controllers\Prospect\ProspectProjectController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
})->name('login');

// for temp used
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('plot', PlotController::class);
        Route::resource('user', UserController::class);
        Route::resource('project', ProjectController::class);
    });

    Route::middleware(['auth', 'users'])->prefix('user')->name('user.')->group(function () {

        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        // New Projects (created by admin)
        Route::get('/projects/new', [UserProjectController::class, 'newProjects'])
        ->name('project.new');
    
        // Ongoing Projects (status = ongoing)
        Route::get('/projects/ongoing', [UserProjectController::class, 'ongoingProjects'])
            ->name('project.ongoing');

        Route::get('projects/{id}', [UserProjectController::class, 'show'])->name('project.show'); 
        Route::post('projects/assign-freelancers', [UserProjectController::class, 'assignFreelancers'])->name('project.assignFreelancers');  
        Route::get('projects/{id}/detail', [UserProjectController::class, 'detail'])->name('project.detail');  
        Route::get('/project/{project}/plot/{plot}/assignments', [UserProjectController::class, 'getPlotAssignments'])
            ->name('project.plot.assignments');
        Route::post('/assign-plot', [UserProjectController::class, 'assignPlot'])->name('assignPlot');
    

    });

    Route::middleware(['auth', 'freelance'])->prefix('freelancer')->name('freelancer.')->group(function () {
        Route::get('dashboard', [FreelanceDashboardController::class, 'index'])->name('dashboard');
        Route::post('/prospects/addProspects', [FreelanceProjectController::class, 'addProspects'])->name('prospects.addProspects');
        Route::get('/prospects/allProspects', [FreelanceProjectController::class, 'showAllProspects'])->name('prospects.allProspects');
        Route::get('/prospects/addedProspects', [FreelanceProjectController::class, 'showAddedProspects'])->name('prospects.addedProspects');
        Route::get('/prospects/pendingProspects', [FreelanceProjectController::class, 'showPendingProspects'])->name('prospects.pendingProspects');
        Route::get('/reward', [FreelanceProjectController::class, 'reward'])->name('reward');
    });

    Route::middleware(['auth', 'prospect'])->prefix('prospect')->name('prospect.')->group(function () {
        Route::get('dashboard', [ProspectDashboardController::class, 'index'])->name('dashboard');
        Route::get('add', [ProspectProjectController::class, 'add'])->name('add'); // add freelancer form
        Route::post('addFreelancer', [ProspectProjectController::class, 'addFreelancer'])->name('addFreelancer');
        Route::get('/{id}/prospects', [ProspectProjectController::class, 'allProspects'])
            ->name('allProspects');
    });

    // Optional default route
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

require __DIR__.'/auth.php';
