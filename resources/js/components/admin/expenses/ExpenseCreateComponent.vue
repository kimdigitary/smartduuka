<template>
  <LoadingComponent :props="loading"/>
  <SmSidebarModalCreateComponent :props="addButton"/>

  <div id="sidebar" class="drawer">
    <div class="drawer-header">
      <h3 class="drawer-title">Expense</h3>
      <button class="fa-solid fa-xmark close-btn" @click="reset"></button>
    </div>
    <div class="drawer-body">
      <form @submit.prevent="save">
        <div class="form-row">
          <div class="form-col-12 sm:form-col-6">
            <label for="name" class="db-field-title required">{{ $t("label.name") }}</label>
            <input v-model="props.form.name" v-bind:class="errors.name ? 'invalid' : ''" type="text" id="name"
                   class="db-field-control">
            <small class="db-field-alert" v-if="errors.name">{{ errors.name }}</small>
          </div>
          <div class="form-col-12 sm:form-col-6">
            <label for="amount" class="db-field-title required">Amount</label>
            <input v-model="props.form.amount" v-bind:class="errors.amount ? 'invalid' : ''" type="number" id="amount"
                   class="db-field-control">
            <small class="db-field-alert" v-if="errors.amount">{{ errors.amount }}</small>
          </div>

          <div class="col-12 sm:col-6 md:col-6 xl:col-6">
            <label for="searchStartDate" class="db-field-title after:hidden">{{
                $t('label.date')
              }}</label>
            <DatePickerComponent @update:modelValue="handleDate" :range="false" inputStyle="filter" v-model="props.form.date"/>
            <small class="db-field-alert" v-if="errors.date">{{ errors.date }}</small>
          </div>
          <div class="form-col-12 sm:form-col-6">
            <label for="product_category_id" class="db-field-title required">
              {{ $t("label.category") }}
            </label>
            <vue-select ref="product_category_id" class="db-field-control f-b-custom-select"
                        id="product_category_id" v-bind:class="errors.category ? 'invalid' : ''"
                        v-model="props.form.category" :options="categories" label-by="name"
                        value-by="id" :closeOnSelect="true" :searchable="true" :clearOnClose="true" placeholder="--"
                        search-placeholder="--"/>
            <small class="db-field-alert" v-if="errors.category">
              {{ errors.category }}
            </small>
          </div>

          <div class="form-col-12">
            <label class="db-field-title ">{{
                $t("label.attachments")
              }}</label>
            <input @change="changeFile" v-bind:class="errors.file ? 'invalid' : ''" type="file"
                   ref="fileProperty" accept="image/png , image/jpeg, image/jpg , application/pdf "
                   class="db-field-control cursor-pointer" id="image"/>
            <small class="db-field-alert" v-if="errors.file">{{
                errors.file
              }}</small>
          </div>

          <div class="form-col-12">
            <label for="description" class="db-field-title">Expense Note</label>
            <div :class="errors.note ? 'invalid textarea-error-box-style' : ''">
              <quill-editor id="description" v-model:value="props.form.note"
                            class="!h-40 textarea-border-radius"/>
            </div>
            <small class="db-field-alert" v-if="errors.note">
              {{ errors.note }}
            </small>
          </div>

          <div :class="`${props.form.isRecurring?'sm:form-col-6 ':'sm:form-col-12 '}form-col-12`">
            <label class="db-field-title required" for="yes">Is Recurring</label>
            <div class="db-field-radio-group">
              <div class="db-field-radio">
                <div class="custom-radio">
                  <input type="radio" v-model="props.form.isRecurring" id="yes"
                         :value="true" class="custom-radio-field">
                  <span class="custom-radio-span"></span>
                </div>
                <label for="yes" class="db-field-label">{{ $t('label.yes') }}</label>
              </div>
              <div class="db-field-radio">
                <div class="custom-radio">
                  <input type="radio" class="custom-radio-field" v-model="props.form.isRecurring"
                         id="no" :value="false">
                  <span class="custom-radio-span"></span>
                </div>
                <label for="no" class="db-field-label">{{ $t('label.no') }}</label>
              </div>
            </div>
          </div>

          <div class="form-col-12 sm:form-col-6" v-show="props.form.isRecurring">
            <label for="tax_id" class="db-field-title">Recurs</label>
            <vue-select ref="tax_id" class="db-field-control f-b-custom-select" id="tax_id"
                        v-bind:class="errors.recurs ? 'invalid' : ''" v-model="props.form.recurs" :options="recurringOptions"
                        label-by="name" value-by="id" :closeOnSelect="true" :searchable="true" :clearOnClose="true"
                        placeholder="--" search-placeholder="--" :multiple="false"/>
            <small class="db-field-alert" v-if="errors.recurs">{{ errors.recurs }}</small>
          </div>

          <div class="form-col-12 sm:form-col-6">
            <label for="unit" class="db-field-title required">Payment Method</label>
            <vue-select class="db-field-control f-b-custom-select" id="unit_id"
                        v-bind:class="errors.paymentMethod ? 'invalid' : ''" v-model="props.form.paymentMethod" :options="paymentMethods"
                        label-by="name" value-by="id" :closeOnSelect="true" :searchable="true" :clearOnClose="true"
                        placeholder="--" search-placeholder="--"/>
            <small class="db-field-alert" v-if="errors.paymentMethod">
              {{ errors.paymentMethod }}
            </small>
          </div>

          <div class="form-col-12 sm:form-col-6" v-show="props.form.paymentMethod===2 || props.form.paymentMethod===3 || props.form.paymentMethod===4 ">
            <label for="maximum_purchase_quantity" class="db-field-title required">{{ referenceLabel }}</label>
            <input v-model="props.form.referenceNo"
                   v-bind:class="errors.referenceNo ? 'invalid' : ''" type="text"
                   id="maximum_purchase_quantity" class="db-field-control">

            <small class="db-field-alert" v-if="errors.referenceNo">
              {{ errors.referenceNo }}
            </small>
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
import DatePickerComponent from "../components/DatePickerComponent.vue";
import {quillEditor} from "vue3-quill";
import activityEnum from "../../../enums/modules/activityEnum";
import askEnum from "../../../enums/modules/askEnum";
import statusEnum from "../../../enums/modules/statusEnum";
import isRecurringEnum from "../../../enums/modules/isRecuringEnum";

