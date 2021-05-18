<template>
  <app-layout>
    <div class="mt-4 px-4 sm:px-6 lg:px-8 min-h-screen">
      <!-- This example requires Tailwind CSS v2.0+ -->
      <!--
  Custom select controls like this require a considerable amount of JS to implement from scratch. We're planning
  to build some low-level libraries to make this easier with popular frameworks like React, Vue, and even Alpine.js
  in the near future, but in the mean time we recommend these reference guides when building your implementation:

  https://www.w3.org/TR/wai-aria-practices/#Listbox
  https://www.w3.org/TR/wai-aria-practices/examples/listbox/listbox-collapsible.html
-->
      <div
        class="flex justify-between items-end sticky top-16 p-2 rounded-tl rounded-tr border-b bg-gray-50 z-10"
      >
        <div class="flex items-center">
          <label
            id="listbox-label"
            class="block text-sm font-medium text-gray-700 mr-3 select-none"
          >
            Assigned to
          </label>
          <div class="relative w-36">
            <button
              @click="selected = !selected"
              type="button"
              class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm"
              aria-haspopup="listbox"
              aria-expanded="true"
              aria-labelledby="listbox-label"
            >
              <span class="block truncate"> Tom Cook </span>
              <span
                class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
              >
                <!-- Heroicon name: solid/selector -->
                <svg
                  class="h-5 w-5 text-gray-400"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </span>
            </button>

            <!--
      Select popover, show/hide based on select state.

      Entering: ""
        From: ""
        To: ""
      Leaving: "transition ease-in duration-100"
        From: "opacity-100"
        To: "opacity-0"
    -->
            <ul
              v-if="selected"
              class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-y-auto focus:outline-none sm:text-sm"
              tabindex="-1"
              role="listbox"
              aria-labelledby="listbox-label"
              aria-activedescendant="listbox-option-3"
            >
              <!--
        Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

        Highlighted: "text-white bg-cyan-600", Not Highlighted: "text-gray-900"
      -->
              <li
                @click="selected = !selected"
                v-for="item in 6"
                :key="item"
                class="text-gray-900 cursor-default select-none relative py-2 pl-8 pr-4"
                id="listbox-option-0"
                role="option"
              >
                <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                <span class="font-normal block truncate"> Wade Cooper </span>

                <!--
          Checkmark, only display for selected option.

          Highlighted: "text-white", Not Highlighted: "text-cyan-600"
        -->
                <span
                  class="text-cyan-600 absolute inset-y-0 left-0 flex items-center pl-1.5"
                >
                  <!-- Heroicon name: solid/check -->
                  <svg
                    class="h-5 w-5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </span>
              </li>

              <!-- More items... -->
            </ul>
          </div>
        </div>

        <!-- Filter -->
        <div>
          <div class="flex rounded-md shadow-sm">
            <div
              class="relative flex items-stretch flex-grow focus-within:z-10"
            >
              <input
                type="text"
                name="search"
                id="search"
                class="focus:ring-cyan-500 focus:border-cyan-500 block w-full rounded-none rounded-l-md pl-3 sm:text-sm border-gray-300"
                placeholder="John Doe"
              />
            </div>
            <button
              class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm text-gray-500 hover:text-white font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition duration-500 select-none"
            >
              <!-- Heroicon name: solid/sort-ascending -->
              <svg
                class="h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
              >
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
              <span>Filter</span>
            </button>
          </div>
        </div>

        <inertia-link
          href="/"
          class="bg-gray-50 hover:bg-cyan-500 rounded py-1 px-3 text-cyan-900 hover:text-white transition duration-500 border border-cyan-400 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 select-none"
          >Back</inertia-link
        >
      </div>
      <!-- Employee Table -->
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="shadow overflow-hidden border-b border-gray-200 sm:rounded-bl sm:rounded-br"
            >
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Avatar
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      User Id
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Offical Name
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Nick Name
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Location Id
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      IC Number
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Citizenship
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Action</span>
                      <span class="flex items-center">
                        <label
                          for="select-all"
                          class="text-xs font-medium text-gray-500 uppercase"
                          >Access</label
                        >
                      </span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr
                    :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                    v-for="(item, index) in 20"
                    :key="index"
                  >
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                      <img
                        class="h-8 w-8 mx-auto rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=GyX6XNR4mP&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt=""
                      />
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm text-gray-500"
                    >
                      34443
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm text-gray-500"
                    >
                      Abu Hanifa Jobbar
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm text-gray-500"
                    >
                      Jobbar
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm text-gray-500"
                    >
                      Malaysia
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm text-gray-500"
                    >
                      23
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap text-sm text-gray-500"
                    >
                      Malay
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap flex"
                    >
                      <span class="flex items-center mr-2">
                        <input
                          id="select-all"
                          type="checkbox"
                          name="select-all"
                          class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                        />
                        <label
                          for="select-all"
                          class="text-xs font-medium text-gray-500"
                          >A</label
                        >
                      </span>
                      <span class="flex items-center mr-2">
                        <input
                          id="select-all"
                          type="checkbox"
                          name="select-all"
                          class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                        />
                        <label
                          for="select-all"
                          class="text-xs font-medium text-gray-500"
                          >B</label
                        >
                      </span>
                      <span class="flex items-center mr-2">
                        <input
                          id="select-all"
                          type="checkbox"
                          name="select-all"
                          class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                        />
                        <label
                          for="select-all"
                          class="text-xs font-medium text-gray-500"
                          >C</label
                        >
                      </span>
                      <span class="flex items-center mr-2">
                        <input
                          id="select-all"
                          type="checkbox"
                          name="select-all"
                          class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                        />
                        <label
                          for="select-all"
                          class="text-xs font-medium text-gray-500"
                          >D</label
                        >
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from "../../Layouts/App";
export default {
  components: {
    AppLayout,
  },
  data() {
    return {
      selected: false,
    };
  },
};
</script>