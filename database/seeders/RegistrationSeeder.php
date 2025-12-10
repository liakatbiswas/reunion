<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // 50 Bangladeshi names
        $bdNames = [
            'Rahim Uddin', 'Karim Ali', 'Abdul Kader', 'Hasan Mahmud', 'Rakib Hasan',
            'Sabbir Hossain', 'Nazmul Islam', 'Ariful Haque', 'Shakil Ahmed', 'Jubayer Hossain',
            'Sumaiya Akter', 'Nusrat Jahan', 'Mim Akter', 'Tanzila Haque', 'Sanjiya Sultana',
            'Fatema Tuz Johora', 'Jannatul Ferdous', 'Maliha Chowdhury', 'Priya Das', 'Rupa Khatun',
            'Mahmudul Hasan', 'Abdul Ahad', 'Ashraful Islam', 'Towhid Alam', 'Shihab Chowdhury',
            'Sharmin Akter', 'Farzana Islam', 'Sadia Tamanna', 'Mouri Akter', 'Jerin Tasnim',
            'Muktadir Rahman', 'Shahriar Kabir', 'Aminul Islam', 'Belal Hossain', 'Sajid Hossain',
            'Tahmina Sultana', 'Lamia Akter', 'Humaira Sultana', 'Anika Rahman', 'Sadia Sultana',
            'Fardin Ahmed', 'Tanvir Rahman', 'Rifat Hossain', 'Mehedi Hasan', 'Sajib Mia',
            'Yasmin Akter', 'Nadia Hasan', 'Shakera Sultana', 'Samia Rahman', 'Sumaya Binte Ali',
        ];

        // Bangladeshi mobile number prefixes
        $bdPhonePrefixes = ['017', '018', '019', '016', '015'];

        for ($i = 1; $i <= 50; $i++) {

            $name = $bdNames[$i - 1];

            // Generate BD style email
            $email = Str::slug($name).rand(10, 99).'@gmail.com';

            Registration::create([
                'name' => $name,
                'regi_id' => 'REG-'.str_pad($i, 4, '0', STR_PAD_LEFT),

                // Foreign keys
                'batch_id' => rand(1, 5),
                'division_id' => rand(1, 8),
                'district_id' => rand(1, 64),
                'upazila_id' => rand(1, 492),

                // Address
                'village' => fake()->streetName(),
                'post_office' => fake()->city(),

                // Status
                'status' => fake()->randomElement(['pending', 'active']),

                // Occupation
                'occupation' => fake()->randomElement([
                    'Student', 'Teacher', 'Farmer', 'Businessman', 'Engineer', 'Doctor',
                    'Housewife', 'Driver', 'Freelancer', 'Service Holder',
                ]),
                'user_id' => 1,

                // Phone numbers
                'phone' => $bdPhonePrefixes[array_rand($bdPhonePrefixes)].rand(10000000, 99999999),
                'bKash' => $bdPhonePrefixes[array_rand($bdPhonePrefixes)].rand(10000000, 99999999),

                // Email + Gender
                'email' => $email,
                'gender' => fake()->randomElement(['male', 'female', 'other']),

                // Money field
                'amount' => fake()->randomElement([800, 1000]),

                // Optional note
                'note' => fake()->optional()->sentence(),

                // Photo (null for now)
                'photo' => null,
            ]);
        }
    }
}
