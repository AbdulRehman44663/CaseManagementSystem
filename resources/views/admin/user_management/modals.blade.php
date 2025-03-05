<div class="modal fade" id="createUserInformation" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <form id="add-user-form" method="POSt">

          <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
          <div class="text_20_700 text_404248 mb_12 main-title"></div>
          
          <div class="text_16_400 text_404248 mb_24 d-none on_add_user"><span class="text_16_400">Note:</span> The new user will receive an email asking him/her to establish a password in order to log in.</div>
          <div class="text_16_400 text_404248 mb_24 d-none on_edit_user"><span class="text_16_400">Note:</span> If you are changing the user's email, please be sure to re-send a link so that the user can reset his/her password.</div>

          
          <input type="hidden" id="user_id" name="user_id" value="">

          <div class="mb_18">
            <div class="text_14_500 text_404248 mb_6">Name <span class="text_B4173A">*</span></div>
            <input type="text" class="form-control myinput bg_F1F2F2" name="name" id="name" placeholder="Enter Name">
            <div class="invalid-feedback" id="error_name"></div>
          </div>

          <div class="mb_18">
            <div class="text_14_500 text_404248 mb_6">Email <span class="text_B4173A">*</span></div>
            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control myinput bg_F1F2F2">
            <div class="invalid-feedback" id="error_email"></div>
          </div>
          
          <div class="mb_18">
            <div class="text_14_500 text_404248 mb_6">Hourly Rate ($) <span class="text_B4173A">*</span></div>
            <input type="number" name="hourly_rate" placeholder="Enter Hourly Rate" id="hourly_rate" class="form-control myinput bg_F1F2F2">
            <div class="invalid-feedback" id="error_hourly_rate"></div>
          </div>
          <div class="mb_24">
            <div class="text_14_500 text_404248 mb_6">User Type <span class="text_B4173A">*</span></div>
            <select class="form-control myinput bg_F1F2F2 select_list_icon" name="user_type" id="user_type">
                <option value="">User Type</option>
                @foreach ($lawyer_user_types as $lawyer_user_type)
                  <option value="{{$lawyer_user_type->id}}"> {{$lawyer_user_type->name}}</option>
                @endforeach
              </select>
            <div class="invalid-feedback" id="error_user_type"></div>
          </div>
          
          <div class="d-flex">
              <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 submit-btn"></button>
              <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 
<!--- assign events --->
<div class="modal fade" id="selectEvents" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">

              <form id="update-edit-event">
                <input type="hidden" name="event_user_id" id="event_user_id" value="">

                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_12">Select events for <span id="event_user_email"></span></div>
                <div class="text_16_400 text_404248 mb_24">Please select the events</div>

                @foreach ($case_types as $case_type)
                  <label class="checkbox_container text_16_400 text_6A6A6A mb_16">{{$case_type->name}}
                    <input type="checkbox" id="casetype_{{ $case_type->id }}" name="case_type_events[]" data-case-id="{{$case_type->id}}">
                    <span class="checkmark"></span>
                  </label>
                @endforeach

                <label class="checkbox_container text_16_400 text_6A6A6A mb_16">Accounting
                  <input type="checkbox" id="accounting_event" name="accounting_events" data-user-id="yes">
                  <span class="checkmark"></span>
                </label>
                 
                <div>
                    <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Apply Changes</button>
                    <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>

            </div>
        </div>
    </div>
</div>

<!---- assign access ---->

<div class="modal fade" id="assignAssess" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
          <div class="modal-body">

            <form id="update-user-assess">
              <input type="hidden" name="assess_user_id" id="assess_user_id" value="">

              <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
              <div class="text_20_700 text_404248 mb_12">Select Accesses  for <span id="assess_user_email"></span></div>
              <div class="text_16_400 text_404248 mb_24">Please select the privileges this user will have:</div>
              
              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[01] ADD NEW CLIENT
                <input type="checkbox" id="access_add_new_client" name="user_access[]" data-access-id="add_new_client">
                <span class="checkmark"></span>
              </label>

              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[02] MODIFY EXISTING CLIENT
                <input type="checkbox" id="access_modify_existing_client" name="user_access[]" data-access-id="modify_existing_client">
                <span class="checkmark"></span>
              </label>

              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[03] ADD PAYMENT
                <input type="checkbox" id="access_add_payment" name="user_access[]" data-access-id="add_payment">
                <span class="checkmark"></span>
              </label>

              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[04] INSERT NEW PAYMENT
                <input type="checkbox" id="access_insert_new_payment" name="user_access[]" data-access-id="insert_new_payment">
                <span class="checkmark"></span>
              </label>

              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[05] MODIFY PAYMENT
                <input type="checkbox" id="access_modify_payment" name="user_access[]" data-access-id="modify_payment">
                <span class="checkmark"></span>
              </label>

              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[06] ADMIN SECTION
                <input type="checkbox" id="access_admin_section" name="user_access[]" data-access-id="admin_section">
                <span class="checkmark"></span>
              </label>
              
              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[07] SEE ALL CLIENTS
                <input type="checkbox" id="access_see_all_clients" name="user_access[]" data-access-id="see_all_clients">
                <span class="checkmark"></span>
              </label>

              <label class="checkbox_container text_16_400 text_6A6A6A mb_16">[08] VIEW DEBIT/CREDIT CARD NUMBER
                <input type="checkbox" id="access_view_debit_credit_card" name="user_access[]" data-access-id="view_debit_credit_card">
                <span class="checkmark"></span>
              </label>
              
              <div>
                  <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Apply Changes</button>
                  <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
              </div>
            </form>

          </div>
      </div>
  </div>
</div>