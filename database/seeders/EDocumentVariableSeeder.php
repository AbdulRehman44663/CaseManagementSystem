<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EDocumentVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentVariables = [
            ['ALT_PHONE_NUMBER', '', '', ''],
            ['ALT_PHONE_NUMBER_2', '', '', ''],
            ['ALT_PHONE_NUMBER_2_NAME', '', '', ''],
            ['ALT_PHONE_NUMBER_NAME', '', '', ''],
            ['CASETYPE_DESCRIPTION', '', '', ''],
            ['CLIENT_INITIALS_1', '', '', ''],
            ['CLIENT_INITIALS_2', '', '', ''],
            ['CLIENT_NAME', '', '', ''],
            ['CLIENT_NAME_2', '', '', ''],
            ['CLIENT_SIGNATURE_1', '', '', ''],
            ['CLIENT_SIGNATURE_2', '', '', ''],
            ['CODE', '', '', ''],
            ['DATE_1', '', '', ''],
            ['DATE_2', '', '', ''],
            ['DOB', '', '', ''],
            ['DOB_2', '', '', ''],
            ['DRIVER_LICENSE_NO', '', '', ''],
            ['DROP_YES_NO', '', '', ''],
            ['EMAIL_1', '', '', ''],
            ['EMAIL_2', '', '', ''],
            ['MARITAL_STATUS', '', '', ''],
            ['PHONE_NUMBER', '', '', ''],
            ['PROPERTY_ADDRESS', '', '', ''],
            ['SSN', '', '', ''],
            ['SSN_2', '', '', ''],
            ['LAWYER_ATTORNEY_ADDRESS', 'lawyer', '', ''],
            ['LAWYER_ATTORNEY_CITYSTATEZIP', 'lawyer', '', ''],
            ['LAWYER_ATTORNEY_EMAIL', 'lawyer', '', ''],
            ['LAWYER_ATTORNEY_FAX', 'lawyer', '', ''],
            ['LAWYER_ATTORNEY_NAME', 'lawyer', '', ''],
            ['LAWYER_ATTORNEY_PHONE', 'lawyer', '', ''],
            ['LAWYER_ATTORNEY_SUITE', 'lawyer', '', ''],
            ['LAWYER_OFFICE_LOGO', '', 'lawyer', ''],
            ['LAWYER_OFFICE_NAME', 'lawyer', '', ''],
            ['LAWYER_SIGNATURE', 'lawyer', '', ''],
            ['LAWYER_SIGNATURE_DATE', 'lawyer', '', ''],
        ];

        foreach ($documentVariables as [$variable_name, $variable_type, $table_name, $table_field_name]) {
            DB::table('e_document_variables')->insert([
                'variable_name'    => $variable_name,
                'variable_type'    => $variable_type,
                'table_name'       => $table_name,
                'table_field_name' => $table_field_name,
            ]);
        }
    }
}
