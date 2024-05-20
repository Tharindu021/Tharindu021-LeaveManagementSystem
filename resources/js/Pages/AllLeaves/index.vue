<template>
    <AppLayout title="All Leaves">
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">
                                    All Leaves
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            All Leaves
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="py-3 mx-3 text-sm card-body">
                            <div class="flex">
                                <div class="col-md-2 mx-3 column__right___padding column__left___padding">
                                    <div for="purchase_uom" class="col-form-label">
                                        User Name
                                    </div>
                                    <input type="text" class="form-control form-control-sm" name="search_name" id="search_name"
                                        v-model="search_data.name" placeholder="User Name" @keyup="getSearch" />
                                 </div>
                                <div class="col-md-2 column__left___padding column__right___padding">
                                    <div for="purchase_uom" class="col-form-label">
                                        Status
                                    </div>
                                    <Multiselect v-model="search_status" :options="status" class="z__index"
                                        :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                        :searchable="true" placeholder="Select Status" label="status" track-by="id" />
                                </div>
                                <div class="col-md-2 mx-3 column__right___padding column__left___padding">
                                    <div for="purchase_uom" class="col-form-label">
                                        Start Date
                                    </div>
                                    <input type="date" class="form-control form-control-sm" name="start_date" id="start_date"
                                        v-model="search_data.start_date" placeholder="Start Date" @change="getSearch" />
                                 </div>
                                <div class="col-md-2 mx-3 column__right___padding column__left___padding">
                                    <div for="purchase_uom" class="col-form-label">
                                        End Date
                                    </div>
                                    <input type="date" class="form-control form-control-sm" name="end_date" id="end_date"
                                        v-model="search_data.end_date" placeholder="End Date" @change="getSearch" />
                                </div>
                                <div class="col-md-2 pl-4 mt-4 column__left___padding">
                                <a href="javascript:void(0)" @click.prevent="clearFilters"
                                    class="btn btn-sm btn-ash float-end mt-2 pt-2 text-end">
                                    CLEAR
                                </a>
                            </div>
                                <div class="flex text-muted ml-auto mx-2">
                                    <div class="inline-block mx-1">
                                        <select class="form-control form-control-sm per-page-entry" :value="25"
                                            v-model="pageCount" @change="perPageChange">
                                            <option v-for="perPageCount in perPage" :key="perPageCount"
                                                :value="perPageCount" v-text="perPageCount" />
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-4 mt-2">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th :class="textClassHead">User Name</th>
                                            <th :class="textClassHead">Start Date</th>
                                            <th :class="textClassHead">End Date</th>
                                            <th :class="textClassHead">Reason</th>
                                            <th :class="statusClassHead">
                                                Status
                                            </th>
                                            <th :class="textClassHead"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="leave_data in leave_datas" :key="leave_data.id" :class="rowClass">
                                            <td :class="textClassBody">
                                                {{ leave_data.user_name.name }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ leave_data.start_date }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ leave_data.end_date }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ leave_data.reason }}
                                            </td>
                                            <td :class="statusClassBody">
                                                <span v-if="leave_data.status == 0"
                                                    class="badge bg-warning text-white fw-bold ml-3">Pending</span>
                                                <span v-if="leave_data.status == 1"
                                                    class="badge bg-success text-white fw-bold ml-3">Accepted</span>
                                                <span v-if="leave_data.status == 2"
                                                    class="badge bg-danger text-white fw-bold ml-3">Rejected</span>
                                            </td>
                                            <td :class="statusClassBody">
                                                <span v-if="leave_data.status == 0" >
                                                    <a type="button" class="float-end ml-3" href="javascript:void(0)"
                                                    @click.prevent="acceptLeave(leave_data.id)" style="font-size: 1.5em; color: Dodgerblue;" >
                                                        <font-awesome-icon icon="fa-solid fa-check" />
                                                    </a>
                                                    <a type="button" class="float-end ml-3" href="javascript:void(0)"
                                                    @click.prevent="rejectLeave(leave_data.id)" style="font-size: 1.5em; color: Tomato;" >
                                                        <font-awesome-icon icon="fa-solid fa-xmark" />
                                                    </a>
                                                </span>
                                                <a type="button" class="float-end ml-3" href="javascript:void(0)"
                                                    @click.prevent="
                                                deleteLeave(leave_data.id)" style="font-size: 1.5em; color: crimson;">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="flex mt-1 mx-1 px-3 card-footer table-footer align-items-center">
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_info column__left___padding" id="DataTables_Table_0_info"
                                    role="status" aria-live="polite">
                                    Showing {{ pagination.from }} to
                                    {{ pagination.to }} of
                                    {{ pagination.total }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_paginate paging_simple_numbers column__right___padding"
                                    id="DataTables_Table_0_paginate">
                                    <nav aria-label="Page navigation" style="float: right">
                                        <ul class="pagination">
                                            <li class="page-item" :class="pagination.current_page == 1
                                                    ? 'disabled'
                                                    : ''
                                                ">
                                                <a class="page-link" href="javascript:void(0)" @click="
                                                setPage(
                                                    pagination.current_page -
                                                    1
                                                )
                                                ">
                                                    <i class="fa-solid fa-angles-left"></i>
                                                </a>
                                            </li>
                                            <template v-for="(
                                                    page, index
                                                ) in pagination.last_page">
                                                <template v-if="page == 1 ||
                                                page ==
                                                pagination.last_page ||
                                                Math.abs(
                                                    page -
                                                    pagination.current_page
                                                ) < 5
                                                ">
                                                    <li class="page-item" :key="index" :class="pagination.current_page ==
                                                    page
                                                    ? 'active'
                                                    : ''
                                                ">
                                                        <a class="page-link" @click="
                                                setPage(page)
                                                ">{{ page }}</a>
                                                    </li>
                                                </template>
                                            </template>
                                            <li class="page-item" :class="pagination.current_page ==
                                                    pagination.last_page
                                                    ? 'disabled'
                                                    : ''
                                                ">
                                                <a class="page-link" href="javascript:void(0)" @click="
                                                setPage(
                                                    pagination.current_page +
                                                    1
                                                )
                                                ">
                                                    <i class="fa-solid fa-angles-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #loader>
            <LoadingBar ref="loading_bar" />
        </template>
    </AppLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { nextTick, ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { onBeforeMount , watch} from "vue";
import axios from "axios";
import LoadingBar from "@/Components/Basic/LoadingBar.vue";
import Multiselect from "vue-multiselect";

import {
    faCheck,
    faHouse, 
    faFloppyDisk,
    faCirclePlus,
    faCloudArrowDown,
    faPrint,
    faWrench,
    faCircleCheck,
    faCircleMinus,
    faTrash,
    faArrowUpFromBracket,
    faXmark,
} from "@fortawesome/free-solid-svg-icons";

library.add(
    faCheck,
    faHouse,
    faFloppyDisk,
    faCirclePlus,
    faCloudArrowDown,
    faPrint,
    faWrench,
    faCircleCheck,
    faCircleMinus,
    faTrash,
    faArrowUpFromBracket,
    faXmark,
);

const status = ref([ 
    { id: 0, status: 'Pending' },
    { id: 1, status: 'Accept' },
    { id: 2, status: 'Reject' } 
]);

const search_status = ref(null);
const loading_bar = ref(null);
const textClassHead = ref("text-start text-uppercase");
const textClassBody = ref("text-start");
const statusClassHead = ref("text-center");
const statusClassBody = ref("text-center");
const iconClassBody = ref("text-right");
const rowClass = ref("cursor-pointer");
const search = ref(null);
const page = ref(1);
const perPage = ref([25, 50, 100]);
const pageCount = ref(25);
const pagination = ref({});
const leave_data = ref({});
const leave_datas = ref([]);
const search_data = ref({});
const validationMessage = ref(null);
const validationErrors = ref({});

onBeforeMount(() => {
    getLeaveData();
    reload();
});

watch(
    () => search_status.value,
    (newX, oldX) => {
        search_data.value.status = newX ? newX.id : null;
        getSearch();
    }
);

const setPage = async (page) => {
    page.value = page;
    reload();
};

const getSearch = async () => {
    page.value = 1;
    reload();
};

const perPageChange = async () => {
    reload();
};

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

const clearFilters = async () => {
    search_data.value = {};
    reload();
};

const reload = async () => {
    nextTick(() => {
        resetValidationErrors();
        loading_bar.value.start();
    });
    try {
        const response = (
            await axios.get(route("allleave.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    "filter[search]": search.value,
                    search_status: search_data.value.status,
                    search_start_date: search_data.value.start_date,
                    search_end_date: search_data.value.end_date,
                    search_user_name: search_data.value.name,
                },
            })
        ).data;
        leave_datas.value = response.data;
        pagination.value = response.meta;
        nextTick(() => {
            loading_bar.value.finish();
        });
    } catch (error) {
        convertValidationNotification(error);
        loading_bar.value.finish();
    }
};

