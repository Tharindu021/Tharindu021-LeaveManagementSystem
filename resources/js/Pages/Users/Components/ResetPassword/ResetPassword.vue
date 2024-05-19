<template>
    <div id="user-info">
        <div class="card-header">
            <h5>Reset Password</h5>
        </div>
        <div class="card-body pt-0 mt-3">
            <form role="form text-left" @submit.prevent="updateUserPassword"
                enctype="multipart/form-data">
                <div class="row mb-1">
                    <div for="password" class="col-md-3 col-form-label ">PASSWORD</div>
                    <div class="col-md-9">
                        <input type="password" class="form-control form-control-sm"
                            name="password" id="password" v-model="user.password"
                            placeholder="Password" >
                            <small v-if="validationErrors.password" id="password"
                                class="text-danger form-text text-error-msg error">{{
                                    validationErrors.password }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="con_password" class="col-md-3 col-form-label ">CONFIRM
                        PASSWORD</div>
                    <div class="col-md-9">
                        <input type="password" class="form-control form-control-sm"
                            name="confirm_password" id="confirm_password"
                            v-model="user.con_password" placeholder="Confirm Password"
                            >
                            <small v-if="validationErrors.con_password" id="confirm_password"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.con_password }}</small>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button type="submit" class="btn  btn-round btn-outline-success btn-sm mb-0">
                        <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                        UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { library } from "@fortawesome/fontawesome-svg-core";
import { faHouse , faFloppyDisk , faTrash } from "@fortawesome/free-solid-svg-icons";
import { onBeforeMount , ref } from "vue";
import Swal from "sweetalert2";

library.add(faHouse, faFloppyDisk, faTrash);

const props = defineProps({
    userId: {
        type: Number,
        required: true,
    },
});

const user = ref({});

onBeforeMount(() => {
    getUserData();
});
const validationMessage = ref(null);
const validationErrors = ref({});

const resetValidationErrors = () => {
    validationErrors.value = {};
    validationMessage.value = null;
};

const convertValidationNotification = (error) => {
    resetValidationErrors();
    if (!(error.response && error.response.data)) return;
    const { message } = error.response.data;

    errorMessage(message);
};

const convertValidationError = (err) => {
    resetValidationErrors();
    if (!(err.response && err.response.data)) return;
    const { message, errors } = err.response.data;
    // Update the assignment of validationMessage and validationErrors
    validationMessage.value = message;
    if (errors) {
        for (const error in errors) {
            validationErrors.value[error] = errors[error][0];
        }
    }
};

const successMessage = (message) => {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
};

const errorMessage = (message) => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
};
const getUserData = async () => {
    resetValidationErrors();
    try{
        const users = (await axios.get(route("user.form.getFormData", props.userId))).data;
    user.value = users;
    }catch (error){
        console.error(error.message);
    }   
};

const updateUserPassword = async () => {
    resetValidationErrors();
    try {
        await axios.post(route('user.form.updatePassword', props.userId), user.value);
        user.value = {};
        successMessage('User password updated successfully');
    } catch (error) {
        convertValidationNotification(error);
    }
};

</script>

<style lang="scss" scoped>
.custom-button {
    background-color: #ffffff;
    border-color: #6343e9;
    color: #6343e9 !important;
}

.custom-button:hover {
    background-color: #6343e9;
    color: #ffffff !important;
}
</style>
