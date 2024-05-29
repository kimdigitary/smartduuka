<template>
    <LoadingComponent :props="loading" />
    <div class="mb-3">
        <div class="flex items-center justify-between gap-3 mb-4">
            <h4 class="font-semibold text-xl mb-3 capitalize text-heading">{{ $t("menu.overview") }}</h4>
            <div class="relative cursor-pointer">
                <DatePickerComponent @update:modelValue="handleDate" inputStyle="box" />
            </div>
        </div>
        <div class="row">
            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-pink p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-dollar-circle text-admin-pink text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">{{ $t('label.total_earnings') }}
                        </h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ total_sales }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-purple p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-line-items text-admin-blue text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">Total Expenses</h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">UGX {{ total_expenses }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-blue p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-document text-admin-blue text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">Gross Profit
                        </h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ gross_profit }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-blue p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-document text-admin-blue text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">Net Profit
                        </h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ net_profit }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-orange p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-box text-admin-orange text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">{{ $t('label.total_orders') }}</h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ total_orders }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-purple p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-users text-admin-purple text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">{{ $t('label.total_customers') }}
                        </h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ total_customers }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-orange p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-box text-admin-orange text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">Stock Value</h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ stock_value }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 sm:col-6 xl:col-3">
                <div class="bg-admin-purple p-4 rounded-lg flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white">
                        <i class="lab-fill-users text-admin-purple text-2xl lab-font-size-24"></i>
                    </div>
                    <div>
                        <h3 class="font-medium tracking-wide capitalize text-white">Vendor Balance
                        </h3>
                        <h4 class="font-semibold text-[22px] leading-[34px] text-white">{{ vendor_balance }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-8">
            <div class="col-12 sm:col-6 xl:col-4">

                <div class="bg-admin-light p-4 rounded-lg flex gap-4">
                    <div>
                        <h3 class="font-medium tracking-wide uppercase text-secondary">Credit Orders</h3>
                        <hr class="dashed-hr">
                        <ul class="flex flex-col gap-1.5 mb-4">
                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Total Orders</span><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ credit_sales ? credit_sales.total_orders : 'N/A' }}</span></li>
                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Credit Sales</span><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ credit_sales ? credit_sales.total_credit_sales : 'N/A' }}</span></li>
                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Credit Paid</span><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ credit_sales ? credit_sales.credit_paid : 'N/A' }}</span></li>
                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium font-client capitalize leading-6 text-[#2E2F38]">Credit Balance</span><span
                                    class="text-sm font-medium font-client capitalize leading-6 text-[#2E2F38]">{{ credit_sales ? credit_sales.credit_balance : 'N/A' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 sm:col-6 xl:col-4">
                <div class="bg-admin-light p-4 rounded-lg flex gap-4">
                    <div>
                        <h3 class="font-medium tracking-wide uppercase text-secondary">Deposit Orders</h3>
                        <hr class="dashed-hr">
                        <ul class="flex flex-col gap-1.5 mb-4">
                            <li class="flex items-center justify-between">
                                <span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Total
                                    Orders</span>
                                <span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ deposit_sales ?
        deposit_sales.total_orders : 'N/A' }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Deposit
                                    Sales</span>
                                <span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ deposit_sales ?
        deposit_sales.total_deposit_sales : 'N/A' }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Deposit
                                    Paid</span>
                                <span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ deposit_sales ?
        deposit_sales.deposit_paid : 'N/A' }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span
                                    class="text-sm font-medium font-client capitalize leading-6 text-[#2E2F38]">Deposit
                                    Balance</span>
                                <span class="text-sm font-medium font-client capitalize leading-6 text-[#2E2F38]">{{
                                    deposit_sales ? deposit_sales.deposit_balance : 'N/A' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 sm:col-6 xl:col-4">
                <div class="bg-admin-light p-4 rounded-lg flex gap-4">
                    <div>
                        <h3 class="font-medium tracking-wide uppercase text-secondary">Stock</h3>
                        <hr class="dashed-hr">
                        <ul class="flex flex-col gap-1.5 mb-4">

                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">In Stock</span><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{ in_stock
                                    }}</span></li>
                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">Out of
                                    Stock</span><span class="text-sm font-medium capitalize leading-6 text-[#2E2F38]">{{
                                    out_stock }}</span></li>
                            <li class="flex items-center justify-between"><span
                                    class="text-sm font-medium font-client capitalize leading-6 text-[#2E2F38]">Total
                                    Products</span><span
                                    class="text-sm font-medium font-client capitalize leading-6 text-[#2E2F38]">{{
                                    total_products }}</span>
                            </li>
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoadingComponent from "../components/LoadingComponent";
import DatePickerComponent from "../components/DatePickerComponent";

export default {
    name: "OverviewComponent",
    components: { LoadingComponent, DatePickerComponent },
    data() {
        return {
            loading: {
                isActive: false,
            },
            first_date: null,
            last_date: null,
            total_sales: null,
            total_orders: null,
            total_customers: null,
            total_products: null,
            credit_sales: null,
            deposit_sales: null,
            in_stock: null,
            out_stock: null,
            total_expenses: null,
            stock_value: null,
            vendor_balance: null,
            gross_profit: null,
            net_profit: null,
        };
    },
    mounted() {
        this.handleDate();
        this.totalSales();
        this.totalOrders();
        this.totalCustomers();
        this.totalProducts();
        this.depositSales();
        this.creditSales();
        this.inStock();
        this.outStock();
        this.totalExpenses();
        this.stockValue();
        this.vendorBalance();
        this.grossProfit();
        this.netProfit();
    },
    methods: {
        handleDate: function (e) {
            if (e) {
                this.first_date = e[0];
                this.last_date = e[1];

                this.totalSales();
                this.totalOrders();
                this.totalCustomers();
                this.totalProducts();
                this.depositSales();
                this.creditSales();
                this.inStock();
                this.outStock();
                this.stockValue();
                this.vendorBalance();
                this.grossProfit();
                this.netProfit();
            } else {
                this.first_date = null;
                this.last_date = null;
                this.totalSales();
                this.totalOrders();
                this.totalCustomers();
                this.totalProducts();
                this.depositSales();
                this.creditSales();
                this.inStock();
                this.outStock();
                this.stockValue();
                this.vendorBalance();
                this.grossProfit();
                this.netProfit();
            }
        },
        totalSales: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/totalSales", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.total_sales = res.data.data.total_sales;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },

        totalOrders: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/totalOrders", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.total_orders = res.data.data.total_orders;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        totalCustomers: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/totalCustomers", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.total_customers = res.data.data.total_customers;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        totalProducts: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/totalProducts", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.total_products = res.data.data.total_products;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        creditSales: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/creditSales", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.credit_sales = res.data.data.credit_sales;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        depositSales: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/depositSales", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.deposit_sales = res.data.data.deposit_sales;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        outStock: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/outStock", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.out_stock = res.data.data.out_stock;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        totalExpenses: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/totalExpenses", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.total_expenses = res.data.data.totalExpense.toLocaleString();
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        inStock: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/inStock", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.in_stock = res.data.data.in_stock;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        stockValue: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/stockValue", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.stock_value = res.data.data.stock_value;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        vendorBalance: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/vendorBalance", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.vendor_balance = res.data.data.vendor_balance;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        grossProfit: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/grossProfit", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.gross_profit = res.data.data.gross_profit;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        netProfit: function () {
            this.loading.isActive = true;
            this.$store.dispatch("dashboard/netProfit", {
                first_date: this.first_date,
                last_date: this.last_date,
            }).then((res) => {
                this.net_profit = res.data.data.net_profit;
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
    },
}
</script>