const getLeaveData = async () => {
    nextTick(() => {
        resetValidationErrors();
        loading_bar.value.start();
    });
    try {
        const response = (await axios.get(route("allleave.all"))).data;
        leave_datas.value = response.data;
        pagination.value = response.meta;
        loading_bar.value.finsh();
    } catch (error) {
        convertValidationError(error);
        nextTick(() => {
            loading_bar.value.finish();
        });
    }
};

const deleteLeave = async (id) => {
    loading_bar.value.start();
    resetValidationErrors();
    try {
        loading_bar.value.finish();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202",
            cancelButtonColor: "#6CA925",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(route("allleave.delete", id));
                reload();
                successMessage('Your Leave Record has been deleted.');
            }
        });
    } catch (error) {
        convertValidationNotification(error);
        loading_bar.value.finish();
    }
};

const acceptLeave = async (id) => {
    loading_bar.value.start();
    resetValidationErrors();
    try {
        loading_bar.value.finish();
        Swal.fire({
            title: "Accept Leave.",
            text: "You want to accept the Leave?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202",
            cancelButtonColor: "#6CA925",
            confirmButtonText: "Yes, Accept it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get(route("allleave.acceptLeave", id));
                reload();
                successMessage('Your Accept the leave Record.');
            }
        });
    } catch (error) {
        convertValidationNotification(error);
        loading_bar.value.finish();
    }
}

const rejectLeave = async (id) => {
    loading_bar.value.start();
    resetValidationErrors();
    try {
        loading_bar.value.finish();
        Swal.fire({
            title: "Reject Leave.",
            text: "You want to reject the Leave?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#C00202",
            cancelButtonColor: "#6CA925",
            confirmButtonText: "Yes, Accept it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get(route("allleave.rejectLeave", id));
                reload();
                successMessage('Your Reject the leave Record.');
            }
        });
    } catch (error) {
        convertValidationNotification(error);
        loading_bar.value.finish();
    }
}

</script>

<style lang="scss" scoped></style>
