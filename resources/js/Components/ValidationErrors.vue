<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600 text-center">Whoops! Something went wrong.</div>

        <ul class="mt-1 list-disc list-inside text-sm text-red-600 text-center">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        }
    }
</script>
