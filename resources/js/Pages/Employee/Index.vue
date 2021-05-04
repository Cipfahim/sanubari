<template>
    <app-layout>
        <!-- Start::Stepper -->
        <div class="mt-4 px-4 sm:px-6 lg:px-8">
            <nav aria-label="Progress">
                <ol class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
                    <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative md:flex-1 md:flex">
                        <a v-if="step.status === 'complete'" :href="step.href" class="group flex items-center w-full">
                            <span class="px-4 py-3 flex items-center text-sm font-medium">
                                <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-cyan-600 rounded-full group-hover:bg-green-800">
                                    <CheckIcon class="w-5 h-5 text-white" aria-hidden="true" />
                                </span>
                                <span class="ml-4 text-sm font-medium text-gray-900">{{ step.name }}</span>
                            </span>
                        </a>
                        <a v-else-if="step.status === 'current'" :href="step.href" class="px-4 py-3 flex items-center text-sm font-medium" aria-current="step">
                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center border-2 border-cyan-600 rounded-full">
                                <span class="text-cyan-600">{{ step.id }}</span>
                            </span>
                            <span class="ml-4 text-sm font-medium text-cyan-600">{{ step.name }}</span>
                        </a>
                        <a v-else :href="step.href" class="group flex items-center">
                            <span class="px-4 py-3 flex items-center text-sm font-medium">
                                <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                <span class="text-gray-500 group-hover:text-gray-900">{{ step.id }}</span>
                                </span>
                                <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ step.name }}</span>
                            </span>
                        </a>
                        <template v-if="(stepIdx !== steps.length - 1)">
                        <!-- Arrow separator for lg screens and up -->
                        <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                            <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                            </svg>
                        </div>
                        </template>
                    </li>
                </ol>
            </nav>
            <!-- Strat::Stepper Contents -->
            <div class="bg-gray-50 p-4 mt-4">
                <form class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                        <div>
                            <div class="sm:border-b sm:border-gray-200 pb-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Official Information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    This information will be displayed publicly so be careful what you share.
                                </p>
                            </div>

                            <div class="mt-4 sm:mt-3 space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                    <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Official
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <div class="max-w-lg flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            workcation.com/
                                            </span>
                                            <input type="text" name="username" id="username" autocomplete="username" class="flex-1 block w-full focus:ring-cyan-500 focus:border-cyan-500 min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" />
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Nick Name
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Location
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                        <select id="country" name="country" autocomplete="country" class="max-w-lg block focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                            <option>United States</option>
                                            <option>Canada</option>
                                            <option>Mexico</option>
                                        </select>
                                        <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Date Of Join
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                            <input type="text" name="join-date" id="join-date" class="focus:ring-cyan-500 focus:border-cyan-500 relative block w-full rounded-none rounded-tl-md rounded-bl-md bg-transparent focus:z-10 sm:text-sm border-gray-300" placeholder="DD / MM / YY" />
                                        </div>
                                        <button class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500">
                                            <CalendarIcon class="h-5 w-5 text-cyan-400" aria-hidden="true"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 space-y-6 sm:pt-10 sm:space-y-5">
                            <div class="sm:border-b sm:border-gray-200 pb-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Official Information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    This information will be displayed publicly so be careful what you share.
                                </p>
                            </div>
                            <div class="space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    First name
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Last name
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Email address
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Country / Region
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="country" name="country" autocomplete="country" class="max-w-lg block focus:ring-cyan-500 focus:border-cyan-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>Mexico</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="street_address" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Street address
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="street_address" id="street_address" autocomplete="street-address" class="block max-w-lg w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="city" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    City
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="city" id="city" class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="state" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    State / Province
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="state" id="state" class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="zip" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    ZIP / Postal
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="zip" id="zip" autocomplete="postal-code" class="max-w-lg block w-full shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                            <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Notifications
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                We'll always let you know about important changes, but you pick what else you want to hear about.
                            </p>
                            </div>
                            <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                            <div class="pt-6 sm:pt-5">
                                <div role="group" aria-labelledby="label-email">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                    <div>
                                    <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-email">
                                        By Email
                                    </div>
                                    </div>
                                    <div class="mt-4 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg space-y-4">
                                        <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="comments" name="comments" type="checkbox" class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300 rounded" />
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="comments" class="font-medium text-gray-700">Comments</label>
                                            <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                        </div>
                                        </div>
                                        <div>
                                        <div class="relative flex items-start">
                                            <div class="flex items-center h-5">
                                            <input id="candidates" name="candidates" type="checkbox" class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300 rounded" />
                                            </div>
                                            <div class="ml-3 text-sm">
                                            <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                                            <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div>
                                        <div class="relative flex items-start">
                                            <div class="flex items-center h-5">
                                            <input id="offers" name="offers" type="checkbox" class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300 rounded" />
                                            </div>
                                            <div class="ml-3 text-sm">
                                            <label for="offers" class="font-medium text-gray-700">Offers</label>
                                            <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="pt-6 sm:pt-5">
                                <div role="group" aria-labelledby="label-notifications">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                    <div>
                                    <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-notifications">
                                        Push Notifications
                                    </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                    <div class="max-w-lg">
                                        <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                                        <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input id="push_everything" name="push_notifications" type="radio" class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300" />
                                            <label for="push_everything" class="ml-3 block text-sm font-medium text-gray-700">
                                            Everything
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="push_email" name="push_notifications" type="radio" class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300" />
                                            <label for="push_email" class="ml-3 block text-sm font-medium text-gray-700">
                                            Same as email
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="push_nothing" name="push_notifications" type="radio" class="focus:ring-cyan-500 h-4 w-4 text-cyan-600 border-gray-300" />
                                            <label for="push_nothing" class="ml-3 block text-sm font-medium text-gray-700">
                                            No push notifications
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                        <div class="pt-5">
                        <div class="flex justify-end">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End::Stepper Contents -->
        </div>
        <!-- End::Stepper -->
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/App";
import {CheckCircleIcon, OfficeBuildingIcon, CashIcon, ChevronRightIcon, CheckIcon, CalendarIcon} from '@heroicons/vue/solid'
import {ScaleIcon} from "@heroicons/vue/outline/esm";

const cards = [
    {name: 'Account balance', href: '#', icon: ScaleIcon, amount: '$30,659.45'},
    // More items...
]
const transactions = [
    {
        id: 1,
        name: 'Payment to Molly Sanders',
        href: '#',
        amount: '$20,000',
        currency: 'USD',
        status: 'success',
        date: 'July 11, 2020',
        datetime: '2020-07-11',
    },
    // More transactions...
]
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800',
}

const steps = [
  { id: 'A', name: 'Employee Details', href: '#', status: 'complete' },
  { id: 'B', name: 'Application form', href: '#', status: 'current' },
  { id: 'C', name: 'Preview', href: '#', status: 'upcoming' },
  { id: 'D', name: 'Preview', href: '#', status: 'upcoming' },
  { id: 'E', name: 'Preview', href: '#', status: 'upcoming' },
]
export default {
    components: {
        AppLayout,
        OfficeBuildingIcon,
        CheckCircleIcon,
        CashIcon,
        ChevronRightIcon,
        CheckIcon,
        CalendarIcon
    },
    setup() {
        return {
            cards,
            transactions,
            statusStyles,
            steps,
        }
    }
}
</script>
