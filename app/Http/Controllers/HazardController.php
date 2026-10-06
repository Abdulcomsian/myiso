<?php

namespace App\Http\Controllers;

use App\Hazard;

class HazardController extends SimpleRegisterController
{
    protected function model()
    {
        return Hazard::class;
    }

    protected function module()
    {
        return [
            'key' => 'hazards',
            'admin_url' => 'hazardsad',
            'title' => 'Hazards (Health & Safety)',
            'subtitle' => 'A list of dangers at work and how we keep people safe.',
            'guide' => [
                'eyebrow' => 'Manuals & Policies',
                'title' => 'Hazard Register',
                'sections' => [
                    ['heading' => 'What is it?', 'body' => ['A list of all the dangers at your workplace, things that could hurt someone. For each one, you write what injury could happen and how you prevent it. No to be confused with Chemical Control.']],
                    ['heading' => 'Why does it matter?', 'body' => ['ISO 45001 requires you to identify all workplace hazards and documented controls. An auditor will ask: "What dangers are there at work? How do you keep people safe?"']],
                    ['heading' => 'Basic steps', 'body' => []],
                ],
                'steps' => [
                    'Identify all workplace hazards, things that could hurt someone.',
                    'For each hazard, note who could be hurt and how you prevent it.',
                    'Assign someone responsible and a monitoring method.',
                    'Update the list when operations change or after an incident.',
                    'Discuss it at your annual management review.',
                ],
            ],
            'info_title' => 'Add hazards that could hurt people, like:',
            'info_items' => ['Slips, trips, falls', 'Sharp objects or machinery', 'Moving vehicles','Heavy lifting or repetitive work'],
            'add_label' => 'Add Hazard',
            'edit_title' => 'Edit Hazard',
            'item_name' => 'Hazard',
            'search_placeholder' => 'Search hazards…',
            'empty' => 'No hazards added yet.',
            'icon' => 'fa-hard-hat',
            'label_field' => 'hazard',
            'fields' => [
                'hazard' => ['label' => 'Hazard', 'type' => 'text', 'required' => true, 'wide' => true, 'placeholder' => 'Example: Slips on wet floor, Sharp tools'],
                'risk' => ['label' => 'Risk / Impact', 'type' => 'text', 'wide' => true, 'placeholder' => 'Example: Staff could break leg, Visitor could get hurt, Severe burn'],
                'controls' => ['label' => 'Controls', 'type' => 'text', 'wide' => true, 'placeholder' => 'Example: Keep floor dry, Use guards on tools, Signage'],
                'responsible_person' => ['label' => 'Responsible Person', 'type' => 'text', 'placeholder' => 'Example: John Smith'],
                'monitoring_method' => ['label' => 'Monitoring Method', 'type' => 'text', 'placeholder' => 'Example: Check daily, Inspect weekly, Add to Requirements Due'],
            ],
            'columns' => [
                'hazard' => 'Hazard',
                'risk' => 'Risk',
                'controls' => 'Controls',
                'responsible_person' => 'Responsible',
                'monitoring_method' => 'Monitoring',
            ],
        ];
    }
}
