<?php

declare(strict_types=1);

namespace App\Http\Controller;

use function App\Functions\get_file_size;
use FastVolt\Helper\Session;

class HomeController extends \FastVolt\Core\Controller 
{   
    public function index()
    {
        $this->delete_all_old_photos();

        return $this->render('frontend/homepage', [
            'page_name' => 'Image Compressor',
            'site_name' => env('app_name', 'ImageTools'),
            'flash_message' => get_flashed_message()
        ]);
    }

    public function upload_image()
    {
        if (request()->is_post_request() && request()->hasPostItems('level') && request()->hasFile('image')) {
            $validate = request()->validate([
                'image' => 'required|is_image|image:jpg,png,webp,jpeg,gif',
                'level' => 'required'
            ], [
                'image' => 'Image File is Required!',
                'image.image' => 'Sorry! Only JPEG, PNG, GIF and WebP image formats are supported.',
                'level' => 'Image Compression Level is Required!'
            ]);

            if ($validate->has_errors()) {
                return $this->handle_feedback($validate->errors());
            }

            $date = date('Y-m-d', time());
            $compress_level = request()->input('level');
            $image = request()->files('image');
            $new_image_name = 'compressed-'.uniqid().'-'.$image->getBaseName();
            $image_with_ext = $new_image_name.'.'.$image->getExtension();
            $save_image_to = resources_path('images/temps/compressed/'.$date.'/', false);

            # delete all unused photos
            $this->delete_all_reductant_photos($image_with_ext, $date);

            if (!isset($compress_level) || !is_int($compress_level)) {
                $compress_level = (int)$compress_level ?? 50;
            }

            # compress and save image to disk
            $compress = \FastVolt\Helper\Image::build($image->getTempdir());
            $compress->setQuality($compress_level);
            $compress->save($save_image_to, $new_image_name);
            //$compress->compress($compress_level, $save_image_to, $new_image_name);
            
            return $this->render_image($image_with_ext, $date);
        }
    }

    private function render_image(string $file_name, string $date)
    {
        $image_url = resources_path('images/temps/compressed/'.$date.'/') . $file_name;
        $image_size = get_file_size(
            resources_path('images/temps/compressed/'.$date.'/' . $file_name, false)
        );
        return '
        <div class="artboard-demo indicator">
            <span class="indicator-item indicator-top indicator-right badge badge-success text-white">new!</span>
            <img src="'.$image_url.'" width="350px" height="350px"  class="mb-5 max-w-sm" id="img_prev">
    
            <a class="btn btn-success mb-3" href="'.$image_url.'" download><i class="fad fa-download"></i> Download ('.$image_size.')</a>
        </div>';
    }

    private function delete_all_reductant_photos(string $new_image, string $date)
    {
        $get_photo = resources_path('images/temps/compressed/'.$date.'/', false);
        $loop = new \FilesystemIterator($get_photo);

        foreach ($loop as $file) {
            $file_name = $file->getFilename();
            if ($file_name !== $new_image) {
                unlink($get_photo.$file_name);
            }
            continue;
        }
    }

    private function delete_all_old_photos()
    {
        $get_temp_photo_dir = resources_path(full_url: false).'/images/temps/compressed/';
        $loop = new \FilesystemIterator($get_temp_photo_dir);
        $current_date = date('Y-m-d', time());

        foreach ($loop as $folder) {
            $folder_name = $folder->getBasename();

            if ($folder_name !== $current_date) {
                $folder_dir = $get_temp_photo_dir.$folder_name;

                if ($this->delete_all_folder_sub_files($folder_dir)) {
                    rmdir($folder_dir);
                }
            }
        }
    }

    private function delete_all_folder_sub_files(string $folder_dir): bool
    {
        $get_temp_photo_dir = $folder_dir;
        $loop = new \FilesystemIterator($get_temp_photo_dir);
        $result = [];

        foreach ($loop as $file) {
            $file_path = $folder_dir.'/'.$file->getFilename();
            $result[] = unlink($file_path);
            continue;
        }

        return !in_array(false, $result);
    }

    private function handle_feedback(string $message, string $type = 'warning')
    {
        flash_message($message, $type);
        return redirect(route('home'));
    }
}