export default {
  name: "ExpenseCreateComponent",
  components: {DatePickerComponent, SmSidebarModalCreateComponent, LoadingComponent, quillEditor},
  props: ['props'],
  data() {
    return {
      tag: "",
      loading: {
        isActive: false
      },
      addButton: {
        title: 'Add Expense'
      },
      enums: {
        statusEnum: statusEnum,
        askEnum: isRecurringEnum,
        activityEnum: activityEnum,
        statusEnumArray: {
          [statusEnum.ACTIVE]: this.$t("label.active"),
          [statusEnum.INACTIVE]: this.$t("label.inactive")
        },
        askEnumArray: {
          [askEnum.YES]: this.$t("label.yes"),
          [askEnum.NO]: this.$t("label.no")
        },
        activityEnumArray: {
          [activityEnum.ENABLE]: this.$t("label.enable"),
          [activityEnum.DISABLE]: this.$t("label.disable")
        }
      },
      errors: {},
      productCategories: [],
      categories: [],
      productBrands: [],
      taxes: [],
      barcodes: [],
      recurringOptions: [],
      paymentMethods: [],
    }
  },
  computed: {
    referenceLabel() {
      switch (this.props.form.paymentMethod) {
        case 2:
          return 'Phone Number'
        case 3:
          return 'Check No.'
        case 4:
          return 'Account Number'
      }
    }
  },
  mounted() {
    this.loading.isActive = true;
    this.recurringOptions = [
      {id: 1, name: 'Daily'},
      {id: 2, name: 'Monthly'},
      {id: 3, name: 'Yearly'},
    ]
    this.paymentMethods = [
      {id: 1, name: 'Cash'},
      {id: 2, name: 'Mobile Money'},
      {id: 3, name: 'Bank'},
      {id: 4, name: 'Bank Transfer'},
    ]

    // this.loading.isActive = true;
    // this.$store.dispatch('expense/lists', {
    //   order_column: 'id',
    //   order_type: 'asc'
    // }).then((res) => {
    //   this.items = res.data.data;
    //   this.loading.isActive = false;
    // }).catch((error) => {
    //   this.loading.isActive = false;
    // });

    this.loading.isActive = true;
    this.$store.dispatch('expenseCategory/lists', {
      order_column: 'id',
      order_type: 'asc'
    }).then((res) => {
      this.categories = res.data.data;
      this.loading.isActive = false;
    }).catch((error) => {
      this.loading.isActive = false;
    });

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
        this.$store.dispatch('expense/save', this.props).then((res) => {
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
