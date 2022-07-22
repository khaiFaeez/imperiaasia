<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInputError from '@/Components/InputError.vue'
import Multiselect from '@vueform/multiselect'

export default {
    props: ['consultants', 'sales', 'invoice'],
    components: {
        BreezeInput,
        BreezeLabel,
        Multiselect,
        BreezeInputError
    },
    data() {
        return {
            value: null,
            options: ['list', 'of', 'options'],
            channel: {
                1: 'ONLINE',
                2: 'DISTRIBUTOR',
                3: 'OFFLINE',
                4: 'SPECIAL ORDER'
            },
            closing: {
                A: 'CALL',
                B: 'WHATSAPP',
                C: 'WALKIN',
                D: 'ROADSHOW'
            }
        }
    },
    methods: {
        findName(consultant) {
            this.sales.consultant2 = consultant.Name
        }
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
    <div class="bg-white p-12 rounded-xl grid md:grid-cols-3 gap-x-4">
        <div>
            <BreezeLabel value="Sales Person" />

            <Multiselect
                v-model="sales.consultant"
                placeholder="Please select"
                label="Employee_Code"
                valueProp="id"
                :options="consultants"
                :canClear="false"
                :searchable="true"
                track-by="Name"
                class="select input-bordered border-primary w-full"
                :classes="{
                    optionSelected: 'bg-gray-400',
                    optionSelectedPointed: 'bg-gray-400 text-white',
                    containerActive: 'ring-none'
                }"
            >
                <template v-slot:singlelabel="{ value }">
                    <div class="multiselect-single-label">
                        <p
                            :class="{
                                'text-error': value.Status != 'Active',
                                'text-success': value.Status == 'Active'
                            }"
                        >
                            {{ value.Name }} - {{ value.Employee_Code }}
                        </p>
                    </div>
                </template>

                <template v-slot:option="{ option }">
                    <p
                        :class="{
                            'text-error': option.Status != 'Active',
                            'text-success': option.Status == 'Active'
                        }"
                    >
                        {{ option.Name }} - {{ option.Employee_Code }}
                    </p>
                </template>
            </Multiselect>
            <BreezeInputError
                :message="
                    $page.props.errors.updateInvoice?.hasOwnProperty(
                        'sales.consultant'
                    )
                        ? $page.props.errors.updateInvoice['sales.consultant']
                        : ''
                "
            />
        </div>

        <div class="col-lg-3">
            <BreezeLabel value="Sales Channel" />
            <Multiselect
                name="channel"
                :close-on-select="true"
                v-model="sales.channel"
                :options="channel"
                :canClear="false"
                class="select input-bordered border-primary w-full"
                :classes="{
                    optionSelected: 'bg-gray-400',
                    optionSelectedPointed: 'bg-gray-400 text-white',
                    containerActive: 'ring-none'
                }"
            >
            </Multiselect>
            <BreezeInputError
                :message="
                    $page.props.errors.updateInvoice?.hasOwnProperty(
                        'sales.channel'
                    )
                        ? $page.props.errors.updateInvoice['sales.channel']
                        : ''
                "
            />
        </div>

        <div class="col-lg-3">
            <BreezeLabel value="Closing Source" />
            <Multiselect
                name="closing"
                :close-on-select="true"
                v-model="sales.closing"
                :options="closing"
                :canClear="false"
                class="select input-bordered border-primary w-full"
                :classes="{
                    optionSelected: 'bg-gray-400',
                    optionSelectedPointed: 'bg-gray-400 text-white',
                    containerActive: 'ring-none'
                }"
            >
            </Multiselect>
            <BreezeInputError
                :message="
                    $page.props.errors.updateInvoice?.hasOwnProperty(
                        'sales.closing'
                    )
                        ? $page.props.errors.updateInvoice['sales.closing']
                        : ''
                "
            />
        </div>

        <div class="col-lg-3">
            <BreezeLabel value="Order Status" />
            <select v-model="invoice.Orderstatus">
                <option value="REPEAT">REPEAT</option>
                <option value="RESHUFFLE">RESHUFFLE</option>
            </select>
            <BreezeInputError
                :message="
                    $page.props.errors.updateInvoice?.hasOwnProperty(
                        'sales.closing'
                    )
                        ? $page.props.errors.updateInvoice['sales.closing']
                        : ''
                "
            />
        </div>
    </div>
</template>
