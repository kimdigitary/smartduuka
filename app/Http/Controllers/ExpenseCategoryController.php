<?php

    namespace App\Http\Controllers;

    use App\Models\ExpenseCategory;
    use App\Traits\ApiResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class ExpenseCategoryController extends Controller
    {
        use ApiResponse;

        public function index()
        {
            return $this -> response(true, 'success', data : ExpenseCategory ::all());
        }

        public function store(Request $request)
        {
            $validator = Validator ::make($request -> all(), ['name' => 'required', 'user_id' => 'required|integer']);
            if ($validator -> fails()) {
                return $this -> response(message : $validator -> errors() -> first());
            }
            $expense_category = ExpenseCategory ::create($validator -> validated());
            return $this -> response(success : true, message : 'success', data : $expense_category);
        }

        public function show(ExpenseCategory $expenseCategory)
        {
            //
        }

        public function update(Request $request, ExpenseCategory $expenseCategory)
        {
            $validation = Validator ::make($request -> all(), ['name' => 'required']);
            if ($validation -> fails()) {
                return $this -> response(message : $validation -> errors() -> first());
            }
            $updated = $expenseCategory -> update($validation -> validated());
            if ($updated) {
                return $this -> response(success : true, message : 'success', data : $updated);
            } else {
                return $this -> response(message : 'Updated failed');
            }
        }

        public function destroy(ExpenseCategory $expenseCategory)
        {
            $deleted = $expenseCategory -> delete();
            if ($deleted) {
                return $this -> response(success : true, message : 'success', data : $deleted);
            } else {
                return $this -> response(message : 'failed');
            }
        }
    }
