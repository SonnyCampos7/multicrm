<?php

return [

    'module' => 'Deals',
    'module_description' => 'Deal is opportunity to sell your product or service.',
    'delete' => 'Delete',
    'edit' => 'Edit',
    'create' => 'Create',
    'back' => 'Back',
    'details' => 'Details',
    'list' => 'Deals list',
    'updated' => 'Deals updated',
    'created' => 'Deals created',
    'create_new' => 'Create Deal',
    'convert_to_quote' => 'Convert to Quote',
    'submit' => 'Submit',

    'dict' => [
        'new_business' => 'New buisness',
        'existing_Business' => 'Existing buisness',
        'qualification' => 'Qualification',
        'needs_analysis' => 'Needs analysis',
        'value_proposition' => 'Value proposition',
        'identify_decision_makers' => 'Identify decision makers',
        'proposal_price_quote' => 'Proposal price quote',
        'negotiation_review' => 'Negotiation review',
        'closed_won' => 'Closed Won',
        'closed_lost' => 'Closed Lost',
        'closed_lost_to_competition' => 'Closed Lost to competition'
    ],

    'panel' => [
        'information' => 'Basic information',
        'notes' => 'Notes'
    ],

    'tabs' => [
      'contacts' => 'Contacts',
      'calls' => 'Call Log',
      'quotes' => 'Quotes',
    ],

    'form' => [
        'name' => 'Deal name',
        'amount' => 'Amount',
        'closing_date' => 'Closing date',
        'probability' => 'Probability',
        'expected_revenue' => 'Expected revenue',
        'next_step' => 'Next step',
        'deal_business_type_id' => 'Business Type',
        'deal_stage_id' => 'Stage',
        'deal_status_id' => 'Status',
        'notes' => 'Notes',
        'owned_by' => 'Assigned To',
        'account_id' => 'Account',
        'account_name' => 'Account',
        'stage' => 'Stage',
        'business_type' => 'Business type',
        'percentage' => 'Percentage of Completion'
    ],

    'table' => [
    ],

    'settings' => [
        'stage' => 'Stage',
        'businesstype' => 'Business Type',
        'status'=> 'Status'
    ],


    'stage' => [
        'module' => 'Stage',
        'module_description' => 'Manage deal stage',
        'panel' => [
            'details' => 'Details'
        ],
        'form' => [
            'name' => 'Name'
        ]
    ],

    'status' => [
        'module' => 'Status',
        'module_description' => 'Manage deal status',
        'panel' => [
            'details' => 'Details',
            'notes' => 'Notes'
        ],
        'form' => [
            'name' => 'Name',
            'step_name' => 'Step Name',
            'description' => 'Description',
            'owned_by' => 'Assigned'
        ]
    ],

    'businesstype' => [
        'module' => 'Business Type',
        'module_description' => 'Manage deal business type',
        'panel' => [
            'details' => 'Details'
        ],
        'form' => [
            'name' => 'Name'
        ]
    ],

];
