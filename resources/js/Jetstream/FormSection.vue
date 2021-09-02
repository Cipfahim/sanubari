<template>
  <div class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6">
    <jet-section-title class="mt-5 md:mt-0 col-span-12">
      <template #title><slot name="title"></slot></template>
      <template #description><slot name="description"></slot></template>
    </jet-section-title>

    <div class="mt-5 md:mt-0 md:col-span-12">
      <form @submit.prevent="$emit('submitted')">
        <div
          class="p-4 py-5 bg-white"
          :class="
            hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'
          "
        >
          <div class="grid grid-cols-1">
            <slot name="form"></slot>
          </div>
        </div>

        <div
          class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right shadow sm:rounded-bl-md sm:rounded-br-md"
          v-if="hasActions"
        >
          <slot name="actions"></slot>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import JetSectionTitle from "./SectionTitle";

export default {
  emits: ["submitted"],

  components: {
    JetSectionTitle,
  },

  computed: {
    hasActions() {
      return !!this.$slots.actions;
    },
  },
};
</script>
