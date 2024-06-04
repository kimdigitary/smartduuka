import StockComponent from "../../components/admin/stock/StockComponent";
import StockListComponent from "../../components/admin/stock/StockListComponent";
import StockCreateOrEditComponent from "../../components/admin/stock/StockCreateAndEditComponent.vue";

export default [
    {
        path: '/admin/stock',
        component: StockComponent,
        name: 'admin.stock',
        redirect: {name: 'admin.stock'},
        meta: {
            isFrontend: false,
            auth: true,
            permissionUrl: 'stock',
            breadcrumb: 'stock'
        },
        children: [
            {
                path: '',
                component: StockListComponent,
                name: 'admin.stock',
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: 'stock',
                    breadcrumb: ''
                },
            },
            {
                path: 'create',
                component: StockCreateOrEditComponent,
                name: 'admin.stock.create',
                meta: {
                    isFrontend:false,
                    auth:true,
                    permissionUrl: 'stock_create',
                    breadcrumb: 'create'
                }
            },
            {
                path: 'edit/:id',
                component: StockCreateOrEditComponent,
                name: 'admin.stock.edit',
                meta: {
                    isFrontend:false,
                    auth:true,
                    permissionUrl: 'stock_edit',
                    breadcrumb: 'edit'
                }
            },
        ]
    }
]
