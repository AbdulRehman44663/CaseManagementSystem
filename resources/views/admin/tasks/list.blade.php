@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
<div class="d-flex justify-content-between mb_24">
    <ul class="nav nav-pills my-nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-assigned-to-me-tab" data-tab="pending-assigned-to-me" type="button" role="tab">Pending - Assigned to me</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="all-pending-tab" data-tab="all-pending" type="button" role="tab">All Pending</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-tab="completed" type="button" role="tab">Completed</button>
        </li>
    </ul>
    <div>
        <button type="button" class="btn ml_13 text_14_400 text-white br_6 bg_126C9B cp_3" data-bs-toggle="modal" href="#addTaskModal" role="button">+ Add Task</button>
    </div>
</div>
<div class="tab-content" id="tab-content-container">
    <!-- Dynamic content will be loaded here -->
</div>

@include('admin.'.$controller.'.modals')
@include('admin.tasks.task-script')


@endsection
