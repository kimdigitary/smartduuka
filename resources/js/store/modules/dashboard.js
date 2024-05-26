import axios from "axios";
import appService from "../../services/appService";

export const dashboard = {
    namespaced: true,
    state: {
        totalSales: [],
        totalOrders: [],
        totalCustomers: [],
        totalProducts: [],
        salesSummary: [],
        customerStates: [],
        featuredItems: [],
        topProducts: [],
        creditSales: [],
        depositSales: [],
        inStock: [],
        outStock: [],
        totalExpenses: [],
    },

    getters: {
        totalExpenses: function (state) {
            return state.totalExpenses;
        },
        totalSales: function (state) {
            return state.totalSales;
        },
        totalOrders: function (state) {
            return state.totalOrders;
        },
        totalCustomers: function (state) {
            return state.totalCustomers;
        },
        totalProducts: function (state) {
            return state.totalProducts;
        },
        salesSummary: function (state) {
            return state.salesSummary;
        },
        customerStates: function (state) {
            return state.customerStates;
        },
        featuredItems: function (state) {
            return state.featuredItems;
        },
        topProducts: function (state) {
            return state.topProducts;
        },
        creditSales: function (state) {
            return state.creditSales;
        },
        depositSales: function (state) {
            return state.depositSales;
        },
        inStock: function (state) {
            return state.inStock;
        },
        outStock: function (state) {
            return state.outStock;
        }
    },

    actions: {
        totalSales: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/total-sales";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url)
                    .then((res) => {
                        context.commit("totalSales", res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        totalExpenses: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/total-expenses";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url)
                    .then((res) => {
                        context.commit("totalExpenses", res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        totalOrders: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/total-orders";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url)
                    .then((res) => {
                        context.commit("totalOrders", res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        totalCustomers: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/total-customers";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("totalCustomers", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        creditSales: function (context, payload) {
            console.log(payload);
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/credit-sales";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("creditSales", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        depositSales: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/deposit-sales";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("depositSales", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        inStock: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/in-stock";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("inStock", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        outStock: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/out-stock";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("outStock", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        totalProducts: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/total-products";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("totalProducts", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        salesSummary: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/sales-summary";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("salesSummary", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        customerStates: function (context, payload) {
            return new Promise((resolve, reject) => {
                let url = "admin/dashboard/customer-states";
                if (payload) {
                    url = url + appService.requestHandler(payload);
                }
                axios.get(url).then((res) => {
                    context.commit("customerStates", res.data.data);
                    resolve(res);
                })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },
        topProducts: function (context) {
            return new Promise((resolve, reject) => {
                axios
                    .get("admin/dashboard/top-products")
                    .then((res) => {
                        context.commit("topProducts", res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        }
    },

    mutations: {
        totalSales: function (state, payload) {
            state.totalSales = payload;
        },
        totalExpenses: function (state, payload) {
            state.totalExpenses = payload;
        },
        totalOrders: function (state, payload) {
            state.totalOrders = payload;
        },
        totalCustomers: function (state, payload) {
            state.totalCustomers = payload;
        },
        totalProducts: function (state, payload) {
            state.totalProducts = payload;
        },
        salesSummary: function (state, payload) {
            state.salesSummary = payload;
        },
        customerStates: function (state, payload) {
            state.customerStates = payload;
        },
        featuredItems: function (state, payload) {
            state.featuredItems = payload;
        },
        topProducts: function (state, payload) {
            state.topProducts = payload;
        },
        creditSales: function (state, payload) {
            state.creditSales = payload;
        },
        depositSales: function (state, payload) {
            state.depositSales = payload;
        },
        inStock: function (state, payload) {
            state.inStock = payload;
        },
        outStock: function (state, payload) {
            state.outStock = payload;
        },
    },
};
