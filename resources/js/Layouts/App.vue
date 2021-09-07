we<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <sidebar ref="sidebar"/>
        <div class="flex-1 overflow-auto focus:outline-none">
            <app-header @toggleSidebar="changeSidebarState"/>
            <main class="flex-1 relative pb-8 z-0">
                <slot/>
            </main>
        </div>
    </div>
    <notification/>
</template>

<script>
import Sidebar from "./Partials/Sidebar";
import AppHeader from "./Partials/Header";
import Notification from "@/Components/Notification";

export default {
    components: {
        AppHeader,
        Sidebar,
        Notification
    },
    methods: {
        changeSidebarState() {
            this.$refs.sidebar.sidebarOpen = !this.$refs.sidebar.sidebarOpen
        }
    }
}
</script>
