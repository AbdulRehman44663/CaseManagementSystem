

@extends('admin.layout.dashboard')
@section('content')
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_12">Welcome to the Admin Panel</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">As an administrator, you will have the ability to manage or maintain your site. With a well thought out administrative back-end, you can add/edit/delete users, create e-mail templates, custom fields, document templates, manage lead sources,
        campaigns, view payments, financial information and more.<br><br>This panel is not open to the regular users, but only accessable with the admin account or admin privileges.</div>
    <div class="text_14_700 ff_dm_sans text_404248 mb_16">Currently you are using 0.01 GB GB. out of 1.00 GB.</div>
    <div class="row">
        <div class="col-md-6">
            <div class="progress myprogress mb_24">
                <div class="progress-bar myprogressbar" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:5%">
                    <span class="sr-only"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Admin Menu</div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Preferences & LawPay Integration</div>
    <div class="row">
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.lawfirmInforamtion')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/preferences-yellow.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Preferences</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.userManagement')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/user-management.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">User Management</div>
                </div>
            </a>
        </div>
      
    </div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Modules</div>
    <div class="row">
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.attorneyManagement')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/atty-management.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Attorney Management</div>
                </div>
            </a>
        </div>
       
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.deleteClients')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/delete-clients.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Delete Clients</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.customFieldsManagement')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/custom-fields.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Custom Fields</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.appointmentColorLegend')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/app-color-legends.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">App. Color Legends</div>
                </div>
            </a>
        </div>
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.clientIntakeManagement')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/client-intake-lead-fields.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Client Intake/Lead Fields</div>
                </div>
            </a>
        </div>
       
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.documentTemplateManagement')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/e-document-templates.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">E-Document Templates</div>
                </div>
            </a>
        </div>
    </div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Leads & Campaign Management</div>
    <div class="row">
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.leadSources')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/lead-sources.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Lead Sources</div>
                </div>
            </a>
        </div>
        
    </div>
   
    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Reports</div>
    <div class="row">
        <div class="col-xl-2  col-lg-4  col-md-6">
            <a href="{{route('admin.clientsRegisteredByMonth')}}">
                <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                    <img src="<?=url('')?>/assets/images/clients-reg-per-month.svg" alt="" width="24px" class="mb_12">
                    <div class="text_16_500 text_6A6A6A">Clients Reg. Per Month</div>
                </div>
            </a>
        </div>
        
    </div>
@endsection('content')
