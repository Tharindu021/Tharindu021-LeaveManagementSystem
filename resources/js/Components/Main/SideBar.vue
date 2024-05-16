<template>
    <nav
        class="bg-white sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light"
        id="sidenav-main"
    >
        <div class="scrollbar-inner">
            <div class="mb-4 text-center sidenav-header">
                <Link class="navbar-brand" :href="route('dashboard')">
                    <img
                        :src="'img/logo/iMake-Indigo.png'"
                        alt="iMake"
                        class="home-logo mt-1"
                        height="150"
                    />
                </Link>
            </div>
            <br />
            <div class="mt-5 navbar-inner">
                <div
                    class="collapse navbar-collapse sidebar_menu"
                    id="sidenav-collapse-main"
                >
                    <ul class="mb-3 navbar-nav">
                        <li class="nav-item">
                            <Link
                                :class="{
                                    active: route().current() == 'dashboard',
                                }"
                                class="nav-link active-preloader"
                                :href="route('dashboard')">
                                <font-awesome-icon icon="fa-solid fa-desktop" />
                                <span class="ml-2 font-weight-400"
                                    >Dashboard</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { reactive } from "vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faDesktop,
    faGear,
    faLayerGroup,
    faFolder,
    faBuilding,
} from "@fortawesome/free-solid-svg-icons";

const data = reactive({
    materialTypes: [],
});

library.add(faDesktop, faLayerGroup, faFolder, faGear, faBuilding);
</script>

<style lang="css">
.sidenav {
    width: 250px; /* Adjust the width as needed */
    height: 100%; /* Set the height to fill the viewport */
    overflow-y: auto; /* Make the sidebar scrollable */
}

.navbar-vertical .navbar-brand-img,
.navbar-vertical .navbar-brand > img {
    max-width: 100%;
    max-height: none;
    margin-top: -60px;
    margin-left: -10px;
}

.navbar-vertical.navbar-expand-xs .navbar-collapse {
    margin-top: -50px;
}
</style>
