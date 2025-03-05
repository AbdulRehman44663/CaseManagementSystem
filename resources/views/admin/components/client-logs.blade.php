@foreach($client_logs as $log)
    <div class="br_6 bg_F1F2F2 cp_6 mb_24 position_relative">
        <div class="icon_top_right">
            <div class="d-flex">
                <div class="d-flex align-items-center" onclick="editLog({{$log->id}})" id="edit-log-btn" role="button">
                    <div>
                        <img src="<?=url('')?>/assets/images/pencile-blue.svg" alt="" width="14px">
                    </div>
                    <div class="text_14_500 text_126C9B ml_6">Edit</div>
                </div>
                <div class="d-flex align-items-center ml_24" onclick="deleteLog({{$log->id}})" role= "button">
                    <div>
                        <img src="<?=url('')?>/assets/images/delete-red.svg" alt="" width="14px">
                    </div>
                    <div class="text_14_500 text_FC3B3B ml_6">Delete</div>
                </div>
            </div>
        </div>
        <div class="text_16_700 text_404248 mb_24">{{$log->title}}</div>
        <div class="text_16_700 text_404248 mb_12">Comments</div>
        <div class="text_16_400 text_6A6A6A mb_24">{{$log->comment}}</div>
        <div class="text_16_700 text_404248 mb_12">Added By</div>
        <div class="text_16_400 text_6A6A6A mb_24">{{$log->user->name}}</div>
        <div class="text_16_400 text_6A6A6A">{{$log->created_at}} </div>
    </div>
@endforeach