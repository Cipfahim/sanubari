<template>
    <SettingLayout>
        <div class="p-4">
            <breadcrumb
                :links="[
          {
            title: 'Cities',
            active: true,
          },
        ]"
            />
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-y-2">
                <div class="flex items-center w-full max-w-md sm:mr-4 order-2 sm:order-1">
                    <div
                        class="h-10 flex items-center w-full bg-white shadow-sm border border-gray-200 overflow-hidden rounded-md relative"
                    >
                        <SearchIcon class="h-7 w-7 text-gray-300 mx-2"/>
                        <input
                            v-model="queryForm.filter"
                            autocomplete="off"
                            type="text"
                            name="search"
                            placeholder="Search…"
                            class="block w-full h-full pl-0 sm:pl-2 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                        />
                    </div>
                    <button
                        type="button"
                        @click="reset"
                        class="h-10 py-2 px-4 rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                    >
                        Reset
                    </button>
                </div>

                <div class="flex justify-between order-1 sm:order-2 ml-auto">
                    <inertia-link
                        :href="route('settings.cities.create')"
                        class="h-10 py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none"
                    >
                        Add City
                    </inertia-link>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <div
                            v-if="cities.data.length"
                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Sl.
                                    </th>
                                    <th
                                        scope="col"
                                        @click="sort('name')"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    >
                                        <sort-arrow :sort="queryForm.sort" field="name"/>
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        <span>Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(city, index) in cities.data"
                                    :key="index"
                                    class="hover:bg-gray-50"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ index + 1 }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 grid grid-cols gap-1"
                                    >
                                        <div>{{ city.name }}</div>
                                    </td>
                                    <td
                                        class="px-6 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <inertia-link
                                            :href="route('settings.cities.edit', city.id)"
                                            class="text-white bg-green-500 hover:bg-green-700 transition duration-500 px-3 py-1 rounded-md shadow-md ml-2 h-10"
                                        >Edit
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination class="m-2" :links="cities.links"/>
                        </div>
                        <no-data-found
                            v-else
                            resource="cities"
                            action-text="Add City"
                            :action-link="route('settings.cities.create')"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete confirmation modal -->
        <jet-confirmation-modal
            :show="confirmingDeletion"
            @close="confirmingDeletion = false"
        >
            <template #title> Delete Category</template>

            <template #content>
                Are you sure you want to delete this category? Once category is deleted,
                all of its resources and data will be permanently deleted.
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmingDeletion = false">
                    Nevermind
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click="destroy">
                    Delete
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </SettingLayout>
</template>

<script>
import SettingLayout from "@/Layouts/SettingLayout";
import NoDataFound from "@/Components/NoDataFound";
import Pagination from "@/Components/Pagination";
import SortArrow from "@/Components/SortArrow";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Button from "@/Jetstream/Button";
import {SearchIcon} from "@heroicons/vue/solid";

export default {
    components: {
        Button,
        SettingLayout,
        JetCheckbox,
        NoDataFound,
        Pagination,
        SortArrow,
        JetConfirmationModal,
        JetSecondaryButton,
        JetDangerButton,
        SearchIcon,
    },
    props: {
        requests: Object,
        cities: Object,
    },
    data() {
        return {
            queryForm: {
                field: this.requests.filter
                    ? Object.keys(this.requests.filter)[0]
                    : "name",
                filter: this.requests.filter
                    ? Object.values(this.requests.filter)[0]
                    : "",
                sort: this.requests.sort,
            },
            bulkIds: [],
            confirmingBulkDeletion: false,
            confirmingDeletion: false,
            deleteCategory: null,
            checkAll: false,
        };
    },
    watch: {
        queryForm: {
            handler: throttle(function () {
                let customQuery = {
                    ["filter[" + this.queryForm.field + "]"]: this.queryForm.filter,
                    sort: this.queryForm.sort,
                };
                let queryString = pickBy(customQuery);
                this.$inertia.get(
                    this.route(
                        "settings.cities.index",
                        Object.keys(queryString).length
                            ? queryString
                            : {remember: "forget"}
                    ),
                    {},
                    {
                        preserveState: true,
                        preserveScroll: true,
                    }
                );
            }, 150),
            deep: true,
        },
    },
    methods: {
        toggleAll() {
            if (!this.checkAll) {
                this.bulkIds = [];
            } else {
                let ids = [];
                this.honorariumCategories.data.forEach(function (category) {
                    ids.push(category.id);
                });
                this.bulkIds = ids;
            }
        },
        // Sort data by field
        sort(field) {
            this.queryForm.sort === field
                ? (this.queryForm.sort = "-" + field)
                : (this.queryForm.sort = field);
        },

        // Reset all filters
        reset() {
            this.$inertia.visit(this.route("settings.cities.index"));
        },

        // Confirm deletion.
        confirmDeletion(category) {
            this.deleteCategory = category;
            this.confirmingDeletion = true;
        },

        // Send delete request.
        destroy() {
            this.$inertia.delete(
                this.route("settings.countries.destroy", this.deleteCategory),
                {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.deleteCategory = null;
                        this.confirmingDeletion = false;
                    },
                }
            );
        },

        // Confirm bulk deletion.
        confirmBulkDeletion() {
            this.confirmingBulkDeletion = true;
        },

        // Send bulk delete request.
        bulkDestroy() {
            this.$inertia.post(
                this.route("settings.countries.bulk-destroy"),
                {
                    _method: "DELETE",
                    categories: this.bulkIds,
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.bulkIds = [];
                        this.confirmingBulkDeletion = false;
                        this.checkAll = false;
                    },
                }
            );
        },
    },
};
</script>
