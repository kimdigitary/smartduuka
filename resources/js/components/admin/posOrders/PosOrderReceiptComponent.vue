<template>
    <div id="receiptModal" class="modal">
        <div class="modal-dialog max-w-[340px] rounded-none" id="print">
            <div class="modal-body">
                <!-- <div class="text-center pb-3.5 border-b border-dashed border-gray-400">
                    <img :src="setting.theme_logo" alt="logo" style="width: 90px; height: 37px;">
                    <h3 class="text-2xl font-bold mb-1">{{ company.company_name }}</h3>
                    <h4 class="text-sm font-normal">{{ company.company_address }}</h4>
                    <h5 class="text-sm font-normal">{{ $t('label.tel') }}: {{ company.company_calling_code }} {{
                        company.company_phone
                    }}</h5>
                </div> -->
                <div class="text-center pb-3.5 border-b border-dashed border-gray-400">
                    <div class="flex flex-col items-center justify-center"> <!-- Flex container to center all content -->
                        <img :src="setting.theme_logo" alt="logo" style="width: 90px; height: 37px; opacity: 50%;" class="mb-2">
                        <h3 class="text-2xl font-bold mb-1">{{ company.company_name }}</h3>
                        <h4 class="text-sm font-normal">{{ company.company_address }}</h4>
                        <h5 class="text-sm font-normal">{{ $t('label.tel') }}: {{ company.company_calling_code }} {{ company.company_phone }}</h5>
                        <h2 class="text-2xl font-bold mb-1" v-if="order.order_type == 10">Receipt</h2>
                        <h2 class="text-2xl font-bold mb-1" v-if="order.order_type == 20">Invoice</h2>
                        <h2 class="text-2xl font-bold mb-1" v-if="order.order_type == 25">Invoice</h2>
                    </div>
                </div>


                <table class="w-full my-1.5">
                    <tr>
                        <td class="text-xs text-left py-0.5 text-heading">{{ $t('label.order_id') }}
                            #{{ order.order_serial_no }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-xs text-left py-0.5 text-heading">{{ order.order_date }}</td>
                        <td class="text-xs text-right py-0.5 text-heading">{{ order.order_time }}</td>
                    </tr>
                </table>

                <table class="w-full">
                    <thead class="border-t border-b border-dashed border-gray-400">
                        <tr>
                            <th scope="col" class="py-1 font-normal text-xs capitalize text-left text-heading w-8">
                                {{ $t('label.qty') }}
                            </th>
                            <th scope="col"
                                class="py-1 font-normal text-xs capitalize flex items-center justify-between text-heading">
                                <span>{{ $t('label.product_description') }}</span>
                                <span>{{ $t('label.price') }}</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="border-b border-dashed border-gray-400">
                        <tr v-if="orderProducts.length > 0" v-for="product in orderProducts" :key="product">
                            <td class="text-left font-normal align-top py-1">
                                <p class="text-xs leading-5 text-heading">{{ product.quantity }}</p>
                            </td>
                            <td class="text-left font-normal align-top py-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs leading-5 text-heading">{{ product.product_name }}
                                    </p>
                                    <p class="text-xs leading-5 text-heading">{{ product.subtotal_currency_price }}
                                    </p>
                                </div>
                                <p v-if="product.variation_names" class="text-xs leading-5 text-heading max-w-[200px]">
                                    {{ product.variation_names }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="py-2 pl-7">
                    <table class="w-full">
                        <tr>
                            <td class="text-xs text-left py-0.5 uppercase text-heading">{{ $t('label.subtotal') }}:</td>
                            <td class="text-xs text-right py-0.5 text-heading">
                                {{ order.subtotal_currency_price }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs text-left py-0.5 uppercase text-heading">
                                {{ $t('label.tax_fee') }}:
                            </td>
                            <td class="text-xs text-right py-0.5 text-heading">
                                {{ order.tax_currency_price }}
                            </td>
                        </tr>
                        <tr v-if="order.payment_method == 1">
                            <td class="text-xs text-left py-0.5 uppercase text-heading">Delivery charge:</td>
                            <td class="text-xs text-right py-0.5 text-heading">{{ order.shipping_charge_currency_price }}</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-left py-0.5 uppercase text-heading">Order type:</td>
                            <td class="text-xs text-right py-0.5 text-heading" v-if="order.order_type == 20">Credit purchase</td>
                            <td class="text-xs text-right py-0.5 text-heading" v-else-if="order.order_type == 25">Deposited purchase</td>
                            <td class="text-xs text-right py-0.5 text-heading" v-else-if="order.order_type == 10">Take away</td>
                        </tr>
                        <tr>
                            <td class="text-xs text-left py-0.5 uppercase text-heading">{{ $t('label.discount') }}:</td>
                            <td class="text-xs text-right py-0.5 text-heading">{{ order.discount_currency_price }}</td>
                        </tr>

                        <tr>
                            <td class="text-xs text-left py-0.5 font-bold uppercase text-heading">
                                {{ $t('label.total') }}:
                            </td>
                            <td v-if="order.shipping_charge > 0" class="text-xs text-right py-0.5 font-bold text-heading">
                                {{ order.total_currency_price + order.shipping_charge}}
                            </td>
                            <td v-else class="text-xs text-right py-0.5 font-bold text-heading">
                                {{ order.total_currency_price }}
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- <p class="text-xs py-2 border-t border-b border-dashed border-gray-400 text-heading">
                    {{ $t('label.payment_type') }}: {{ $t('label.cash') }}
                </p> -->
                <div class="text-center pt-2 pb-4">
                    <p class="text-[11px] leading-[14px] capitalize text-heading">
                        {{ $t('message.thank_you') }}
                    </p>
                    <p class="text-[11px] leading-[14px] capitalize text-heading">
                        {{ $t('message.please_come_again') }}
                    </p>
                </div>
                <!-- <div class="flex flex-col items-end">
                    <h5 class="text-[8px] font-normal text-left w-[46px] leading-[10px]">
                        {{ $t('label.powered_by') }}
                    </h5>
                     <h6 class="text-xs font-normal leading-4">Smart Duuka</h6>
                    <p><small>Visit: https://smartduuka.com</small></p>
                </div> -->
                <div class="flex flex-col items-end">
                    <div class="flex justify-between items-center w-full"> <!-- New div for logo and text -->
                        <div class="flex items-center"> <!-- Logo div -->
                            <img src="logo.png" alt="Logo" style="width: 90px; height: 37px;" class="mr-2">
                            <!-- Adjust width and height -->

                        </div>
                        <div class="text-right"> <!-- Text content div -->
                            <div>
                                <h5 class="text-[8px] font-normal text-left w-[66px] leading-[10px]">
                                    {{ $t('label.powered_by') }}
                                </h5>
                                <h6 class="text-xs font-normal text-left leading-4">Smart Duuka</h6>
                            </div>
                            <p class="text-[8px] font-normal text-left leading-[10px]"><a href="https://smartduuka.com">Visit: https://smartduuka.com</a></p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "PosOrderReceiptComponent",
    props: {
        order: Object
    },
    computed: {
        company: function () {
            return this.$store.getters['company/lists'];
        },
        orderProducts: function () {
            return this.$store.getters['posOrder/orderProducts'];
        },
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
    },
    mounted() {
        this.$store.dispatch("company/lists").then().catch();
    }
}
</script>
