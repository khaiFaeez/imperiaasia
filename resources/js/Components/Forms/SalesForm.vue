<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import Multiselect from '@vueform/multiselect'

export default {
    props:['consultants','sales'],
    components:{
        BreezeInput,
        BreezeLabel,
        Multiselect
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
                '0': 'CALL',
                '1': 'WHATSAPP',
                '2': 'WALKIN',
                '3': 'ROADSHOW'
            }
        }
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
    <div class="bg-white  p-12 rounded-xl grid md:grid-cols-3 gap-x-4 ">
        <div>
            <BreezeLabel value="Sales Person" />

            <Multiselect v-model="sales.consultant" placeholder="Please select" label="Employee_Code" valueProp="id"
                :options="consultants" :canClear="false" :searchable="true"
                class="select input-bordered border-primary w-full" :classes="{
    optionSelected: 'bg-gray-400',
    optionSelectedPointed:'bg-gray-400 text-white',
    containerActive: 'ring-none',
                }">
                <template v-slot:singlelabel=" { value }">
                    <div class="multiselect-single-label">
                        <p :class="{ 'text-error': value.Status != 'Active','text-success':value.Status == 'Active'}">
                            {{value.Name}} - {{value.Employee_Code}} </p>
                    </div>
                </template>

                <template v-slot:option="{ option }">
                    <p :class="{ 'text-error': option.Status != 'Active','text-success':option.Status == 'Active'}">
                        {{option.Name}} - {{option.Employee_Code}} </p>
                </template>
            </Multiselect>

        </div>


        <div class="col-lg-3">
            <BreezeLabel value="Sales Channel" />
            <Multiselect name="channel" :close-on-select="true" v-model="sales.channel" :options="channel"
                :canClear="false" class="select input-bordered border-primary w-full" :classes="{
    optionSelected: 'bg-gray-400',
    optionSelectedPointed:'bg-gray-400 text-white',
    containerActive: 'ring-none',
                }">
            </Multiselect>
        </div>

        <div class="col-lg-3">
            <BreezeLabel value="Closing Source" />
            <Multiselect name="closing" :close-on-select="true" v-model="sales.closing" :options="closing"
                :canClear="false" class="select input-bordered border-primary w-full" :classes="{
    optionSelected: 'bg-gray-400',
    optionSelectedPointed:'bg-gray-400 text-white',
    containerActive: 'ring-none',
                }">
            </Multiselect>
        </div>
    </div>
</template>
