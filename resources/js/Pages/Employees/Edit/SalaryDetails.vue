<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <top-bar :employee="employee.id" :current="route('employees.edit.salary-details.index', employee.id)"/>

            <jet-form-section
                @submitted="submit"
                class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
            >
                <template #form class=" md:col-span-12">
                    <!-- Strat::Stepper Contents -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <!-- Login details-->
                            <div class="space-y-6 sm:pt-10 sm:space-y-5 mt-5 sm:mt-0">
                                <div class="sm:border-b sm:border-gray-200 pb-2">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Salary Details
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        This section contains sensitive information.
                                    </p>
                                </div>

                                <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">

                                    <!-- Basic salary-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="basic_salary" value="Basic Salary *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1 flex-wrap">
                                                <jet-input
                                                    id="basic_salary_1"
                                                    ref="basic_salary_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,1)"
                                                />
                                                <jet-input
                                                    id="basic_salary_2"
                                                    ref="basic_salary_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,2)"
                                                    @keyup.delete="focusPrevSalary(2)"
                                                />
                                                <jet-input
                                                    id="basic_salary_3"
                                                    ref="basic_salary_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,3)"
                                                    @keyup.delete="focusPrevSalary(3)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">,</span>
                                                </div>
                                                <jet-input
                                                    id="basic_salary_4"
                                                    ref="basic_salary_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,4)"
                                                    @keyup.delete="focusPrevSalary(4)"
                                                />
                                                <jet-input
                                                    id="basic_salary_5"
                                                    ref="basic_salary_5"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_5"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,5)"
                                                    @keyup.delete="focusPrevSalary(5)"
                                                />
                                                <jet-input
                                                    id="basic_salary_6"
                                                    ref="basic_salary_6"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_6"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,6)"
                                                    @keyup.delete="focusPrevSalary(6)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="basic_salary_7"
                                                    ref="basic_salary_7"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_7"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup="focusNextSalary($event,7)"
                                                    @keyup.delete="focusPrevSalary(7)"
                                                />
                                                <jet-input
                                                    id="basic_salary_8"
                                                    ref="basic_salary_8"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_salary.basic_salary_8"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.basic_salary }"
                                                    @keyup.delete="focusPrevSalary(8)"
                                                />
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.basic_salary"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- living_allowance-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="living_allowance" value="Cost of Living Allowance *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1 flex-wrap">
                                                <jet-input
                                                    id="living_allowance_1"
                                                    ref="living_allowance_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_living.living_allowance_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.living_allowance }"
                                                    @keyup="focusNextLiving($event , 1)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">,</span>
                                                </div>
                                                <jet-input
                                                    id="living_allowance_2"
                                                    ref="living_allowance_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_living.living_allowance_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.living_allowance }"
                                                    @keyup="focusNextLiving($event , 2)"
                                                    @keyup.delete="focusPrevLiving(2)"
                                                />
                                                <jet-input
                                                    id="living_allowance_3"
                                                    ref="living_allowance_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_living.living_allowance_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.living_allowance }"
                                                    @keyup="focusNextLiving($event , 3)"
                                                    @keyup.delete="focusPrevLiving(3)"
                                                />
                                                <jet-input
                                                    id="living_allowance_4"
                                                    ref="living_allowance_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_living.living_allowance_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.living_allowance }"
                                                    @keyup="focusNextLiving($event , 4)"
                                                    @keyup.delete="focusPrevLiving(4)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="living_allowance_5"
                                                    ref="living_allowance_5"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_living.living_allowance_5"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.living_allowance }"
                                                    @keyup="focusNextLiving($event , 5)"
                                                    @keyup.delete="focusPrevLiving(5)"
                                                />
                                                <jet-input
                                                    id="living_allowance_6"
                                                    ref="living_allowance_6"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_living.living_allowance_6"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.living_allowance }"
                                                    @keyup.delete="focusPrevLiving(6)"
                                                />
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.living_allowance"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- attendance_allowance-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="attendance_allowance" value="Attendance Allowance *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1 flex-wrap">
                                                <jet-input
                                                    id="attendance_allowance_1"
                                                    ref="attendance_allowance_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_attendance.attendance_allowance_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.attendance_allowance }"
                                                    @keyup="focusNextAttendance($event , 1)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">,</span>
                                                </div>
                                                <jet-input
                                                    id="attendance_allowance_2"
                                                    ref="attendance_allowance_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_attendance.attendance_allowance_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.attendance_allowance }"
                                                    @keyup="focusNextAttendance($event , 2)"
                                                    @keyup.delete="focusPrevAttendance(2)"
                                                />
                                                <jet-input
                                                    id="attendance_allowance_3"
                                                    ref="attendance_allowance_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_attendance.attendance_allowance_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.attendance_allowance }"
                                                    @keyup="focusNextAttendance($event , 3)"
                                                    @keyup.delete="focusPrevAttendance(3)"
                                                />
                                                <jet-input
                                                    id="attendance_allowance_4"
                                                    ref="attendance_allowance_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_attendance.attendance_allowance_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.attendance_allowance }"
                                                    @keyup="focusNextAttendance($event , 4)"
                                                    @keyup.delete="focusPrevAttendance(4)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="attendance_allowance_5"
                                                    ref="attendance_allowance_5"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_attendance.attendance_allowance_5"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.attendance_allowance }"
                                                    @keyup="focusNextAttendance($event , 5)"
                                                    @keyup.delete="focusPrevAttendance(5)"
                                                />
                                                <jet-input
                                                    id="attendance_allowance_6"
                                                    ref="attendance_allowance_6"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_attendance.attendance_allowance_6"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.attendance_allowance }"
                                                    @keyup.delete="focusPrevAttendance(6)"
                                                />
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.attendance_allowance"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <!-- levy-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="levy" value="Levy *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1 flex-wrap">
                                                <jet-input
                                                    id="levy_1"
                                                    ref="levy_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_levy.levy_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.levy }"
                                                    @keyup="focusNextLevy($event , 1)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">,</span>
                                                </div>
                                                <jet-input
                                                    id="levy_2"
                                                    ref="levy_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_levy.levy_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.levy }"
                                                    @keyup="focusNextLevy($event , 2)"
                                                    @keyup.delete="focusPrevLevy(2)"
                                                />
                                                <jet-input
                                                    id="levy_3"
                                                    ref="levy_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_levy.levy_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.levy }"
                                                    @keyup="focusNextLevy($event , 3)"
                                                    @keyup.delete="focusPrevLevy(3)"
                                                />
                                                <jet-input
                                                    id="levy_4"
                                                    ref="levy_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_levy.levy_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.levy }"
                                                    @keyup="focusNextLevy($event , 4)"
                                                    @keyup.delete="focusPrevLevy(4)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="levy_5"
                                                    ref="levy_5"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_levy.levy_5"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.levy }"
                                                    @keyup="focusNextLevy($event , 5)"
                                                    @keyup.delete="focusPrevLevy(5)"
                                                />
                                                <jet-input
                                                    id="levy_6"
                                                    ref="levy_6"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_levy.levy_6"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.levy }"
                                                    @keyup.delete="focusPrevLevy(6)"
                                                />
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.levy"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>


                                    <!-- in_charge_allowance-->
                                    <div
                                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2"
                                    >
                                        <jet-label for="in_charge_allowance" value="In Charge Allowance *"/>
                                        <div class="col-span-2 max-w-lg">
                                            <div class="flex gap-1 flex-wrap">
                                                <jet-input
                                                    id="in_charge_1"
                                                    ref="in_charge_1"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_in_charge.in_charge_1"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.in_charge_allowance }"
                                                    @keyup="focusNextInCharge($event , 1)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">,</span>
                                                </div>
                                                <jet-input
                                                    id="in_charge_2"
                                                    ref="in_charge_2"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_in_charge.in_charge_2"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.in_charge_allowance }"
                                                    @keyup="focusNextInCharge($event , 2)"
                                                    @keyup.delete="focusPrevInCharge(2)"
                                                />
                                                <jet-input
                                                    id="in_charge_3"
                                                    ref="in_charge_3"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_in_charge.in_charge_3"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.in_charge_allowance }"
                                                    @keyup="focusNextInCharge($event , 3)"
                                                    @keyup.delete="focusPrevInCharge(3)"
                                                />
                                                <jet-input
                                                    id="in_charge_4"
                                                    ref="in_charge_4"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_in_charge.in_charge_4"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.in_charge_allowance }"
                                                    @keyup="focusNextInCharge($event , 4)"
                                                    @keyup.delete="focusPrevInCharge(4)"
                                                />
                                                <div class="flex flex-col justify-end">
                                                    <span class="text-lg font-bold text-gray-800">.</span>
                                                </div>
                                                <jet-input
                                                    id="in_charge_5"
                                                    ref="in_charge_5"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_in_charge.in_charge_5"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.in_charge_allowance }"
                                                    @keyup="focusNextInCharge($event , 5)"
                                                    @keyup.delete="focusPrevInCharge(5)"
                                                />
                                                <jet-input
                                                    id="in_charge_6"
                                                    ref="in_charge_6"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    maxlength="1"
                                                    v-model="temp_in_charge.in_charge_6"
                                                    class="!w-8 !h-8 sm:h-10 sm:w-12 text-xs text-center p-1"
                                                    :class="{ 'border-red-500': form.errors.in_charge_allowance }"
                                                    @keyup.delete="focusPrevInCharge(6)"
                                                />
                                            </div>
                                            <jet-input-error
                                                :message="form.errors.in_charge_allowance"
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
                                                        :href="route('employees.edit.bank-details.index',employee.id)"
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

                                                    <button
                                                        @click.prevent="saveAndContinue"
                                                        type="button"
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
                    </div>
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
        JetCheckbox
    },
    data() {
        return {
            temp_salary:{
                 basic_salary_1: null,
                 basic_salary_2: null,
                 basic_salary_3: null,
                 basic_salary_4: null,
                 basic_salary_5: null,
                 basic_salary_6: null,
                 basic_salary_7: null,
                 basic_salary_8: null,
            },
            temp_living:{
                 living_allowance_1: null,
                 living_allowance_2: null,
                 living_allowance_3: null,
                 living_allowance_4: null,
                 living_allowance_5: null,
                 living_allowance_6: null,
            },
            temp_attendance:{
                 attendance_allowance_1: null,
                 attendance_allowance_2: null,
                 attendance_allowance_3: null,
                 attendance_allowance_4: null,
                 attendance_allowance_5: null,
                 attendance_allowance_6: null,
            },
            temp_levy:{
                 levy_1: null,
                 levy_2: null,
                 levy_3: null,
                 levy_4: null,
                 levy_5: null,
                 levy_6: null,
            },
            temp_in_charge:{
                 in_charge_1: null,
                 in_charge_2: null,
                 in_charge_3: null,
                 in_charge_4: null,
                 in_charge_5: null,
                 in_charge_6: null,
            },
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    basic_salary: null,
                    living_allowance: null,
                    attendance_allowance: null,
                    levy: null,
                    in_charge_allowance: null,
                    continue: false
                },
                {
                    resetOnSuccess: true,
                }
            ),
        }
    },
    mounted() {
        const salary_details = this.employee.salary_details;
        if (salary_details) {
            this.form.basic_salary = salary_details.basic_salary
            this.form.living_allowance = salary_details.living_allowance
            this.form.attendance_allowance = salary_details.attendance_allowance
            this.form.levy = salary_details.levy
            this.form.in_charge_allowance = salary_details.in_charge_allowance
        }
    },
    computed:{
        salaryResult(){
            let num = this.temp_salary.basic_salary_1
                +this.temp_salary.basic_salary_2
                +this.temp_salary.basic_salary_3
                +this.temp_salary.basic_salary_4
                +this.temp_salary.basic_salary_5
                +this.temp_salary.basic_salary_6
                + '.'
                +this.temp_salary.basic_salary_7
                +this.temp_salary.basic_salary_8
            return parseFloat(num)
        },
        livingResult(){
            let num = this.temp_living.living_allowance_1
                +this.temp_living.living_allowance_2
                +this.temp_living.living_allowance_3
                +this.temp_living.living_allowance_4
                + '.'
                +this.temp_living.living_allowance_5
                +this.temp_living.living_allowance_6
            return parseFloat(num)
        },
        attendanceResult(){
            let num = this.temp_attendance.attendance_allowance_1
                +this.temp_attendance.attendance_allowance_2
                +this.temp_attendance.attendance_allowance_3
                +this.temp_attendance.attendance_allowance_4
                + '.'
                +this.temp_attendance.attendance_allowance_5
                +this.temp_attendance.attendance_allowance_6
            return parseFloat(num)
        },
        levyResult(){
            let num = this.temp_levy.levy_1
                +this.temp_levy.levy_2
                +this.temp_levy.levy_3
                +this.temp_levy.levy_4
                + '.'
                +this.temp_levy.levy_5
                +this.temp_levy.levy_6
            return parseFloat(num)
        },
        inChargeResult(){
            let num = this.temp_in_charge.in_charge_1
                +this.temp_in_charge.in_charge_2
                +this.temp_in_charge.in_charge_3
                +this.temp_in_charge.in_charge_4
                + '.'
                +this.temp_in_charge.in_charge_5
                +this.temp_in_charge.in_charge_6
            return parseFloat(num)
        }
    },
    methods: {
        // Salary
        focusNextSalary(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.temp_salary.basic_salary_1){
                            this.$refs.basic_salary_2.focus()
                        }
                        break;
                    case 2:
                        if(this.temp_salary.basic_salary_2){
                            this.$refs.basic_salary_3.focus()
                        }
                        break;
                    case 3:
                        if(this.temp_salary.basic_salary_3){
                            this.$refs.basic_salary_4.focus()
                        }
                        break;
                    case 4:
                        if(this.temp_salary.basic_salary_4){
                            this.$refs.basic_salary_5.focus()
                        }
                        break;
                    case 5:
                        if(this.temp_salary.basic_salary_5){
                            this.$refs.basic_salary_6.focus()
                        }
                        break;
                    case 6:
                        if(this.temp_salary.basic_salary_6){
                            this.$refs.basic_salary_7.focus()
                        }
                        break;
                    case 7:
                        if(this.temp_salary.basic_salary_7){
                            this.$refs.basic_salary_8.focus()
                        }
                        break;
                }
            }
        },
        focusPrevSalary(index){
            switch (index){
                case 2:
                    this.$refs.basic_salary_1.focus()
                    break;
                case 3:
                    this.$refs.basic_salary_2.focus()
                    break
                case 4:
                    this.$refs.basic_salary_3.focus()
                    break
                case 5:
                    this.$refs.basic_salary_4.focus()
                    break;
                case 6:
                    this.$refs.basic_salary_5.focus()
                    break
                case 7:
                    this.$refs.basic_salary_6.focus()
                    break
                case 8:
                    this.$refs.basic_salary_7.focus()
                    break
            }

        },

        // Living
        focusNextLiving(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.temp_living.living_allowance_1){
                            this.$refs.living_allowance_2.focus()
                        }
                        break;
                    case 2:
                        if(this.temp_living.living_allowance_2){
                            this.$refs.living_allowance_3.focus()
                        }
                        break;
                    case 3:
                        if(this.temp_living.living_allowance_3){
                            this.$refs.living_allowance_4.focus()
                        }
                        break;
                    case 4:
                        if(this.temp_living.living_allowance_4){
                            this.$refs.living_allowance_5.focus()
                        }
                        break;
                    case 5:
                        if(this.temp_living.living_allowance_5){
                            this.$refs.living_allowance_6.focus()
                        }
                        break;
                }
            }
        },
        focusPrevLiving(index){
            switch (index){
                case 2:
                    this.$refs.living_allowance_1.focus()
                    break;
                case 3:
                    this.$refs.living_allowance_2.focus()
                    break
                case 4:
                    this.$refs.living_allowance_3.focus()
                    break
                case 5:
                    this.$refs.living_allowance_4.focus()
                    break;
                case 6:
                    this.$refs.living_allowance_5.focus()
                    break
            }

        },

        // Attendance
        focusNextAttendance(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.temp_attendance.attendance_allowance_1){
                            this.$refs.attendance_allowance_2.focus()
                        }
                        break;
                    case 2:
                        if(this.temp_attendance.attendance_allowance_2){
                            this.$refs.attendance_allowance_3.focus()
                        }
                        break;
                    case 3:
                        if(this.temp_attendance.attendance_allowance_3){
                            this.$refs.attendance_allowance_4.focus()
                        }
                        break;
                    case 4:
                        if(this.temp_attendance.attendance_allowance_4){
                            this.$refs.attendance_allowance_5.focus()
                        }
                        break;
                    case 5:
                        if(this.temp_attendance.attendance_allowance_5){
                            this.$refs.attendance_allowance_6.focus()
                        }
                        break;
                }
            }
        },
        focusPrevAttendance(index){
            switch (index){
                case 2:
                    this.$refs.attendance_allowance_1.focus()
                    break;
                case 3:
                    this.$refs.attendance_allowance_2.focus()
                    break
                case 4:
                    this.$refs.attendance_allowance_3.focus()
                    break
                case 5:
                    this.$refs.attendance_allowance_4.focus()
                    break;
                case 6:
                    this.$refs.attendance_allowance_5.focus()
                    break
            }
        },

        // Levy
        focusNextLevy(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.temp_levy.levy_1){
                            this.$refs.levy_2.focus()
                        }
                        break;
                    case 2:
                        if(this.temp_levy.levy_2){
                            this.$refs.levy_3.focus()
                        }
                        break;
                    case 3:
                        if(this.temp_levy.levy_3){
                            this.$refs.levy_4.focus()
                        }
                        break;
                    case 4:
                        if(this.temp_levy.levy_4){
                            this.$refs.levy_5.focus()
                        }
                        break;
                    case 5:
                        if(this.temp_levy.levy_5){
                            this.$refs.levy_6.focus()
                        }
                        break;
                }
            }
        },
        focusPrevLevy(index){
            switch (index){
                case 2:
                    this.$refs.levy_1.focus()
                    break;
                case 3:
                    this.$refs.levy_2.focus()
                    break
                case 4:
                    this.$refs.levy_3.focus()
                    break
                case 5:
                    this.$refs.levy_4.focus()
                    break;
                case 6:
                    this.$refs.levy_5.focus()
                    break
            }
        },

        // in_charge_allowance
        focusNextInCharge(event,index){
            if(event.keyCode >= 48 && event.keyCode <= 57){
                switch (index){
                    case 1:
                        if(this.temp_in_charge.in_charge_1){
                            this.$refs.in_charge_2.focus()
                        }
                        break;
                    case 2:
                        if(this.temp_in_charge.in_charge_2){
                            this.$refs.in_charge_3.focus()
                        }
                        break;
                    case 3:
                        if(this.temp_in_charge.in_charge_3){
                            this.$refs.in_charge_4.focus()
                        }
                        break;
                    case 4:
                        if(this.temp_in_charge.in_charge_4){
                            this.$refs.in_charge_5.focus()
                        }
                        break;
                    case 5:
                        if(this.temp_in_charge.in_charge_5){
                            this.$refs.in_charge_6.focus()
                        }
                        break;
                }
            }
        },
        focusPrevInCharge(index){
            switch (index){
                case 2:
                    this.$refs.in_charge_1.focus()
                    break;
                case 3:
                    this.$refs.in_charge_2.focus()
                    break
                case 4:
                    this.$refs.in_charge_3.focus()
                    break
                case 5:
                    this.$refs.in_charge_4.focus()
                    break;
                case 6:
                    this.$refs.in_charge_5.focus()
                    break
            }
        },
        submit() {
            this.form.basic_salary = this.salaryResult
            this.form.living_allowance = this.livingResult
            this.form.attendance_allowance = this.attendanceResult
            this.form.levy = this.levyResult
            this.form.in_charge_allowance = this.inChargeResult

            this.form.post(this.route('employees.edit.salary-details.update', this.employee.id))
        },

        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    }
};
</script>
