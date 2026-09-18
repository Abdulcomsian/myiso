<?php

namespace App\Http\Controllers;

use App\EnvironmentalImpact;

class EnvironmentalImpactController extends SimpleRegisterController
{
    protected function model()
    {
        return EnvironmentalImpact::class;
    }

    protected function module()
    {
        return [
            'key' => 'environmental_impacts',
            'admin_url' => 'environmentalImpactsad',
            'title' => 'Environmental Impacts',
            'subtitle' => 'A list of what your business does to the environment and how you control these things.',
            'info_title' => 'Add items that affect the environment, like:',
            'info_items' => ['Use of energy', 'Creating waste', 'Using water', 'Using chemicals'],
            'add_label' => 'Add Environmental Aspect',
            'edit_title' => 'Edit Environmental Aspect',
            'item_name' => 'Environmental Aspect',
            'search_placeholder' => 'Search aspects…',
            'empty' => 'No environmental aspects added yet.',
            'icon' => 'fa-leaf',
            'label_field' => 'aspect',
            'fields' => [
                'aspect' => ['label' => 'Aspect', 'type' => 'text', 'required' => true, 'wide' => true, 'placeholder' => 'Example: Energy use, Waste created, Water usage'],
                'impact' => ['label' => 'Environmental Impact', 'type' => 'text', 'wide' => true, 'placeholder' => 'Example: Climate change, Pollution, Resource loss'],
                'controls' => ['label' => 'Controls / Actions', 'type' => 'text', 'wide' => true, 'placeholder' => 'Example: LED lights, Recycling program, Water saving'],
                'responsible_person' => ['label' => 'Responsible Person', 'type' => 'text', 'placeholder' => 'Example: John Smith (optional)'],
                'monitoring_method' => ['label' => 'Monitoring Method', 'type' => 'text', 'placeholder' => 'Example: Check monthly, Count weekly (optional)'],
            ],
            'columns' => [
                'aspect' => 'Aspect',
                'impact' => 'Impact',
                'controls' => 'Controls',
                'responsible_person' => 'Responsible',
                'monitoring_method' => 'Monitoring',
            ],
        ];
    }
}
