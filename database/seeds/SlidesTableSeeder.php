<?php

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slide::create([
            'title' => 'Lorem ipsum dolor',
            'content' => 'Lorem ipsum dolor sit amet.',
            'button' => 'Xem thêm',
            'link' => '#',
            'image' => 'slide_1.jpg',
            'folder' => 'slides',
        ]);

        Slide::create([
            'title' => 'Lorem ipsum dolor sit',
            'content' => 'Lorem ipsum dolor sit.',
            'button' => 'Xem thêm',
            'link' => '#',
            'image' => 'slide_2.jpg',
            'folder' => 'slides',
        ]);

        Slide::create([
            'title' => 'Lorem ipsum dolor sit',
            'content' => 'Lorem ipsum dolor sit amet consectetur.',
            'button' => 'Xem thêm',
            'link' => '#',
            'image' => 'slide_3.jpg',
            'folder' => 'slides',
        ]);
    }
}
