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
            name: 'Contact Details',
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
        <!-- Tab for Mobile -->
        <div class="sm:hidden">
          <label for="tabs" class="sr-only">Select a tab</label>
          <select
            id="tabs"
            name="tabs"
            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm rounded-md"
          >
            <option>Contact Number</option>

            <option>Personal Email</option>

            <option selected>Contact Address</option>
          </select>
        </div>
        <!-- Tab for Desktop -->
        <div class="hidden sm:block">
          <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
              <!-- Current: "border-cyan-500 text-cyan-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200" -->
              <a
                href="#"
                
                class="border-cyan-500 text-cyan-600 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"
              >
                Contact Number

                <!-- Current: "bg-cyan-100 text-cyan-600", Default: "bg-gray-100 text-gray-900" -->
                <span
                  class="bg-cyan-100 text-cyan-600 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                  >2</span
                >
              </a>

              <a
                href="#"
                class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"
              >
                Personal Email

                <span
                  class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                  >3</span
                >
              </a>

              <a
                href="#"
                class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"
                aria-current="page"
              >
                Contact Address

                
                <span
                  class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block"
                  >5</span
                >
              </a>
            </nav>
          </div>
        </div>
        <!-- Personal Phone -->
        <div class="mt-4">
          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
            <label
              class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
            >
              Contact Number<span class="text-blue-600"> *</span>
            </label>

            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="max-w-lg flex justify-space-between">
                <vue-tel-input
                  v-model="phone"
                  mode="international"
                  class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                >
                </vue-tel-input>

                <button
                  type="button"
                  class="ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                >
                  <TrashIcon class="h-5 w-5 text-red-400 mr-2" />
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Personal Email -->
        <div class="mt-4">
          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
            <label
              class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
            >
              Contact Email<span class="text-blue-600"> *</span>
            </label>

            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="max-w-lg flex justify-space-between">
                <input
                  type="email"
                  class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md"
                />

                <button
                  type="button"
                  class="ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                >
                  <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2" />
                  Add
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Address -->
        <div class="mt-4">
          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
            <label
              class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
            >
              Contact Address<span class="text-blue-600"> *</span>
            </label>

            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="max-w-lg flex justify-space-between">
                <input
                  type="email"
                  class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md"
                />

                <button
                  type="button"
                  class="ml-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
                >
                  <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2" />
                  Add
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
  TrashIcon,
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
    TrashIcon,
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
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("employees.update", this.employee.id));
    },
  },
};
</script>
