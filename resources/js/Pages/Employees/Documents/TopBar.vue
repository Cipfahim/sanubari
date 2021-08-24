<template>
    <div>
        <!-- Profile header -->
        <div>
            <div>
                <img class="h-32 w-full object-cover object-top lg:h-48"
                     src="https://images.unsplash.com/photo-1444628838545-ac4016a5418a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                     alt="">
            </div>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                    <div class="flex">
                        <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32"
                             :src="employee.user.photo  ? getFileUrl(employee.user.photo) : '/images/icon/avatar.png'"
                             :alt="employee.official_name">
                    </div>
                    <div
                        class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                        <div class="sm:hidden 2xl:block mt-6 min-w-0 flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 truncate">
                                {{ employee.official_name }}
                            </h1>
                        </div>
                        <div
                            class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <inertia-link :href="route('employees.index')"
                                          class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md bg-red-600 hover:bg-red-500 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <!-- Heroicon name: solid/mail -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Back</span>
                            </inertia-link>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:block 2xl:hidden mt-6 min-w-0 flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 truncate">
                        {{ employee.official_name }}
                    </h1>
                </div>
            </div>
        </div>

        <!-- Tabs Button-->
        <div class="mt-6 sm:mt-2 2xl:mt-5 overflow-x-auto scrollbar-hide">
            <div class="border-b border-gray-200">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <!-- Current: "border-cyan-500 text-gray-900", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                        <inertia-link :href="route('employees.show',{'id':employee.id,'showTab':1})"
                                      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                      aria-current="page">
                            Employee Details
                        </inertia-link>

                        <inertia-link :href="route('employees.show',{'id':employee.id,'showTab':1})"
                                      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                      aria-current="page">
                            Contact Details
                        </inertia-link>

                        <inertia-link :href="route('employees.show',{'id':employee.id,'showTab':2})"
                                      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                      aria-current="page">
                            Contribution
                        </inertia-link>

                        <inertia-link :href="route('employees.show',{'id':employee.id,'showTab':3})"
                                      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                      aria-current="page">
                            Salary Details
                        </inertia-link>

                        <inertia-link :href="route('employees.show',{'id':employee.id,'showTab':4})"
                                      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                      aria-current="page">
                            Annual Leave
                        </inertia-link>

                        <inertia-link :href="route('employees.documents.index',employee.id)"
                                      :class="{'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': !route().current('employees.documents.index',employee.id), 'border-cyan-500 text-gray-900' : route().current('employees.documents.index',employee.id)}"
                                      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none"
                                      aria-current="page">
                            Documents
                        </inertia-link>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        employee: Object
    }
}
</script>
