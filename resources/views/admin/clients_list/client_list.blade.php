@foreach($clients as $client)
 
@foreach($client->clientCasesInfo as $clientCaseesInfo)
 
    <div class="br_6 bg_F1F2F2 cp_9 mb_32">
        <div class="row">
            <div class="col-md-6">
                <div class="text_20_700 text_126C9B mb_14">{{$client->primary_client_name}}</div>
                <div class="text_14_700 text_404248 mb_10">Service: <span class="text_14_400">{{$clientCaseesInfo->caseType->name}}</span></div>
                <div class="text_14_700 text_404248 mb_24">Case Number: <span class="text_14_400">{{isset($clientCaseesInfo->case_number) ?$clientCaseesInfo->case_number : 'N/A'}}</span></div>

                <div class="text_14_700 text_404248 mb_10">Fee Type: Flat Fee</div>
                <div class="text_14_700 text_404248 mb_10">Attorney Amount: $1000.00</div>
                <div class="text_14_700 text_404248 mb_32">Filling Fee: 0.00</div>

                <div class="text_14_700 text_404248 mb_10">Total Paid: $0.00</div>
                <div class="text_14_700 text_404248 mb_24">Balance: $0.00</div>
            </div>
            <div class="col-md-6">
                <div class="text_14_700 text_404248 mb_10">Status:</div>
                <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_10 mybtn text-white mb_40">{{ucfirst($client->clientStatus->name)}}</button>
                <div class="text_14_700 text_404248 mb_10">Address: <span class="text_14_400">{{$client->property_address}}</span></div>
                <div class="text_14_700 text_404248 mb_10">Telephone: <span class="text_14_400">{{$client->telephone_number}}</span></div>
                <div class="text_14_700 text_404248 mb_10">Email: <span class="text_14_400">{{$client->email_address}}</span></div>
                <div class="text_14_700 text_404248 mb_10">Email 2: <span class="text_14_400">{{!empty($client->secondary_email_address) ? $client->secondary_email_address : 'Not Available' }}</span></div>
            </div>
        </div>
        <a class="btn text_14_400 text-white br_6 bg_126C9B cp_3" href="{{ route('admin.clientInfo', [$client->id, $clientCaseesInfo->id]) }}">
            View Client Details
        </a>
        
    </div>
    @endforeach
@endforeach
<div id="pagination_links">
    <div>
        {{ $clients->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>