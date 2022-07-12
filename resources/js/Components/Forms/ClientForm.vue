<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from '@/Components/InputError.vue'

export default {
    props: ['client', 'countries', 'states'],
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
        <div class="card-body grid grid-cols-1 xl:grid-cols-2 gap-x-4">
            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="IC Number / Passport" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="MyKad_SSM"
                        v-model="client.MyKad_SSM"
                    />
                    <BreezeInputError :message="$page.props.errors.MyKad_SSM" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Name" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Name"
                        v-model="client.Name"
                    />
                    <BreezeInputError :message="$page.props.errors.Name" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Contact No. 1" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Phone_1"
                        v-model="client.Mobile_No"
                    />
                    <BreezeInputError :message="$page.props.errors.Mobile_No" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Contact No. 2" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Phone_2"
                        v-model="client.Phone"
                        placeholder=""
                    />
                    <BreezeInputError :message="$page.props.errors.Phone" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Contact No. 3" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        name="Phone_3"
                        v-model="client.Off_Phone"
                        placeholder=""
                    />
                    <BreezeInputError :message="$page.props.errors.Off_Phone" />
                </div>
            </div>

            <!-- <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Client Occupation" />
                </div>
                <div class="md:w-2/3">
                    <select name="Occupation" v-model="client.occupation" class="input input-bordered w-full">
                        <option value=''>Please select</option>
                        <option value='A'>Gaji Bulanan</option>
                        <option value='B'>Bekerja Sendiri/berniaga</option>
                        <option value='C'>Suri Rumah</option>
                        <option value='D'>Goverment Staff</option>
                    </select>
                    <BreezeInputError :message="$page.props.errors.occupation" />
                </div>
            </div> -->

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Address" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        placeholder=""
                        name="Address"
                        v-model="client.Address"
                    />
                    <BreezeInputError :message="$page.props.errors.Address" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Address 2" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        placeholder=""
                        name="Address_2"
                        v-model="client.Address_2"
                    />
                    <BreezeInputError :message="$page.props.errors.Address_2" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Poscode" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        placeholder=""
                        name="Poscode"
                        v-model="client.Poscode"
                    />
                    <BreezeInputError :message="$page.props.errors.Poscode" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="City" />
                </div>
                <div class="md:w-2/3">
                    <BreezeInput
                        type="text"
                        placeholder=""
                        name="City"
                        v-model="client.City"
                    />
                    <BreezeInputError :message="$page.props.errors.City" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="State" />
                </div>
                <div class="md:w-2/3">
                    <select
                        name="State"
                        v-model="client.State"
                        class="select input-bordered w-full"
                    >
                        <option value="">Please select state</option>
                        <option
                            v-for="$state in states"
                            :key="$state.id"
                            :value="$state.id"
                        >
                            {{ $state.Negeri }}
                        </option>
                    </select>
                    <BreezeInputError :message="$page.props.errors.State" />
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <BreezeLabel value="Country" />
                </div>
                <div class="md:w-2/3">
                    <select
                        name="Country"
                        v-model="client.Country"
                        class="select input-bordered w-full"
                    >
                        <option
                            v-for="$country in countries"
                            :key="$country"
                            :value="$country"
                        >
                            {{ $country }}
                        </option>
                    </select>
                    <BreezeInputError :message="$page.props.errors.Country" />
                </div>
            </div>
        </div>
    </div>
</template>
