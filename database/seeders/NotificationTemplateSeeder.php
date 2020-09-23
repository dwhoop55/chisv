<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [
            "name" => "chi19 Let's get registered",
            "conference_id" => 1,
            "data" => "{\"destinations\":[{\"role_id\":10,\"state_id\":12,\"type\":\"group\",\"display\":\"Accepted SVs\"}],\"elements\":[{\"type\":\"markdown\",\"data\":\"As you might have noticed, the CHI 20## registration site is live. Now we can step right into the next phase of the SV program! This email contains info about:\\n\\n- The SV contract\\n- Registration info (deadline: ###### ##nd, 20##)\\n- Visa support letters\\n- Slack Channel\\n- Housing\\n\\n\\n#THE SV CONTRACT\\n\\nPlease take the time to read this carefully. We want to make sure that everybody is on the same page when they arrive in Glasgow and knows what is expected of them. Being an SV at CHI can be a wonderful experience, but it's less wonderful when you are working extra hours, because a fellow SV didn't step up and work their hours.\\n\\n##You agree to\\n\\n1. Volunteer a _minimum_ of __20 hours__ at the conference as a student volunteer.\\n\\n2. Arrive in Glasgow on or before Sunday, __May 5th__, and stay through the end of the conference on Thursday, May 9th (or Friday, May 10th, if you plan to attend the SV Party).\\n\\n3. Attend one of the three SV orientations. The orientation times are __Saturday, May 4th at 6pm__ and __Sunday, May 5th at 11am and 6pm__.\\n\\n##We agree to\\n\\n1. Waive your registration fees and give you a conference reception ticket (you must pay workshop\\\\\\\/course fees, if you want to attend any).\\n\\n2. Provide you with breakfast and lunch daily (food details are still being worked out).\\n\\n\\n#LET'S GET REGISTERED\\n\\nRegistration is now open! Here's the process for registering for CHI 2019 as a student volunteer. (Note: you must register for the conference by February 22nd, 2019 to maintain your SV spot. If you know that you can't attend, please let us know as soon as possible so we can give your spot to someone on the waitlist).\\n\\n1. Go to [this website](http://www.cvent.com).\\n__ATTENTION: This link can ONLY be used by accepted Student Volunteers.__\\n\\n\\n##Important additional details\\nIf we haven't heard from you in any way by February 22nd, 2018, 12:00 EST, we will assume you are no longer interested in volunteering, and will remove you from the SV accepted list.\\n\\nPlease let us know if you have any issues, we are happy to work things out with you!\\n\\n\\n#VISA SUPPORT LETTERS\\n\\nYou need to download the request form as part of the registration process and follow the instructions described in that form.\\n\\n\\n#SLACK CHANNEL\\n\\nWe will invite you to our Slack Channel as soon as you are registered for the conference. Slack is a good place for you to introduce yourselves to your fellow SVs, or to coordinate sharing a hotel room. It also provides us with a much faster channel to reach you (and vice versa) during the conference, so please accept the invitation as soon as you receive it.\\n\\n\\n## HOUSING\\nYou can find information about housing at [chi2019.acm.org/for-attendees/hotels](https://chi2019.acm.org/for-attendees/hotels/) - the estimated rates are included below. To reduce your accommodation costs, you can share rooms with fellow SVs. You can talk to your fellow SVs via Slack and find someone to share a room with. Use the #housing channel. However, there are a couple of things that you should keep in mind before booking a hotel room together:\\n\\n##CONFERENCE HOTEL RATES\\nHere are the conference hotel rates for your reference. They are also available on the conference website. Most of these are for a single or double room.\\n\\n\\nThat's it for now - if you have any other questions: just email us and we will do our best to help you with any questions as quickly as we can.\"}],\"greeting\":null,\"subject\":\"LET'S GET REGISTERED -- DEADLINES INSIDE\",\"salutation\":\"Regards,\\n\\nSV Chairs CHI20, Honolulu, Hawai\\u02bbi, USA\\n\\n[noreply@chisv.org](mailto:noreply@chisv.org)\\n\\n[ACM](https://www.acm.org/)\"}",
            "year" => 2020,
        ];
        DB::table('notification_templates')->insert($templates);
    }
}