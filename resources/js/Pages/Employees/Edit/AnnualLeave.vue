<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar :employee="employee.id" :current="route('employees.edit.annual-leave.index', employee.id)"/>
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
                                        Leave Quota
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        This section contains sensitive information.
                                    </p>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Annual Leave-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="annual_leave_quota" value="Annual Leave *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="annual_leave"
                                                type="text"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                v-model="form.annual_leave"
                                                :class="{ 'border-red-500': form.errors.annual_leave }"
                                                maxlength="2"
                                            />
                                            <jet-input-error
                                                :message="form.errors.annual_leave"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Annual Leave-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="medical_leave_quota" value="Medical Leave *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="medical_leave"
                                                type="text"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                v-model="form.medical_leave"
                                                :class="{ 'border-red-500': form.errors.medical_leave }"
                                                maxlength="2"
                                            />
                                            <jet-input-error
                                                :message="form.errors.medical_leave"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Annual Leave-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="bereavement_leave_quota" value="Bereavement Leave *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="bereavement_leave"
                                                type="text"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                v-model="form.bereavement_leave"
                                                :class="{ 'border-red-500': form.errors.bereavement_leave }"
                                                maxlength="2"
                                            />
                                            <jet-input-error
                                                :message="form.errors.bereavement_leave"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Leave field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="hospital_leave_quota" value="Hospital Leave *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="hospital_leave"
                                                type="text"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                v-model="form.hospital_leave"
                                                :class="{ 'border-red-500': form.errors.hospital_leave }"
                                                maxlength="2"
                                            />
                                            <jet-input-error
                                                :message="form.errors.hospital_leave"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6 sm:space-y-5">
                                    <!-- Leave field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="peternity_maternity_leave_quota"
                                                   value="Paternity/Maternity Leave *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <jet-input
                                                id="paternity_maternity_leave"
                                                type="text"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                v-model="form.paternity_maternity_leave"
                                                :class="{ 'border-red-500': form.errors.paternity_maternity_leave }"
                                                maxlength="2"
                                            />
                                            <jet-input-error
                                                :message="form.errors.maternity_paternity_leave"
                                                class="mt-2"
                                            />
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
                                                <inertia-link
                                                    :href="route('employees.edit.salary-details.index',employee.id)"
                                                    class="py-2 px-4 border border-transparent rounded-md ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                                                >
                                                    Previous
                                                </inertia-link>
                                                <button
                                                    type="submit"
                                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                >
                                                    Save
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
import AppLayout from "@/Layouts/App";
import TopBar from "@/Pages/Employees/Edit/TopBar";
import {
    CalendarIcon,
    CashIcon,
    CheckCircleIcon,
    CheckIcon,
    ChevronRightIcon,
    OfficeBuildingIcon,
    PlusCircleIcon,
} from "@heroicons/vue/solid";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "@/Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import {Switch} from "@headlessui/vue";

export default {
    props: {
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
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: "PUT",
                    annual_leave: this.employee.leave_quota ? this.employee.leave_quota.annual_leave : null,
                    medical_leave: this.employee.leave_quota ? this.employee.leave_quota.medical_leave : null,
                    bereavement_leave: this.employee.leave_quota ? this.employee.leave_quota.bereavement_leave : null,
                    hospital_leave: this.employee.leave_quota ? this.employee.leave_quota.hospital_leave: null,
                    paternity_maternity_leave: this.employee.leave_quota ? this.employee.leave_quota.paternity_maternity_leave : null
                },
                {
                    resetOnSuccess: true,
                }
            ),
        };
    },
    methods: {
        submit() {
            this.form
                .post(this.route("employees.edit.annual-leave.update", this.employee.id));
        },
    },
};
</script>
