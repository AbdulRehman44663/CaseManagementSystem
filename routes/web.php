<?php

use Illuminate\Http\Request;
use App\Models\CaseIntakeField;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\LeadsController;
use App\Http\Controllers\admin\TasksController;
use App\Http\Controllers\admin\CalendarController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DocumentsController;
use App\Http\Controllers\admin\VariablesController;
use App\Http\Controllers\admin\AccountingController;
use App\Http\Controllers\admin\AdminPanelController;
use App\Http\Controllers\admin\ADPlacementController;
use App\Http\Controllers\admin\ClientsListController;
use App\Http\Controllers\admin\ClosedCasesController;
use App\Http\Controllers\admin\LeadSourcesController;
use App\Http\Controllers\admin\ViewBalancesController;
use App\Http\Controllers\admin\ClientsDetailController;
use App\Http\Controllers\admin\DeleteClientsController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\admin\CaseIntakeFieldController;
use App\Http\Controllers\admin\ConversationLogController;
use App\Http\Controllers\admin\NewClientsByMonthController;
use App\Http\Controllers\admin\PaymentsCollectedController;
use App\Http\Controllers\admin\AttorneyManagementController;
use App\Http\Controllers\admin\CaseTypeManagementController;
use App\Http\Controllers\admin\LawFirmInformationController;
use App\Http\Controllers\admin\ClientsByLeadSourceController;
use App\Http\Controllers\admin\AppointmentLocationsController;
use App\Http\Controllers\admin\LawPayAccountOptionsController;
use App\Http\Controllers\admin\HearingTypeManagementController;
use App\Http\Controllers\admin\AppointmentColorLegendController;
use App\Http\Controllers\admin\ClientIntakeManagementController;
use App\Http\Controllers\admin\CustomFieldsManagementController;
use App\Http\Controllers\admin\CourtSelectorManagementController;
use App\Http\Controllers\admin\EmailTemplateManagementController;
use App\Http\Controllers\admin\ClientsRegisteredByMonthController;
use App\Http\Controllers\admin\DocumentTemplateManagementController;
use App\Http\Controllers\client\CalendarController as ClientCalendarController;
use App\Http\Controllers\client\InvoicesController as ClientInvoicesController;
use App\Http\Controllers\client\DashboardController as ClientDashboardController;
use App\Http\Controllers\client\DocumentsController as ClientDocumentsController;
use App\Http\Controllers\client\CommunicationsController as ClientCommunicationsController;

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

