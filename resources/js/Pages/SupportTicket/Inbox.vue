<template>
    <app-layout>
        <div class="mt-4 px-4 sm:px-6 lg:px-8 fixed bottom-0 top-16 right-0 left-64">
            <!--    Inbox     -->
            <div class="flex flex-col">
                <div class="shadow rounded sm:rounded-lg min-w-full bg-white py-4">
                    <div v-if="true">
                        <div class="p-4 border-b border-gray-100 bg-transparent rounded py-5 flex justify-between gap-10">
                            <!--    Title     -->
                            <div class="flex-1 flex gap-4">
                                <button class="h-8 w-8 bg-gray-100 hover:bg-gray-200 rounded-full p-2 flex justify-center items-center cursor-pointer focus:outline-none">
                                    <ChevronLeftIcon class="h-6 w-6 text-cyan-600"/>
                                </button>
                                <div>
                                    <h2 class="text-xl text-gray-800 leading-7 font-semibold">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
                                    <p class="text-xs font-bold text-gray-500 uppercase">Token Id: 123456</p>
                                </div>
                            </div>
                            <!--    Action     -->
                            <div class="w-auto">
                                <jet-dropdown>
                                    <template v-slot:trigger>
                                        <div class="bg-cyan-50 hover:bg-cyan-100 h-10 w-10 rounded-full flex items-center justify-center cursor-pointer">
                                            <DotsHorizontalIcon class="h-5 w-5 text-cyan-600"/>
                                        </div>
                                    </template>
                                    <template v-slot:content>
                                        <div class="px-2">
                                            <jet-dropdown-link :href="1">
                                                <div class="group flex items-center gap-1">
                                                    <!--                                                    <XIcon class="h-3 w-3 group-hover:text-red-600 text-red-500"/>-->
                                                    <span class="group-hover:text-red-600 text-red-500">Mark as Spam</span>
                                                </div>
                                            </jet-dropdown-link>
                                            <jet-dropdown-link :href="1" class="group">
                                                <div class="group flex items-center gap-1">
                                                    <span class="group-hover:text-yellow-600 text-yellow-500">Mark as Pending</span>
                                                </div>
                                            </jet-dropdown-link>
                                            <jet-dropdown-link :href="1" class="group">
                                                <div class="group flex items-center gap-1">
                                                    <span class="group-hover:text-green-600 text-green-500">Mark as Complete</span>
                                                </div>
                                            </jet-dropdown-link>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                        <!--    Inbox Body     -->
                        <div class="mx-4 bg-cyan-50 rounded-tl-md rounded-tr-md px-2 py-4 space-y-2 overflow-y-auto h-[55vh]">
                            <div v-for="n in 5" class="space-y-2">
                                <!-- Left side -->
                                <div>
                                    <div class="flex gap-2">
                                        <img class="h-7 w-7 mt-auto rounded-full" src="/images/icon/avatar.png" alt="Avatar">
                                        <div class="flex-1 max-w-sm bg-cyan-500 rounded-xl rounded-bl-none p-2">
                                            <p class="text-white text-sm font-semibold leading-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consequuntur facilis voluptatibus! A eligendi harum iste maiores officiis reprehenderit voluptatibus?</p>
                                        </div>
                                    </div>
                                    <div class="ml-9 flex gap-1 items-center">
                                        <CheckIcon class="h-3 w-3" :class=" true ? 'text-cyan-500' : 'text-gray-500'"/>
                                        <p class="text-xs font-normal text-gray-500">Yesterday at 3:00pm</p>
                                    </div>
                                </div>
                                <!-- Right side -->
                                <div class="flex gap-2 ml-auto justify-end">
                                    <div>
                                        <div class="flex gap-2">
                                            <div class="flex-1 max-w-sm bg-cyan-500 rounded-xl rounded-br-none p-2">
                                                <p class="text-white text-sm font-semibold leading-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consequuntur facilis voluptatibus! A eligendi harum iste maiores officiis reprehenderit voluptatibus?</p>
                                            </div>
                                            <img class="h-7 w-7 mt-auto rounded-full" src="/images/icon/avatar.png" alt="Avatar">
                                        </div>
                                        <div class="mr-9 flex gap-1 items-center justify-end">
                                            <p class="text-xs font-normal text-gray-500">Yesterday at 3:00pm</p>
                                            <CheckIcon class="h-3 w-3" :class=" false ? 'text-cyan-500' : 'text-gray-500'"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mx-4 p-2 bg-cyan-200 rounded-bl-md rounded-br-md">
                            <div class="relative">
                                <textarea placeholder="Type..." class="h-28 pr-16 text-sm text-gray-800 border border-cyan-400 rounded-md px-2 focus:outline-none focus:border-cyan-500 focus:ring-0 w-full resize-none"></textarea>
                                <button class="absolute top-2 right-3 z-10 group group-hover:bg-cyan-100 bg-cyan-50 h-16 w-16 rounded-full flex justify-center items-center p-2">
                                    <PaperAirplaneIcon class="h-8 w-8 text-cyan-500 group-hover:text-cyan-700 transform rotate-45 cursor-pointer"/>
                                </button>
                            </div>
                        </div>
                    </div>

                    <no-data-found
                        v-else
                        resource="Token"
                        action-text="See All Token"
                        :action-link="route('employees.create')"
                    />
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/App";
import Breadcrumb from "@/Components/Breadcrumb";
import NoDataFound from "@/Components/NoDataFound";
import Pagination from "@/Components/Pagination";
import SortArrow from "@/Components/SortArrow";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetButton from "@/Jetstream/Button";
import {ChevronLeftIcon , DotsHorizontalIcon , XIcon , CheckIcon, PaperAirplaneIcon} from "@heroicons/vue/solid";
import JetDropdown from "../../Jetstream/Dropdown";
import JetDropdownLink from "../../Jetstream/DropdownLink";
import JetInput from "../../Jetstream/Input";

export default {
    components: {
        JetButton,
        AppLayout,
        Breadcrumb,
        NoDataFound,
        Pagination,
        SortArrow,
        JetSecondaryButton,
        JetDangerButton,
        ChevronLeftIcon,
        DotsHorizontalIcon,
        XIcon,
        CheckIcon,
        PaperAirplaneIcon,
        JetDropdown,
        JetDropdownLink,
        JetInput
    },
    data() {
        return {
        };
    },

};
</script>
