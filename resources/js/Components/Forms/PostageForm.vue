<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from '@/Components/InputError.vue'

export default {
    props: ['countries', 'states', 'shipping'],
    components: {
        BreezeLabel,
        BreezeInput,
        BreezeInputError,
        Link
    }
}
</script>
<template>
    <div class="w-full card bg-white">
        <div class="card-body grid grid grid-cols-1 xl:grid-cols-2 gap-x-4">
            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping Name" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Ship_Name"
                        v-model="shipping.Ship_Name"
                    />
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_Name'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_Name'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping Phone" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Ship_Phone"
                        v-model="shipping.Ship_Phone"
                    />
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_Phone'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_Phone'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping Address" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Ship_Add1"
                        v-model="shipping.Ship_Add1"
                    />
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_Add1'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_Add1'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping Address" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Ship_Add2"
                        v-model="shipping.Ship_Add2"
                    />
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_Add2'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_Add2'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping Postcode" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Ship_poscode"
                        v-model="shipping.Ship_poscode"
                    />
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_poscode'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_poscode'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping City" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Ship_City"
                        v-model="shipping.Ship_City"
                    />
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_City'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_City'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping State" />
                </div>
                <div class="md:w-2/3">
                    <select
                        name="State"
                        v-model="shipping.Ship_State"
                        class="select select-bordered w-full select-sm"
                    >
                        <option value="">Please select state</option>
                        <option
                            v-for="$state in $page.props.states"
                            :key="$state.id"
                            :value="$state.id"
                        >
                            {{ $state.Negeri }}
                        </option>
                    </select>
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_State'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_State'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Shipping Country" />
                </div>
                <div class="md:w-2/3">
                    <select
                        name="Country"
                        v-model="shipping.Ship_Country"
                        class="select select-bordered w-full select-sm"
                    >
                        <option
                            v-for="$country in $page.props.countries"
                            :key="$country"
                            :value="$country"
                        >
                            {{ $country }}
                        </option>
                    </select>
                    <BreezeInputError
                        :message="
                            $page.props.errors.updateInvoice?.hasOwnProperty(
                                'shipping.Ship_Country'
                            )
                                ? $page.props.errors.updateInvoice[
                                      'shipping.Ship_Country'
                                  ]
                                : ''
                        "
                    />
                </div>
            </div>
        </div>
    </div>
</template>
