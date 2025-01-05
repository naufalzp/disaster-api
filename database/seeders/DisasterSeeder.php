<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a disaster (tanah longsor semua, untuk user 1 dan 2 saja)
        $disasters = [
            [
                'location' => 'Bogor',
                'description' => 'Tanah longsor menutupi jalan raya Bogor',
                'severity' => 'low',
                'time' => '12:00:00',
                'date' => '2025-01-05',
                'created_by' => 1,
            ],
            [
                'location' => 'Semarang',
                'description' => 'Tanah longsor menghancurkan rumah warga',
                'severity' => 'high',
                'time' => '22:00:00',
                'date' => '2025-01-12',
                'created_by' => 2,
            ],
            // lagi dengan kontenks deskripsi yang berbeda dan jam hari berbeda dan tingkatnya berbeda
            [
                'location' => 'Jakarta',
                'description' => 'Tanah longsor menghancurkan jalan pemukiman',
                'severity' => 'medium',
                'time' => '08:00:00',
                'date' => '2025-01-10',
                'created_by' => 1,
            ],
            [
                'location' => 'Bandung',
                'description' => 'Tanah longsor menghancurkan jembatan',
                'severity' => 'high',
                'time' => '18:00:00',
                'date' => '2025-01-15',
                'created_by' => 2,
            ],
        ];

        foreach ($disasters as $disaster) {
            \App\Models\Disaster::create($disaster);
        }
    }
}
