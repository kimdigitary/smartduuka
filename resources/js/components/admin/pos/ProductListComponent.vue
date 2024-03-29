<template>
    <div
        class="grid gap-3 sm:gap-[18px] grid-cols-[repeat(auto-fill,_minmax(140px,_1fr))] sm:grid-cols-[repeat(auto-fill,_minmax(185px,_1fr))] mb-8 md:mb-0">
        <div v-if="products.length > 0" v-for="product in products" @click.prevent="handleProductModal(product)"
            data-modal="#modal"
            class="sm:p-2 rounded-2xl sm:shadow-card transition-all duration-300 sm:hover:shadow-hover group bg-white cursor-pointer">
            <div class="relative overflow-hidden rounded-xl isolate">
                <img :src="product.cover" alt="product"
                    class="w-full rounded-xl transition-all duration-300 group-hover:scale-105 group-hover:rotate-3">
            </div>

            <div class="px-1 sm:px-0 pt-4 pb-2">
                <h3
                    class="capitalize text-base font-semibold whitespace-nowrap mb-1.5 transition-all duration-300 hover:text-primary overflow-hidden">
                    {{ product.name }}
                </h3>


                <h4 class="text-xl sm:text-[22px] font-bold">
                    <span>{{ product.currency_price }}</span>
                </h4>
            </div>
        </div>
    </div>


    <div id="variation-modal"
        class="fixed inset-0 z-50 p-3 w-screen h-screen overflow-y-auto bg-black/50 transition-all duration-500 opacity-0 invisible">
        <div class="w-full rounded-xl mx-auto bg-white transition-all duration-500 max-w-4xl">
            <div class="flex items-center justify-between gap-2 py-4 px-4 border-b border-slate-100">
                <h3 class="text-lg font-bold capitalize">{{ $t('label.product_variation') }}</h3>
                <button @click="reset" type="button" class="lab-line-circle-cross text-lg text-[#E93C3C]"></button>
            </div>
            <ProductDetailsComponent v-if="productId" :method="reset" :productId="productId" />
        </div>
    </div>
</template>

<script>

import starRating from "vue-star-rating";
import ProductDetailsComponent from "./ProductDetailsComponent";
import targetService from "../../../services/targetService";
export default {
    name: "ProductListComponent",
    components: {
        starRating,
        ProductDetailsComponent
    },
    props: {
        "products": "object",
    },
    data() {
        return {
            rating: [],
            productId: ""
        }
    },
    methods: {
        handleProductModal: function (product) {
            this.productId = product.id;
        },
        reset: function () {
            targetService.hideTarget("variation-modal", 'modal-active');
            setTimeout(() => {
                this.productId = "";
            }, 500);
        },
    }
}
</script>
