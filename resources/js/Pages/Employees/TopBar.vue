<template>
    <nav aria-label="Progress">
        <ol
            class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0"
        >
            <li
                v-for="(step, index) in steps"
                :key="step.name"
                class="relative md:flex-1 md:flex"
            >

                <inertia-link
                    v-if="step.status"
                    :href="step.href"
                    class="px-4 py-3 flex items-center text-sm font-medium"
                    aria-current="step"
                >
              <span
                  class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full"
                  :class="{'bg-cyan-600 group-hover:bg-green-800':step.current, 'border-2 border-cyan-600':!step.current}"
              >
                <span class="text-cyan-600">{{ step.id }}</span>
              </span>
                    <span class="ml-4 text-sm font-medium text-cyan-600">{{
                            step.name
                        }}</span>
                </inertia-link>

                <span v-else :href="step.href" class="group flex items-center">
                  <span class="px-4 py-3 flex items-center text-sm font-medium">
                    <span
                        class="flex-shrink-0 w-8 h-8 flex items-center justify-center border-2 border-gray-300 rounded-full group-hover:border-gray-400"
                    >
                      <span class="text-gray-500 group-hover:text-gray-900">{{
                              step.id
                          }}</span>
                    </span>
                    <span
                        class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900"
                    >{{ step.name }}</span
                    >
                  </span>
                </span>
                <template v-if="index !== steps.length - 1">
                    <!-- Arrow separator for lg screens and up -->
                    <div
                        class="hidden md:block absolute top-0 right-0 h-full w-5"
                        aria-hidden="true"
                    >
                        <svg
                            class="h-full w-full text-gray-300"
                            viewBox="0 0 22 80"
                            fill="none"
                            preserveAspectRatio="none"
                        >
                            <path
                                d="M0 -2L20 40L0 82"
                                vector-effect="non-scaling-stroke"
                                stroke="currentcolor"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                </template>
            </li>
        </ol>
    </nav>
</template>

<script>
export default {
    props: ['steps'],
}
</script>
