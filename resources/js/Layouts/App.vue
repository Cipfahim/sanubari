<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <sidebar ref="sidebar"/>
        <div class="flex-1 overflow-auto focus:outline-none">
            <app-header @toggleSidebar="changeSidebarState"/>
            <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
                <slot/>
            </main>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Partials/Sidebar";
import AppHeader from "./Partials/Header";

export default {
    components: {
        AppHeader,
        Sidebar,
    },
    methods: {
        changeSidebarState() {
            this.$refs.sidebar.sidebarOpen = !this.$refs.sidebar.sidebarOpen
        }
    }
}
</script>
