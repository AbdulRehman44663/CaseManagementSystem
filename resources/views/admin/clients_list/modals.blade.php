

<div class="modal fade" id="invoiceDetail" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_24">Invoice # 00010</div>
                <div class="row">
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Service</div>
                        <div class="text_16_700 text_404248">Eviction</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Total Billed Hours</div>
                        <div class="text_16_700 text_404248"> 1.00 / $350.00</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Total Fee</div>
                        <div class="d-flex">
                            <div class="text_16_700 text_404248">$1,000.00</div>
                            <div class="text_16_700 text_FCAF3B ml_10">Edit</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Total Billed Expenses</div>
                        <div class="text_16_700 text_404248">$0.00</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Total Paid</div>
                        <div class="text_16_700 text_404248">$0.00</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Amount Due</div>
                        <div class="text_16_700 text_FCAF3B">N/A *This is a flat fee retainer.</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Attorney Fee</div>
                        <div class="text_16_700 text_404248">$1,000.00</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Cost/Filing Fee</div>
                        <div class="text_16_700 text_404248">$0.00</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Type</div>
                        <div class="text_16_700 text_404248">Flat Fee</div>
                    </div>
                    <div class="col-md-6 mb_24">
                        <div class="text_14_500 text_6A6A6A mb_4">Cost/Filing Fee</div>
                        <div class="text_16_700 text_404248">$0.00</div>
                    </div>
                </div>
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Mark as uncollectable</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" href="#paymentPlans" role="button">Payment Plans</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentPlans" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_24">Payment Plan for Invoice #001</div>
                <div class="br_6 bg_F1F2F2 cp_6 mb_24 position_relative">
                    <div class="icon_top_right">
                        <div class="d-flex">
                            <div class="d-flex align-items-center" data-bs-toggle="modal" href="#editTaskModal" role="button">
                                <div>
                                    <img src="<?=url('')?>/assets/images/pencile-blue.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_126C9B ml_6">Edit</div>
                            </div>
                            <div class="d-flex align-items-center ml_24">
                                <div>
                                    <img src="<?=url('')?>/assets/images/delete-red.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_FC3B3B ml_6">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="text_16_700 text_404248 mb_24">Payment No. 1</div>
                    <div class="row mb_16">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Payment Amount:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_6A6A6A">250.00</div>
                        </div>
                    </div>
                    <div class="row mb_16">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Payment Scheduled Date:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_6A6A6A">12/29/2023</div>
                        </div>
                    </div>
                    <div class="row mb_24">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Payment Status:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_6A6A6A">Pending</div>
                        </div>
                    </div>
                    <div class="text_16_700 text_6A6A6A">An Invoice has been created and e-mailed to the client(s) for payment , if you want to cancel this invoiced payment <a href="#" class="text_FCAF3B">Click Here</a></div>
                </div>
                <div class="br_6 bg_F1F2F2 cp_6 mb_24 position_relative">
                    <div class="icon_top_right">
                        <div class="d-flex">
                            <div class="d-flex align-items-center" data-bs-toggle="modal" href="#editTaskModal" role="button">
                                <div>
                                    <img src="<?=url('')?>/assets/images/pencile-blue.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_126C9B ml_6">Edit</div>
                            </div>
                            <div class="d-flex align-items-center ml_24">
                                <div>
                                    <img src="<?=url('')?>/assets/images/delete-red.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_FC3B3B ml_6">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="text_16_700 text_404248 mb_24">Payment No. 2</div>
                    <div class="row mb_16">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Payment Amount:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_6A6A6A">250.00</div>
                        </div>
                    </div>
                    <div class="row mb_16">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Payment Scheduled Date:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_6A6A6A">12/29/2023</div>
                        </div>
                    </div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white">Email Invoice</button>
                </div>
                <div class="br_6 bg_F1F2F2 cp_6 mb_24 position_relative">
                    <div class="icon_top_right">
                        <div class="d-flex">
                            <div class="d-flex align-items-center" data-bs-toggle="modal" href="#editTaskModal" role="button">
                                <div>
                                    <img src="<?=url('')?>/assets/images/pencile-blue.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_126C9B ml_6">Edit</div>
                            </div>
                            <div class="d-flex align-items-center ml_24">
                                <div>
                                    <img src="<?=url('')?>/assets/images/delete-red.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_FC3B3B ml_6">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="text_16_700 text_404248 mb_24">Payment No. 3</div>
                    <div class="text_14_500 text_6A6A6A mb_6">Payment Amount <span class="text_B4173A">*</span></div>
                    <input type="text" class="form-control myinput mb_24">
                    <div class="text_14_500 text_6A6A6A mb_6">Schedule Date <span class="text_B4173A">*</span></div>
                    <input type="text" class="form-control myinput mb_24">
                    <div class="text_14_500 text_6A6A6A mb_6">Select Payment Method <span class="text_B4173A">*</span></div>
                    <input type="text" class="form-control myinput mb_24">
                    <div class="text_14_500 text_6A6A6A mb_6">Input Check No. <span class="text_B4173A">*</span></div>
                    <input type="text" class="form-control myinput mb_24">
                    <div class="text_14_500 text_6A6A6A mb_6">Mark as Paid</div>
                    <div class="mb_24 d-flex">
                        <label class="radio_container">Yes
                            <input type="radio" checked="checked" name="radio">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio_container ml_24">No
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div>
                        <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Save Payment</button>
                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                    </div>
                </div>
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">+ Add New Payment</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addHourlyRate" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_24">Add Hourly Rate</div>
                <div class="text_14_500 text_404248 mb_6">Client <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Duration <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Date <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Standard Hourly Rate <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">User <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Rate <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Description <span class="text_B4173A">*</span></div>
                <textarea class="form-control myinput bg_F1F2F2 mb_24" rows="5"></textarea>
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Submit</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addExpenses" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_24">Add Expenses</div>
                <div class="text_14_500 text_404248 mb_6">Client <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Date <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Rate <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Description <span class="text_B4173A">*</span></div>
                <textarea class="form-control myinput bg_F1F2F2 mb_24" rows="5"></textarea>
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Submit</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewInvoice" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_24">Add New Invoice</div>
                <div class="text_14_500 text_404248 mb_6">Select Invoice Type</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_24">
                <div class="text_14_500 text_404248 mb_6">Amount</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_24">
                <div class="text_14_500 text_404248 mb_6">Cost/Filing Fee</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_24">
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Submit</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewLog" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="main-title text_20_700 text_404248 mb_24"></div>
                <form id="log-form">

                    <input type="hidden" id="userId" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="client_id" id="client_id" value="{{isset($record->id) ? $record->id : ''}}">
                    <input type="hidden" name="client_case_information_id" id="client_case_information_id" value="{{isset($case_info_record->id) ? $case_info_record->id:''}}">
                    <input type="hidden" id="logId" name="logId" value=""> 
                    <div class="text_14_500 text_404248 mb_6">Your Name</div>
                    <input type="text" id="name" name="name" value="{{auth()->user()->name}}" class="form-control myinput bg_F1F2F2 mb_18" readonly>

                    
                    <div class="text_14_500 text_404248 mb_6">Log Title</div>
                    <input type="text" name="title" id="title" class="form-control myinput bg_F1F2F2 mb_18">
                    <div class="invalid-feedback" id="error_title"></div>
                    
                    <div class="text_14_500 text_404248 mb_6">Comments</div>
                        <textarea name="comment" id="comment" class="form-control myinput bg_F1F2F2 mb_24" rows="5"></textarea>
                    <div class="invalid-feedback" id="error_comment"></div>
                    
                    <div>
                        <button type="submit" class="submit-btn text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16"> </button>
                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewTask" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <form id="client-task-form">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="main-title text_20_700 text_404248 mb_24"></div>
                            <input type="hidden" name="client_id" id="client_id" value="{{isset($record->id) ? $record->id : ''}}">
                            <input type="hidden" name="client_case_information_id" id="client_case_information_id" value="{{isset($case_info_record->id) ? $case_info_record->id:''}}">
                            <input type="hidden" id="taskId" name="taskId" value=""> 
                            <div class="text_14_500 text_404248 mb_6">Details</div>
                            <textarea name="details" id="details" class="form-control myinput bg_F1F2F2 mb_24" rows="5"></textarea>
                            <div class="invalid-feedback" id="error_details"></div>

                            <div class="text_14_500 text_404248 mb_6">Date</div>
                            <input type="date" name="date" id="task_date" class="form-control myinput bg_F1F2F2 mb_24">
                            <div class="invalid-feedback" id="error_date"></div>

                            <div class="text_14_500 text_404248 mb_6">Time</div>
                            <input type="time" name="time" id="task_time" class="form-control myinput bg_F1F2F2 mb_24">
                            <div class="invalid-feedback" id="error_time"></div>
                        </div>
                        <div class="col-md-5 mb_24">
                            <div class="text_20_700 text_404248 mb_24">Assign Task To</div>
                            <div class="text_14_500 text_404248 mb_6">Users List</div>
                            <div class="bg_F1F2F2 br_8 cp_6">
                                @foreach($users as $user)
                                    <label class="checkbox_container text_16_400 text_6A6A6A mb_16">{{$user->name}}
                                    <input type="checkbox" id="assign_task[]" value={{$user->id}} name="assign_task[]">
                                    <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="submit-btn text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16"></button>
                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewEmail" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                
                <form id="client-email-form" enctype="multipart/form-data">    
                    <div class="row">
                        <input type="hidden" name="client_id" id="client_id" value="{{isset($record->id) ? $record->id : ''}}">
                        <input type="hidden" name="client_case_information_id" id="client_case_information_id" value="{{isset($case_info_record->id) ? $case_info_record->id:''}}">
                        <div class="col-xl-7">
                            <div class="main-title text_20_700 text_404248 mb_24"></div>
                            
                            <div class="text_14_500 text_404248 mb_6">Subject <span class="text_B4173A">*</span></div>
                            <input type="text" name="subject" id="subject" class="form-control myinput bg_F1F2F2 mb_24">
                            <div class="invalid-feedback" id="error_subject"></div>

                            <div class="text_14_500 text_404248 mb_6">From <span class="text_B4173A">*</span></div>
                            <input type="text" name="from" id="from" value="{{auth()->user()->email}}"  readonly class="form-control myinput bg_F1F2F2 mb_24">
                            <div class="invalid-feedback" id="error_from"></div>

                            <div class="text_14_500 text_404248 mb_6">To <span class="text_B4173A">*</span></div>
                            <input type="text" name ="to" id="to" value="{{isset($record->email_address) ? $record->email_address: ''}}"  readonly class="form-control myinput bg_F1F2F2 mb_24">
                            <div class="invalid-feedback" id="error_to"></div>

                            <div class="text_14_500 text_404248 mb_6">Attach Files  </div>
                            
                            <div class="uploadDiv mb_24">
                                <button type="button" class="text_14_400 text_404248 btnupload">Choose File</button>
                                <input type="file" name="email_file[]" id="email_file" class="hidden uploadfile" multiple>
                            </div>
                            
                            <div class="text_14_500 text_404248 mb_6">E-mail Body <span class="text_B4173A">*</span></div>
                            
                            <div class="position-relative mb-30">
                                <textarea name="email_body" id="email_body" style="display:none" placeholder="Type text here....">
                                </textarea>
                                <div class="form-control mb_24 bg_F1F2F2 quilleditor">
                                </div>
                            </div>
                            <div class="invalid-feedback" id="error_email_body"></div>

                        </div>
                        <div class="col-xl-5">
                            <div class="text_20_700 text_404248 mb_24">Insert Variables</div>
                             
                            <div class="bg_F1F2F2 br_8 cp_6 clientEmailTagList">
                                @foreach($email_variables as $email_variable)
                                    <div class="text_16_400 text_6A6A6A mb_16">{{$email_variable->variable}}</div>
                                @endforeach
                                 
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="submit-btn text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16"></button>
                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="emailDetail" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_24">Email Details</div>
                <form id="resend-email-form">
                    <div class="row mb_18">
                        <input type="hidden" name="client_email_id" id="client_email_id" value="">
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_4">Subject</div>
                            <div class="text_16_700 text_404248 mb_26" id="client_email_subject"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_4">Date sent</div>
                            <div class="text_16_700 text_404248 mb_26" id="client_email_date_sent"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_4">Last Re-sent</div>
                            <div class="text_16_700 text_404248 mb_26"  id="client_email_last_resent"> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_4">Times Resent</div>
                            <div class="text_16_700 text_404248 mb_26"  id="client_email_times_resent"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_4">Sent from</div>
                            <div class="text_16_700 text_404248 mb_26"  id="client_email_from"> 
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_4">Sent to</div>
                            <div class="text_16_700 text_404248 mb_26"  id="client_email_sent_to"> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text_14_500 text_6A6A6A mb_6">Attached Files</div>
                            <div id="client_email_attachments"></div>
                            
                        </div>
                    </div>
                    <div class="text_14_500 text_6A6A6A mb_6">E-mail Body</div>
                    <div class="bg_F1F2F2 br_8 h_320 mb_24" id="client_email_body"> </div>
                    <div>
                        <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white">Resend Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>