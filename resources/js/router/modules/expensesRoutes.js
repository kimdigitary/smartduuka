import ExpenseComponent from "../../components/admin/expenses/ExpenseComponent.vue";
import expensetListComponent from "../../components/admin/expenses/ExpensetListComponent.vue";
import ExpenseShowComponent from "../../components/admin/expenses/ExpenseShowComponent.vue";

export default [
    {
        path: '/admin/expenses',
        component: ExpenseComponent,
        name: 'admin.expenses',
        redirect: {name: 'admin.expenses'},
        meta: {
            isFrontend: false,
            auth: true,
            permissionUrl: 'expenses',
            breadcrumb: 'expenses'
        },
        children: [
            {
                path: '',
                component: expensetListComponent,
                name: 'admin.expenses',
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: 'expenses',
                    breadcrumb: ''
                },
            },
            {
                path: "show/:id",
                component: ExpenseShowComponent,
                name: "admin.expenses.show",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "expenses",
                    breadcrumb: "view",
                },
            }
        ]
    }
]
