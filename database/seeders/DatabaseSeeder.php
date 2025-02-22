<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);

        // =============Seed Dummy Data================
        // \App\Models\Author::factory(10)->create();
        // \App\Models\Publisher::factory(10)->create();
        // \App\Models\PublicationType::factory(10)->create();
        // \App\Models\Language::factory(2)->create();
        // \App\Models\Location::factory(10)->create();
        // \App\Models\PublicationCategory::factory(10)->create();
        // \App\Models\PublicationSubCategory::factory(10)->create();
        // \App\Models\Keyword::factory(10)->create();
        // \App\Models\Publication::factory(20)->create();

        // \App\Models\VideoType::factory(3)->create();
        // \App\Models\VideoCategory::factory(10)->create();
        // \App\Models\VideoSubCategory::factory(10)->create();
        // \App\Models\Video::factory(10)->create();

        // \App\Models\ImageCategory::factory(8)->create();
        // \App\Models\ImageSubCategory::factory(10)->create();
        // \App\Models\ImageType::factory(3)->create();
        // \App\Models\Image::factory(10)->create();

        // \App\Models\NewsCategory::factory(8)->create();
        // \App\Models\NewsSubCategory::factory(10)->create();
        // \App\Models\NewsType::factory(3)->create();
        // \App\Models\News::factory(10)->create();

        // \App\Models\AudioType::factory(3)->create();
        // \App\Models\AudioCategory::factory(8)->create();
        // \App\Models\AudioSubCategory::factory(10)->create();
        // \App\Models\Audio::factory(10)->create();

        // \App\Models\Menu::factory(3)->create();
        // \App\Models\Footer::factory(1)->create();
        // \App\Models\Link::factory(3)->create();
        // \App\Models\Database::factory(1)->create();
        // \App\Models\WebsiteInfo::factory(1)->create();

        // \App\Models\ThesisType::factory(3)->create();
        // \App\Models\Lecturer::factory(5)->create();
        // \App\Models\Supervisor::factory(5)->create();
        // \App\Models\Major::factory(3)->create();
        // \App\Models\Student::factory(5)->create();
        // \App\Models\ThesisCategory::factory(5)->create();

        // \App\Models\JournalType::factory(3)->create();
        \App\Models\JournalCategory::factory(4)->create();


    }
}
