<template>
  <div class="mb-5 flex items-center">
    <template v-for="link in links">
      <template v-if="link.url">
        <inertia-link :href="link.url" class="text-xl text-cyan-700 font-bold"
          >{{ link.title }}
        </inertia-link>
        <p class="text-xl text-gray-400 font-bold mx-2">/</p>
      </template>
      <template v-else>
        <p v-if="link.active" class="text-xl text-gray-700 font-bold">
          {{ link.title }}
        </p>
        <inertia-link v-else href="#" class="text-xl text-cyan-700 font-bold"
          >{{ link.title }}
        </inertia-link>
      </template>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
};
</script>

