<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            if (empty($teacher->days) || empty($teacher->periods)) {
                continue;
            }

            foreach ($teacher->days as $day) {
                foreach ($teacher->periods as $period) {
                    Schedule::create([
                        'day' => $day,
                        'grade' => $teacher->grade,
                        'period_id' => $period,
                        'subject' => $teacher->subject,
                        'teacher_id' => $teacher->id,
                        'teacher_name' => $teacher->name,
                    ]);
                }
            }
        }
    }
}