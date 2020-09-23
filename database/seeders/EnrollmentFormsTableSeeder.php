<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $body = array(
            'header' => 'Please answer the following questions',
            'agreement' => 'Please read this carefully: SVs will work for approximately 14 hours during the conference',
            'fields' =>
            array(
                'know_city' =>
                array(
                    'type' => 'boolean',
                    'description' => 'Are you local to where the conference will be this year?',
                    'hint' => 'If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.',
                    'value' => false,
                    'weight' => 0,
                    'required' => true,
                ),
                'attended_before' =>
                array(
                    'type' => 'integer',
                    'range' => [0, 99],
                    'description' => 'How many times have you attended this conference before?',
                    'value' => 0,
                    'weight' => 0,
                    'required' => true,
                ),
                'sved_before' =>
                array(
                    'type' => 'integer',
                    'range' => [0, 99],
                    'description' => 'How many times have you been an SV at this conference before?',
                    'value' => 0,
                    'weight' => 0,
                    'required' => false,
                ),
                'need_visa' =>
                array(
                    'type' => 'boolean',
                    'description' => 'Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)',
                    'hint' => 'Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.',
                    'value' => true,
                    'weight' => 0,
                    'required' => true,
                ),
                'why_you_want_to_be_sv' =>
                array(
                    'type' => 'string',
                    'description' => 'Please explain why you want to be an SV at the conference:',
                    'maxlength' => 2000,
                    'value' => '',
                    'required' => true,
                ),
            ),
        );

        $enrollmentForms = [
            ["id" => 1, "name" => "Default", "is_template" => true, "body" => json_encode($body)],
        ];
        DB::table('enrollment_forms')->insert($enrollmentForms);
    }
}