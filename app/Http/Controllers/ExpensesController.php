<?php

    namespace App\Http\Controllers;

    use App\Models\Expense;
    use App\Traits\ApiResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class ExpensesController extends Controller
    {
        use ApiResponse;

        public function index()
        {
            return $this -> response(true, 'success', data : Expense ::all());
        }

        public function store(Request $request)
        {
            info($request -> all());
            $validator = Validator ::make(
                $request -> all(),
                ['name' => 'required']
            );
        }

        public function show(string $id)
        {
            //
        }

        public function update(Request $request, string $id)
        {
            //
        }

        public function destroy(string $id)
        {
            //
        }
    }
