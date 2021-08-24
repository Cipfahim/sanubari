<template>
    <label class="mb-1 block font-medium text-sm text-gray-700 select-none">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
