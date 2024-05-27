<?php

    namespace App\Traits;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;

    trait FilesTrait
    {
        public function saveFiles(Request $request, Model $model, $files) : bool
        {
            $files_saved_successfully = false;
            foreach ($files as $file => $type) {
                try {
                    if ($request -> hasFile("$file")) {
                        $mediaPath    = $type . '_' . $model -> id . '_' . time() . '.' . $request -> file("$file") -> extension();
                        $relativePath = 'public/attachments';
                        $basePath     = '/' . $relativePath;
                        $request -> file($file) -> storeAs($basePath, $mediaPath);
                        $model ->{$type} = $relativePath . '/' . $mediaPath;
                        $model -> save();
                        $files_saved_successfully = true;
                    } else {
                        info('no file');
                    }
                } catch (\Exception $e) {
                    $files_saved_successfully = false;
                }
            }
            return $files_saved_successfully;
        }
    }