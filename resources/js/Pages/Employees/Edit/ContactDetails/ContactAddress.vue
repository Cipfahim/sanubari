<template>
    <div class="w-full mx-auto">
        <div class="w-full mx-auto flex items-center justify-between mt-3">
            <label class="text-base font-medium text-gray-700 sm:mt-px sm:pt-2">
                Address<span class="text-blue-600"> *</span>
            </label>

            <button
                type="button"
                @click.prevent="addNewItem"
                class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 flex items-center"
            >
                <PlusCircleIcon class="h-5 w-5 text-cyan-400 mr-2"/>
                Add
            </button>
        </div>

        <jet-form-section
            @submitted="submit"
        >
            <template #form>
                <div class="h-[500px] overflow-y-auto scrollbar-hide">
                    <div class="mt-1 sm:mt-0 sm:grid grid-cols-2 gap-8">
                        <div class="relative col-span-1 border-gray-300 border p-4 mb-3 sm:mb-0 rounded"
                             v-for="(item, index) in form.items">
                            <button
                                v-if="index !== 0"
                                @click.prevent="removeItem(index, item)"
                                class="absolute right-1 top-1 text-white bg-red-200 rounded-full h-6 w-6 text-center">
                                <XIcon class="h-5 w-5 text-red-600 mx-auto"/>
                            </button>
                            <div class="space-y-2">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Address
                                        Type</label>
                                    <textarea
                                        v-model="item.type"
                                        class="mt-1 block w-full h-10 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm rounded-md"
                                        :class="{ 'border-red-500': getNestedErrors('items.'+index+'.addressType',form) }"
                                    ></textarea>
                                    <jet-input-error
                                        :message="getNestedErrors('items.'+index+'.addressType',form)"
                                        class="mb-2"
                                    />
                                </div>
                                <div>
                                    <jet-label for="nationality" value="Nationality *"/>
                                    <div class="col-span-2 max-w-lg">
                                        <Multiselect
                                            searchable
                                            v-model="item.country"
                                            :options="countries"
                                            valueProp="id"
                                            trackBy="name"
                                            placeholder="Choose a nationality"
                                            class="mt-1 block w-full"
                                            :class="{ 'border-red-500' : form.errors.country }"
                                        >
                                            <template v-slot:singlelabel="{ value }">
                                                <div class="flex gap-2 items-center multiselect-single-label">
                                                    <img class="h-8 w-10 rounded-md character-label-icon"
                                                         :src="getFileUrl(value.flag_path)">
                                                    <p class="flex-1">{{ value.name }}</p>
                                                </div>
                                            </template>
                                            <template v-slot:option="{ option }">
                                                <div class="flex gap-2 items-center">
                                                    <img class="h-8 w-10 rounded-md"
                                                         :src="getFileUrl(option.flag_path)">
                                                    <p class="flex-1">{{ option.name }}</p>
                                                </div>
                                            </template>
                                        </Multiselect>
                                        <jet-input-error
                                            :message="getNestedErrors('items.'+index+'.country',form)"
                                            class="mb-2"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-700">
                                        Address<span class="text-blue-600"> *</span>
                                    </label>
                                    <jet-input
                                        id="address_line_one"
                                        type="text"
                                        v-model="item.address_line_one"
                                        class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                                        :class="{ 'border-red-500': getNestedErrors('items.'+index+'.address_line_one',form) }"
                                    />
                                    <jet-input-error
                                        :message="getNestedErrors('items.'+index+'.address_line_one',form)"
                                        class="mb-2"
                                    />
                                </div>

                                <div>
                                    <label class="text-sm text-gray-700">
                                        Address 2
                                    </label>
                                    <jet-input
                                        id="address_line_two"
                                        type="text"
                                        v-model="item.address_line_two"
                                        class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                                        :class="{ 'border-red-500': getNestedErrors('items.'+index+'.address_line_two',form) }"
                                    />
                                    <jet-input-error
                                        :message="getNestedErrors('items.'+index+'.address_line_two',form)"
                                        class="mb-2"
                                    />
                                </div>

                                <div>
                                    <label class="text-sm text-gray-700">
                                        Address 3
                                    </label>
                                    <jet-input
                                        id="address_line_three"
                                        type="text"
                                        v-model="item.address_line_three"
                                        class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                                        :class="{ 'border-red-500': getNestedErrors('items.'+index+'.address_line_three',form) }"
                                    />
                                    <jet-input-error
                                        :message="getNestedErrors('items.'+index+'.address_line_three',form)"
                                        class="mb-2"
                                    />
                                </div>

                                <div class="sm:grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="text-sm text-gray-700">
                                            Postal Code
                                        </label>
                                        <jet-input
                                            id="postal_code"
                                            type="text"
                                            v-model="item.postal_code"
                                            class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                                            :class="{ 'border-red-500': getNestedErrors('items.'+index+'.postal_code',form) }"
                                        />
                                        <jet-input-error
                                            :message="getNestedErrors('items.'+index+'.postal_code',form)"
                                            class="mb-2"
                                        />
                                    </div>

                                    <div>
                                        <label class="text-sm text-gray-700">
                                            City *
                                        </label>
                                        <jet-input
                                            id="city"
                                            type="text"
                                            v-model="item.city"
                                            class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                                            :class="{ 'border-red-500': getNestedErrors('items.'+index+'.city',form) }"
                                        />
                                        <jet-input-error
                                            :message="getNestedErrors('items.'+index+'.city',form)"
                                            class="mb-2"
                                        />
                                    </div>

                                    <div>
                                        <label class="text-sm text-gray-700">
                                            State *
                                        </label>
                                        <jet-input
                                            id="state"
                                            type="text"
                                            v-model="item.state"
                                            class="focus:ring-cyan-500 focus:border-cyan-500 block w-full sm:text-sm border border-gray-300 rounded-md mb-3"
                                            :class="{ 'border-red-500': getNestedErrors('items.'+index+'.state',form) }"
                                        />
                                        <jet-input-error
                                            :message="getNestedErrors('items.'+index+'.state',form)"
                                            class="mb-2"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="getMeIfYouCan"></div>
                </div>

                <div class="pt-5">
                    <div class="space-y-6 sm:space-y-5">
                        <div
                            class="sm:grid sm:grid-cols-1 sm:gap-4 sm:items-start sm:pt-2"
                        >
                            <div class="mt-1 sm:mt-0 sm:col-span-1">
                                <div
                                    class="max-w-full relative flex justify-end items-stretch flex-grow focus-within:z-10"
                                >
                                    <inertia-link
                                        :href="route('employees.edit.identification.index',employee.id)"
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
            </template>
        </jet-form-section>
    </div>

