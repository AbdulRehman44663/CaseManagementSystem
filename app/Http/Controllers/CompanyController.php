<?php

namespace App\Http\Controllers;


use App\Models\CompanyInformation;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function update(Request $request, CompanyInformation $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'attorney_1' => 'nullable|string|max:255',
            'attorney_2' => 'nullable|string|max:255',
            'attorney_3' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'suite' => 'nullable|string|max:255',
            'city_state_zip' => 'nullable|string|max:255',
            'telephone_no' => 'nullable|string|max:15',
            'fax_no' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'email_signature' => 'nullable|string',
            'show_email_signature' => 'nullable|boolean',
            'logo_path' => 'nullable|string',
            'signature_path' => 'nullable|string',
        ]);

        $company->update($validated);

        return redirect()->back()->with('success', 'Company information updated successfully.');
    }
}
