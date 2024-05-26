<template>
  <LoadingComponent :props="loading"/>
  <SmSidebarModalCreateComponent :props="addButton"/>

  <div id="sidebar" class="drawer">
    <div class="drawer-header">
      <h3 class="drawer-title">Add Expense Category</h3>
      <button class="fa-solid fa-xmark close-btn" @click="reset"></button>
    </div>
    <div class="drawer-body">
      <form @submit.prevent="save">
        <div class="form-row">
          <div class="form-col-12 sm:form-col-12">
            <label for="name" class="db-field-title required">{{ $t("label.name") }}</label>
            <input v-model="props.form.name" v-bind:class="errors.name ? 'invalid' : ''" type="text" id="name"
                   class="db-field-control">
            <small class="db-field-alert" v-if="errors.name">{{ errors.name }}</small>
          </div>

          <div class="col-12">
            <div class="flex flex-wrap gap-3 mt-4">
              <button type="submit" class="db-btn py-2 text-white bg-primary">
                <i class="lab lab-fill-save"></i>
                <span>{{ $t("label.save") }}</span>
              </button>
              <button type="button" class="modal-btn-outline modal-close" @click="reset">
                <i class="lab lab-fill-close-circle"></i>
                <span>{{ $t("button.close") }}</span>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import SmSidebarModalCreateComponent from "../components/buttons/SmSidebarModalCreateComponent";
import LoadingComponent from "../components/LoadingComponent";
import alertService from "../../../services/alertService";
import appService from "../../../services/appService";

export default {
  name: "ExpenseCategoryCreateComponent",
  components: {SmSidebarModalCreateComponent, LoadingComponent},
  props: ['props'],
  data() {
    return {
      tag: "",
      loading: {
        isActive: false
      },
      addButton: {
        title: 'Add Category'
      },
      errors: {},
    }
  },
  mounted() {

  },
  methods: {
    reset: function () {
      appService.sideDrawerHide();
      this.$store.dispatch('product/reset').then().catch();
      this.errors = {};
      this.$props.props.form = {
        name: ""
      };
    },
    save: function () {
      try {
        const tempId = this.$store.getters['product/temp'].temp_id;
        this.loading.isActive = true;
        this.$store.dispatch('expenseCategory/save', this.props).then((res) => {
          appService.sideDrawerHide();
          this.loading.isActive = false;
          alertService.successFlip((tempId === null ? 0 : 1), "Expense Category");
          this.props.form = {
            name: ""
          }
          this.errors = {};
        }).catch(({response}) => {
          this.loading.isActive = false;
          if (response.data) {
            Object.entries(response.data.data).forEach(([key, value]) => {
              this.errors = {[key]: value};
            });
          }
        })
      } catch (err) {
        this.loading.isActive = false;
      }
    }
  }
}
</script>