<template>
    <div v-if="theme === 'frontend'">
        <router-view></router-view>
    </div>

    <div v-if="theme === 'backend'">
        <main class="db-main" v-if="logged">
            <BackendNavbarComponent />
            <BackendMenuComponent />
            <router-view></router-view>
        </main>
        <div v-if="!logged">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import BackendNavbarComponent from "./layouts/backend/BackendNavbarComponent";
import BackendMenuComponent from "./layouts/backend/BackendMenuComponent";

export default {
    name: "DefaultComponent",
    components: {
        BackendNavbarComponent,
        BackendMenuComponent,
    },
    data() {
        return {
            theme: "frontend",
        }
    },
    computed: {
        logged: function () {
            return this.$store.getters.authStatus;
        }
    },
    beforeMount() {
        this.$store.dispatch('frontendSetting/lists').then(res => {

            this.$store.dispatch('frontendLanguage/show', res.data.data.site_default_language).then(res => {

            }).catch();

            this.$store.dispatch("globalState/init", {
                language_id: res.data.data.site_default_language
            });
        }).catch();
    },
    watch: {
        $route(e) {
            if (e.meta.isFrontend === true) {
                this.theme = "frontend";
            } else {
                this.theme = "backend";
            }
        }
    },
}
</script>
