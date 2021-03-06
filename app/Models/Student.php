<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'course',
        'group_id',
        'timeslot_id'
    ];

    /**
     * Returns Collection containing all students of specified course or all if none provided.
     *
     * @param string $course Course to select students by. Selects all if none provided
     *
     * @return Collection
     */
    static function getByCourse($course = '')
    {
        if (empty($course)) return self::all();
        return self::where('course', 'LIKE', $course)->get();
    }

    /**
     * Returns Collection containing all students of specified attendance or all if none provided.
     *
     * @param string $attendance Attendance to select students by. Selects all if none provided
     *
     * @return Collection
     */
    static function getByAttendance($attendance = '')
    {
        if (empty($attendance)) return self::all();
        return self::where('attended', '=', $attendance)->get();
    }

    /**
     * Returns Collection containing all students of specified timeslot or all if none provided.
     *
     * @param string $timeslotId Timeslot to select students by. Selects all if none provided
     *
     * @return Collection
     */
    static function getByTimeslot($timeslotId = '')
    {
        if (empty($timeslotId)) return self::all();
        return self::where('timeslot_id', 'LIKE', $timeslotId)->get();
    }

    /**
     * Returns Collection containing all students of specified timeslot and course by first
     * selecting for timeslot and then selecting that result for the course.
     *
     * @param string $timeslotId Timeslot to select students by. Selects all if none provided
     * @param string $course Course to select students by. Selects all of previous result if none provided
     *
     * @return Collection
     */
    static function getByTimeslotAndCourse($timeslotId = '', $course = '')
    {
        $res = null;
        if (empty($timeslotId)) $res = self::all();
        else $res = self::where('timeslot_id', 'LIKE', $timeslotId);
        if (empty($course))  return $res->get();
        return $res->where('course', 'LIKE', $course)->get();
    }

    /**
     * Returns Collection containing all students of specified group or all unassigned if none provided.
     *
     * @param string $groupId Group to select students by. Selects all unassigned if none provided
     *
     * @return Collection
     */
    static function getByGroup($groupId = '')
    {
        if (empty($groupId)) return self::where('group_id', null)->get();
        return self::where('group_id', 'LIKE', $groupId)->get();
    }

    /**
     * Returns Collection containing all students of specified group and course by first
     * selecting for group and then selecting that result for the course.
     *
     * @param string $groupId Group to select students by. Selects all unassigned if none provided
     * @param string $course Course to select students by. Selects all of previous result if none provided
     *
     * @return Collection
     */
    static function getByGroupAndCourse($groupId = '', $course = '')
    {
        $res = null;
        if (empty($groupId)) $res = self::where('group_id', null);
        else $res = self::where('group_id', 'LIKE', $groupId);
        if (empty($course))  return $res->get();
        return $res->where('course', 'LIKE', $course)->get();
    }

    /**
     * Get the group from the student.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
