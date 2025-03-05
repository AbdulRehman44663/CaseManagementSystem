<?php

use App\Models\ADPlacement;
use App\Models\CaseType;
use App\Models\LeadSources;
use App\Models\CaseIntakeField;

function getCaseType($id = null)
{
    if ($id) {
        return CaseType::where('id',$id)->first();
    }
    
    return CaseType::all();
}


function getLeadSources()
{
    return LeadSources::all();
}

function getADPlacement()
{
    return ADPlacement::all();
}

function getCaseTypeFields($id)
{
    return CaseIntakeField::where('case_type', $id)->orderBy('order_number','ASC')->get();
}

function getFileName($file)
{
    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);  
    $extension = $file->getClientOriginalExtension(); 
    $timestamp = time();  
    return $originalName . '_' . $timestamp . '.' . $extension; 
    return CaseIntakeField::where('case_type', $id)->orderBy('id','DESC') ->get();
}