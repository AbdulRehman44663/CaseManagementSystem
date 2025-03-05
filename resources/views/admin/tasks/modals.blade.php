<div class="modal fade" id="addTaskModal" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?= url('') ?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text_20_700 text_404248 mb_24" id="modalTitle"></div>
                        <div class="mb_18">
                            <div class="text_14_500 text_6A6A6A mb_6">Client’s Name <span class="text_B4173A">*</span></div>
                            <input type="hidden" id="client_id" name="client_id" value="">
                            <input type="hidden" id="client_info_id" name="client_info_id" value="">
                            <input type="text" name="client_name" id="client_name" placeholder="Search Client Name" class="form-control br_8 bg_F1F2F2 myinput">
                            <div class="client-dropdown position-relative"></div> <!-- Dropdown will appear here -->

                            <div class="invalid-feedback" id="error_client_id"></div>
                        </div>
                        <div class="mb_18">
                            <div class="text_14_500 text_6A6A6A mb_6">Details</div>
                            <textarea name="details" id="details" class="form-control br_8 bg_F1F2F2 myinput" rows="5"></textarea>
                             
                        </div> 
                        <div class="mb_18">
                            <div class="text_14_500 text_6A6A6A mb_6">Date <span class="text_B4173A">*</span></div>
                            <input type="date" name="date" id="date" class="form-control br_8 bg_F1F2F2 myinput">
                            <div class="invalid-feedback" id="error_date"></div>
                        </div>
                        <div class="mb_18">
                            <div class="text_14_500 text_6A6A6A mb_6">Time <span class="text_B4173A">*</span></div>
                            <input type="time" name="time" id="time" class="form-control br_8 bg_F1F2F2 myinput">
                            <div class="invalid-feedback" id="error_time"></div>
                        </div>

                    </div>
                    <div class="col-md-5 mb_24">
                        <div class="text_20_700 text_404248 mb_24">Assign Task To</div>
                        <div class="text_14_500 text_6A6A6A mb_6">Users List <span class="text_B4173A">*</span></div>
                        <div class="bg_F1F2F2 br_8 cp_6" id="userList">
                            @if($users->isEmpty())
                            <div class="text_14_500 text_6A6A6A">No users available to assign tasks.</div>
                            @else
                                @foreach($users as $user)
                                <label class="checkbox_container text_16_400 text_6A6A6A mb_21">{{$user->name}}
                                    <input type="checkbox" id="user_{{ $user->id }}" name="assigned_users[]" data-user-id="{{$user->id}}">
                                    <span class="checkmark"></span>
                                </label>
                                @endforeach

                            @endif
                        </div>
                        <div class="invalid-feedback" id="error_assigned_users"></div>
                        {{-- <div id="user_list_error" class="text-danger"></div> --}}
                    </div>
                </div>
                <input type="hidden" id="taskId">
                <div class="d-flex">
                    <button class="btn text_14_400 text-white br_6 bg_126C9B cp_3 mr_16" id="submitTaskBtn">Submit</button>
                    <button class="btn text_14_400 text-white br_6 bg_FCAF3B cp_3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewTaskModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?= url('') ?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text_20_700 text_404248 mb_24">Task Details</div>
                        <div class="text_14_500 text_6A6A6A mb_6">Client’s Name</div>
                        <input type="text" id="viewClientName" class="form-control br_8 bg_F1F2F2 mb_24 myinput" readonly>
                        <div class="text_14_500 text_6A6A6A mb_6">Details</div>
                        <textarea id="viewDetails" class="form-control br_8 bg_F1F2F2 mb_24 myinput" rows="5" readonly></textarea>
                        <div class="text_14_500 text_6A6A6A mb_6">Date</div>
                        <input type="date" id="viewDate" class="form-control br_8 bg_F1F2F2 mb_24 myinput" readonly>
                        <div class="text_14_500 text_6A6A6A mb_6">Time</div>
                        <input type="time" id="viewTime" class="form-control br_8 bg_F1F2F2 mb_24 myinput" readonly>
                    </div>
                    <div class="col-md-5 mb_24">
                        <div class="text_20_700 text_404248 mb_24">Assign Task To</div>
                        <div class="text_14_500 text_6A6A6A mb_6">Users List</div>
                        <div id="viewUsersList" class="bg_F1F2F2 br_8 cp_6">
                            <!-- Users will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
