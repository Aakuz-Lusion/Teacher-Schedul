<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\Schedule;

class ScheduleGenerator
{
    protected $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    protected $periods = [1, 2, 4, 5, 7, 8, 10];
    protected $grades = [
        'Grade 1-A', 'Grade 1-B',
        'Grade 2-A', 'Grade 2-B',
        'Grade 3-A', 'Grade 3-B',
        'Grade 4-A', 'Grade 4-B',
        'Grade 5-A', 'Grade 5-B'
    ];

    public function generate()
{
    Schedule::truncate();

    $teachers = Teacher::where('is_available', 1)->get();

    if ($teachers->isEmpty()) {
        return ['total' => 0, 'errors' => ['No available teachers found']];
    }

    $totalSchedules = 0;
    $errors = [];

    foreach ($this->grades as $grade) {
        $gradeTeachers = $teachers->filter(function($teacher) use ($grade) {
            $grades = $this->decodeJson($teacher->grades);
            return in_array($grade, $grades);
        });

        if ($gradeTeachers->isEmpty()) {
            $errors[] = "No teachers found for {$grade}";
            continue;
        }

        foreach ($this->days as $day) {
            $availableTeachers = $gradeTeachers->filter(function($teacher) use ($day) {
                $days = $this->decodeJson($teacher->days);
                return in_array($day, $days);
            });

            $assignedTeachers = [];

            foreach ($this->periods as $period) {
                $teacher = $this->findTeacherForPeriod(
                    $availableTeachers,
                    $period,
                    $assignedTeachers
                );

                if ($teacher) {
                    Schedule::create([
                        'day' => $day,
                        'grade' => $grade,
                        'period_id' => $period,
                        'subject' => $teacher->subject,
                        'teacher_id' => $teacher->id,
                        'teacher_name' => $teacher->name,
                    ]);
                    
                    $assignedTeachers[$teacher->id] = ($assignedTeachers[$teacher->id] ?? 0) + 1;
                    $totalSchedules++;
                } else {
                    Schedule::create([
                        'day' => $day,
                        'grade' => $grade,
                        'period_id' => $period,
                        'subject' => 'unassigned',
                        'teacher_id' => null,
                        'teacher_name' => '—',
                    ]);
                }
            }
        }
    }

    return [
        'total' => $totalSchedules,
        'errors' => $errors
    ];
}

    protected function findTeacherForPeriod($teachers, $period, $assigned)
    {
        $priorityOrder = ['high', 'medium', 'low'];
        
        $available = $teachers->filter(function($teacher) use ($period) {
            $periods = $this->decodeJson($teacher->periods);
            return in_array($period, $periods);
        });

        if ($available->isEmpty()) {
            return null;
        }

        $sorted = $available->sortBy(function($teacher) use ($priorityOrder) {
            return array_search($teacher->priority, $priorityOrder);
        });

        foreach ($sorted as $teacher) {
            $assignedCount = $assigned[$teacher->id] ?? 0;
            if ($assignedCount < 4) {
                return $teacher;
            }
        }

        return $sorted->first();
    }

    protected function decodeJson($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            
            $decoded = json_decode(stripslashes($value), true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }
        
        return [];
    }

    public function generateForGrade($grade)
    {
        Schedule::where('grade', $grade)->delete();

        $teachers = Teacher::where('is_available', 1)
            ->where('grade', $grade)
            ->get();

        if ($teachers->isEmpty()) {
            return ['total' => 0, 'errors' => ["No teachers found for {$grade}"]];
        }

        $totalSchedules = 0;

        foreach ($this->days as $day) {
            $availableTeachers = $teachers->filter(function($teacher) use ($day) {
                $days = $this->decodeJson($teacher->days);
                return in_array($day, $days);
            });

            $assignedTeachers = [];

            foreach ($this->periods as $period) {
                $teacher = $this->findTeacherForPeriod(
                    $availableTeachers,
                    $period,
                    $assignedTeachers
                );

                if ($teacher) {
                    Schedule::create([
                        'day' => $day,
                        'grade' => $grade,
                        'period_id' => $period,
                        'subject' => $teacher->subject,
                        'teacher_id' => $teacher->id,
                        'teacher_name' => $teacher->name,
                    ]);
                    
                    $assignedTeachers[$teacher->id] = ($assignedTeachers[$teacher->id] ?? 0) + 1;
                    $totalSchedules++;
                } else {
                    Schedule::create([
                        'day' => $day,
                        'grade' => $grade,
                        'period_id' => $period,
                        'subject' => 'unassigned',
                        'teacher_id' => null,
                        'teacher_name' => '—',
                    ]);
                }
            }
        }

        return ['total' => $totalSchedules, 'errors' => []];
    }
}