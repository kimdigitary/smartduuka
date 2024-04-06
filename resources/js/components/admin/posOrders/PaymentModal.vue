<template>
    <LoadingComponent :props="loading" />
    <div v-if="isVisible" class="modal-backdrop">
        <div class="modal-dialog max-w-[420px]">
            <div class="modal-header hidden-print">
                <h3 class="drawer-title">Payment Details</h3><button class="fa-solid fa-xmark close-btn"
                    @click="closeModal"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="submitForm">
                    <div class="form-row">
                        <div class="form-col-12 sm:form-col-12">
                            <label for="amount" class="db-field-title required">Amount (Ugx)</label>
                            <input class="db-field-control" required type="text" id="amount" v-model="amount">
                        </div>
                        <!-- Assuming orderId is already available in the component's data -->
                        <!-- <input class="db-field-control" required type="text" id="orderId" v-model="orderId" readonly> -->
                        <!-- Use v-model to bind orderId to the input and make it read-only -->
                        <div class="form-col-12">
                            <div class="flex flex-wrap gap-3 mt-4">
                                <button type="submit" class="db-btn py-2 text-white bg-primary">
                                    <i class="lab lab-save"></i><span>Save</span>
                                </button>
                                <button type="button" @click="closeModal" class="modal-btn-outline modal-close">
                                    <i class="lab lab-close"></i><span>Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import LoadingComponent from "../components/LoadingComponent";
import alertService from "../../../services/alertService";

export default {
    components: {
        LoadingComponent,
    },
    props: {
        isVisible: {
            type: Boolean,
            default: false
        },
        orderId: {
            type: Number, // Assuming payment ID is a number
            required: true
        }
    },
    data() {
        return {
            amount: null,
            loading: {
                isActive: false
            },
        };
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        submitForm() {
            // Prepare the data to send in the POST request
            const postData = {
                amount: this.amount
            };

            // Send the POST request to the API endpoint

            try {
                this.loading.isActive = true;
                axios.post(`/admin/pos-order/payment/${this.orderId}`, postData)
                    .then(response => {
                        // Handle success response if needed
                        console.log(response.data);
                        this.loading.isActive = false;
                        alertService.successFlip(
                            1,
                            "Payment added!"
                        );
                        this.amount = null;
                        this.closeModal();

                        this.$emit('formSaved'); //refresh the payment list
                    })
                    .catch(error => {
                        // Handle error response if needed
                        console.error('Error submitting form:', error);
                        this.loading.isActive = false;
                        alertService.error(err.response.data.message);
                    });
            } catch (err) {
                this.loading.isActive = false;
                alertService.error(err.response.data.message);
            }
        }
    }
}
</script>


<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
}

.medium {
    width: 30%;
    /* Adjust this as needed */
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
}

.submit-button {
    background-color: red;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.close-button {
    background-color: transparent;
    color: red;
    border: 1px solid red;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

.close-button:hover {
    background-color: red;
    color: white;
}
</style>
