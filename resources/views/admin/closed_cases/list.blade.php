
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}  (Work In-progress)</div>
    <div class="d-flex mb_26">
        <input type="text" class="form-control search_input text_16_500" placeholder="Search">
        <button class="btn ml_13 text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Closed Cases</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0"> 
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Date Closed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DENNIS PETERS</td>
                        <td>123 Test St, Anywhere CA 90270  </td>
                        <td>323 3456 541</td>
                        <td>$0.00</td>
                        <td>
                            <div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="#" role="button">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>DENNIS PETERS</td>
                        <td>123 Test St, Anywhere CA 90270  </td>
                        <td>323 3456 541</td>
                        <td>$0.00</td>
                        <td>
                            <div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="#" role="button">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>DENNIS PETERS</td>
                        <td>123 Test St, Anywhere CA 90270  </td>
                        <td>323 3456 541</td>
                        <td>$0.00</td>
                        <td>
                            <div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="#" role="button">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>DENNIS PETERS</td>
                        <td>123 Test St, Anywhere CA 90270  </td>
                        <td>323 3456 541</td>
                        <td>$0.00</td>
                        <td>
                            <div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="#" role="button">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>DENNIS PETERS</td>
                        <td>123 Test St, Anywhere CA 90270  </td>
                        <td>323 3456 541</td>
                        <td>$0.00</td>
                        <td>
                            <div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="#" role="button">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-between cp_1">
                <div class="text_14_500 ff_dm_sans text_404248">Showing 1 to 10 of 50 results</div>
                <div class="d-flex align-items-center">
                    <div>
                        <select name="" id="" class="select_list">
                <option value="">5</option>
            </select>
                    </div>
                    <div class="text_14_500 ff_dm_sans text_404248 ml_8">per page</div>
                </div>
                <div></div>
            </div>
        </div>
    </div>
    
    @include('admin.'.$controller.'.modals') 
@endsection('content')