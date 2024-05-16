<template>
    <AppLayout title="User-Management">
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 row align-items-center">
                            <div class="col-lg-6">
                                <h6 class="mb-0 h2 text-dark d-inline-block">
                                    User Data
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link href="/">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <Link :href="route('user.index')" class="breadcrumb-text">
                                            User Management
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            #{{ props.user.name }}
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
            <div class="mt-4 row">
                <div class="col-lg-2 col-md-2">
                    <div class="nav-wrapper-loc">
                        <ul class="nav nav-pills nav-fill flex-column" id="tabs-icons-text" role="tablist">
                            <li class="mb-2 nav-item">
                                <a class="nav-link active" id="user-data-tab" data-toggle="tab" href="#user-data"
                                    role="tab" aria-controls="user-data" aria-selected="true">
                                    User Data</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link active" id="password-update-tab" data-toggle="tab" href="#password-update"
                                    role="tab" aria-controls="password-update" aria-selected="true">
                                    Password Update</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="permission-management-tab" data-toggle="tab" href="#permission-management"
                                    role="tab" aria-controls="permission-management" aria-selected="true">
                                    Permissions</a>
                            </li>
                            <li hidden></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10">
                    <div class="shadow card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="user-data" role="tabpanel">
                                    <UserDataform :userId="props.user.id" />
                                </div>
                                <div class="tab-pane fade show active" id="password-update" role="tabpanel">
                                    <ResetPassword :userId="props.user.id" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script setup>
import UserDataform from "@/Pages/Users/Components/UserDataForm/editForm.vue"
import ResetPassword from "@/Pages/Users/Components/ResetPassword/ResetPassword.vue"
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faHouse } from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    user: {},
})

library.add(faHouse);

</script>

<style lang="scss" scoped>
.breadcrumb-text {
    color: #6343e9 !important;
}

.nav-link.active {
    background-color: #6343e9 !important;
    color: #fff !important;
}
</style>
