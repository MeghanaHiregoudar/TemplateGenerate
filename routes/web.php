<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\TemplateReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/',[AdminController::Class,'index'])->name('login');
Route::get('/',function(){
    if(session()->exists('email'))
	{
		return redirect()->route('admin.dashboard');
	}
	return view('admin.login');
    
})->name('login');

Route::post('admin/auth',[AdminController::Class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function()
{
  
Route::get('admin/dashboard',[AdminController::Class,'dashboard'])->name('admin.dashboard');

Route::get('admin/users',[UsersController::Class,'index'])->name('admin.users');
Route::get('admin/users_list',[UsersController::Class,'user_list'])->name('admin.users_list');
Route::get('admin/manage_user',[UsersController::Class,'manage_user'])->name('admin.manage_user');
Route::post('admin/user_store',[UsersController::Class,'user_store'])->name('admin.user_store');
Route::get('admin/{id}/user_edit',[UsersController::Class,'user_edit'])->name('admin.user_edit');
Route::patch('admin/user_update',[UsersController::Class,'user_update'])->name('admin.user_update');
Route::put('admin/user_delete',[UsersController::Class,'user_delete'])->name('admin.user_delete');


Route::get('admin/field',[FieldController::Class,'index'])->name('admin.field');
Route::get('admin/field_list',[FieldController::Class,'field_list'])->name('admin.field_list');
Route::get('admin/manage_field',[FieldController::Class,'manage_field'])->name('admin.manage_field');
Route::post('admin/field_store',[FieldController::Class,'field_store'])->name('admin.field_store');
Route::get('admin/{id}/field_edit',[FieldController::Class,'field_edit'])->name('admin.field_edit');
Route::patch('admin/{id}/field_update',[FieldController::Class,'field_update'])->name('admin.field_update');
Route::put('admin/field_delete',[FieldController::Class,'field_delete'])->name('admin.field_delete');


Route::get('admin/letter_types',[LetterTypeController::Class,'index'])->name('admin.letter_types');
Route::get('admin/manage_letter_types',[LetterTypeController::Class,'manage_letter_types'])->name('admin.manage_letter_types');
Route::post('admin/letter_types_store',[LetterTypeController::Class,'letter_types_store'])->name('admin.letter_types_store');
Route::get('admin/{id}/letter_types_edit',[LetterTypeController::Class,'letter_types_edit'])->name('admin.letter_types_edit');
Route::put('admin/letter_types_update',[LetterTypeController::Class,'letter_types_update'])->name('admin.letter_types_update');
Route::put('admin/letter_types_delete',[LetterTypeController::Class,'letter_types_delete'])->name('admin.letter_types_delete');
Route::get('admin/{id}/letter_types_createbody',[LetterTypeController::Class,'letter_types_createbody'])->name('admin.letter_types_createbody');
Route::patch('admin/letter_types_storebody',[LetterTypeController::Class,'letter_types_storebody'])->name('admin.letter_types_storebody');
// Route::post('admin/upload',[LetterTypeController::Class,'json_image']);
//Route::post('/upload',[LetterTypeController::Class,'upload']);
Route::post('upload',[LetterTypeController::Class,'upload'])->name('ckeditor.upload');



Route::get('admin/report_type',[TemplateReportController::Class,'index'])->name('admin.report_type');
Route::post('admin/store_template_type',[TemplateReportController::Class,'store_template_type'])->name('admin.store_template_type');
Route::post('admin/feild_data',[TemplateReportController::Class,'feild_data'])->name('admin.feild_data');
Route::patch('admin/store_body',[TemplateReportController::Class,'store_body'])->name('admin.store_body');
Route::get('admin/{id}/preview_print',[TemplateReportController::Class,'preview_print'])->name('admin.preview');
Route::get('admin/{id}/report_edit',[TemplateReportController::Class,'report_edit'])->name('admin.report_edit');
Route::put('admin/report_update',[TemplateReportController::Class,'report_update']);

Route::get('admin/template_report',[TemplateReportController::Class,'template_report'])->name('admin.template_report');
Route::post('admin/view_report',[TemplateReportController::Class,'view_report'])->name('admin.view_report');
Route::put('admin/delete_report',[TemplateReportController::Class,'delete_report'])->name('admin.delete_report');
Route::get('admin/{id}/report_pdf',[TemplateReportController::Class,'report_pdf'])->name('admin.report_pdf');
Route::post('admin/report_email',[TemplateReportController::Class,'report_email'])->name('admin.report_email');

Route::get('admin/logout',function(){
    if(session()->has('ADMIN_LOGIN'))
    {
        session()->forget(['ADMIN_LOGIN','ADMIN_ID','ADMIN_CREATOR','ADMIN_NAME','ADMIN_ROLES']);
        session()->flush();
    }
    return redirect()->route('login');
})->name('admin.logout');

});
