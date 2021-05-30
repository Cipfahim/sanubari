<template>
  <app-layout>
    <!-- Start::Stepper -->
    <div class="mt-4 px-4 sm:px-6 lg:px-8">
      <top-bar
        :steps="[
          {
            id: 'A',
            name: 'Employee Details',
            href: route('employees.edit', employee.id),
            status: true,
          },
          {
            id: 'B',
            name: 'Identification Details',
            href: route('employees.identification.index', employee.id),
            status: true,
          },
          {
            id: 'C',
            name: 'Contact Details (TODO)',
            href: route('employees.contact-details.index', employee.id),
            status: true,
            current: true,
          },
          {
            id: 'D',
            name: 'Contribution',
            href: route('employees.contributions.index', employee.id),
            status: true,
          },
          {
            id: 'E',
            name: 'Salary Details',
            href: route('employees.salary-details.index', employee.id),
            status: true,
          },
          {
            id: 'F',
            name: 'Annual Leave',
            href: route('employees.annual-leave.index', employee.id),
            status: true,
          },
        ]"
      />
      <div class="bg-gray-50 p-4 rounded-md mt-5">

        <!-- Tab for Desktop & mobile -->
        <div class="block sm:block overflow-x-scroll scrollbar-hide">
          <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-6 sm:space-x-8" aria-label="Tabs">
              <!-- Current: "border-cyan-500 text-cyan-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200" -->
              <button
                type="button"
                @click="toggleTabs(1)"
                :class="{
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200':
                    openTab !== 1,
                  'border-cyan-500 text-cyan-600': openTab === 1,
                }"
                class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
              >
                Contact Number

                <!-- Current: "bg-cyan-100 text-cyan-600", Default: "bg-gray-100 text-gray-900" -->
                <span
                  class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                  :class="{
                    'bg-gray-100 text-gray-900 ': openTab !== 1,
                    'bg-cyan-100 text-cyan-600 ': openTab === 1,
                  }"
                  >2</span
                >
              </button>

              <button
                type="button"
                @click="toggleTabs(2)"
                :class="{
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200':
                    openTab !== 2,
                  'border-cyan-500 text-cyan-600': openTab === 2,
                }"
                class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
              >
                Personal Email

                <span
                  class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                  :class="{
                    'bg-gray-100 text-gray-900 ': openTab !== 2,
                    'bg-cyan-100 text-cyan-600 ': openTab === 2,
                  }"
                  >3</span
                >
              </button>

              <button
                type="button"
                @click="toggleTabs(3)"
                :class="{
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200':
                    openTab !== 3,
                  'border-cyan-500 text-cyan-600': openTab === 3,
                }"
                class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                aria-current="page"
              >
                Contact Address

                <span
                  class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                  :class="{
                    'bg-gray-100 text-gray-900 ': openTab !== 3,
                    'bg-cyan-100 text-cyan-600 ': openTab === 3,
                  }"
                  >5</span
                >
              </button>
            </nav>
          </div>
        </div>
        <!-- Personal Phone -->
        <div
          class="mt-4 h-full sm:h-96"
          :class="{ hidden: openTab !== 1, block: openTab === 1 }"
        >
          <!-- <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"> -->
          <div class="w-full sm:w-3/6 mx-auto sm:pt-2 sm:px-3">
            <div class="flex items-center justify-between mb-3">
              <label class="text-base font-medium text-gray-700 sm:mt-px sm:pt-2">
                Contact Number<span class="text-blue-600"> *</span>
              </label>

              <button
                  type="button"
                  class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                >
                  <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2" />
                  Add
                </button>
            </div>

            <div class="mt-1 sm:mt-0">
              <vue-tel-input
                  v-model="phone"
                  mode="international"
                  class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
              >
              </vue-tel-input>

              <div class="relative">
                <vue-tel-input
                  v-model="phone"
                  mode="international"
                  class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                >
                </vue-tel-input>
                <button class="absolute right-2 top-2 text-red-500 hover:bg-gray-200 rounded-full h-7 w-7 text-center">
                  <XIcon class="h-5 w-5 text-red-400 mx-auto" />
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Personal Email -->
        <div
          class="mt-4 h-full sm:h-96"
          :class="{ hidden: openTab !== 2, block: openTab === 2 }"
        >
          <div class="w-full sm:w-3/6 mx-auto sm:pt-2 sm:px-3">
            <div class="flex items-center justify-between mb-3">
              <label class="text-base font-medium text-gray-700 sm:mt-px sm:pt-2">
                Contact Email<span class="text-blue-600"> *</span>
              </label>

              <button
                  type="button"
                  class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                >
                  <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2" />
                  Add
                </button>
            </div>

            <div class="mt-1 sm:mt-0">
              <input
                  type="email"
                  class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md mb-3"
                />

              <div class="relative">
                <input
                  type="email"
                  class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md mb-3"
                />
                <button class="absolute right-2 top-1.5 text-red-500 hover:bg-gray-200 rounded-full h-7 w-7 text-center">
                  <XIcon class="h-5 w-5 text-red-400 mx-auto" />
                </button>
              </div>
            </div>
          </div>

        </div>
        <!-- Address -->
        <div
          class="mt-4 h-full sm:h-96"
          :class="{ hidden: openTab !== 3, block: openTab === 3 }"
        >
          <div class="w-full sm:w-3/6 mx-auto sm:pt-2 sm:px-3">
            <div class="flex items-center justify-between mb-3">
              <label class="text-base font-medium text-gray-700 sm:mt-px sm:pt-2">
                Contact Address<span class="text-blue-600"> *</span>
              </label>

              <button
                  type="button"
                  class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                >
                  <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2" />
                  Add
                </button>
            </div>

            <div class="mt-1 sm:mt-0">
              <input
                  type="email"
                  class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md mb-3"
                />

              <div class="relative">
                <input
                  type="email"
                  class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md mb-3"
                />
                <button class="absolute right-2 top-1.5 text-red-500 hover:bg-gray-200 rounded-full h-7 w-7 text-center">
                  <XIcon class="h-5 w-5 text-red-400 mx-auto" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End::Stepper -->
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/App";
import TopBar from "./TopBar";

import {
  CalendarIcon,
  CashIcon,
  CheckCircleIcon,
  CheckIcon,
  ChevronRightIcon,
  OfficeBuildingIcon,
  PlusCircleIcon,
  XIcon,
} from "@heroicons/vue/solid";
import { mask } from "vue-the-mask";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "../../Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import { VueTelInput } from "vue3-tel-input";
import "vue3-tel-input/dist/vue3-tel-input.css";

export default {
  props: {
    locations: Array,
    employee: Object,
  },
  components: {
    Input,
    TopBar,
    AppLayout,
    OfficeBuildingIcon,
    CheckCircleIcon,
    CashIcon,
    ChevronRightIcon,
    CheckIcon,
    CalendarIcon,
    PlusCircleIcon,
    XIcon,
    JetFormSection,
    JetSecondaryButton,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
    JetButton,
    JetCheckbox,
    VueTelInput,
  },
  directives: { mask },
  data() {
    return {
      form: this.$inertia.form(
        {
          _method: "PUT",
          phone: this.employee.user.phone,
          password: null,
        },
        {
          resetOnSuccess: true,
        }
      ),
      openTab: 1,
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("employees.update", this.employee.id));
    },
    toggleTabs(tabNumber) {
      this.openTab = tabNumber;
    },
  },
};
</script>
