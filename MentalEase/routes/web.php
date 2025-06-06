<?php



use App\Http\Controllers\Index;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Assessment;
use App\Http\Controllers\Users;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// login route
Route::get('/login', [Index::class, 'login'])->name('login');
Route::post('/login', [Index::class, 'login'])->name('login');

// register route
Route::post('/register', [Index::class, 'register'])->name('register');

Route::match(['get', 'post'], '/activate/{username}', [Users::class, 'activate'])->name('activate');

Route::get('/email/activationcode', [Users::class, 'email/activationcode'])->name('email.activationcode');

// welcome route for patient
route::get('/welcomepatient', [Index::class, 'welcomepatient'])->name('welcomepatient');

// logout
Route::get('/logout', [Index::class, 'logout'])->name('logout');

// chatbot
Route::get('/chatbot', [Chat::class, 'chatbot'])->name('chatbot');
Route::post('/chatbot', 'App\Http\Controllers\Chat');

// about
Route::get('/about', [Index::class, 'about'])->name('about');

// appointment
Route::get('/appointment', [Index::class, 'appointment'])->name('appointment');

// assessments
Route::get('/assessment/stress', [Assessment::class, 'stress'])->name('assessment.stress');
Route::get('/assessment/stress/takeassessment', [Assessment::class, 'stressassessment'])->name('assessment.stress.take');

Route::get('/assessment/emotional', [Assessment::class, 'emotional'])->name('assessment.emotional');
Route::get('/assessment/emotional/takeassessment', [Assessment::class, 'emotionalassessment'])->name('assessment.emotional.take');


// schedule
Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
Route::post('/schedule/store', [ScheduleController::class, 'store'])->name('schedule.store');
Route::get('/schedule/view', [ScheduleController::class, 'view'])->name('schedule.view');

// appointment 
Route::get('/appointment/select', [AppointmentController::class, 'selectPsychometrician'])->name('appointment.selectPsychometrician');
Route::get('/appointment/choose/{id}', [AppointmentController::class, 'chooseSchedule'])->name('appointment.choose');
Route::post('/appointment/payment', [AppointmentController::class, 'payment'])->name('appointment.payment');
Route::post('/appointment/confirm', [AppointmentController::class, 'confirm'])->name('appointment.confirm');
Route::get('/appointment/success', [AppointmentController::class, 'success'])->name('appointment.success');

// User profile
Route::get('/profile', [Users::class, 'profile'])->name('profile');
Route::post('/profile/update', [Users::class, 'updateProfile'])->name('profile.update');

// user settings
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

// welome for admin
Route::get('/welcome/admin', [Index::class, 'welcomeadmin'])->name('welcomeadmin');


// admin user management
Route::get('/usersview', [Users::class, 'usersview'])->name('users.view');
Route::get('/users/add', [Users::class, 'usersadd'])->name('users.add');
Route::post('/users/add', [Users::class, 'usersadd'])->name('users.add');
Route::get('/users/edit/{id}', [Users::class, 'usersedit'])->name('users.edit');
Route::post('/users/edit/{id}', [Users::class, 'usersedit'])->name('users.edit');
Route::get('/users/disable/{id}', [Users::class, 'usersdisable'])->name('users.disable');
Route::get('/users/idview/{id}', [Users::class, 'usersidview'])->name('users.idview');
Route::get('/users/idview/disabled/{id}', [Users::class, 'usersidviewdisabled'])->name('users.idview.disabled');
Route::get('/users/enable/{id}', [Users::class, 'usersenable'])->name('users.enable');
Route::get('/usersarchive', [Users::class, 'usersarchive'])->name('users.archive');


// consultation
Route::get('/consultation', [Index::class, 'consultation'])->name('consultation');


// welcome for psychometrician
Route::get('/welcome/psychometrician', [Index::class, 'welcomepsychometrician'])->name('welcomepsychometrician');

// patient record
Route::get('/myrecords', [Index::class, 'myrecords'])->name('myrecords');

// journal
Route::get('/journal', [Index::class, 'journal'])->name('journal');

// Routes for resending activation code
Route::get('/activate/{username}/resend', [Users::class, 'resendActivationCodeForm'])->name('resend.activation.code');
Route::post('/activate/resend', [Users::class, 'resendActivationCode'])->name('resend.activation.code.submit');
