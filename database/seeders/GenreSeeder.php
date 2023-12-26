<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'Comedy',
            'description' => 'komedi adalah genre seni yang berasal dari Yunani Kuno dan bertujuan untuk menghibur, menimbulkan tawa, terutama di televisi, film, dan lawakan'
        ]);

        Genre::create([
            'name' => 'Children\'s',
            'description' => 'Genre film anak-anak, atau film keluarga, mencakup berbagai genre utama seperti realisme, fantasi, petualangan, perang, musikal, komedi, dan adaptasi sastra'
        ]);

        Genre::create([
            'name' => 'Romance',
            'description' => 'Genre romance, atau cinta, adalah salah satu genre cerita non fiksi yang berfokus pada kisah kebahagiaan atau kisah asmara seorang pria dan wanita'
        ]);

        Genre::create([
            'name' => 'Slice of Life',
            'description' => 'Genre "slice of life" (potongan kehidupan) adalah salah satu genre dalam dunia seni, terutama dalam film, sastra, dan anime'
        ]);
    }
}
