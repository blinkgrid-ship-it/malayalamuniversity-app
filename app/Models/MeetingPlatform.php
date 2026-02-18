<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingPlatform extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'type',
        'account_id',
        'created_by',
        'key',
        'secret',
        'token',
        'calender_id',
        'timezone',
        'address',
        'host_video',
        'participant_video',
        'waiting_room',
        'status',
    ];
public static function createDefaultForUniversity($universityId)
{
    self::insert([
        [
            'name' => 'In person',
            'image' => 'assets/images/icon/in-person.png',
            'type' => MEETING_PLATFORMS_PERSON,
            'university_id' => $universityId,
            'status' => STATUS_ACTIVE,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Zoom',
            'image' => 'assets/images/icon/zoom.png',
            'type' => MEETING_PLATFORMS_ZOOM,
            'university_id' => $universityId,
            'status' => STATUS_DEACTIVATE,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Google Meet',
            'image' => 'assets/images/icon/google-meet.png',
            'type' => MEETING_PLATFORMS_MEET,
            'university_id' => $universityId,
            'status' => STATUS_DEACTIVATE,
            'created_at' => now(),
            'updated_at' => now()
        ],
    ]);
}


}
