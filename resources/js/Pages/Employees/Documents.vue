<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <div class="w-full flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold text-gray-800">KUDDUS</h1>
                <inertia-link
                    href="#"
                    class="py-2 px-4 border border-transparent font-bold shadow-sm text-sm rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none"
                >
                    Add Document
                </inertia-link>
            </div>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto scrollbar-hide sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden scrollbar-hide border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y overflow-x-auto  scrollbar-hide divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        File Description
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Year
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        View
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tools
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-2 text-left py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">23456</div>
                                    </td>
                                    <td class="px-2 text-center py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Medical Report</div>
                                    </td>
                                    <td class="px-2 text-center py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">2017</div>
                                    </td>
                                    <td class="px-2 text-center py-4 whitespace-nowrap">
                                        <img class="h-24 w-36 mx-auto rounded"
                                             src="https://cdn.pixabay.com/photo/2018/10/29/22/25/analysis-3782319__340.jpg"
                                             alt="">
                                    </td>
                                    <td class="px-2 text-center py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex h-24 justify-center items-center">
                                            <a href="#" class="text-green-600 hover:text-green-700">
                                                <PencilAltIcon class="h-5 w-5 mx-2"/>
                                            </a>
                                            <a href="#" class="text-cyan-600 hover:text-cyan-700">
                                                <EyeIcon class="h-5 w-5 mx-2"/>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-700">
                                                <!-- <DownloadIcon class="h-5 w-5 mx-2" /> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
    DownloadIcon,
    EyeIcon,
    OfficeBuildingIcon,
    PencilAltIcon,
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
        PencilAltIcon,
        EyeIcon,
        DownloadIcon
    },
};
</script>
