<?php

    namespace App\Http\Controllers\Admin;


    use App\Http\Requests\PaginateRequest;
    use App\Http\Resources\MenuSectionResource;
    use App\Services\MenuSectionService;
    use Exception;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\Routing\ResponseFactory;
    use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
    use Illuminate\Http\Response;

    class MenuSectionController extends AdminController
    {

        private MenuSectionService $menuSectionService;

        public function __construct(MenuSectionService $menuSection)
        {
            parent ::__construct();
            $this -> menuSectionService = $menuSection;
        }

        public function index(PaginateRequest $request
        ) : Response | AnonymousResourceCollection | Application | ResponseFactory {
            try {
                return MenuSectionResource ::collection($this -> menuSectionService -> list($request));
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }
    }