</template>

<script>
import {PlusCircleIcon, XIcon,} from "@heroicons/vue/solid";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetFormSection from "@/Jetstream/FormSection";
import Multiselect from "@vueform/multiselect";
import '@vueform/multiselect/themes/default.css'

export default {
    components: {
        JetFormSection,
        PlusCircleIcon,
        XIcon,
        JetLabel,
        JetInputError,
        JetInput,
        Multiselect
    },
    props: {
        employee: Object,
        addressTypes: Array,
        countries: Array,
    },
    data() {
        return {
            open: false,
            form: this.$inertia.form({
                items: [],
                continue: false
            }, {
                resetOnSuccess: true,
            }),
        }
    },
    mounted() {
        this.setOptions()
    },
    methods: {
        setOptions() {
            this.form.items = []
            if (this.employee.contact_address.length) {
                this.employee.contact_address.forEach((value, index) => {
                    let data = {
                        id: value.id,
                        type: value.type,
                        address_line_one: value.address_line_one,
                        address_line_two: value.address_line_two,
                        address_line_three: value.address_line_three,
                        city: value.city,
                        country: value.country,
                        postal_code: value.postal_code,
                        state: value.state,
                    }
                    this.form.items.push(data)
                })
            } else {
                this.addNewItem()
            }
        },

        addNewItem() {
            this.form.items.push({
                addressType: null,
                nationality: null,
                address_line_one: null,
                address_line_two: null,
                address_line_three: null,
                postal_code: null,
                city: null,
                state: null
            })

            setTimeout(function () {
                document.getElementById('getMeIfYouCan').scrollIntoView();
            }, 100);

        },
        removeItem(index, item) {
            if (item.id) {
                this.$inertia.delete(this.route('employees.edit.contact-details.item-destroy', {
                    'id': this.employee.id,
                    'contactDetailsId': item.id
                }), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.setOptions()
                    }
                })
            } else {
                this.form.items.splice(index, 1)
            }
        },
        submit() {
            this.form.post(this.route('employees.edit.contact-details.store.address', this.employee.id))
        },
        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    }
}
</script>
