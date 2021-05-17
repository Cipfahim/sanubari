<template>
  <div class="min-h-screen bg-white flex">
    <div
      class="flex-1 flex flex-col justify-center py-6 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-gradient-to-r from-green-200 to-blue-300"
    >
      <slot />
    </div>
    <div class="hidden lg:block relative flex-1">
      <img
        class="absolute inset-0 h-full w-full object-cover"
        src="http://www.sanubarisecurity.com/wp-content/uploads/2012/01/slide-1.jpg"
        alt=""
      />
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