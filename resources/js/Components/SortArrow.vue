<template>
    <span v-if="sort === field"> ↑ </span>
    <span v-else-if="sort === '-'+field"> ↓ </span>
    <span v-else>↑↓</span>
</template>

<script>
export default {
    props: ['sort', "field"]
}
</script>
