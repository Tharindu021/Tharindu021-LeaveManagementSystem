<template>
    <AppLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">
                                    Users
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                            <font-awesome-icon icon="fa-solid fa-users" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            User Management
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-4 text-right">
                                <a href="javascript:void(0)" @click.prevent="newUser"
                                    class="btn btn-sm btn-neutral float-end">
                                    <font-awesome-icon icon="fa-solid fa-circle-plus" />
                                    ADD NEW
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
                        <div class="row my-4 mx-2">
                            <div class="col-md-3 column__right___padding">
                                <div for="purchase_uom" class="col-form-label">
                                    NAME
                                </div>
                                <input type="text" class="form-control form-control-sm" name="code" id="code"
                                    v-model="search" placeholder="Name" @keyup="getSearch" />
                            </div>
                            <!-- <div class="col-md-2 column__left___padding column__right___padding">
                                <div for="purchase_uom" class="col-form-label">
                                    USER TYPE
                                </div>
                                <Multiselect v-model="select_search_type" :options="types" class="z__index"
                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                    :searchable="true" placeholder="User Type" label="user_type" track-by="id" />
                            </div> -->
                            <!-- <div class="col-md-3 column__left___padding column__right___padding">
                                <div for="purchase_uom" class="col-form-label">
                                    STATUS
                                </div>
                                <Multiselect v-model="select_search_status" :options="status" class="z__index"
                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                    :searchable="true" placeholder="Select Status" label="status" track-by="id" />
                            </div> -->
                            <div class="col-md-2 mt-4 column__left___padding">
                                <a href="javascript:void(0)" @click.prevent="clearFilters"
                                    class="btn btn-sm btn-ash float-end mt-2 pt-2">
                                    CLEAR
                                </a>
                            </div>
                            <div class="text-muted ml-auto mx-4 mt-4">
                                <div class="inline-block">
                                    <select class="form-control form-control-sm per-page-entry mt-2" :value="100"
                                        v-model="pageCount" @change="perPageChange" name="PageData" id="pageData">
                                        <option v-for="perPageCount in perPage" :key="perPageCount"
                                            :value="perPageCount" v-text="perPageCount" />
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th :class="textClassHead">
                                                Name
                                            </th>
                                            <th :class="textClassHead">
                                                Email
                                            </th>
                                            <th :class="textClassHead">User Name</th>
                                            <th :class="textClassHead">
                                                Contact Number
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users" :key="user.id" :class="rowClass"  @click.prevent="editUser(user.id)">
                                            <td :class="textClassBody">
                                                {{ user.name }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ user.email }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ user.username }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ user.telephone }}
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
                                                        <a class="page-link" @click="setPage(page)">{{ page }}
                                                        </a>
                                                    </li>
                                                </template>
                                            </template>
                                            <li class="page-item" :class="pagination.current_page ==
                                                    pagination.last_page
                                                    ? 'disabled'
                                                    : ''">
                                                <a class="page-link" href="javascript:void(0)" @click="
                                                setPage(
                                                    pagination.current_page +
                                                    1
                                                )">
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
            <div class="modal fade" id="newUserModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newUserModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_UserLabel">
                                ADD USER
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
                                    <form role="form text-left" @submit.prevent="createUser"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label col-form-label">
                                                NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    v-model="user.name" id="name" placeholder="Name" required />
                                                <small v-if="validationErrors.message
                                                " id="msg_code" class="text-danger form-text text-error-msg error">
                                                    {{
                                                validationErrors.message
                                            }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="emai" class="col-md-3 col-form-label col-form-label">
                                                EMAIL
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control form-control-sm" name="email"
                                                    v-model="user.email" id="email" placeholder="Email" required />
                                                <small v-if="validationErrors.message
                                                " id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                validationErrors.message
                                            }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="password" class="col-md-3 col-form-label col-form-label">
                                                PASSWORD
                                            </div>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control form-control-sm" name="password"
                                                    v-model="user.password" id="password" placeholder="Password" required />
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
                                                CREATE
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
import { reactive, nextTick, ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { onBeforeMount, watch } from "vue";
import axios from "axios";
import Multiselect from "vue-multiselect";
import {
    faUsers,
    faHouse,
    faFloppyDisk,
    faCirclePlus,
    faClone,
    faCloudArrowDown,
    faPrint,
    faWrench,
    faArrowUpFromBracket,
    faXmark,
    faPen,
} from "@fortawesome/free-solid-svg-icons";

library.add(
    faUsers,
    faHouse,
    faFloppyDisk,
    faCirclePlus,
    faClone,
    faCloudArrowDown,
    faPrint,
    faWrench,
    faArrowUpFromBracket,
    faXmark,
    faPen
);

const loading_bar = ref(null);
const textClassHead = ref("text-start text-uppercase");
const textClassBody = ref("text-start");
const rowClass = ref("cursor-pointer");
const search = ref(null);
const page = ref(1);
const perPage = ref([25, 50, 100]);
const pageCount = ref(25);
const pagination = ref({});
const select_search_type = ref(null);
const select_search_status = ref(null);
const select_type = ref(null);
const select_status = ref(null);
const user = ref({});
const users = ref([]);
const validationErrors = ref({});

onBeforeMount(() => {
    getUserData();
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
    validationErrors.message = error.message;
};

const clearFilters = async () => {
    search.value = null;
    reload();
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("user.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    "filter[search]": search.value,
                },
            })
        ).data;
        users.value = response.data;
        pagination.value = response.meta;
    } catch (error) {
        console.log("Error reloading users data:", error);
    }
};


const getUserData = async () => {
    try {
        const response = (await axios.get(route("user.all"))).data;
        users.value = response.data;
        pagination.value = response.meta;
    } catch (error) {
        console.log("Error fetching users data:", error);
    }
};

const createUser = async () => {
    resetValidationErrors();
    try {
        await axios.post(route("user.store"), user.value)
        $("#newUserModal").modal("hide");
        user.value = {};
        reload();
    } catch (error) {
        convertValidationNotification(error);
    }
};

const editUser = async (id) => {
    window.location.href = route("user.edit", id);
};

const newUser = () => {
    user.value = {};
    $("#newUserModal").modal("show");
};

</script>

<style lang="scss" scoped></style>
