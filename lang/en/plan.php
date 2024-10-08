<?php


return [
    'btn-save' => 'Save',
    'btn-cancel' => 'Cancel',
    'btn-reset' => 'Reset',
    'btn_permanently_deleted' => 'permanently deleted',
    'btn-delete' => 'Delete',
    'btn_restored' => 'Restore',
    'btn-edit' => 'Update',
    'edit' => 'Edit',
    'create' => 'Create',

    'create_plan' => 'Create Plan',
    'edit_plan' => 'Edit Plan',
    'plans' => 'Plan List',

    'btn-export-csv' => 'Export csv',
    'btn-export-xlsx' => 'Export xlsx',
    'btn-import-cvs' => 'Import csv',
    'btn-export-pdf' => 'Export in PDF',

    
    'table' => [
        '#' => 'Sr. No',
        'name' => 'Name',
        'description' => 'Description',
        'validity_month' => 'Validity',
        'price' => 'Price',
        'btn' => 'Action',
    ],
    'form' => [
        '#' => 'Sr. No',
        'name' => 'Name',
        'description' => 'Description',
        'validity_month' => 'Validity in Months',
        'price' => 'Price',
        'btn' => 'Action',
        'status' => 'Status',


    ],
    'message' => [
        'save-message' => 'Plan created successfully',
        'update-message' => 'Plan updated successfully',
        'delete-message' => 'Plan deleted successfully',
        'restore-message' => 'Plan restored successfully',
        'permanently-delete-message' => 'Plan delete permanently successfully',

        'error_name' => 'The name field is required',
        'error_description' => 'The description field is required',
        'error_validity_month' => 'The validity month field is required',
        'error_price' => 'The price field is required',
        'error_auth_delete_message' => 'Only Product Owner can delete the pakage',
        'error_name_unique' => 'Plan name already exists.'
    ]

];