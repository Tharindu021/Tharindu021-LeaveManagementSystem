<template>
    <div id="user-info">
        <div class="card-header">
            <h5>Assign Permission</h5>
        </div>
        <div class="card-body pt-2 mt-3">
            <form role="form text-left" @submit.prevent="updatePermission">
                <div class="mb-1 row">
                    <div class="mb-2 col-md-6" v-for="group in groups" :key="group.group_name">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ group.group_name }}</h5>
                                <ul class="list-group">
                                    <li class="list-group-item mb-1" v-for="permission in permissions" :key="permission.id" >
                                        <div class="form-check form-switch" v-if="permission.group_name == group.group_name">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                v-model="user_permissions" :id="permission.name"
                                                :value="permission.name">
                                            <label class="form-check-label" :for="permission.name">
                                                {{ permission.name }}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-round btn-outline-primary btn-sm mr-1 mb-1">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" />
                            <span>SAVE</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick, onBeforeMount } from 'vue';
import Swal from 'sweetalert2';
import { usePage } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faHouse, faFloppyDisk, faCirclePlus, faPen, faTrash, faTimes, faArrowLeftRotate } from '@fortawesome/free-solid-svg-icons';

const props = defineProps({
    userId: {
        type: Number,
        required: true,
    },
});

const groups = ref([]);
const permissions = ref([]);
const user_permissions = ref([]);

library.add(faHouse, faArrowLeftRotate, faFloppyDisk, faCirclePlus, faPen, faTrash, faTimes);

onBeforeMount(() => {
    getPermissions();
    getPermissionGroup();
});

const getPermissionGroup = async () => {
    const groups_data = (await axios.get(route("permission.allGroup"))).data;
    groups.value = groups_data;
};

const getPermissions = async () => {
    const permissions_data = (await axios.get(route("permission.all"))).data;
    permissions.value = permissions_data;
};

const getUserPermission = async () => {
    const    
}

const updatePermission = async () => {
    try {
        console.log(props.userId);
        await axios.post(route("permission.update", props.userId), {
            permissions: user_permissions.value,
        });
        successMessage('Role Permission Updated Successfully');
        window.location.reload();
    } catch (error) {
        convertValidationError(error);
    }
}

onMounted(() => {
    initData();
});

const initData = () => {
    // Your initialization logic here
};

const successMessage = (message) => {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
    });
};

const convertValidationError = (error) => {
    // Your error handling logic here
};
</script>
