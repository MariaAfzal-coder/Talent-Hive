<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\PartsCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\InchargeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CertificateController;

use App\Http\Controllers\InterviewController;

 use App\Http\Controllers\MechanicCategoryController;
 use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');;
Route::get('/mainpage', [HomeController::class, 'mainPage'])->name('mainpage');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//Student Panel Routes
Route::post('/student/save', [StudentsController::class, 'save'])->name('student.save');
Route::post('/student/check', [StudentsController::class, 'check'])->name('student.check');
Route::get('/student/logout', [StudentsController::class, 'logout'])->name('student.logout');
Route::post('/student/profile/update', [StudentsController::class, 'updateProfile'])->name('student.profile.update');
Route::get('/get-company-name/{id}', [StudentsController::class, 'getCompanyName']);

 
Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/student/register', [StudentsController::class, 'register'])->name('student.register');
    Route::get('/student/login', [StudentsController::class, 'login'])->name('student.login');
    Route::get('/student/dashboard', [StudentsController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [StudentsController::class, 'profile'])->name('student.profile');
    Route::get('/student/makeprofile', [StudentsController::class, 'makeprofile'])->name('student.makeprofile');
    Route::get('/student/editprofile', [StudentsController::class, 'editprofile'])->name('student.editprofile');
    Route::get('/student/viewprofile', [StudentsController::class, 'viewprofile'])->name('student.viewprofile');

    Route::get('/student/createproject', [StudentsController::class, 'createproject'])->name('student.createproject');
    Route::get('/student/projectdetails', [StudentsController::class, 'projectdetails'])->name('student.projectdetails');
    Route::get('/student/cv', [StudentsController::class, 'cv'])->name('student.cv');
    Route::post('/student/cv', [CVController::class, 'store'])->name('student.cv.store');
    Route::get('/student/cv/export', [CVController::class, 'exportCV'])->name('student.cv.export');
    Route::get('/student/cv/export/{id}', [CVController::class, 'downloadCV'])->name('student.cv.download');
    Route::get('/student/interview', [StudentsController::class, 'interview'])->name('student.interview');
    Route::get('/student/chats', [StudentsController::class, 'chats'])->name('student.chats');
    Route::get('/student/messages/{companyId}', [StudentsController::class, 'fetchMessages'])->name('student.fetchMessages');
    Route::post('/student/messages/send', [StudentsController::class, 'sendMessage']);
    Route::get('/student/certificate', [StudentsController::class, 'certificate'])->name('student.certificate');


});

Route::post('student/createproject', [ProjectsController::class, 'store'])->name('student.createproject');

 

 




///Incharge Panel Routes
Route::post('/incharge/save', [InchargeController::class, 'save'])->name('incharge.save');
Route::post('/incharge/check', [InchargeController::class, 'check'])->name('incharge.check');
Route::get('/incharge/logout', [InchargeController::class, 'logout'])->name('incharge.logout');


Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/incharge/register', [InchargeController::class, 'register'])->name('incharge.register');
    Route::get('/incharge/projects', [InchargeController::class, 'projects'])->name('incharge.projects');
    Route::get('/incharge/events', [InchargeController::class, 'events'])->name('incharge.events');
    Route::get('/incharge/attendence', [InchargeController::class, 'attendence'])->name('incharge.attendence');
    Route::get('/incharge/profile', [InchargeController::class, 'profile'])->name('incharge.profile');
    Route::get('/incharge/editprofile', [InchargeController::class, 'editprofile'])->name('incharge.editprofile');
    Route::get('/incharge/project/{id}', [InchargeController::class, 'show'])->name('incharge.project.detail');
    Route::get('incharge/viewcv/{id}', [InchargeController::class, 'viewCV'])->name('viewcv');

    Route::get('/incharge/makeprofile', [InchargeController::class, 'makeprofile'])->name('incharge.makeprofile');

    Route::get('/incharge/certificaiton', [InchargeController::class, 'certification'])->name('incharge.certificaiton');
    Route::get('/incharge/report', [InchargeController::class, 'report'])->name('incharge.report');
    Route::get('/incharge/generate-report', [InchargeController::class, 'generateReport'])->name('incharge.generate.report');
    Route::get('/incharge/statustracking', [InchargeController::class, 'statustracking'])->name('incharge.statustracking');
    Route::post('/incharge/save-attendance', [InchargeController::class, 'saveAttendance'])->name('incharge.saveAttendance');
    Route::get('/incharge/login', [InchargeController::class, 'login'])->name('incharge.login');
    Route::get('/incharge/dashboard', [InchargeController::class, 'dashboard'])->name('incharge.dashboard');
});
Route::delete('/projects/{event_id}/{project_id}', [InchargeController::class, 'destroy'])->name('project.destroy');
Route::post('/events', [InchargeController::class, 'store'])->name('events.store');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::post('/events/{id}/toggle-status', [EventController::class, 'toggleStatus'])->name('events.toggleStatus');
Route::post('/incharge/profile/update', [InchargeController::class, 'updateProfile'])->name('incharge.profile.update');
Route::post('/generate-certificate', [CertificateController::class, 'generate'])->name('generate.certificate');
Route::post('/certificate/download', [CertificateController::class, 'downloadCertificate'])->name('certificate.download');











