<div class="col-xxl-4 col-xl-6">
    <div class="br_6 bg_F1F2F2 cp_4 mb_24 position_relative">
        <div class="icon_top_right">
            <div class="d-flex">
                <div class="d-flex align-items-center" data-bs-toggle="modal" data-task-id="{{$task->id}}" href="#addTaskModal" role="button">
                    <div>
                        <img src="{{ url('') }}/assets/images/pencile-blue.svg" alt="" width="14px">
                    </div>
                    <div class="text_14_500 text_126C9B ml_6">Edit</div>
                </div>
                <div class="d-flex align-items-center ml_24 gap-2" onclick="deleteTask({{ $task->id }})" data-task-id="{{ $task->id }}">
                    <img src="{{ url('') }}/assets/images/delete-red.svg" alt="" width="14px">
                    <span class="text_14_500 text_FC3B3B delete-task-btn">Delete</span>
                </div>
                
                 
            </div>
        </div>
        <div class="mb_24">
            <div class="d-flex align-items-center mb_15">
                <div class="height_26">
                    <img src="{{ url('') }}/assets/images/calendar-yellow.svg" alt="" width="24px">
                </div>
                <div class="text_14_600 text_404248 ml_6">Date: {{ $task->date }}</div>
            </div>
            <div class="d-flex align-items-center">
                <div class="height_26">
                    <img src="{{ url('') }}/assets/images/clock-yellow.svg" alt="" width="24px">
                </div>
                <div class="text_14_600 text_404248 ml_6">Time: {{ \Carbon\Carbon::parse($task->time)->format('h:i A') }}</div>
            </div>
            <div class="row mb_14">
                <div class="col-md-4">  
                    <div class="text_16_700 text_404248">Assigned to:</div>
                </div>
                <div class="col-md-4">
                    <div class="text_16_400 text_404248 ml_27" style="max-height: 120px; height:100px; overflow-y: auto;">
                        @foreach ($task->assignedUsers as $user)
                            {{ $user->name }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                </div>
                
            </div>
            <div class="row mb_14">
                <div class="col-md-4">
                    <div class="text_16_700 text_404248">Client(s):</div>
                </div>
                <div class="col-md-4">
                    <div class="text_16_400 text_404248 ml_27">{{ $task->client->primary_client_name }}</div>
                </div>
            </div>
            <div class="row mb_14">
                <div class="col-md-4">
                    <div class="text_16_700 text_404248">Assigned by:</div>
                </div>
                <div class="col-md-4">
                    <div class="text_16_400 text_404248 ml_27">{{ $task->assignedBy->name }}</div>
                </div>
            </div>
            <div class="row mb_20">
                <div class="col-md-4">
                    <div class="text_16_700 text_404248">Completed:</div>
                </div>
                <div class="col-md-4">
                    <div class="text_16_400 text_404248 ml_27">{{ $task->completed ? 'YES' : 'NO' }}</div>
                </div>
            </div>
        </div>
        <button class="btn text_14_400 text-white br_6 bg_126C9B cp_5" data-bs-toggle="modal" data-task-id="{{$task->id}}" href="#viewTaskModal" role="button">View Details</button>
    </div>
</div>