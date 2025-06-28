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
use App\Http\Controllers\CashierController;
use App\Http\Controllers\BackupController;

use App\Http\Controllers\Journal;

use Illuminate\Support\Facades\Route;


// uncomment when maintenance is done

// Route::get('/', function () {
//     return view('maintenance');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [Index::class, 'welcome'])->name('welcome');


// login route
Route::get('/login', [Index::class, 'login'])->name('login');
Route::post('/login', [Index::class, 'login'])->name('login');

// register route
Route::get('/register', [Index::class, 'register'])->name('register');
Route::post('/register', [Index::class, 'register'])->name('register');


Route::get('/profile/complete', [Users::class, 'profilecomplete'])->name('profile.complete');
Route::post('/profile/complete', [Users::class, 'profilecomplete'])->name('profile.complete');

Route::get('/activate/{username}', [Users::class, 'activate'])->name('activate');
Route::post('/activate/{username}', [Users::class, 'activate'])->name('activate');

Route::get('/email/activationcode', [Users::class, 'email/activationcode'])->name('email.activationcode');

// welcome route for patient
route::get('/welcomepatient', [Index::class, 'welcomepatient'])->name('welcomepatient');

// logout
Route::get('/logout', [Index::class, 'logout'])->name('logout');

// Auto logout (for incomplete profiles when closing browser)
Route::get('/logout/auto', [Index::class, 'autoLogout'])->name('logout.auto');

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
Route::get('/appointment/patientview', [AppointmentController::class, 'appointmentspatientview'])->name('appointment.patientview');
Route::post('/appointments/cancel/{id}', [AppointmentController::class, 'appointmentscancel'])->name('appointments.cancel');
Route::get('/patient/appointment/history', [Users::class, 'patientappointmenthistory'])->name('patient.appointment.history');
Route::get('/appointment/details/{id}', [AppointmentController::class, 'details'])->name('appointment.details');

// get videosdk token
Route::get('/get-videosdk-token', [VideoController::class, 'getToken']);

// view appointments for psychometrician
Route::get('/appointment/view', [AppointmentController::class, 'appointmentview'])->name('appointment.view');
Route::get('/appointment/viewconfirmed', [AppointmentController::class, 'appointmentviewconfirmed'])->name('appointment.viewconfirmed');
Route::get('/appointment/confirmation', [AppointmentController::class, 'appointmentsconfirmation'])->name('appointment.confirmation');
Route::get('/appointments/show/{id}', [AppointmentController::class, 'appointmentsshow'])->name('appointments.show');
Route::get('/appointments/showconfirmation/{id}', [AppointmentController::class, 'appointmentsshowconfirmation'])->name('appointments.showconfirmation');
Route::get('/appointments/edit/{id}', [AppointmentController::class, 'appointmentsedit'])->name('appointments.edit');
Route::post('/appointments/complete/{id}', [AppointmentController::class, 'appointmentscomplete'])->name('appointments.complete');
Route::post('/appointments/confirming/{id}', [AppointmentController::class, 'appointmentconfirming'])->name('appointments.confirming');
Route::post('/appointment/cancel/{id}', [AppointmentController::class, 'cancelAppointment'])->name('appointment.cancel');

// User profile routes
Route::get('/profile', [Users::class, 'profile'])->name('profile');
Route::get('/profile/edit', [Users::class, 'editProfile'])->name('profile.edit');
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

// admin appointment records
Route::get('/appointments/records', [AppointmentController::class, 'appointmentsrecords'])->name('appointment.records');
Route::get('/appointments/pdf', [AppointmentController::class, 'generatePdf'])->name('appointment.pdf');

// consultation routes
Route::get('/consultation', [Index::class, 'consultation'])->name('consultation');
Route::get('/consultation/psychometrician', [Index::class, 'consultationpsychometrician'])->name('consultationpsychometrician');


// Dashboard for psychometrician
Route::get('/welcomepsychometrician', [AppointmentController::class, 'welcomepsychometrician'])->name('welcomepsychometrician');

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

// Route for resending activation code
Route::get('/activate/{username}/resend', [Users::class, 'resendActivationCodeForm'])->name('resend.activation.code');

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

Route::get('/payment/records', [PaymentController::class, 'paymentrecords'])->name('payment.records');

// Admin dashboard routes
Route::get('/admin/refresh-stats', [App\Http\Controllers\AdminController::class, 'refreshStats'])->name('admin.refresh-stats');

// Cashier routes
Route::get('/welcomecashier', [Index::class, 'welcomeCashier'])->name('welcomecashier');Route::get('/payment/create', [PaymentController::class, 'createPaymentForm'])->name('payment.create');
Route::post('/payment/store', [PaymentController::class, 'storePayment'])->name('payment.store');
Route::get('/payment/records', [PaymentController::class, 'paymentRecords'])->name('payment.records');
Route::get('/payment/reports', [PaymentController::class, 'paymentReports'])->name('payment.reports');
Route::get('/payment/receipt/{id}', [PaymentController::class, 'generateReceipt'])->name('payment.receipt');


// Backup routes
Route::get('/backup/viewbackups', [BackupController::class, 'viewbackups'])->name('backup.viewbackups');
Route::get('/backups/download/{filename}', [BackupController::class, 'download'])->name('backups.download');
Route::get('/backup/create', [BackupController::class, 'createbackup'])->name('backups.create');










