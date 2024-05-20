<template>
    <div class="app">
        <Head :title="title ? title : 'Leave Management System'">
            <link rel="icon" type="image/svg+xml" href="/img/logo/logoN.png" />
            <slot name="meta_head" />
        </Head>
        <SideBar />
        <div class="main-content" id="panel">
            <NavBar />
            <slot name="header" />
            <div class="container-fluid mt--6">
                <slot name="content" />
            </div>
        </div>
        <slot name="modals" />
        <slot name="loader" />
        <Footer />
    </div>
</template>

<script setup>

import { Head } from '@inertiajs/vue3';
import SideBar from "@/Components/Main/SideBar.vue";
import NavBar from "@/Components/Main/NavBar.vue";
import Footer from "@/Components/Main/Footer.vue";

const props = defineProps({
    title: String,
});
</script>

<style lang="scss">
body {
    background-image: url("@/../src/img/banner/bg.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100%;
}

.main-content {
    min-height: 95vh;
}

.bg-header {
    background-color: #55699f;
}

.table-responsive {
    overflow: auto;
}
</style>
