<?php

namespace Dorcas\ModulesOps\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function create(Request $request){
        $user = $this->user($request);
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',

        ]);
        $faculty = null;
        $event_data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'faculty_id' => $user->id,
        ];
        $zoom_date =  $this->transformDateToTimeZone($request->input('event_date'),'Africa/Lagos');
        $webinar = $this->createWebinar($request->input('title'),
            $zoom_date,
            $request->input('description'),
            $faculty);
        $request->request->set('event_url',$webinar->join_url);
        $request->request->set('event_meta_data',json_encode($webinar));
        $event_data['event_url'] = $request->event_url;
        $event_data['event_meta_data'] = $request->event_meta_data;
        $event = $this->events->create($event_data);
        // $resource = new Item($event, new EventTransformer(), 'events');
        return response()->json($event->toArray(), 201);
    }

    private function createWebinar($event_title,$event_date,$event_description,$faculty){
        $client = new Client(['base_uri' => 'https://api.zoom.us']);
        try{
            $userInstance = DB::table('zoom_access_tokens')->first();
            $token = $userInstance->access_token;
            // $is_zoom_user_exists = $this->fetchZoomUser($faculty,$token,$userInstance->refresh_token);
            // if (! $is_zoom_user_exists->existed_email || $is_zoom_user_exists === null){
            //     $zoom_user = $this->createZoomUser($faculty,$token,$userInstance->refresh_token);
            // }
            $meetingInstance = DB::table('zoom_access_tokens')->first();
            $meetingToken = $meetingInstance->access_token;
            $response = $client->request('POST', 'v2/users/'.env('ZOOM_USER_ID').'/meetings', [
                "headers" => [
                    "Authorization" => "Bearer $meetingToken"
                ],
                'json' => [
                    "topic" => $event_title,
                    "type" => 2,
                    "duration" => 240,
                    "start_time" => $event_date,
                    "timezone" => "Africa/Bangui",
                    "password" => random_int(10,300),
                    "agenda"  => $event_description,
                    "settings"=> [
                        "host_video"=> true,
                        "participant_video"=> false,
                        "join_before_host"=> true,
                        "hd_video"=> true,
                        "mute_upon_entry"=> true,
                        "approval_type"=>  0,
                        "registration_type"=> 1,
                        "audio"=> "both",
                        "auto_recording"=> "cloud",
                        "enforce_login"=>  false,
                        "meeting_authentication" =>false,
//                    "alternative_hosts" => $zoom_user->id,
                        "registrants_email_notification"=> true
                    ]
                ],
            ]);

            return  json_decode($response->getBody());
        }
        catch(Exception $e) {
            throw new  Exception($e->getMessage());
        }

    }
}