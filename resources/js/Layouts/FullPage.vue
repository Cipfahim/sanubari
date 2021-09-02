<template>
    <div>
        <main class="flex-1 relative pb-8 z-0">
            <slot/>
        </main>
    </div>
    <notification/>
</template>

<script>
import Notification from "@/Components/Notification";

export default {
    components: {
        Notification
    },
    methods: {
        changeSidebarState() {
            this.$refs.sidebar.sidebarOpen = !this.$refs.sidebar.sidebarOpen
        }
    }
}
</script>
