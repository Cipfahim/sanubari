<template>
  <app-layout>
    <!-- Start::Stepper -->
    <div class="mt-4 px-4 sm:px-6 lg:px-8">
      <nav aria-label="Progress">
        <ol
          class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0"
        >
          <li
            v-for="(step, stepIdx) in steps"
            :key="step.name"
            class="relative md:flex-1 md:flex"
          >
            <a
              v-if="step.status === 'complete'"
              :href="step.href"
              class="group flex items-center w-full"
            >
              <span class="px-4 py-3 flex items-center text-sm font-medium">
                <span
                  class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-cyan-600 rounded-full group-hover:bg-green-800"
                >
                  <CheckIcon class="w-5 h-5 text-white" aria-hidden="true" />
                </span>
                <span class="ml-4 text-sm font-medium text-gray-900">{{
                  step.name
                }}</span>
              </span>
            </a>
            <a
              v-else-if="step.status === 'current'"
              :href="step.href"
              class="px-4 py-3 flex items-center text-sm font-medium"
              aria-current="step"
            >
              <span
                class="flex-shrink-0 w-8 h-8 flex items-center justify-center border-2 border-cyan-600 rounded-full"
              >
                <span class="text-cyan-600">{{ step.id }}</span>
              </span>
              <span class="ml-4 text-sm font-medium text-cyan-600">{{
                step.name
              }}</span>
            </a>
            <a v-else :href="step.href" class="group flex items-center">
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
            </a>
            <template v-if="stepIdx !== steps.length - 1">
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
      <!-- Strat::Stepper Contents -->
      <div class="bg-gray-50 p-4 mt-4">
        <form class="space-y-8 divide-y divide-gray-200">
          <div>
            <div>
              <div class="sm:border-b sm:border-gray-200 pb-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Contact Details
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  Star (*) means required!
                </p>
              </div>

              <div
                class="mt-4 sm:mt-3 space-y-6 sm:space-y-5 border-b border-gray-200 pb-5"
                v-for="(n, index) in 2"
                :key="index"
              >
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Contact Number<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">
                      <input
                        type="text"
                        class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Personal E-mail<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">
                      <input
                        type="email"
                        class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label class="block text-sm font-medium text-gray-700"
                    >Contact Address</label
                  >
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <textarea
                      id="message"
                      rows="4"
                      class="py-3 px-4 block w-full sm:max-w-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                    />
                  </div>
                </div>
              </div>
              <button
                type="button"
                class="mx-auto block mt-10 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
              >
                Add Address
              </button>
            </div>

            <div class="pt-5">
              <div class="flex justify-end">
                <inertia-link
                  href="employees"
                  class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                >
                  Previous
                </inertia-link>
                <inertia-link
                  href="/contributions"
                  class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                >
                  Next
                </inertia-link>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- End::Stepper Contents -->
    </div>
    <!-- End::Stepper -->
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/App";
import { CheckIcon } from "@heroicons/vue/solid";

const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};

const steps = [
  { id: "A", name: "Employee Details", href: "#", status: "complete" },
  { id: "B", name: "Contact Details", href: "#", status: "current" },
  { id: "C", name: "Contribution", href: "#", status: "upcoming" },
  { id: "D", name: "Salary Details", href: "#", status: "upcoming" },
];
export default {
  components: {
    AppLayout,
    CheckIcon,
  },
  setup() {
    return {
      statusStyles,
      steps,
    };
  },
};
</script>
