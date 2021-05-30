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
            current: true,
          },
          {
            id: 'C',
            name: 'Contact Details',
            href: route('employees.contact-details.index', employee.id),
            status: true,
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
                    Identification Details
                  </h3>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    This section contains sensitive information.
                  </p>
                </div>

                <div class="space-y-6 sm:space-y-5">
                  <!-- Citizenship field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="citizenship" value="Citizenship *" />
                    <Switch
                      v-model="enabledCountry"
                      :class="enabledCountry ? 'bg-cyan-900' : 'bg-cyan-700'"
                      class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                    >
                      <span
                        aria-hidden="true"
                        :class="enabledCountry ? 'translate-x-20' : 'translate-x-0'"
                        class="flex items-center justify-center pointer-events-none h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200"
                      >                         
                        <span v-if="enabledCountry" class="text-cyan-900">Foreigner</span>
                        <span v-else  class="text-cyan-900">Malaysian</span>
                      </span>
                    </Switch>
                    <jet-input-error
                      :message="form.errors.citizenship"
                      class="mt-2"
                    />
                  </div>
                  <!-- Identity Card field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="identity" value="Identity Card (IC) Number *" />
                    <jet-input
                      id="identity"
                      type="text"
                      :class="{ 'border-red-500': form.errors.identity }"
                    />
                    <jet-input-error
                      :message="form.errors.identity"
                      class="mt-2"
                    />
                  </div>
                
                  <!-- Passport Numbrt field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="passport" value="Passport Number *" />
                    <jet-input
                      id="passport"
                      type="text"
                      :class="{ 'border-red-500': form.errors.passport }"
                    />
                    <jet-input-error
                      :message="form.errors.passport"
                      class="mt-2"
                    />
                  </div>

                  <!-- Date of birth field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="dob" value="Date of Birth *" />
                    <jet-input
                      id="dob"
                      type="text"
                      :class="{ 'border-red-500': form.errors.dob }"
                    />
                    <jet-input-error
                      :message="form.errors.dob"
                      class="mt-2"
                    />
                  </div>
                  <!-- Country of birth field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="cob" value="Country of Birth *" />
                    <jet-input
                      id="cob"
                      type="text"
                      :class="{ 'border-red-500': form.errors.cob }"
                    />
                    <jet-input-error
                      :message="form.errors.cob"
                      class="mt-2"
                    />
                  </div>
                  <!-- State of birth field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="sob" value="State of Birth *" />
                    <jet-input
                      id="sob"
                      type="text"
                      :class="{ 'border-red-500': form.errors.sob }"
                    />
                    <jet-input-error
                      :message="form.errors.sob"
                      class="mt-2"
                    />
                  </div>
                  <!-- Citizenship field-->
                  <div
                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                  >
                    <jet-label for="gender" value="Sex *" />
                    <Switch
                      v-model="enabledGender"
                      :class="enabledGender ? 'bg-cyan-900' : 'bg-cyan-700'"
                      class="relative inline-flex flex-shrink-0 h-[38px] w-[174px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                    >
                      <span
                        aria-hidden="true"
                        :class="enabledGender ? 'translate-x-20' : 'translate-x-0'"
                        class="flex items-center justify-center pointer-events-none h-[34px] w-[90px] rounded-full bg-white shadow-sm transform ring-0 transition ease-in-out duration-200"
                      >                         
                        <span v-if="enabledGender" class="text-cyan-900">Male</span>
                        <span v-else  class="text-cyan-900">Female</span>
                      </span>
                    </Switch>
                    <jet-input-error
                      :message="form.errors.gender"
                      class="mt-2"
                    />
                  </div>
                </div>
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
import { ref } from "vue";
import { Switch } from "@headlessui/vue";

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
    Switch,
  },
  directives: { mask },

  setup() {
    const enabledCountry = ref(false);
    const enabledGender = ref(false);

    return { 
      enabledCountry,
      enabledGender
    };
  },
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
