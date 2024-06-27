<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Resources\CustomerStatesResource;
    use App\Http\Resources\OrderStatisticsResource;
    use App\Http\Resources\SalesSummaryResource;
    use App\Http\Resources\SimpleProductResource;
    use App\Libraries\AppLibrary;
    use App\Models\Expense;
    use App\Services\DashboardService;
    use App\Services\ProductService;
    use App\Traits\ApiResponse;
    use App\Traits\AuthUser;
    use Exception;
    use Illuminate\Http\Request;

    class DashboardController extends AdminController
    {
        use AuthUser, ApiResponse;

        private DashboardService $dashboardService;
        private ProductService   $productService;

        public function __construct(DashboardService $dashboardService, ProductService $productService)
        {
            parent ::__construct();
            $this -> dashboardService = $dashboardService;
            $this -> productService   = $productService;
            $this -> middleware(['permission:dashboard']) -> only(
                'orderStatistics',
                'orderSummary',
                'featuredItems',
                'topCustomers',
                'totalSales',
                'salesSummary',
                'customerStates',
                'totalOrders',
                'totalCustomers',
                'totalProducts',
                'creditSales',
                'depositSales',
                'inStock',
                'outStock',
                'grossProfit',
                'netProfit',
                'stockValue',
                'vendorBalance',
            );
        }

        public function grossProfit(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['gross_profit' => AppLibrary ::currencyAmountFormat($this -> dashboardService -> grossProfit($request))]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function netProfit(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['net_profit' => AppLibrary ::currencyAmountFormat($this -> dashboardService -> netProfit($request))]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function stockValue(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['stock_value' => AppLibrary ::currencyAmountFormat($this -> dashboardService -> stockValue($request))]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function vendorBalance(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['vendor_balance' => AppLibrary ::currencyAmountFormat($this -> dashboardService -> vendorBalance($request))]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function totalSales(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['total_sales' => AppLibrary ::currencyAmountFormat($this -> dashboardService -> totalSales($request))]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function totalExpenses()
        {
            $total = Expense ::where('user_id', $this -> id()) -> sum('amount');
            return $this -> response(true, 'success', data : ['totalExpense' => number_format($total)]);
        }

        public function pendingExpenses()
        {
            $total = Expense ::where('user_id', $this -> id())
                             -> selectRaw('SUM(amount - paid) as total')
                             -> value('total');
            return $this -> response(true, 'success', data : ['pendingExpense' => number_format($total)]);
        }

        public function totalOrders(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['total_orders' => $this -> dashboardService -> totalOrders($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function totalCustomers(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['total_customers' => $this -> dashboardService -> totalCustomers($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function totalProducts(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['total_products' => $this -> dashboardService -> totalProducts($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function salesSummary(
            Request $request
        ) : \Illuminate\Http\Response | SalesSummaryResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return new SalesSummaryResource($this -> dashboardService -> salesSummary($request));
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function customerStates(
            Request $request
        ) : \Illuminate\Http\Response | CustomerStatesResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return new CustomerStatesResource($this -> dashboardService -> customerStates($request));
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function topProducts(
        ) : \Illuminate\Http\Response | \Illuminate\Http\Resources\Json\AnonymousResourceCollection | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
        {
            try {
                return SimpleProductResource ::collection($this -> productService -> topProducts());
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function creditSales(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['credit_sales' => $this -> dashboardService -> creditSales($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function depositSales(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['deposit_sales' => $this -> dashboardService -> depositSales($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function inStock(Request $request) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
        {
            try {
                return ['data' => ['in_stock' => $this -> dashboardService -> inStock($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }

        public function outStock(Request $request
        ) : \Illuminate\Http\Response | array | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
            try {
                return ['data' => ['out_stock' => $this -> dashboardService -> outStock($request)]];
            } catch (Exception $exception) {
                return response(['status' => false, 'message' => $exception -> getMessage()], 422);
            }
        }
    }