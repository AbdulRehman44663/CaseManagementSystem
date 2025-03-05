<?php
namespace App\Services;

use App\Models\ClientInvoice;

class ClientInvoiceService
{

    public function createClientInvoice($data)
    {
        try
        {
            $caseType = new ClientInvoice();
            $caseType->name = $data['name'];
            $caseType->save();
            //session()->flash('success', 'Case Type saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
            //session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function updateClientInvoice($data, $id)
    {
        try {
            $caseType = ClientInvoice::findOrFail($id);

            // Update the fields
            $caseType->name = $data['name'];
            $caseType->save();

            //session()->flash('success', 'Case Type updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            //session()->flash('error', $errorMessage);
            return false;
        }
    }
}
