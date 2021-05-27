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
      <jet-form-section
        @submitted="submit"
        class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
      >
        <template #form class="md:col-span-12">
          <!-- Strat::Stepper Contents -->
          <div class="bg-gray-50 p-4 rounded-md">
            <div class="space-y-8 divide-y divide-gray-200">
              <!-- Login details-->
              <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
                <div class="sm:border-b sm:border-gray-200 pb-2">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Contact Details
                  </h3>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    This section contains sensitive information.
                  </p>
                </div>

                <div
                  class="mt-4 sm:mt-3 space-y-6 sm:space-y-5 border-b border-gray-200 pb-5"
                  v-for="(n, index) in 2"
                  :key="index"
                >
                  <!-- Start::international Telephone -->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <label
                      class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                    >
                      Contact Number<span class="text-blue-600"> *</span>
                    </label>
                    <div class="mt-1 relative sm:mt-0 sm:col-span-2 max-w-lg">
                      <vue-tel-input
                        v-model="phone"
                        mode="international"
                        class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                      >
                      </vue-tel-input>
                    </div>
                  </div>
                  <!-- End::international Telephone -->
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
                <div class="space-y-6 sm:space-y-5">
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <div class="mt-1 sm:mt-0 sm:col-span-2 sm:col-start-2">
                      <div
                        class="max-w-lg relative flex justify-end items-stretch flex-grow focus-within:z-10"
                      >
                        <inertia-link
                          :href="route('employees.index')"
                          class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                        >
                          Cancel
                        </inertia-link>
                        <button
                          type="submit"
                          class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                        >
                          Save & Continue
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End::Stepper Contents -->
        </template>
      </jet-form-section>
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
import { VueTelInput } from 'vue3-tel-input'
import 'vue3-tel-input/dist/vue3-tel-input.css'

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
    JetFormSection,
    JetSecondaryButton,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
    JetButton,
    JetCheckbox,
    VueTelInput
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