Route::group(['prefix' => 'admin'], function () {

    Route::post('/custom-login', [AuthController::class, 'customLogin'])->name('admin.login.custom');
    Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
    Route::get('verify-user/{token}', [AuthController::class, 'verifyUser'])->name('user.verify');
    Route::post('/set-password', [AuthController::class, 'setPassword'])->name('admin.set.password');

    Route::get('reset-password/{userId}', [AuthController::class, 'resetPassword'])->name('admin.reset.password');
    Route::post('update-password', [AuthController::class, 'updatePassword'])->name('admin.update.password');

   // Route::group(['middleware' => ['authcheck']], function () {
    Route::middleware(['authcheck'])->group(function () {
        /// logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard-tasks', [DashboardController::class, 'dashboardTaskDatatable'])->name('admin.getDashboardTask');
        Route::get('/courseDeadline', [DashboardController::class, 'courseDeadline'])->name('admin.dashboard.courseDeadline');

        Route::get('/closedCases', [ClosedCasesController::class, 'index'])->name('admin.closedCases');


        Route::get('/adminPanel', [AdminPanelController::class, 'index'])->name('admin.adminPanel');

        Route::get('/lawfirmInforamtion', [LawFirmInformationController::class, 'index'])->name('admin.lawfirmInforamtion');
        Route::put('/lawfirmInforamtion', [LawFirmInformationController::class, 'update'])->name('admin.update.lawfirmInforamtion');

        /// user management.
        Route::get('/userManagement', [UserManagementController::class, 'index'])->name('admin.userManagement');
        Route::get('getUser', [UserManagementController::class, 'userDatatable'])->name('admin.getUser');
        Route::post('create-user', [UserManagementController::class, 'createUser'])->name('admin.create.user');
        Route::get('edit-user/{id}', [UserManagementController::class, 'editUser'])->name('admin.edit.user');
        Route::put('update-user/{id}', [UserManagementController::class, 'updateUser'])->name('admin.update.user');
        Route::delete('delete-user/{id}', [UserManagementController::class, 'deleteUser'])->name('admin.destroy.user');
        Route::put('update-user-status/{id}', [UserManagementController::class, 'updateUserStatus'])->name('admin.update.user.status');
        // user events
        Route::get('edit-user-event/{id}', [UserManagementController::class, 'editUserEvent'])->name('admin.edit.user.event');
        Route::put('update-user-event/{id}', [UserManagementController::class, 'updateUserEvent'])->name('admin.update.user.event');
        // user access
        Route::get('edit-user-assess/{id}', [UserManagementController::class, 'editUserAccess'])->name('admin.edit.user.access');
        Route::put('update-user-access/{id}', [UserManagementController::class, 'updateUserAccess'])->name('admin.update.user.access');
        ///reset email password
        Route::put('update-user-password/{id}', [UserManagementController::class, 'updateUserPassword'])->name('admin.update.user.password');

        Route::get('/lawpayAccountOptions', [LawPayAccountOptionsController::class, 'index'])->name('admin.lawpayAccountOptions');
        Route::get('/lawpayaccountoptionsform', [LawPayAccountOptionsController::class, 'form'])->name('admin.lawpayAccountOptionsform');

        /// attorney management
        Route::get('/attorneyManagement', [AttorneyManagementController::class, 'index'])->name('admin.attorneyManagement');
        Route::get('/getAttorneyManagement', [AttorneyManagementController::class, 'attorneyManagementDatatable'])->name('admin.getAttorneyManagement');
        Route::post('create-attorney-management', [AttorneyManagementController::class, 'createAttorneyManagement'])->name('admin.create.attorneyManagement');
        Route::get('edit-attorney-management/{id}', [AttorneyManagementController::class, 'editAttorneyManagement'])->name('admin.edit.attorneyManagement');
        Route::put('update-attorney-management/{id}', [AttorneyManagementController::class, 'updateAttorneyManagement'])->name('admin.update.attorneyManagement');
        Route::delete('delete-attorney-management/{id}', [AttorneyManagementController::class, 'destroy'])->name('admin.destroy.attorneyManagement');

        Route::get('/appontmentLocations', [AppointmentLocationsController::class, 'index'])->name('admin.appontmentLocations');
        Route::get('/getAppontmentLocations', [AppointmentLocationsController::class, 'appointmentLocationsDatatable'])->name('admin.getAppontmentLocations');
        Route::post('create-appontment-locations', [AppointmentLocationsController::class, 'createAppointmentLocations'])->name('admin.create.appontmentLocations');
        Route::get('edit-appontment-locations/{id}', [AppointmentLocationsController::class, 'editAppointmentLocations'])->name('admin.edit.appontmentLocations');
        Route::put('update-appontment-locations/{id}', [AppointmentLocationsController::class, 'updateAppointmentLocations'])->name('admin.update.appontmentLocations');
        Route::delete('delete-appontment-locations/{id}', [AppointmentLocationsController::class, 'deleteAppointmentLocations'])->name('admin.delete.appontmentLocations');

        Route::get('/hearingTypeManagement', [HearingTypeManagementController::class, 'index'])->name('admin.hearingTypeManagement');
        Route::get('/hearingTypes/{id}', [HearingTypeManagementController::class, 'hearingTypes'])->name('admin.hearingTypes');
        Route::get('/getHearingTypes/{id}', [HearingTypeManagementController::class, 'hearingTypesDatatable'])->name('admin.getHearingTypes');
        Route::post('createHearingTypes', [HearingTypeManagementController::class, 'createHearingTypes'])->name('admin.create.hearingTypes');
        Route::get('editHearingTypes/{id}', [HearingTypeManagementController::class, 'editHearingTypes'])->name('admin.edit.hearingTypes');
        Route::put('updateHearingTypes/{id}', [HearingTypeManagementController::class, 'updateHearingTypes'])->name('admin.update.hearingTypes');
        Route::delete('deleteHearingTypes/{id}', [HearingTypeManagementController::class, 'deleteHearingTypes'])->name('admin.delete.hearingTypes');

        /// email templates
        Route::get('/emailTemplateManagement', [EmailTemplateManagementController::class, 'index'])->name('admin.emailTemplateManagement');
        Route::get('/emailTemplate/{id}', [EmailTemplateManagementController::class, 'emailTemplate'])->name('admin.emailTemplate');
        Route::get('/getEmailTemplate/{id}', [EmailTemplateManagementController::class, 'emailTemplateDatatable'])->name('admin.getEmailTemplate');
        Route::post('createEmailTemplate', [EmailTemplateManagementController::class, 'createEmailTemplate'])->name('admin.create.emailTemplate');
        Route::get('editEmailTemplate/{id}', [EmailTemplateManagementController::class, 'editEmailTemplate'])->name('admin.edit.emailTemplate');
        Route::put('updateEmailTemplate/{id}', [EmailTemplateManagementController::class, 'updateEmailTemplate'])->name('admin.update.emailTemplate');
        Route::get('deleteEmailTemplate/{id}', [EmailTemplateManagementController::class, 'deleteEmailTemplate'])->name('admin.delete.emailTemplate');

        Route::get('/deleteClients', [DeleteClientsController::class, 'index'])->name('admin.deleteClients');
        Route::get('getClients', [DeleteClientsController::class, 'clientDatatable'])->name('admin.getClients');
        Route::delete('delete-client/{id}', [DeleteClientsController::class, 'destroy'])->name('admin.client.destroy');

        /// E-document template
        Route::get('/documentTemplateManagement', [DocumentTemplateManagementController::class, 'index'])->name('admin.documentTemplateManagement');
        Route::get('/documentTemplate/{case_type_id}', [DocumentTemplateManagementController::class, 'documentTemplate'])->name('admin.documentTemplate');
        Route::get('/getDocumentTemplate/{id}', [DocumentTemplateManagementController::class, 'documentTemplateDatatable'])->name('admin.getDocumentTemplateDatatable');
        Route::post('create-document-template', [DocumentTemplateManagementController::class, 'createDocumentTemplate'])->name('admin.create.document.template');
        Route::get('edit-document-template/{id}', [DocumentTemplateManagementController::class, 'editDocumentTemplate'])->name('admin.edit.document.template');
        Route::put('update-docuemnt-template/{id}', [DocumentTemplateManagementController::class, 'updateDocumentTemplate'])->name('admin.update.document.template');
        Route::get('deleteDocumentTemplate/{id}', [DocumentTemplateManagementController::class, 'deleteDocumentTemplate'])->name('admin.delete.documentTemplate');


        //admin custom field management
        /// custom group
        Route::get('/customFieldsManagement', [CustomFieldsManagementController::class, 'index'])->name('admin.customFieldsManagement');
        Route::get('/customFields/{caseType}', [CustomFieldsManagementController::class, 'customFields'])->name('admin.customFields');
        Route::post('create-custom-group', [CustomFieldsManagementController::class, 'createCustomGroup'])->name('admin.create.customgroup');
        Route::get('edit-custom-group/{id}', [CustomFieldsManagementController::class, 'editCustomGroup'])->name('admin.edit.customGroup');
        Route::put('update-custom-group/{id}', [CustomFieldsManagementController::class, 'updateCustomGroup'])->name('admin.update.customGroup');
        Route::delete('delete-custom-group/{id}', [CustomFieldsManagementController::class, 'destroyCustomgroup'])->name('admin.customGroup.destroy');
        Route::post('custom-group-fields-save-order', [CustomFieldsManagementController::class, 'customFieldSaveOrder'])->name('admin.custom.group.save.order');

        /// custom group fields
        Route::get('/customFieldsGroup/{group_id}', [CustomFieldsManagementController::class, 'customFieldsGroup'])->name('admin.customFieldsGroup');
        Route::post('create-custom-group-detail', [CustomFieldsManagementController::class, 'createCustomGroupDetail'])->name('admin.create.customGroupDetail');
        Route::get('edit-custom-group-detail/{id}', [CustomFieldsManagementController::class, 'editCustomGroupDetail'])->name('admin.edit.customGroupDetail');
        Route::put('update-custom-group-detail/{id}', [CustomFieldsManagementController::class, 'updateCustomGroupDetail'])->name('admin.update.customGroupDetail');
        Route::delete('delete-custom-group-detail/{id}', [CustomFieldsManagementController::class, 'destroyCustomgroupDetail'])->name('admin.customGroupDetail.destroy');
        Route::post('custom-group-detail-fields-save-order', [CustomFieldsManagementController::class, 'customFieldSaveOrderDetail'])->name('admin.custom.group.detail.save.order');

        /// admin appointment color legend
        Route::get('/appointmentColorLegend', [AppointmentColorLegendController::class, 'index'])->name('admin.appointmentColorLegend');
        Route::get('/getAppointmentColor', [AppointmentColorLegendController::class, 'appointmentColorDatatable'])->name('admin.getAppointmentColor');
        Route::post('create-appointment-color', [AppointmentColorLegendController::class, 'createAppointmentColor'])->name('admin.create.appointmentColor');
        Route::get('edit-appointment-color/{id}', [AppointmentColorLegendController::class, 'editAppointmentColor'])->name('admin.edit.appointmentColor');
        Route::put('update-appointment-color/{id}', [AppointmentColorLegendController::class, 'updateAppointmentColor'])->name('admin.update.appointmentColor');
        Route::delete('delete-appointment-color/{id}', [AppointmentColorLegendController::class, 'destroy'])->name('admin.appointment.destroy');

        Route::get('/clientIntakeManagement', [ClientIntakeManagementController::class, 'index'])->name('admin.clientIntakeManagement');
        Route::get('/clientIntakeFields/{case_id}', [ClientIntakeManagementController::class, 'clientIntakeFields'])->name('admin.clientIntakeFields');
        Route::get('/fetchFieldData/{case_id}/{field_id}', [CaseIntakeFieldController::class, 'fetchFieldData'])->name('admin.fetch.field.data');
        Route::post('intakeFields/save-order', [CaseIntakeFieldController::class, 'saveOrder'])->name('admin.intakeFields.save.order');

        Route::post('/create-case-type-field/{id}', [CaseIntakeFieldController::class, 'createCaseTypeField'])->name('admin.createClientIntakeFields');
        Route::put('/update-case-type-field/{id}', [CaseIntakeFieldController::class, 'updateCaseTypeField'])->name('admin.updateClientIntakeFields');
        Route::delete('/case-type-field', [CaseIntakeFieldController::class, 'deleteCaseTypeField'])->name('admin.deleteClientIntakeFields');
        // case type
        Route::get('/caseTypeManagement', [CaseTypeManagementController::class, 'index'])->name('admin.caseTypeManagement');
        Route::get('/getCaseType', [CaseTypeManagementController::class, 'caseTypeDatatable'])->name('admin.getCaseType');
        Route::post('create-case-type', [CaseTypeManagementController::class, 'createCaseType'])->name('admin.create.caseType');
        Route::get('edit-case-type/{id}', [CaseTypeManagementController::class, 'editCaseType'])->name('admin.edit.caseType');
        Route::put('update-case-type/{id}', [CaseTypeManagementController::class, 'updateCaseType'])->name('admin.update.caseType');
        Route::delete('delete-case-type/{id}', [CaseTypeManagementController::class, 'deleteCaseType'])->name('admin.destroy.caseType');

        // lead sources
        Route::get('leadSources', [LeadSourcesController::class, 'index'])->name('admin.leadSources');
        Route::get('getLeadSources', [LeadSourcesController::class, 'leadSourcesDatatable'])->name('admin.getLeadSources');
        Route::post('create-lead-sources', [LeadSourcesController::class, 'createLeadSources'])->name('admin.create.leadSources');
        Route::get('edit-lead-sources/{id}', [LeadSourcesController::class, 'editLeadSources'])->name('admin.edit.leadSources');
        Route::put('update-lead-sources/{id}', [LeadSourcesController::class, 'updateLeadSources'])->name('admin.update.leadSources');
        Route::delete('delete-lead-sources/{id}', [LeadSourcesController::class, 'deleteLeadSource'])->name('admin.destroy.leadSources');

        // ad placement
        Route::get('addPlacement', [ADPlacementController::class, 'index'])->name('admin.addPlacement');
        Route::get('getADPlacement', [ADPlacementController::class, 'adPlacementDatatable'])->name('admin.getADPlacement');
        Route::post('create-ad-placement', [ADPlacementController::class, 'createADPlacement'])->name('admin.create.adPlacement');
        Route::get('edit-ad-placement/{id}', [ADPlacementController::class, 'editADPlacement'])->name('admin.edit.adPlacement');
        Route::put('update-ad-placement/{id}', [ADPlacementController::class, 'updateADPlacement'])->name('admin.update.adPlacement');
        Route::delete('delete-ad-placement/{id}', [ADPlacementController::class, 'deleteADPlacement'])->name('admin.destroy.adPlacement');

        // Admin Finances
        Route::get('/viewBalances', [ViewBalancesController::class, 'index'])->name('admin.viewBalances');
        Route::get('/getBalanaces', [ViewBalancesController::class, 'balancesDatatable'])->name('admin.getBalanaces');

        Route::get('/paymentsCollected', [PaymentsCollectedController::class, 'index'])->name('admin.paymentsCollected');
        Route::get('/getPaymentCollected', [PaymentsCollectedController::class, 'paymentsDatatable'])->name('admin.getPaymentCollected');

        /// reports
        Route::get('/clientsRegisteredByMonth', [ClientsRegisteredByMonthController::class, 'index'])->name('admin.clientsRegisteredByMonth');
        Route::get('new-lead-client-by-date-range', [ClientsRegisteredByMonthController::class, 'getClientLeadDateRange'])->name('admin.total.lead.client.month');

        Route::get('/newClientsByMonth', [NewClientsByMonthController::class, 'index'])->name('admin.newClientsByMonth');
        Route::get('new-client-by-date-range', [NewClientsByMonthController::class, 'getNewClientByDateRange'])->name('admin.total.client.month');

        Route::get('/clientsByLeadSource', [ClientsByLeadSourceController::class, 'index'])->name('admin.clientsByLeadSource');
        Route::get('client-by-lead-source', [ClientsByLeadSourceController::class, 'getClientByLeadSource'])->name('admin.client.lead.source');

        Route::get('/courtSelectorManagement', [CourtSelectorManagementController::class, 'index'])->name('admin.courtSelectorManagement');
        Route::post('bk-court-selection', [CourtSelectorManagementController::class, 'bkCourtSelection'])->name('admin.bk.court.selection');
        Route::post('update.selected.casetype', [CourtSelectorManagementController::class, 'bkCourtCaseTypeSelection'])->name('admin.update.selected.casetype');

        Route::post('immigration-court-selection', [CourtSelectorManagementController::class, 'immigrationCourtSelection'])->name('admin.immigration.court.selection');

        Route::post('general-court-selection', [CourtSelectorManagementController::class, 'generalCourtSelection'])->name('admin.general.court.selection');

        // Route::post('update.selected.casetype', [CourtSelectorManagementController::class, 'bkCourtCaseTypeSelection'])->name('admin.update.selected.casetype');



        /// calendar
        Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
        Route::get('appointment-events', [CalendarController::class, 'appointmentEvents'])->name('admin.appointment.events');
        Route::post('custom-events', [CalendarController::class, 'store'])->name('admin.calendar.custom.events');
        Route::put('update-appointment-event/{id}', [CalendarController::class, 'updateAppointmentEvent'])->name('admin.update.event.appointment');
        Route::put('update-custom_event/{id}', [CalendarController::class, 'updateCustomEvent'])->name('admin.update.event.custom');
        Route::delete('delete-appointment-event/{id}', [CalendarController::class, 'appointmentDestroy'])->name('admin.destroy.event.appointment');
        Route::delete('delete-custom_event/{id}', [CalendarController::class, 'customDestroy'])->name('admin.destroy.event.custom');
        Route::get('monthly-agenda', [CalendarController::class, 'monthlyAgenda'])->name('admin.monthly.agenda');


        /// variables
        Route::get('/variables', [VariablesController::class, 'index'])->name('admin.variables');
        Route::get('/create', [VariablesController::class, 'create'])->name('create'); // Show create form
        Route::post('/variables', [VariablesController::class, 'store'])->name('store'); // Store new variable
        Route::get('/variables/{variable}/edit', [VariablesController::class, 'edit'])->name('edit'); // Show edit form
        Route::delete('/{variable}', [VariablesController::class, 'destroy'])->name('destroy'); // Delete variable
        Route::get('/variables/data', [VariablesController::class, 'getEmailVariables'])->name('admin.getVariables');
        Route::get('/variables/data/email', [VariablesController::class, 'getEmailVariables'])->name('admin.getEmailVariables');
        Route::get('/variables/data/doc', [VariablesController::class, 'getDocVariables'])->name('admin.getDocVariables');
        Route::put('/variables/{id}', [VariablesController::class, 'update'])->name('admin.variables.update');


        // client info

        Route::get('/clientsList', [ClientsListController::class, 'index'])->name('admin.clientsList');
        Route::get('/clientInfo/{client_id}/{client_case_info_id}', [ClientsListController::class, 'clientInfo'])->name('admin.clientInfo');
        Route::post('/convert-lead', [ClientsListController::class, 'convertLead'])->name('admin.convert-lead-to-client');
        Route::put('update-client-info/{client_id}/{client_case_information_id}', [ClientsListController::class, 'updateClientinfo'])->name('admin.update-clientInfo');
        Route::put('client-appointment/{id}', [ClientsListController::class, 'clientAppointment'])->name('admin.client-appointment');
        Route::post('/client/save-status', [ClientsListController::class, 'saveStatus'])->name('admin.client.saveStatus');


        // admin client doc upload
        Route::post('upload-document/{client_case_information_id}', [ClientsDetailController::class, 'uploadClientDocument'])->name('admin.upload-client-document');
        Route::get('document-listing/{client_case_information_id}', [ClientsDetailController::class, 'clientDocumentsDataTable'])->name('admin.document.listing');
        Route::delete('delete-document/{id}', [ClientsDetailController::class, 'destroy'])->name('admin.document.destroy');

        // admin client log
        Route::get('logs/{client_case_information_id}', [ClientsDetailController::class, 'logsindex'])->name('admin.logs-listing');
        Route::post('logs-create', [ClientsDetailController::class, 'createLogs'])->name('admin.create-logs');
        Route::get('logs-edit/{id}', [ClientsDetailController::class, 'editLog'])->name('admin.edit-logs');
        Route::put('logs-update/{id}', [ClientsDetailController::class, 'updateLogs'])->name('admin.update-logs');
        Route::delete('delete-client-logs/{id}', [ClientsDetailController::class, 'destroyLogs'])->name('admin.client-logs-destroy');

        // admin client tasks
        Route::get('client-task/{id}', [ClientsDetailController::class, 'clientTasksDataTable'])->name('admin.client-task-listing');
        Route::post('client-tasks-create', [ClientsDetailController::class, 'createClientTasks'])->name('admin.client-create-tasks');
        Route::get('client-tasks-edit/{id}', [ClientsDetailController::class, 'editClientTasks'])->name('admin.client-edit-tasks');
        Route::put('client-tasks-update/{id}', [ClientsDetailController::class, 'updateClientTasks'])->name('admin.client-update-tasks');
        Route::delete('delete-client-tasks/{id}', [ClientsDetailController::class, 'destroyClientTasks'])->name('admin.client-destroy-tasks');
        Route::get('client-tasks-mark_status/{id}', [ClientsDetailController::class, 'markStatusClientTasks'])->name('admin.client-mark-status-tasks');

        //admin client invoices
        Route::get('client-invoices/{id}', [ClientsDetailController::class, 'clientInvoicesDataTable'])->name('admin.client-invoice-listing');

        // admin client email
        Route::get('client-email/{id}', [ClientsDetailController::class, 'clientEmailDataTable'])->name('admin.client-email-listing');
        Route::post('client-emails-create', [ClientsDetailController::class, 'createClientEmails'])->name('admin.client-create-emails');
        Route::get('client-emails-view/{id}', [ClientsDetailController::class, 'viewClientEmails'])->name('admin.client-view-emails');
        Route::post('client-emails-resend', [ClientsDetailController::class, 'resendClientEmails'])->name('admin.client-resend-emails');

        Route::get('/leads', [LeadsController::class, 'index'])->name('admin.leads');
        Route::get('/addLead', [LeadsController::class, 'add'])->name('admin.addLead');
        Route::post('/addLead', [LeadsController::class, 'redirectOnLead'])->name('admin.addLead');
        Route::post('/saveLead', [LeadsController::class, 'store'])->name('admin.saveLead');
        Route::get('/clientsRetained', [LeadsController::class, 'clientsRetained'])->name('admin.clientsRetained');
        Route::get('/totalOfLeadsNotRetained', [LeadsController::class, 'totalOfLeadsNotRetained'])->name('admin.totalOfLeadsNotRetained');
        Route::get('/totalOfDeadLeads', [LeadsController::class, 'totalOfDeadLeads'])->name('admin.totalOfDeadLeads');
        Route::get('/getLeadsData', [LeadsController::class, 'getLeadsData'])->name('admin.getLeadsData');
        Route::get('/leads/{id}/edit', [LeadsController::class, 'edit'])->name('admin.leads.edit');
        Route::post('/leads/{id}', [LeadsController::class, 'update'])->name('admin.leads.update');
        Route::get('/getLeadsAjax', [LeadsController::class, 'getLeads'])->name('admin.leads.getAjax');
        Route::get('/api/leads/{leadId}', [LeadsController::class, 'getLeadsStatus']);
        Route::post('/api/conversation-logs', [ConversationLogController::class, 'storeLog']);
        // For an API route (routes/api.php)
        Route::post('/lead/update-status/{id}', [LeadsController::class, 'updateStatus'])->name('lead.updateStatus');


        Route::get('/documents', [DocumentsController::class, 'index'])->name('admin.documents');

        Route::get('/tasks', [TasksController::class, 'index'])->name('admin.tasks');
        Route::post('/tasks', [TasksController::class, 'storeOrUpdate'])->name('admin.tasks.store');
        Route::get('/tasks/{taskId}', [TasksController::class, 'getTask'])->name('admin.get.task');
        Route::put('/tasks/{taskId}', [TasksController::class, 'storeOrUpdate'])->name('admin.tasks.update');
        Route::delete('/task/{task}', [TasksController::class, 'destroy'])->name('admin.tasks.destroy');
        Route::get('search-clients', [TasksController::class, 'searchClients'])->name('admin.searchClients');



        Route::get('/accounting', [AccountingController::class, 'index'])->name('admin.accounting');

        Route::get('/company/edit', [CompanyInformation::class, 'edit'])->name('admin.company.edit');
        Route::post('/company/update', [CompanyInformation::class, 'update'])->name('admin.company.update');
    });
});


Route::group(['prefix' => 'client'], function () {
    Route::get('verify-client/{token}', [AuthController::class, 'verifyUser'])->name('client.verify');
    Route::post('/set-password', [AuthController::class, 'setPassword'])->name('client.set.password');
    Route::post('/custom-login', [AuthController::class, 'customLogin'])->name('client.login.custom');
    Route::get('/login', [AuthController::class, 'index'])->name('client.login');



    //Route::middleware(['authcheckclient', 'LoadClientData'])->group(function () {
        Route::post('/logout', [AuthController::class, 'clientLogout'])->name('client.logout');
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');

        Route::post('/update-case-type', [ClientDashboardController::class, 'updateCaseType'])->name('update.case.type')->withoutMiddleware('LoadClientData');;





        Route::get('/communications', [ClientCommunicationsController::class, 'index'])->name('client.communications');

        Route::get('/invoices', [ClientInvoicesController::class, 'index'])->name('client.invoices');

        Route::get('/documents', [ClientDocumentsController::class, 'index'])->name('client.documents');

        Route::get('/calendar', [ClientCalendarController::class, 'index'])->name('client.calendar');
   // });
});

Route::get('/', [AuthController::class, 'index'])->name('admin.login');

