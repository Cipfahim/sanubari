<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8 min-h-screen">
            <div class="flex justify-between items-center sticky top-16 p-2 rounded-tl rounded-tr border-b bg-gray-50 z-10">
                <div class="flex items-center">
                    <label class="block text-lg font-semibold text-gray-800 mr-3 select-none"> Auditor Name </label>
                </div>

                <!-- Location -->
                <div class="flex items-center">
                    <label id="listbox-label" class="block text-sm font-medium text-gray-700 mr-3 select-none"> Select Location </label>
                    <div class="relative w-36">
                        <select @change="employeeList" v-model="locationId" class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                            <option v-for="location in locations" :key="location.id" :value="location.id">
                                {{ location.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Filter -->
                <div>
                    <div class="flex rounded-md shadow-sm">
                        <div class="relative flex items-stretch flex-grow focus-within:z-10">
                            <input type="text" name="search" id="search" class="focus:ring-cyan-500 focus:border-cyan-500 block w-full rounded-none rounded-l-md pl-3 sm:text-sm border-gray-300" placeholder="John Doe" />
                        </div>
                        <button class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm text-gray-500 hover:text-white font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition duration-500 select-none">
                            <!-- Heroicon name: solid/sort-ascending -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>

                <inertia-link :href="route('auditor-access.edit', session.id)" class="bg-gray-50 hover:bg-cyan-500 rounded py-2 px-3 text-cyan-900 hover:text-white transition duration-500 border border-cyan-400 focus:outline-none select-none">Grand Access</inertia-link>
            </div>
            <!-- Employee Table -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-bl sm:rounded-br">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Id</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Offical Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nick Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location Id</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IC Number</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Citizenship</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                            <span class="flex items-center">
                                                <input id="select-all" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500 uppercase">Access all</label>
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Odd row -->
                                    <tr :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'" v-for="(employee, index) in employees.data" :key="employee.id">
                                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <img class="h-8 w-8 mx-auto rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=GyX6XNR4mP&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ employee.id }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ employee.official_name }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ employee.nick_name }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ employee.location }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ employee.ic_number }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ employee.citizenship }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                            <span class="flex items-center">
                                                <input @click="giveAccess(employee.id)" type="checkbox" name="select-all" v-model="employee.check" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">Check</label>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div v-if="paginationLength > 2">
                                <div class="flex flex-wrap -mb-1">
                                    <template v-for="(link, index) in links">
                                        <div v-if="link[0] === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link[0].label" />
                                        <button @click="employeeList(index)" v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{'bg-white': link.active}">
                                            <span v-html="link.label"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "../../Layouts/App"
import Pagination from "../../Components/Pagination"

export default {
    props: {
        session: Object,
        locations: Object,
        locationId: Number,
    },
    components: {
        Pagination,
        AppLayout,
    },
    methods: {
        giveAccess(employee) {
            this.$inertia.post(
                this.route("auditor-access.give-access"),
                {
                    _method: "POST",
                    session: this.session.id,
                    employee: employee,
                    paginationLength: 0,
                    links: Array,
                },
                {
                    onSuccess: (data) => {},
                }
            )
        },
        employeeList(page = 1) {
            var that = this
            axios
                .get(this.route("auditor-access.employee-list"), {
                    params: {
                        session: this.session.id,
                        location: this.locationId,
                        page: page,
                    },
                })
                .then(function (response) {
                    that.employees = response.data
                    that.paginationLength = that.employees.links.length
                    that.links = response.data.links
                })
        },
    },
    data() {
        return {
            selected: false,
            employees: Object,
        }
    },
    mounted() {
        this.employeeList()
    },
}
</script>
