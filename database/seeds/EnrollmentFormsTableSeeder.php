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
        $enrollmentForms = [
            ["id" => 1, "name" => "Default", "is_filled" => false, "body" => '{"order":["know_city","attended_before","sved_before","need_visa","why"],"fields":{"know_city":{"type":"boolean","description":"Are you local to where ISS2019 will be this year?","default":false,"hint":"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others."},"attended_before":{"type":"boolean","description":"Have you attended this conference before?","default":false},"sved_before":{"type":"boolean","description":"Have you been an SV at this conference before?","default":false},"need_visa":{"type":"boolean","description":"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)","default":false,"hint":"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs."},"why":{"type":"textarea","description":"Please explain why you want to be an SV at the conference.","maxlength":2000}},"header":"Please answer the following questions","agreement":"Please read this carefully: SVs will work for approximately 14 hours during the conference"}'],
        ];
        DB::table('enrollment_forms')->insert($enrollmentForms);
    }
}