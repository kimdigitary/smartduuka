import PosOrderComponent from "../../components/admin/posOrders/PosOrderComponent";
import PosOrderListComponent from "../../components/admin/posOrders/PosOrderListComponent";
import PosOrderShowComponent from "../../components/admin/posOrders/PosOrderShowComponent";

import PosDepositOrderListComponent from "../../components/admin/posDepositOrders/PosOrderListComponent";

import PosCreditOrderListComponent from "../../components/admin/posCreditOrders/PosOrderListComponent";

export default [
    {
        path: "/admin/pos-orders",
        component: PosOrderComponent,
        name: "admin.pos.orders",
        redirect: { name: "admin.pos.orders.list" },
        meta: {
            isFrontend: false,
            auth: true,
            permissionUrl: 'pos',
            breadcrumb: 'pos_orders'
        },
        children: [
            {
                path: "",
                component: PosOrderListComponent,
                name: "admin.pos.orders.list",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "pos",
                    breadcrumb: "",
                },
            },
            {
                path: "credit",
                component: PosCreditOrderListComponent,
                name: "admin.pos.orders.credit.list",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "pos",
                    breadcrumb: "pos_credit_orders",
                },
            },
            {
                path: "deposit",
                component: PosDepositOrderListComponent,
                name: "admin.pos.orders.deposit.list",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "pos",
                    breadcrumb: "pos_deposit_orders",
                },
            },
            {
                path: "show/:id",
                component: PosOrderShowComponent,
                name: "admin.pos.orders.show",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "pos",
                    breadcrumb: "view",
                },
            }
        ],
    },
];
