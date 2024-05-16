<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 col align-items-center">
                            <h6 class="mb-0 h2 text-dark d-inline-block">Dashboard</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link href="/">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                        Dashboard
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
            
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHouse } from '@fortawesome/free-solid-svg-icons'
import { defineProps } from 'vue';

library.add(faHouse);

</script>

<style lang="scss" scoped>
.breadcrumb-text{
    color: #6343e9 !important;
}
</style>
