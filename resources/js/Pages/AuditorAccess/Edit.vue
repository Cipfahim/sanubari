<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8 min-h-screen">
            <div class="flex justify-between items-center sticky top-16 p-2 rounded-tl rounded-tr border-b bg-gray-50 z-10">
                <div class="flex items-center">
                    <label id="listbox-label" class="block text-sm font-medium text-gray-700 mr-3 select-none"> Assigned to </label>
                </div>
                <!-- Location -->
                <div class="flex items-center">
                    <label id="listbox-label" class="block text-sm font-medium text-gray-700 mr-3 select-none"> Select Location </label>
                    <div class="relative w-36">
                        <select class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                            <option>demo</option>
                        </select>
                    </div>
                </div>

                <!-- Filter -->
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

                <div class="flex">
                    <inertia-link href="/" class="bg-red-600 hover:bg-red-500 text-white focus:outline-none rounded py-2 px-4 text-white transition duration-500 focus:outline-none focus:ring select-none">Back</inertia-link>
                    <button @click="addMore()" class="py-2 px-4 ml-2 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">Add More</button>
                </div>
            </div>
            <!-- Employee Table -->
            <div class="flex flex-col overflow-hidden">
                <div class="overflow-x-auto">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-bl sm:rounded-br">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Id</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Offical Name</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nick Name</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location Id</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Action</span>
                                        <span class="flex items-center">
                                                <label for="select-all" class="text-xs font-medium text-gray-500 uppercase">Access</label>
                                            </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Odd row -->

                                <tr :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'" v-for="(item, index) in accessedEmployees.data" :key="index">
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <img class="h-8 w-8 mx-auto rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=GyX6XNR4mP&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                        {{ item.employee_id }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                        {{ item.employee.official_name }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                        {{ item.employee.nick_name }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                                        {{ item.employee.location.name }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap block">
                                            <span class="flex items-center mr-2">
                                                <input type="checkbox" v-model="item.employee_details" @click="extraAccess(item.id, !item.employee_details, null, null, null, null, null, null)" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">Employee Details</label>
                                            </span>
                                        <span class="flex items-center mr-2">
                                                <input v-model="item.contact_details" @click="extraAccess(item.id, null, !item.contact_details, null, null, null, null, null)" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">Contact Details</label>
                                            </span>
                                        <span class="flex items-center mr-2">
                                                <input v-model="item.contribution" @click="extraAccess(item.id, null, null, !item.contribution, null, null, null, null)" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label class="text-xs font-medium text-gray-500">Contributions</label>
                                            </span>
                                        <span class="flex items-center mr-2">
                                                <input v-model="item.documents" @click="extraAccess(item.id, null, null, null, null, !item.documents, null, null)" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">Documents</label>
                                            </span>
                                        <span class="flex items-center mr-2">
                                                <input v-model="item.salary_details" @click="extraAccess(item.id, null, null, null,  !item.salary_details, null, null)" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">Salary Details</label>
                                            </span>
                                        <span class="flex items-center mr-2">
                                                <input v-model="item.payslips" @click="extraAccess(item.id, null, null, null, null, null, null, !item.payslips)" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">PaySlips</label>
                                            </span>
                                        <span class="flex items-center mr-2">
                                                <input v-model="item.leave" @click="extraAccess(item.id, null, null, null, null, null, !item.leave, null)" type="checkbox" name="select-all" class="h-3 w-3 mr-2 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                                                <label for="select-all" class="text-xs font-medium text-gray-500">Leave</label>
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
import AppLayout from "../../Layouts/App"
import Button from "../../Jetstream/Button"
export default {
    props: {
        accessedEmployees: Object,
        session: Number,
        requests: Object,
        locations: Object
    },
    components: {
        Button,
        AppLayout,
    },
    data() {
        return {
            selected: false,
        }
    },
    methods: {
        addMore() {
            this.$inertia.get(this.route("auditor-access.create"), {
                session: this.session,
            })
        },
        extraAccess(id, employeeDetails, contactDetails, contribution, salaryDetails, documents, leave, payslips) {
            axios
                .get(this.route("auditor-access.extra-access"), {
                    params: {
                        id: id,
                        employee_details: employeeDetails,
                        contact_details: contactDetails,
                        contribution: contribution,
                        salary_details: salaryDetails,
                        documents: documents,
                        leave: leave,
                        payslips: payslips,
                    },
                })
                .then(function (data) {
                    console.log(data)
                })
        },
    },
    mounted() {
        console.log()
    },
}
</script>
