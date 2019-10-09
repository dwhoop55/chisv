<?php

use Illuminate\Database\Seeder;

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
                    'description' => 'Are you local to where ISS2019 will be this year?',
                    'hint' => 'If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.',
                    'value' => true,
                    'required' => true,
                ),
                'attended_before' =>
                array(
                    'type' => 'boolean',
                    'description' => 'Have you attended this conference before?',
                    'value' => true,
                    'required' => true,
                ),
                'sved_before' =>
                array(
                    'type' => 'boolean',
                    'description' => 'Have you been an SV at this conference before?',
                    'value' => false,
                    'required' => true,
                ),
                'need_visa' =>
                array(
                    'type' => 'boolean',
                    'description' => 'Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)',
                    'hint' => 'Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.',
                    'value' => true,
                    'required' => true,
                ),
                'why' =>
                array(
                    'type' => 'string',
                    'description' => 'Please explain why you want to be an SV at the conference.',
                    'maxlength' => 2000,
                    'value' => 'Very long text',
                    'required' => true,
                ),
                'short' =>
                array(
                    'type' => 'string',
                    'description' => 'Some short text:',
                    'maxlength' => 99,
                    'value' => 'Short text',
                    'required' => false,
                ),
            ),
        );

        $enrollmentForms = [
            ["id" => 1, "name" => "Default", "is_filled" => false, "body" => json_encode($body)],
        ];
        DB::table('enrollment_forms')->insert($enrollmentForms);
    }
}