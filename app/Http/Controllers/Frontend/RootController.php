<?php

    namespace App\Http\Controllers\Frontend;


    use App\Http\Controllers\Controller;
    use App\Models\ThemeSetting;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;

    class RootController extends Controller
    {
        public function index() : Factory | View | Application
        {
            $themeFavicon = ThemeSetting ::where(['key' => 'theme_favicon_logo']) -> first();
            $favIcon      = $themeFavicon -> faviconLogo;
            return view('master', ['favicon' => $favIcon]);
        }
    }
