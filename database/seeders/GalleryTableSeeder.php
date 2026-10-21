<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Register the images that already sit in
     * public/assets/backend/images/gallery_images so the gallery page
     * can render them.
     *
     * Matches GalleryController: file_path is the web path to the image and
     * file_name is the file on disk. The path is stored root-relative so it
     * stays valid whichever host the site is served from.
     *
     * @return void
     */
    public function run()
    {
        $directory = public_path('assets/backend/images/gallery_images');

        if (!is_dir($directory)) {
            $this->command->warn('Gallery image directory not found: ' . $directory);
            return;
        }

        // The gallery page filters by category, so every image needs one.
        $category = GalleryCategory::firstOrCreate(['category' => 'General']);

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
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

            $path = '/assets/backend/images/gallery_images/' . $file;

            if (Gallery::where('file_path', $path)->exists()) {
                $skipped++;
                continue;
            }

            Gallery::create([
                'category_id' => $category->id,
                'file_name'   => $file,
                'file_path'   => $path,
            ]);

            $created++;
        }

        $this->command->info("Gallery images seeded: {$created} created, {$skipped} already present.");
        $this->command->info("Category used: '{$category->category}' (id {$category->id}).");
    }
}
