<?php
namespace App\Services;

use App\Models\LeadSources;

class LeadSourcesService
{
    public function createLeadSources($data)
    {
        try
        {
            $leadSources = new LeadSources();
            $leadSources->name = $data['name'];
            $leadSources->chart_color = '#126C9B';
            $leadSources->save();
            session()->flash('success', 'Lead Sources saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
            session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function updateLeadSources($data, $id)
    {
        try {
            $leadSources = LeadSources::findOrFail($id);
    
            // Update the fields
            $leadSources->name = $data['name'];
            $leadSources->save();
            
            session()->flash('success', 'Lead Sources updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
}