<script>
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue'
import BreezeLabel from '@/Components/Label.vue'

export default {
    props:['payment'],
    components:{
        BreezeInput,
        BreezeInputError,
        BreezeLabel
    },
    methods:{
         totalSettlement () {
            this.payment.total_settlement = this.payment.items.reduce((a, b) => +a + +b.settlement, 0);;//this.products.items.forEach( (e) => Number(this.products.items[0].total) + Number(this.products.items[1].total) + Number(this.products.items[2].total) + Number(this.products.items[3].total )+ Number(this.products.items[4].total)
        },
    }
}
</script>

<template>
    <div class="bg-white  p-12 rounded-xl grid md:grid-cols-3 gap-x-4 ">
        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <BreezeLabel value="Client Occupation" />
            </div>
            <div class="md:w-2/3">
                <select name="Occupation" v-model="payment.occupation" class="input input-bordered w-full">
                    <option value=''>Please select</option>
                    <option value='1'>Gaji Bulanan</option>
                    <option value='2'>Bekerja Sendiri/berniaga</option>
                    <option value='3'>Suri Rumah</option>
                    <option value='4'>Goverment Staff</option>
                </select>
                <BreezeInputError :message="$page.props.errors.occupation" />
            </div>
        </div>
    </div>
    <div class="overflow-x-auto py-2">
        <BreezeInputError
            :message="$page.props.errors.updateInvoice?.hasOwnProperty('payment.items.0.ptp') ? $page.props.errors.updateInvoice['payment.items.0.ptp'] : ''" />
        <table class=" table table-compact w-full">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Promise To Pay (PTP)</th>
                    <th scope="col">Settlement (RM)</th>
                </tr>
            </thead>
            <tbody>

                <tr class="line_items" v-for="(n, i) in payment.items.length" :key="i">
                    <td class="">{{n}}</td>
                    <td>
                        <BreezeInput type="date" v-model="payment.items[i].ptp" placeholder="" class="border-0" />
                    </td>
                    <td>
                        <BreezeInput v-model="payment.items[i].settlement" placeholder="" class="border-0"
                            @change="totalSettlement(i)" />
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan=1></th>
                <th>Total Settlement (RM)</th>
                <th>
                    <BreezeInput v-model="payment.total_settlement" name="total_settlement" placeholder="" />
                </th>
            </tfoot>
        </table>
    </div>
</template>



