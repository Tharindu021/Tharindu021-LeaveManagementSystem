<template>
    <AppLayout title="My Leaves">
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">
                                    My Leaves
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            My Leaves
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-4 text-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addLeaveModal"
                                    class="btn btn-sm btn-neutral float-end">
                                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                                    ADD LEAVE
                                </a>
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
                                <div class="col-md-3 mx-3 column__right___padding column__left___padding">
                                    <div for="purchase_uom" class="col-form-label">
                                        Start Date
                                    </div>
                                    <input type="date" class="form-control form-control-sm" name="start_date" id="start_date"
                                        v-model="search_data.start_date" placeholder="Start Date" @keyup="getSearch" />
                                 </div>
                                <div class="col-md-3 mx-3 column__right___padding column__left___padding">
                                    <div for="purchase_uom" class="col-form-label">
                                        End Date
                                    </div>
                                    <input type="date" class="form-control form-control-sm" name="end_date" id="end_date"
                                        v-model="search_data.end_date" placeholder="End Date" @keyup="getSearch" />
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
                                            <th :class="textClassHead">Start Date</th>
                                            <th :class="textClassHead">End Date</th>
                                            <th :class="textClassHead">Reason</th>
                                            <th :class="textClassHead">
                                                Status
                                            </th>
                                            <th :class="textClassHead"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="leave_data in leave_datas" :key="leave_data.id" :class="rowClass">
                                            <td :class="textClassBody">
                                                {{ leave_data.start_date }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ leave_data.end_date }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ leave_data.reason }}
                                            </td>
                                            <td>
                                                <span v-if="leave_data.status == 0"
                                                    class="badge bg-danger text-white fw-bold ml-3">Pending</span>
                                                <span v-if="leave_data.status == 1"
                                                    class="badge bg-sucess text-white fw-bold ml-3">Accepted</span>
                                                <span v-if="leave_data.status == 2"
                                                    class="badge bg-warning text-white fw-bold ml-3">Rejected</span>
                                            </td>
                                            <td :class="iconClassBody">
                                                <a type="button" class="p-2 float-end" href="javascript:void(0)"
                                                    @click.prevent="
                                                deleteLeave(leave_data.id)
                                                ">
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
        <template #modals>
            <div class="modal fade" id="addLeaveModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="addLeaveModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_leave">
                                Leave Form
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <font-awesome-icon icon="fa-solid fa-xmark" />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body m-2">
                                    <form role="form text-left" @submit.prevent="createLeave"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="start_date" class="col-md-3 col-form-label col-form-label">
                                                Start Date
                                            </div>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control form-control-sm" name="start_date"
                                                    v-model="leave_data.start_date" id="start_date" placeholder="Start Date" required />
                                                <small v-if="validationErrors.message
                                                " id="msg_code" class="text-danger form-text text-error-msg error">
                                                    {{
                                                validationErrors.message
                                            }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="end_date" class="col-md-3 col-form-label col-form-label">
                                                END DATE
                                            </div>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control form-control-sm" name="end_date"
                                                    v-model="leave_data.end_date" id="end_date" placeholder="End Date" required />
                                                <small v-if="validationErrors.message
                                                " id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                validationErrors.message
                                            }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="reason" class="col-md-3 col-form-label col-form-label">
                                                REASON
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="reason"
                                                    v-model="leave_data.reason" id="reason" placeholder="Reason" required />
                                                <small v-if="validationErrors.message
                                                " id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                validationErrors.message
                                            }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="submit" class="btn btn-round btn-outline--info btn-sm mb-0">
                                                <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                                                Send
                                            </button>
                                        </div>
                                    </form>
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
import { nextTick, reactive, ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { onBeforeMount, watch } from "vue";
import axios from "axios";
import LoadingBar from "@/Components/Basic/LoadingBar.vue";

import {
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


const loading_bar = ref(null);
const textClassHead = ref("text-start text-uppercase");
const textClassBody = ref("text-start");
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
const validationErrors = ref({});

onBeforeMount(() => {
    getLeaveData();
    reload();
});

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
    validationErrors.value = [];
};

const convertValidationNotification = (error) => {
    validationErrors.value.message = error.message;
};

const clearFilters = async () => {
    search_data.value = {};
    reload();
};

const reload = async () => {
    nextTick(() => {
        //loading_bar.value.start();
    });
    try {
        const response = (
            await axios.get(route("myleave.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    "filter[search]": search.value,
                    search_start_date: search_data.value.start_date,
                    search_end_date: search_data.value.end_date,
                },
            })
        ).data;
        leave_datas.value = response.data;
        pagination.value = response.meta;
        nextTick(() => {
            //loading_bar.value.finish();
        });
    } catch (error) {
        console.log("Error reloading leave_data data:", error);
    }
};

const getLeaveData = async () => {
    nextTick(() => {
        //loading_bar.value.start();
    });
    try {
        const response = (await axios.get(route("myleave.all"))).data;
        leave_datas.value = response.data;
        pagination.value = response.meta;
        nextTick(() => {
            //loading_bar.value.finsh();
        });
    } catch (error) {
        console.log("Error fetching leave data:", error);
    }
};

const createLeave = async () => {
    resetValidationErrors();
    try {
        await axios.post(route("myleave.store"), leave_data.value);
        $("#addLeaveModal").modal("hide");
        leave_data.value = {};
        reload();
    } catch (error) {
        convertValidationNotification(error);
    }
};

const deleteLeave = async (id) => {
    console.log(id);
    try {
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
                axios.delete(route("myleave.delete", id));
                reload();
                Swal.fire("Deleted!", `Your Leave Record has been deleted.`, "success");
            }
        });
    } catch (error) {
        convertValidationNotification(error);
    }
};

</script>

<style lang="scss" scoped></style>
