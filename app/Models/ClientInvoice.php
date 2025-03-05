<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function clientCaseinformation()
    {
        return $this->belongsTo(ClientCaseInformation::class, 'client_case_information_id', 'id');
    }

    public function caseType()
    {
        return $this->belongsTo(CaseType::class, 'case_type_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function invoicePayments()
    {
        return $this->hasMany(PlanPayment::class, 'client_invoice_id', 'id');
    }
}
