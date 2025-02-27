<template>
    <div class="w-full sm:w-3/6 mx-auto sm:pt-2 sm:px-3">
        <div class="flex items-center justify-between mb-3">
            <label class="text-base font-medium text-gray-700 sm:mt-px sm:pt-2">
                Contact Number<span class="text-blue-600"> *</span>
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
            class="md:grid md:grid-cols-1 md:gap-0 md:gap-y-6"
        >
            <template #form class="md:col-span-12">
                <div class="mt-1 sm:mt-0">
                    <div class="flex gap-2" v-for="(item, index) in form.items">
                        <textarea v-model="item.contact_number_type"
                                  class="block h-10 w-24 sm:w-36 py-1 px-1 text-base border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm rounded-md resize-none"></textarea>
                        <jet-input-error
                            :message="getNestedErrors('items.'+index+'.contact_number_type',form)"
                            class="mb-2"
                        />
                        <div class="w-full relative">
                            <vue-tel-input
                                :value="item.contact_number"
                                :ref="`telPhone_`+index"
                                mode="international"
                                class="h-10 focus:ring-cyan-500 focus:border-cyan-500 relative block w-full !rounded-md sm:text-sm !border-gray-300 overflow-hidden"
                            >
                            </vue-tel-input>
                            <jet-input-error
                                :message="getNestedErrors('items.'+index+'.contact_number',form)"
                                class="mb-2"
                            />
                            <button
                                v-if="index !== 0"
                                @click.prevent="removeItem(index, item)"
                                class="absolute right-1 sm:right-2 top-1.5 text-red-500 hover:bg-gray-200 rounded-full h-7 w-7 text-center">
                                <XIcon class="h-5 w-5 text-red-400 mx-auto"/>
                            </button>
                        </div>
                    </div>
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
import {VueTelInput} from 'vue3-tel-input'

export default {
    components: {
        JetFormSection,
        PlusCircleIcon,
        XIcon,
        JetLabel,
        JetInputError,
        JetInput,
        VueTelInput
    },
    props: {
        employee: Object,
        numberTypes: Array
    },
    data() {
        return {
            open: false,
            form: this.$inertia.form({
                items: [],
                continue: false,
            }, {
                resetOnSuccess: true,
            }),
            phone: null,
        }
    },
    mounted() {
        this.setOptions()
    },
    methods: {
        setOptions() {
            this.form.items = []
            if (this.employee.contact_numbers.length) {
                this.employee.contact_numbers.forEach((value, index) => {
                    let data = {
                        id: value.id,
                        type: value.type,
                        contact_number: value.number,
                        contact_number_type: value.contact_type
                    }
                    this.form.items.push(data)
                })
            } else {
                this.addNewItem()
            }
        },
        getValue(index) {
            return this.employee.contact_numbers[index]
                ? this.employee.contact_numbers[index].number
                : '';
        },
        addNewItem() {
            this.form.items.push({
                contact_number: null,
                contact_number_type: null,
            })
        },
        removeItem(index, item) {
            if (item.id) {
                this.$inertia.delete(this.route('employees.edit.contact-details.item-destroy', {
                    'id': this.employee.id,
                    'contactDetailsId': item.id
                }), {
                    preserveState: false,
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
            let newItems = [];

            this.form.items.forEach((item, index) => {
                if (item.contact_number === null) {
                    newItems.push({
                        contact_number_type: item.contact_number_type,
                        contact_number: this.$refs['telPhone_' + index].phoneObject.number,
                    })
                    this.form.items = newItems;
                    this.form.post(this.route('employees.edit.contact-details.store.number', this.employee.id));
                } else {
                    if (this.employee.contact_numbers[index].number === this.$refs['telPhone_' + index].phoneObject.number) {
                        this.form.post(this.route('employees.edit.contact-details.store.number', this.employee.id));
                    }
                }
            });

            // this.form.post(this.route('employees.edit.contact-details.store.number', this.employee.id))

            // let newItems = []
            // this.form.items.forEach((item, index) => {
            //     console.log(item);
            //     newItems.push({
            //         contact_number_type: item.contact_number_type,
            //         contact_number: this.$refs['telPhone_' + index].phoneObject.number,
            //     })
            // });
            // this.form.items = newItems

            // this.form.post(this.route('employees.edit.contact-details.store.number', this.employee.id))
        },
        saveAndContinue() {
            this.form.continue = true
            this.submit()
        }
    }
}
</script>

<style scoped>

</style>
