<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar :employee="employee.id" :current="route('employees.edit.contributions.index', employee.id)"/>
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
                                        Contributions
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        This section contains sensitive information.
                                    </p>
                                </div>

                                <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">

                                    <!-- epf_employee field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="epf_no" value="EPF No *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1 flex-wrap">
                                                <jet-input
                                                    id="epf_1"
                                                    ref="epf_1"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    @keyup="focusNext($event,1)"
                                                    @paste="onPaste($event)"
                                                />
                                                <jet-input
                                                    id="epf_2"
                                                    ref="epf_2"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup="focusNext($event,2)"
                                                    @keyup.delete="focusPrev(2)"
                                                />
                                                <jet-input
                                                    id="epf_3"
                                                    ref="epf_3"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup="focusNext($event,3)"
                                                    @keyup.delete="focusPrev(3)"
                                                />
                                                <jet-input
                                                    id="epf_4"
                                                    ref="epf_4"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup="focusNext($event,4)"
                                                    @keyup.delete="focusPrev(4)"
                                                />
                                                <jet-input
                                                    id="epf_5"
                                                    ref="epf_5"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_5"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup="focusNext($event,5)"
                                                    @keyup.delete="focusPrev(5)"
                                                />
                                                <jet-input
                                                    id="epf_6"
                                                    ref="epf_6"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_6"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup="focusNext($event,6)"
                                                    @keyup.delete="focusPrev(6)"
                                                />
                                                <jet-input
                                                    id="epf_7"
                                                    ref="epf_7"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_7"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup="focusNext($event,7)"
                                                    @keyup.delete="focusPrev(7)"
                                                />
                                                <jet-input
                                                    id="epf_8"
                                                    ref="epf_8"
                                                    type="text"
                                                    maxlength="1"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    v-model="temp_epf.epf_8"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_no }"
                                                    @keyup.delete="focusPrev(8)"
                                                />
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.epf_no"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- epf_employee field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="epf_employee" value="EPF Employee * (%)"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1">
                                                <jet-input
                                                    id="epf_employee_1"
                                                    ref="epf_employee_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employee.epf_employee_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employee }"
                                                    @keyup="focusNextEmployee($event , 1)"
                                                />
                                                <jet-input
                                                    id="epf_employee_2"
                                                    ref="epf_employee_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employee.epf_employee_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employee }"
                                                    @keyup="focusNextEmployee($event , 2)"
                                                    @keyup.delete="focusPrevEmployee(2)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="epf_employee_3"
                                                    ref="epf_employee_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employee.epf_employee_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employee }"
                                                    @keyup="focusNextEmployee($event , 3)"
                                                    @keyup.delete="focusPrevEmployee(3)"
                                                />
                                                <jet-input
                                                    id="epf_employee_4"
                                                    ref="epf_employee_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employee.epf_employee_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employee }"
                                                    @keyup.delete="focusPrevEmployee(4)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-medium text-gray-800">%</span>
                                                </div>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.epf_employee"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- epf_employer field-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="epf_employer" value="EPF Employer * (%)"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1">
                                                <jet-input
                                                    id="epf_employer_1"
                                                    ref="epf_employer_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employer.epf_employer_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employer }"
                                                    @keyup="focusNextEmployer($event , 1)"
                                                />
                                                <jet-input
                                                    id="epf_employer_2"
                                                    ref="epf_employer_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employer.epf_employer_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employer }"
                                                    @keyup="focusNextEmployer($event , 2)"
                                                    @keyup.delete="focusPrevEmployer(2)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="epf_employer_3"
                                                    ref="epf_employer_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employer.epf_employer_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employer }"
                                                    @keyup="focusNextEmployer($event , 3)"
                                                    @keyup.delete="focusPrevEmployer(3)"
                                                />
                                                <jet-input
                                                    id="epf_employer_4"
                                                    ref="epf_employer_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="epf_employer.epf_employer_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.epf_employer }"
                                                    @keyup.delete="focusPrevEmployer(4)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-medium text-gray-800">%</span>
                                                </div>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.epf_employer"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="epf_no" value="SOCSO Group"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="w-full flex justify-space-between">
                                                <select
                                                    v-model="form.socso_group"
                                                    class="focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    :class="{ 'border-red-500': form.errors.socso_group }"
                                                >
                                                    <option selected disabled>Select one</option>
                                                    <option value="Group-1">Group - 1</option>
                                                    <option value="Group-2">Group - 2</option>
                                                </select>
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.socso_group"
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
                                                    :href="route('employees.edit.contact-details.index',employee.id)"
                                                    class="py-2 px-2 sm:px-4 border border-transparent rounded-md ml-2 sm:ml-3 font-bold text-sm shadow-sm bg-red-500 hover:bg-red-600 text-white hover:text-gray-100 focus:outline-none"
                                                >
                                                    Previous
                                                </inertia-link>
                                                <button
                                                    type="submit"
                                                    class="ml-2 sm:ml-3 inline-flex justify-center py-2 px-2 sm:px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                                                >
                                                    Save
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="saveAndContinue()"
                                                    class="ml-2 sm:ml-3 inline-flex justify-center py-2 px-2 sm:px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
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
import {mask} from "vue-the-mask";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Input from "@/Components/Input";
import JetCheckbox from "@/Jetstream/Checkbox";

