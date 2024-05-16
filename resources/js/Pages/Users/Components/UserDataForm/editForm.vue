<template>
    <div id="user-info">
        <div class="card-header">
            <h5>User Imformation</h5>
        </div>
        <div class="card-body pt-0 mt-3">
            <form role="form text-left" @submit.prevent="updateUserData" enctype="multipart/form-data">
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">NAME</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                            v-model="editForm.name" required />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="email" class="col-md-2 col-form-label">EMAIL</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="email" id="email"
                            v-model="editForm.email" required />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="telephone" class="col-md-2 col-form-label">CONTACT-NUMBER</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="telephone" id="telephone"
                            v-model="editForm.telephone" required />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="username" class="col-md-2 col-form-label">USERNAME</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="username" id="username"
                            v-model="editForm.username" required />
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-round btn-outline-danger mb-0"
                        @click.prevent="deleteUser">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        DELETE
                    </button>
                    <button type="submit" class="btn btn-round custom-button btn-sm mb-0">
                        <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                        SAVE
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faHouse , faFloppyDisk , faTrash } from "@fortawesome/free-solid-svg-icons";
import { onBeforeMount , ref } from "vue";

library.add(faHouse, faFloppyDisk, faTrash);

const props = defineProps({
    userId: {
        type: Number,
        required: true,
    },
});

const editForm = ref({});

onBeforeMount(() => {
    getUserData();
});

const getUserData = async () => {
    const users = (await axios.get(route("user.form.getFormData", props.userId))).data;
    editForm.value = users;
};

const updateUserData = async () => {
    try {
        await axios.post(route("user.form.update", props.userId),
            editForm.value
        );
        Swal.fire({
            title: "User Data updated successfully",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#6CA925", // Green,
        });
    } catch (error) {
        convertValidationError(error);
    }
};

const deleteUser = async () => {
    try {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202", // Green
            cancelButtonColor: "#6CA925", // Secondary Color
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(route("user.form.delete", editForm.value.id)).
                then((response) => {
                        router.visit(route("user.index"));
                    });
            }
        });
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
