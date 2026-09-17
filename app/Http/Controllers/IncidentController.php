<?php

namespace App\Http\Controllers;

use App\Incident;

class IncidentController extends SimpleRegisterController
{
    protected function model()
    {
        return Incident::class;
    }

    protected function module()
    {
        return [
            'key' => 'incidents',
            'admin_url' => 'incidentsad',
            'title' => 'Incident & Injury',
            'subtitle' => 'Record all accidents, injuries, and near-misses at work.',
            'info_title' => 'Report incidents immediately after they happen:',
            'info_items' => ['Someone got hurt (injury)', 'Something dangerous almost happened (near-miss)', 'Accident or damage to property'],
            'add_label' => 'Report New Incident',
            'edit_title' => 'Edit Incident',
            'item_name' => 'Incident',
            'search_placeholder' => 'Search incidents…',
            'empty' => 'No incidents recorded yet.',
            'icon' => 'fa-user-injured',
            'label_field' => 'description',
            'fields' => [
                // Order matters: short fields pair up in the 2-column form, textareas take a full row
                'incident_date' => ['label' => 'Date of Incident', 'type' => 'date', 'required' => true],
                'status' => ['label' => 'Status', 'type' => 'select', 'required' => true, 'options' => [
                    'open' => 'Open',
                    'investigating' => 'Investigating',
                    'closed' => 'Closed',
                ]],
                'description' => ['label' => 'Description', 'type' => 'textarea', 'required' => true, 'placeholder' => 'What happened - what caused the incident?'],
                'injured_person' => ['label' => 'Who Was Involved / Injured', 'type' => 'text', 'required' => true, 'placeholder' => 'Name of person affected'],
                'severity' => ['label' => 'Injury Severity', 'type' => 'select', 'required' => true, 'options' => [
                    'none' => 'No injury (near-miss)',
                    'minor' => 'Minor',
                    'moderate' => 'Moderate',
                    'severe' => 'Severe',
                ]],
                'location' => ['label' => 'Location / Department', 'type' => 'text', 'required' => true, 'placeholder' => 'Where did it happen?'],
                'witnesses' => ['label' => 'Witness Names', 'type' => 'text', 'placeholder' => 'Names of people who saw it (optional)'],
                'first_aid' => ['label' => 'First Aid Given', 'type' => 'textarea', 'placeholder' => 'What first aid was provided? (optional)'],
                'investigation' => ['label' => 'Investigation Findings', 'type' => 'textarea', 'placeholder' => 'What we found out about why it happened (optional)'],
                'corrective_actions' => ['label' => 'Corrective Actions', 'type' => 'textarea', 'placeholder' => 'What we will do to stop it happening again (optional)'],
            ],
            'columns' => [
                'incident_date' => 'Date',
                'description' => 'Description',
                'injured_person' => 'Injured',
                'severity' => 'Severity',
                'location' => 'Location',
                'status' => 'Status',
            ],
            // chip colour per select value
            'chips' => [
                'severity' => ['none' => 'info', 'minor' => 'success', 'moderate' => 'warning', 'severe' => 'danger'],
                'status' => ['open' => 'danger', 'investigating' => 'warning', 'closed' => 'success'],
            ],
        ];
    }
}
