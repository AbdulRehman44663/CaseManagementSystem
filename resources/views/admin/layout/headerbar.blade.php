
    <div class="header_bar bg_F1F2F2">
        <div class="row">
            <div class="col-xl-5 col-lg-12 order-2 order-xl-1">
                <div class="input-group search_input pl-0">
                    <span class="input-group-text pr-0">
                        <img src="<?=url('')?>/assets/images/search.svg" alt="">
                    </span>
                    <input type="text" class="form-control search_input_field ff_dm_sans" placeholder="Search Client Name">
                </div>
            </div>
            <div class="col-xl-2 col-lg-11 col-md-11 col-10 order-1 order-xl-2 mb-lg-10">
               
            </div>
            <div class="col-xl-5 col-lg-1 col-md-1 col-2 order-1 order-xl-3 mb-lg-10">
                <div class="cp_18">
                    <div class="d-flex align-items-center justify-content-end">
                        <a type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_1 mybtn text-white headerbar_buttons" href="{{route('admin.clientsList')}}">Client List</a>
                        <a type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_1 mybtn text-white ml_16 headerbar_buttons" href="{{route('admin.addLead')}}">Add new Lead/Client</a>
                       
                        <div class="ml_16">
                            <div class="dropdown">
                                <img src="<?=url('')?>/assets/images/profile-img.png" alt="" width="34px" class="mybtndropdown dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li class="headerbar_dropdown_buttons">
                                        <a class="dropdown-item text_12_400 text_6A6A6A" href="{{route('admin.clientsList')}}" role="button">Client List</a>
                                    </li>
                                    <li class="headerbar_dropdown_buttons">
                                        <a class="dropdown-item text_12_400 text_6A6A6A" href="{{route('admin.addLead')}}" role="button">Add new Lead/Client</a>
                                    </li>
                                    <li class="headerbar_dropdown_buttons">
                                        <a class="dropdown-item text_12_400 text_6A6A6A" href="{{route('admin.closedCases')}}" role="button">View Closed Files (WIP)</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text_12_400 text_6A6A6A">Logout</button>
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="addTimeEntry" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div class="text_20_700 text_404248 mb_12">Add Time Entry</div>
                <div class="text_14_500 text_404248 mb_6">Client Name</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18" placeholder="Dennis Peterson">
                <div class="text_14_500 text_404248 mb_6">Duration</div>
                <div class="d-flex">
                    <input type="text" class="form-control myinput bg_F1F2F2 mb_18 w_fit_content w_100px" placeholder="Hours">
                    <input type="text" class="form-control myinput bg_F1F2F2 mb_18 ml_6 w_fit_content w_100px" placeholder="Minutes">
                </div>
                <div class="text_14_500 text_404248 mb_6">Date</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Hourly Fee ($)</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div class="text_14_500 text_404248 mb_6">Description</div>
                <textarea class="form-control myinput bg_F1F2F2 mb_18" rows="3"></textarea>
                <div class="text_14_500 text_404248 mb_6">Rate ($)</div>
                <input type="text" class="form-control myinput bg_F1F2F2 mb_18">
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Save Entry</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