export default {
    props: {
        employee: Object,
        contribution: Object,
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
    },
    directives: {mask},
    data() {
        return {
            temp_epf:{
                epf_1: null,
                epf_2: null,
                epf_3: null,
                epf_4: null,
                epf_5: null,
                epf_6: null,
                epf_7: null,
                epf_8: null,
            },
            epf_employee:{
                epf_employee_1: null,
                epf_employee_2: null,
                epf_employee_3: null,
                epf_employee_4: null
            },
            epf_employer:{
                epf_employer_1: null,
                epf_employer_2: null,
                epf_employer_3: null,
                epf_employer_4: null
            },
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    epf_employee: null,
                    epf_employer: null,
                    socso_group: '',
                    epf_no: null,
                    continue: false
                },
                {
                    resetOnSuccess: true,
                }
            ),
        };
    },
    computed:{
      epfNoResult(){
          let numb = this.temp_epf.epf_1
              +this.temp_epf.epf_2
              +this.temp_epf.epf_3
              +this.temp_epf.epf_4
              +this.temp_epf.epf_5
              +this.temp_epf.epf_6
              +this.temp_epf.epf_7
              +this.temp_epf.epf_8
          return parseInt(numb)
      },
      epfEmployeeResult(){
          let numb = this.epf_employee.epf_employee_1
              +this.epf_employee.epf_employee_2
              +this.epf_employee.epf_employee_3
              +this.epf_employee.epf_employee_4
          return parseFloat(numb)
      },
        epfEmployerResult(){
          let numb = this.epf_employer.epf_employer_1
              +this.epf_employer.epf_employer_2
              + '.'
              +this.epf_employer.epf_employer_3
              +this.epf_employer.epf_employer_4
          return parseFloat(numb)
      },
    },
    mounted() {
        const contribution = this.employee.contribution;
        if (contribution) {
            this.form.epf_employee = contribution.epf_employee
            this.form.epf_employer = contribution.epf_employer
            this.form.socso_group = contribution.socso_group
            this.form.epf_no = contribution.epf_no
        }
    },
    methods: {
        onPaste(event){
            let pasteData = event.clipboardData.getData('text').split('')
            pasteData.forEach((data,index) => {
                switch (index){
                    case 0:
                        this.temp_epf.epf_1 = data
                        break
                    case 1:
                        this.temp_epf.epf_2 = data
                        break
                    case 2:
                        this.temp_epf.epf_3 = data
                        break
                    case 3:
                        this.temp_epf.epf_4 = data
                        break
                    case 4:
                        this.temp_epf.epf_5 = data
                        break
                    case 5:
                        this.temp_epf.epf_6 = data
                        break
                    case 6:
                        this.temp_epf.epf_7 = data
                        break
                    case 7:
                        this.temp_epf.epf_8 = data
                        break
                }
            })
        },
        focusNext(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.temp_epf.epf_1){
                            this.$refs.epf_2.focus()
                        }
                        break;
                    case 2:
                        if(this.temp_epf.epf_2){
                            this.$refs.epf_3.focus()
                        }
                        break;
                    case 3:
                        if(this.temp_epf.epf_3){
                            this.$refs.epf_4.focus()
                        }
                        break;
                    case 4:
                        if(this.temp_epf.epf_4){
                            this.$refs.epf_5.focus()
                        }
                        break;
                    case 5:
                        if(this.temp_epf.epf_5){
                            this.$refs.epf_6.focus()
                        }
                        break;
                    case 6:
                        if(this.temp_epf.epf_6){
                            this.$refs.epf_7.focus()
                        }
                        break;
                    case 7:
                        if(this.temp_epf.epf_7){
                            this.$refs.epf_8.focus()
                        }
                        break;
                }
            }
        },
        focusPrev(index){
            switch (index){
                case 2:
                    this.$refs.epf_1.focus()
                    break;
                case 3:
                    this.$refs.epf_2.focus()
                    break
                case 4:
                    this.$refs.epf_3.focus()
                    break
                case 5:
                    this.$refs.epf_4.focus()
                    break;
                case 6:
                    this.$refs.epf_5.focus()
                    break
                case 7:
                    this.$refs.epf_6.focus()
                    break
                case 8:
                    this.$refs.epf_7.focus()
                    break
            }

        },
        focusNextEmployee(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.epf_employee.epf_employee_1){
                            this.$refs.epf_employee_2.focus()
                        }
                        break;
                    case 2:
                        if(this.epf_employee.epf_employee_2){
                            this.$refs.epf_employee_3.focus()
                        }
                        break;
                    case 3:
                        if(this.epf_employee.epf_employee_3){
                            this.$refs.epf_employee_4.focus()
                        }
                        break;
                }
            }
        },
        focusPrevEmployee(index){
            switch (index){
                case 2:
                    this.$refs.epf_employee_1.focus()
                    break;
                case 3:
                    this.$refs.epf_employee_2.focus()
                    break
                case 4:
                    this.$refs.epf_employee_3.focus()
                    break
            }

        },
        focusNextEmployer(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.epf_employer.epf_employer_1){
                            this.$refs.epf_employer_2.focus()
                        }
                        break;
                    case 2:
                        if(this.epf_employer.epf_employer_2){
                            this.$refs.epf_employer_3.focus()
                        }
                        break;
                    case 3:
                        if(this.epf_employer.epf_employer_3){
                            this.$refs.epf_employer_4.focus()
                        }
                        break;
                }
            }
        },
        focusPrevEmployer(index){
            switch (index){
                case 2:
                    this.$refs.epf_employer_1.focus()
                    break;
                case 3:
                    this.$refs.epf_employer_2.focus()
                    break
                case 4:
                    this.$refs.epf_employer_3.focus()
                    break
            }

        },
        submit() {
            this.form.epf_no = this.epfNoResult
            this.form.epf_employee = this.epfEmployeeResult
            this.form.epf_employer = this.epfEmployerResult

            this.form.post(this.route("employees.edit.contributions.update", this.employee.id));
        },

        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    },
};
</script>
