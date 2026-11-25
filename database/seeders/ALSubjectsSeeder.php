<?php

namespace Database\Seeders;

use App\Models\ALSubjects;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ALSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        $alSubjects = [
            // Science & Maths
            ['code' => 'AL01', 'name' => 'Combined Mathematics', 'cat' => 'Science'],
            ['code' => 'AL02', 'name' => 'Physics', 'cat' => 'Science'],
            ['code' => 'AL03', 'name' => 'Chemistry', 'cat' => 'Science'],
            ['code' => 'AL04', 'name' => 'Biology', 'cat' => 'Science'],
            ['code' => 'AL05', 'name' => 'Agricultural Science', 'cat' => 'Science'],

            // Commerce
            ['code' => 'AL06', 'name' => 'Accounting', 'cat' => 'Commerce'],
            ['code' => 'AL07', 'name' => 'Business Studies', 'cat' => 'Commerce'],
            ['code' => 'AL08', 'name' => 'Economics', 'cat' => 'Commerce'],
            ['code' => 'AL09', 'name' => 'Business Statistics', 'cat' => 'Commerce'],

            // Technology
            ['code' => 'AL10', 'name' => 'Engineering Technology (ET)', 'cat' => 'Technology'],
            ['code' => 'AL11', 'name' => 'Bio-Systems Technology (BST)', 'cat' => 'Technology'],
            ['code' => 'AL12', 'name' => 'Science for Technology (SFT)', 'cat' => 'Technology'],
            ['code' => 'AL13', 'name' => 'Information & Communication Technology (ICT)', 'cat' => 'Technology / Common'],

            // Arts
            ['code' => 'AL14', 'name' => 'Sinhala', 'cat' => 'Arts'],
            ['code' => 'AL15', 'name' => 'Tamil', 'cat' => 'Arts'],
            ['code' => 'AL16', 'name' => 'English', 'cat' => 'Arts'],
            ['code' => 'AL17', 'name' => 'Political Science', 'cat' => 'Arts'],
            ['code' => 'AL18', 'name' => 'Geography', 'cat' => 'Arts'],
            ['code' => 'AL19', 'name' => 'History', 'cat' => 'Arts'],
            ['code' => 'AL20', 'name' => 'Logic & Scientific Method', 'cat' => 'Arts'],
            ['code' => 'AL21', 'name' => 'Communication & Media Studies', 'cat' => 'Arts'],
            ['code' => 'AL22', 'name' => 'Buddhist Civilization', 'cat' => 'Arts'],
            ['code' => 'AL23', 'name' => 'Hindu Civilization', 'cat' => 'Arts'],
            ['code' => 'AL24', 'name' => 'Islamic Civilization', 'cat' => 'Arts'],
            ['code' => 'AL25', 'name' => 'Christian Civilization', 'cat' => 'Arts'],
            ['code' => 'AL26', 'name' => 'Home Economics', 'cat' => 'Arts'],
            ['code' => 'AL27', 'name' => 'Art', 'cat' => 'Arts'],
            ['code' => 'AL28', 'name' => 'Dancing (Indigenous / Bharatha)', 'cat' => 'Arts'],
            ['code' => 'AL29', 'name' => 'Music (Oriental / Western / Carnatic)', 'cat' => 'Arts'],
            ['code' => 'AL30', 'name' => 'Drama and Theatre', 'cat' => 'Arts'],

            // Common
            ['code' => 'AL31', 'name' => 'General English', 'cat' => 'Common'],
            ['code' => 'AL32', 'name' => 'Common General Test', 'cat' => 'Common'],
        ];

        $mediums = [
            'SI' => 'Sinhala',
            'TA' => 'Tamil',
            'EN' => 'English',
        ];

        foreach ($alSubjects as $subject) {
            foreach ($mediums as $prefix => $mediumName) {
                ALSubjects::create([
                    'subject_code' => $subject['code'] . '-' . $prefix,
                    'name'         => $subject['name'],
                    'medium'       => $mediumName,
                    'category'     => $subject['cat'],
                ]);
            }
        }
    }
}
