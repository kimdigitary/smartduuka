<template>
    <LoadingComponent :props="loading" />

<!--    <div class="mb-8">-->
<!--&lt;!&ndash;        <h3 class="capitalize font-bold text-2xl text-primary mb-1.5">{{ visitorMessage() }}</h3>&ndash;&gt;-->
<!--        <h4 class="capitalize font-medium text-xl text-secondary">{{ authInfo.name }}</h4>-->
<!--    </div>-->
    <!--========OVERVIEW START=============-->
    <OverviewComponent />
    <!--========OVERVIEW END=============-->
    <div class="row">
        <!--========SALES SUMMARY START=============-->
        <SalesSummaryComponent />
        <!--========SALES SUMMARY END=============-->

        <!--========CUSTOMER STATS START=============-->
        <CustomerStatsComponent />
        <!--========CUSTOMER STATS END=============-->

        <!--========MOST POPULAR ITEMS START=============-->
        <TopProductsComponent />
        <!--========MOST POPULAR ITEMS END=============-->
    </div>
</template>

<script>
import LoadingComponent from "../components/LoadingComponent";
import OverviewComponent from "./OverviewComponent";
import SalesSummaryComponent from "./SalesSummaryComponent";
import CustomerStatsComponent from "./CustomerStatsComponent";
import TopProductsComponent from "./TopProductsComponent";
import ENV from "../../../config/env";

export default {
    name: "DashboardComponent",
    components: {
        LoadingComponent,
        OverviewComponent,
        SalesSummaryComponent,
        CustomerStatsComponent,
        TopProductsComponent,
    },
    data() {
        return {
            loading: {
                isActive: false,
            },
            demo: ENV.DEMO
        };
    },
    computed: {
        authInfo: function () {
            return this.$store.getters.authInfo;
        }
    },
    methods: {
        visitorMessage: function () {
            let greet;
            let myDate = new Date();
            let hrs = myDate.getHours();
            if (hrs < 12) {
                greet = this.$t('message.good_morning');
            } else if (hrs >= 12 && hrs <= 17) {
                greet = this.$t('message.good_afternoon');
            } else if (hrs >= 17 && hrs <= 24) {
                greet = this.$t('message.good_evening');
            }
            return greet;
        }
    }
}
</script>
