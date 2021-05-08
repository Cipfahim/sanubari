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
        <!-- <div class="w-full flex justify-center py-4">
          <div
            class="h-20 w-20 rounded-full border-2 border-dashed border-gray-200 flex items-center justify-center cursor-pointer"
          >
            <PlusCircleIcon class="h-10 w-10 text-gray-300" />
            <input type="file" class="hidden" placeholder="Avatar" />
          </div>
        </div> -->
        <form class="space-y-8 divide-y divide-gray-200">
          <div>
            <div>
              <div class="sm:border-b sm:border-gray-200 pb-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Official Information
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  Star (*) means required!
                </p>
              </div>

              <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="username"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Official Name<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">
                      <input
                        type="text"
                        name="username"
                        id="username"
                        autocomplete="username"
                        class="flex-1 block w-full focus:ring-cyan-500 focus:border-cyan-500 min-w-0 rounded-md sm:text-sm border-gray-300"
                      />
                    </div>
                    <!-- <p class="text-xs text-gray-400 mt-1 block">Required</p> -->
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="first_name"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Nick Name<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex shadow-sm">
                      <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        autocomplete="given-name"
                        class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Location<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex justify-space-between">
                      <select
                        id="country"
                        name="country"
                        autocomplete="country"
                        class="focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      >
                        <option>Select one</option>
                        <option>Location - 1</option>
                        <option>Location - 2</option>
                        <option>Location - 3</option>
                        <option>Location - 4</option>
                      </select>
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
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Date of Join<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div
                      class="max-w-lg shadow-sm relative flex items-stretch flex-grow focus-within:z-10"
                    >
                      <input
                        type="text"
                        name="join-date"
                        id="join-date"
                        class="focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-none rounded-tl-md rounded-bl-md focus:z-10 sm:text-sm border-gray-300"
                        placeholder="DD / MM / YY"
                      />
                      <button
                        class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500"
                      >
                        <CalendarIcon
                          class="h-5 w-5 text-cyan-400"
                          aria-hidden="true"
                        />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

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
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="first_name"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Sex<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="flex">
                      <div class="flex items-center mr-10">
                        <input
                          id="push_everything"
                          name="push_notifications"
                          type="radio"
                          class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300"
                        />
                        <label
                          for="push_everything"
                          class="ml-3 block text-sm font-medium text-gray-700"
                        >
                          Male
                        </label>
                      </div>
                      <div class="flex items-center">
                        <input
                          id="push_email"
                          name="push_notifications"
                          type="radio"
                          class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300"
                        />
                        <label
                          for="push_email"
                          class="ml-3 block text-sm font-medium text-gray-700"
                        >
                          Female
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Date of Birth<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div
                      class="max-w-lg shadow-sm relative flex items-stretch flex-grow focus-within:z-10"
                    >
                      <input
                        type="date"
                        class="text-gray-600 focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-none rounded-tl-md rounded-bl-md focus:z-10 sm:text-sm border-gray-300"
                        placeholder="DD / MM / YY"
                      />
                      <!-- <button
                        class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500"
                      >
                        <CalendarIcon
                          class="h-5 w-5 text-cyan-400"
                          aria-hidden="true"
                        />
                      </button> -->
                    </div>
                  </div>
                </div>

                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="email"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Citizenship<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="max-w-lg flex">
                      <div class="flex items-center mr-10">
                        <input
                          id="push_everything"
                          name="push_notifications"
                          type="radio"
                          class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300"
                        />
                        <label
                          for="push_everything"
                          class="ml-3 block text-sm font-medium text-gray-700"
                        >
                          Malaysian
                        </label>
                      </div>
                      <div class="flex items-center">
                        <input
                          id="push_email"
                          name="push_notifications"
                          type="radio"
                          class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300"
                        />
                        <label
                          for="push_email"
                          class="ml-3 block text-sm font-medium text-gray-700"
                        >
                          Foriegn
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Country of Birth<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select
                      id="country"
                      name="country"
                      autocomplete="country"
                      class="max-w-lg block focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    >
                      <option>Select one</option>
                      <option>Malaysian</option>
                      <option>Canadian</option>
                      <option>Mexican</option>
                    </select>
                  </div>
                </div>

                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="street_address"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Street of Birth<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input
                      type="text"
                      name="street_address"
                      id="street_address"
                      autocomplete="street-address"
                      class="block max-w-lg w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm border-gray-300 rounded-md"
                    />
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="state"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Identity Card (IC) Number<span class="text-blue-600">
                      *</span
                    >
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input
                      type="text"
                      name="state"
                      id="state"
                      class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm border-gray-300 rounded-md"
                    />
                  </div>
                </div>

                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="city"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Passport Number<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input
                      type="text"
                      name="city"
                      id="city"
                      class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm border-gray-300 rounded-md"
                    />
                  </div>
                </div>
              </div>
            </div>

            <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
              <div class="sm:border-b sm:border-gray-200 pb-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Bank Details
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  This section contains sensitive information.
                </p>
              </div>
              <div class="space-y-6 sm:space-y-5">
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Bank Name<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select
                      id="bank"
                      name="bank"
                      autocomplete="bank"
                      class="max-w-lg block focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    >
                      <option>Select one</option>
                      <option>AFFIN BANK</option>
                      <option>AMBANK BERHAD</option>
                      <option>RHB BANK BERHAD</option>
                    </select>
                  </div>
                </div>
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Account No<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div
                      class="max-w-lg shadow-sm relative flex items-stretch flex-grow focus-within:z-10"
                    >
                      <input
                        type="tel"
                        v-mask="'#####-####-####-####'"
                        class="focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-md focus:z-10 sm:text-sm border-gray-300"
                        placeholder="##### - #### - #### - ####"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
              <div class="sm:border-b sm:border-gray-200 pb-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Annual Leave
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  How many days dose an emplyee have in total for one year.
                </p>
              </div>
              <div class="space-y-6 sm:space-y-5">
                <div
                  class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                >
                  <label
                    for="country"
                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Quota<span class="text-blue-600"> *</span>
                  </label>
                  <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div
                      class="max-w-lg shadow-sm relative flex items-stretch flex-grow focus-within:z-10"
                    >
                      <input
                        type="number"
                        name="join-date"
                        id="join-date"
                        class="focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-md focus:z-10 sm:text-sm border-gray-300"
                        placeholder="Days"
                      />
                    </div>
                  </div>
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
                      <button
                        type="button"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                      >
                        Cancel
                      </button>
                      <inertia-link
                        href="/contact-details"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                      >
                        Next
                      </inertia-link>
                    </div>
                  </div>
                </div>
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
import {
  CheckCircleIcon,
  OfficeBuildingIcon,
  CashIcon,
  ChevronRightIcon,
  CheckIcon,
  CalendarIcon,
  PlusCircleIcon,
} from "@heroicons/vue/solid";
import { ScaleIcon } from "@heroicons/vue/outline/esm";
import { mask } from "vue-the-mask";

const cards = [
  { name: "Account balance", href: "#", icon: ScaleIcon, amount: "$30,659.45" },
  // More items...
];
const transactions = [
  {
    id: 1,
    name: "Payment to Molly Sanders",
    href: "#",
    amount: "$20,000",
    currency: "USD",
    status: "success",
    date: "July 11, 2020",
    datetime: "2020-07-11",
  },
  // More transactions...
];
const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};

const steps = [
  { id: "A", name: "Employee Details", href: "#", status: "current" },
  { id: "B", name: "Contact Details", href: "#", status: "upcoming" },
  { id: "C", name: "Contribution", href: "#", status: "upcoming" },
  { id: "D", name: "Salary Details", href: "#", status: "upcoming" },
];
export default {
  components: {
    AppLayout,
    OfficeBuildingIcon,
    CheckCircleIcon,
    CashIcon,
    ChevronRightIcon,
    CheckIcon,
    CalendarIcon,
    PlusCircleIcon,
  },
  directives: { mask },
  setup() {
    return {
      cards,
      transactions,
      statusStyles,
      steps,
    };
  },
};
</script>
