<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConversationLog;

class ConversationLogController extends Controller
{
    public function __construct() {}

    public function storeLog(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'conversation' => 'required|string',
        ]);

        ConversationLog::create([
            'client_id' => $request->client_id,
            'conversation' => $request->conversation,
        ]);

        return response()->json(['message' => 'Log saved successfully'], 201);
    }
}