//Supervisor Routes

Route::post('/supervisor/save', [SupervisorController::class, 'save'])->name('supervisor.save');
Route::post('/supervisor/check', [SupervisorController::class, 'check'])->name('supervisor.check');
Route::get('/supervisor/logout', [SupervisorController::class, 'logout'])->name('supervisor.logout');
 
Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/supervisor/register', [SupervisorController::class, 'register'])->name('supervisor.register');
    Route::get('/supervisor/login', [SupervisorController::class, 'login'])->name('supervisor.login');
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/profile', [SupervisorController::class, 'profile'])->name('supervisor.profile');
    Route::get('/supervisor/editprofile', [SupervisorController::class, 'editprofile'])->name('supervisor.editprofile');
    Route::get('/supervisor/project', [SupervisorController::class, 'project'])->name('supervisor.project');
    Route::get('/supervisor/statustracking', [SupervisorController::class, 'statustracking'])->name('supervisor.statustracking');
    Route::get('/supervisor/project/{id}', [SupervisorController::class, 'showProject'])->name('supervisor.project.show');
    Route::get('/supervisor/makeprofile', [SupervisorController::class, 'makeprofile'])->name('supervisor.makeprofile');
});

    Route::post('/supervisor/projects/{id}/update-progress', [SupervisorController::class, 'updateProgress'])->name('supervisor.updateProgress');
    Route::post('/supervisor/update', [SupervisorController::class, 'update'])->name('supervisor.update');
    Route::post('/supervisor/profile/update', [SupervisorController::class, 'updateProfile'])->name('supervisor.profile.update');














//Company Routes
Route::post('/company/save', [CompanyController::class, 'save'])->name('company.save');
Route::post('/company/check', [CompanyController::class, 'check'])->name('company.check');
Route::get('/company/logout', [CompanyController::class, 'logout'])->name('company.logout');
Route::post('/comments/store', [CompanyController::class, 'storeComment'])->name('comments.store');
Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/company/register', [CompanyController::class, 'register'])->name('company.register');
    Route::get('/company/login', [CompanyController::class, 'login'])->name('company.login');
    Route::get('/company/dashboard', [CompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/company/profile', [CompanyController::class, 'profile'])->name('company.profile');
    Route::get('/company/makeprofile', [CompanyController::class, 'makeprofile'])->name('company.makeprofile');

    Route::get('/company/editprofile', [CompanyController::class, 'editprofile'])->name('company.editprofile');
    Route::get('/company/project', [CompanyController::class, 'project'])->name('company.project');
    Route::get('/company/hiringcandidate', [CompanyController::class, 'hiring'])->name('company.hiringcandidate');
    Route::get('/company/chats', [CompanyController::class, 'chats'])->name('company.chats');
    Route::get('/company/pendingcandidate', [CompanyController::class, 'pendingcandidate'])->name('company.pendingcandidate');
// In your web.php routes file
Route::get('/get-projects-by-event/{eventId}', [InchargeController::class, 'getProjectsByEvent'])->name('get.projects.by.event');

    Route::get('/company/project/{id}', [CompanyController::class, 'show'])->name('company.project.detail');
    Route::post('/company/profile/update', [CompanyController::class, 'updateProfile'])->name('company.profile.update');
    Route::get('/company/student/{id}', [CompanyController::class, 'showStudentCV'])->name('company.student.cv');
    Route::get('/company/cv-analyzer/{studentId}', [CompanyController::class, 'analyzeCV'])->name('company.cv.analyze');
    Route::post('/schedule-interview', [InterviewController::class, 'store'])->name('interviews.store');
    Route::post('/update-interview-status', [InterviewController::class, 'updateStatus'])->name('interviews.updateStatus');

});

 



//CompanyStudentsChat 
Route::post('/company/first-message', [MessageController::class, 'sendfirstMessage'])->name('send.company.first.message');

Route::post('/company/send-message', [MessageController::class, 'sendCompanyMessage'])->name('send.company.message');
 Route::get('/company/messages/{studentId}', [MessageController::class, 'fetchMessages'])->name('fetch.company.messages');



 Route::post('/student/first-message', [MessageController::class, 'sendstudentfirstMessage'])->name('send.student.first.message');

