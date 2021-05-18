<template>
  <div class="min-h-screen  bg-gradient-to-r from-green-200 to-blue-300">
    <div
      class="flex justify-center items-center py-4 sm:py-16 px-4 sm:px-6 lg:px-20 xl:px-24"
    >
      <slot />
    </div>
  </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";

export default {
  components: {
    BreezeApplicationLogo,
  },
};
</script>