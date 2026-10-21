<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Register the slider images that already sit in
     * public/assets/backend/images/slider_images so the home page banner
     * can render them.
     *
     * Matches SliderController@store: image_path is the file on disk,
     * image_name is the original upload name.
     *
     * @return void
     */
    public function run()
    {
        $directory = public_path('assets/backend/images/slider_images');

        if (!is_dir($directory)) {
            $this->command->warn('Slider image directory not found: ' . $directory);
            return;
        }

        $allowed = ['jpg', 'jpeg', 'png'];
        $created = 0;
        $skipped = 0;

        foreach (scandir($directory) as $file) {
            if ($file === '.' || $file === '..' || is_dir($directory . DIRECTORY_SEPARATOR . $file)) {
                continue;
            }

            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {
                continue;
            }

            if (Slider::where('image_path', $file)->exists()) {
                $skipped++;
                continue;
            }

            $base = pathinfo($file, PATHINFO_FILENAME);

            // SliderController appends _<unix timestamp> to the uploaded name.
            $original = preg_replace('/_\d{9,}$/', '', $base);

            Slider::create([
                'title'      => str_replace(['_', '-'], ' ', $original),
                'image_name' => $original . '.' . $extension,
                'image_path' => $file,
            ]);

            $created++;
        }

        $this->command->info("Sliders seeded: {$created} created, {$skipped} already present.");
    }
}
