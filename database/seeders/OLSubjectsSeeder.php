<?php

namespace Database\Seeders;

use App\Models\OLSubjects;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OLSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Main Subjects
            ['code' => 'OL01', 'name' => 'Sinhala Language & Literature', 'cat' => 'Main'],
            ['code' => 'OL02', 'name' => 'Tamil Language & Literature', 'cat' => 'Main'],
            ['code' => 'OL03', 'name' => 'English Language', 'cat' => 'Main'],
            ['code' => 'OL04', 'name' => 'Mathematics', 'cat' => 'Main'],
            ['code' => 'OL05', 'name' => 'Science', 'cat' => 'Main'],
            ['code' => 'OL06', 'name' => 'History', 'cat' => 'Main'],

            // Religions
            ['code' => 'OL07', 'name' => 'Buddhism', 'cat' => 'Religion'],
            ['code' => 'OL08', 'name' => 'Hinduism', 'cat' => 'Religion'],
            ['code' => 'OL09', 'name' => 'Islam', 'cat' => 'Religion'],
            ['code' => 'OL10', 'name' => 'Catholicism', 'cat' => 'Religion'],
            ['code' => 'OL11', 'name' => 'Christianity', 'cat' => 'Religion'],

            // Basket 1
            ['code' => 'OL12', 'name' => 'Business & Accounting Studies', 'cat' => 'Basket 1'],
            ['code' => 'OL13', 'name' => 'Geography', 'cat' => 'Basket 1'],
            ['code' => 'OL14', 'name' => 'Civic Education', 'cat' => 'Basket 1'],
            ['code' => 'OL15', 'name' => 'Entrepreneurship Studies', 'cat' => 'Basket 1'],
            ['code' => 'OL16', 'name' => 'Second Language (Sinhala)', 'cat' => 'Basket 1'],
            ['code' => 'OL17', 'name' => 'Second Language (Tamil)', 'cat' => 'Basket 1'],

            // Aesthetic
            ['code' => 'OL18', 'name' => 'Eastern Music', 'cat' => 'Aesthetic'],
            ['code' => 'OL19', 'name' => 'Western Music', 'cat' => 'Aesthetic'],
            ['code' => 'OL20', 'name' => 'Carnatic Music', 'cat' => 'Aesthetic'],
            ['code' => 'OL21', 'name' => 'Art', 'cat' => 'Aesthetic'],
            ['code' => 'OL22', 'name' => 'Dancing (Oriental)', 'cat' => 'Aesthetic'],
            ['code' => 'OL23', 'name' => 'Dancing (Bharatha)', 'cat' => 'Aesthetic'],
            ['code' => 'OL24', 'name' => 'Drama and Theatre', 'cat' => 'Aesthetic'],

            // Basket 3
            ['code' => 'OL25', 'name' => 'Information & Communication Technology (ICT)', 'cat' => 'Basket 3'],
            ['code' => 'OL26', 'name' => 'Agriculture & Food Technology', 'cat' => 'Basket 3'],
            ['code' => 'OL27', 'name' => 'Health & Physical Education', 'cat' => 'Basket 3'],
            ['code' => 'OL28', 'name' => 'Home Economics', 'cat' => 'Basket 3'],
            ['code' => 'OL29', 'name' => 'Design & Construction Technology', 'cat' => 'Basket 3'],
            ['code' => 'OL30', 'name' => 'Design & Mechanical Technology', 'cat' => 'Basket 3'],
            ['code' => 'OL31', 'name' => 'Design, Electrical & Electronic Technology', 'cat' => 'Basket 3'],
            ['code' => 'OL32', 'name' => 'Communication & Media Studies', 'cat' => 'Basket 3'],
        ];

        $mediums = [
            'SI' => 'Sinhala',
            'TA' => 'Tamil',
            'EN' => 'English',
        ];

        foreach ($subjects as $subject) {
            foreach ($mediums as $prefix => $mediumName) {
                OLSubjects::create([
                    'subject_code' => $subject['code'] . '-' . $prefix,
                    'name'         => $subject['name'],
                    'medium'       => $mediumName,
                    'category'     => $subject['cat'],
                ]);
            }
        }
    }
}
