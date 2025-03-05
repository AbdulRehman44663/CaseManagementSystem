<?php

namespace App\Http\Middleware;

use App\Models\CaseType;
use Closure;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LoadClientData
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure session has client_id
        if (Session::has('client_id') && Session::has('case_type_id')) {

            $clientId = Session::get('client_id');
            $caseTypeId = Session::get('case_type_id');

            // Check if client data is not already stored or case type has changed
            if (!Session::has('client_detail') || $request->has('case_type_id')) {
                
                
                $client = CaseType::with(['clientCaseInfo' => function ($query) use ($clientId) {
                    $query->where('client_id', $clientId);
                }, 'clientCaseInfo.client.user'])
                ->where('id', $caseTypeId)
                ->first();
                Session::put('client_detail', $client);
                
            }
        }

        return $next($request);
    }
}
