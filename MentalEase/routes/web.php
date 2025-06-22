<?php



use App\Http\Controllers\Index;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Assessment;
use App\Http\Controllers\Users;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\VideoSDKController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Journal;

use Illuminate\Support\Facades\Route;


// uncomment when maintenance is done

// Route::get('/', function () {
//     return view('maintenance');
// });

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome'); 

// login route
Route::get('/login', [Index::class, 'login'])->name('login');
Route::post('/login', [Index::class, 'login'])->name('login');

// register route
Route::get('/register', [Index::class, 'register'])->name('register');
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

// assessments pss and dass21
Route::get('/assessment/pss', [Assessment::class, 'pss'])->name('assessment.pss');
Route::get('/assessment/pss/takeassessment', [Assessment::class, 'pssassessment'])->name('assessment.pss.take');
Route::post('/assessment/pss/submit', [Assessment::class, 'pssSubmit'])->name('assessment.pss.submit');

Route::get('/assessment/dass', [Assessment::class, 'dass'])->name('assessment.dass');
Route::get('/assessment/dass/takeassessment', [Assessment::class, 'dassassessment'])->name('assessment.dass.take');
Route::get('/assessment/dass/take', [Assessment::class, 'dassAssessmentTake'])->name('assessment.dass.take');
Route::post('/assessment/dass/submit', [Assessment::class, 'dassSubmit'])->name('assessment.dass.submit');
Route::get('/assessment/dass/results', [Assessment::class, 'dassResults'])->name('assessment.dass.results');

// schedule
Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
Route::post('/schedule/store', [ScheduleController::class, 'store'])->name('schedule.store');
Route::get('/schedule/view', [ScheduleController::class, 'view'])->name('schedule.view');
Route::get('/available-times', [ScheduleController::class, 'getAvailableTimes'])->name('schedule.available-times');
Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

// appointment 
Route::get('/appointment/select', [AppointmentController::class, 'selectPsychometrician'])->name('appointment.selectPsychometrician');
Route::get('/appointment/choose/{id}', [AppointmentController::class, 'chooseSchedule'])->name('appointment.choose');
Route::post('/appointment/payment', [AppointmentController::class, 'payment'])->name('appointment.payment');
Route::post('/appointment/confirm', [AppointmentController::class, 'confirm'])->name('appointment.confirm');
Route::get('/appointment/success', [AppointmentController::class, 'success'])->name('appointment.success');

// get videosdk token
Route::get('/get-videosdk-token', [VideoController::class, 'getToken']);

// view appointments for psychometrician
Route::get('/appointment/view', [AppointmentController::class, 'appointmentsview'])->name('appointment.view');
Route::get('/appointments/show/{id}', [AppointmentController::class, 'appointmentsshow'])->name('appointments.show');
Route::get('/appointments/edit/{id}', [AppointmentController::class, 'appointmentsedit'])->name('appointments.edit');
Route::post('/appointments/complete/{id}', [AppointmentController::class, 'appointmentscomplete'])->name('appointments.complete');

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
Route::get('/users/pdf', [Users::class, 'generatePdf'])->name('users.pdf');


// consultation
Route::get('/consultation', [Index::class, 'consultation'])->name('consultation');


// welcome for psychometrician
Route::get('/welcome/psychometrician', [Index::class, 'welcomepsychometrician'])->name('welcomepsychometrician');

// patient record
Route::get('/myrecords', [Index::class, 'myrecords'])->name('myrecords');

// journal routes
Route::get('/journal', [Index::class, 'journal'])->name('journal');
Route::get('/journal/list', [Journal::class, 'journallist'])->name('journal.list');
Route::get('/journal/add', [Journal::class, 'journaladd'])->name('journal.add');
Route::post('/journal/store', [Journal::class, 'journalstore'])->name('journal.store');
Route::get('/journal/{id}', [Journal::class, 'journalshow'])->name('journal.show');
Route::get('/journal/{id}/edit', [Journal::class, 'journaledit'])->name('journal.edit');
Route::post('/journal/{id}/update', [Journal::class, 'journalupdate'])->name('journal.update');
Route::delete('/journal/{id}', [Journal::class, 'journaldelete'])->name('journal.delete');

Route::get('/journal/record', [Index::class, 'journalrecord'])->name('journal.record');

// Routes for resending activation code
Route::get('/activate/{username}/resend', [Users::class, 'resendActivationCodeForm'])->name('resend.activation.code');
Route::post('/activate/resend', [Users::class, 'resendActivationCode'])->name('resend.activation.code.submit');

// PSS Assessment results route
Route::get('/assessment/pss/results', [Assessment::class, 'pssResults'])->name('assessment.pss.results');


// videosdk
Route::post('/create/meeting', [VideoSDKController::class, 'createmeeting'])->name('create.meeting');


// payment
Route::post('/pay', [PaymentController::class, 'createCheckout'])->name('pay');
Route::get('/payment/success/{id}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failed/{id}', [PaymentController::class, 'paymentFailed'])->name('payment.failed');
Route::get('/payment/cancelled/{id}', [PaymentController::class, 'paymentCancelled'])->name('payment.cancelled');

// welcome cashier
Route::get('/welcome/cashier', [Index::class, 'welcomecashier'])->name('welcomecashier');
