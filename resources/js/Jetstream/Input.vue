<template>
    <input class="h-10 focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-md sm:text-sm border-gray-300" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

