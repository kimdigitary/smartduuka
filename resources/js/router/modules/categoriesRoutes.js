import ExpenseCategoryComponent from "../../components/admin/expenseCategories/ExpenseCategoryComponent.vue";
import ExpenseCategorytListComponent from "../../components/admin/expenseCategories/ExpenseCategorytListComponent.vue";
import ExpenseCategoryShowComponent from "../../components/admin/expenseCategories/ExpenseCategoryShowComponent.vue";

export default [
    {
        path: '/admin/categories',
        component: ExpenseCategoryComponent,
        name: 'admin.categories',
        redirect: {name: 'admin.categories'},
        meta: {
            isFrontend: false,
            auth: true,
            permissionUrl: 'categories',
            breadcrumb: 'categories'
        },
        children: [
            {
                path: '',
                component: ExpenseCategorytListComponent,
                name: 'admin.categories',
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: 'categories',
                    breadcrumb: ''
                },
            },
            {
                path: "show/:id",
                component: ExpenseCategoryShowComponent,
                name: "admin.categories.show",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "categories",
                    breadcrumb: "view",
                },
            }
        ]
    }
]
