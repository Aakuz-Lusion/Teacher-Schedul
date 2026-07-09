<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Mr. Sharma',
                'email' => 'sharma@school.com',
                'password' => Hash::make('password'),
                'subject' => 'math',
                'grades' => ['Grade 5-A', 'Grade 4-A'],
                'priority' => 'high',
                'days' => json_encode(['Sunday', 'Monday', 'Wednesday', 'Thursday']),
                'periods' => json_encode([1, 2, 4, 5])
            ],
            [
                'name' => 'Ms. Gurung',
                'email' => 'gurung@school.com',
                'password' => Hash::make('password'),
                'subject' => 'english',
                'grades' => ['Grade 5-A', 'Grade 4-B'],
                'priority' => 'high',
                'days' => json_encode(['Sunday', 'Tuesday', 'Wednesday', 'Friday']),
                'periods' => json_encode([1, 3, 4, 7])
            ],
            [
                'name' => 'Mr. Thapa',
                'email' => 'thapa@school.com',
                'password' => Hash::make('password'),
                'subject' => 'science',
                'grades' => ['Grade 5-B', 'Grade 4-A'],
                'priority' => 'medium',
                'days' => json_encode(['Monday', 'Tuesday', 'Thursday', 'Friday']),
                'periods' => json_encode([2, 3, 5, 6])
            ],
            [
                'name' => 'Ms. Adhikari',
                'email' => 'adhikari@school.com',
                'password' => Hash::make('password'),
                'subject' => 'nepali',
                'grades' => ['Grade 5-B', 'Grade 4-B'],
                'priority' => 'medium',
                'days' => json_encode(['Sunday', 'Monday', 'Wednesday', 'Friday']),
                'periods' => json_encode([1, 2, 6, 7])
            ],
            [
                'name' => 'Mr. Poudel',
                'email' => 'poudel@school.com',
                'password' => Hash::make('password'),
                'subject' => 'social',
                'grades' => ['Grade 3-A', 'Grade 2-A'],
                'priority' => 'low',
                'days' => json_encode(['Tuesday', 'Wednesday', 'Thursday', 'Friday']),
                'periods' => json_encode([3, 4, 5, 7])
            ],
            [
                'name' => 'Ms. Rai',
                'email' => 'rai@school.com',
                'password' => Hash::make('password'),
                'subject' => 'science',
                'grades' => ['Grade 3-B', 'Grade 2-B'],
                'priority' => 'medium',
                'days' => json_encode(['Sunday', 'Monday', 'Thursday', 'Friday']),
                'periods' => json_encode([1, 2, 4, 6])
            ],
            [
                'name' => 'Mr. Karki',
                'email' => 'karki@school.com',
                'password' => Hash::make('password'),
                'subject' => 'english',
                'grades' => ['Grade 2-A', 'Grade 1-A'],
                'priority' => 'high',
                'days' => json_encode(['Sunday', 'Tuesday', 'Wednesday', 'Thursday']),
                'periods' => json_encode([2, 3, 5, 7])
            ],
            [
                'name' => 'Ms. Tamang',
                'email' => 'tamang@school.com',
                'password' => Hash::make('password'),
                'subject' => 'math',
                'grades' => ['Grade 2-B', 'Grade 1-B'],
                'priority' => 'medium',
                'days' => json_encode(['Monday', 'Wednesday', 'Thursday', 'Friday']),
                'periods' => json_encode([1, 3, 4, 6])
            ],
            [
                'name' => 'Mr. Sherpa',
                'email' => 'sherpa@school.com',
                'password' => Hash::make('password'),
                'subject' => 'social',
                'grades' => ['Grade 3-B', 'Grade 2-B'],
                'priority' => 'low',
                'days' => json_encode(['Sunday', 'Tuesday', 'Thursday', 'Friday']),
                'periods' => json_encode([1, 2, 5, 7])
            ],
            [
                'name' => 'Ms. Limbu',
                'email' => 'limbu@school.com',
                'password' => Hash::make('password'),
                'subject' => 'nepali',
                'grades' => ['Grade 1-A', 'Grade 1-B'],
                'priority' => 'medium',
                'days' => json_encode(['Sunday', 'Monday', 'Tuesday', 'Wednesday']),
                'periods' => json_encode([2, 4, 5, 6])
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }

        $this->command->info( . count($teachers) . ' teachers seeded successfully!');
    }
}