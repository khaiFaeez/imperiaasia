<script>
import BreezeInput from '@/Components/Input.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    props:['payment'],
    components:{
        BreezeInput,
        Datepicker
    },
    methods:{
         totalSettlement () {
            this.payment.total_settlement = this.payment.items.reduce((a, b) => +a + +b.settlement, 0);;//this.products.items.forEach( (e) => Number(this.products.items[0].total) + Number(this.products.items[1].total) + Number(this.products.items[2].total) + Number(this.products.items[3].total )+ Number(this.products.items[4].total)
        },
    }
}
</script>

<template>
<div class="overflow-x-auto py-2">
            <table class="table table-compact w-full">
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
                        <td class="p-0">
                              <!-- <Datepicker v-model="payment.items[i].ptp"  :format="YYYY-MM-dd" :previewFormat="YYYY-MM-dd"  type="date"></Datepicker> -->

                            <BreezeInput type="date" v-model="payment.items[i].ptp" placeholder="" class="border-0"/>
                        </td>
                        <td class="p-0">
                            <BreezeInput v-model="payment.items[i].settlement" placeholder="" class="border-0" @change="totalSettlement(i)"/>
                        </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <th colspan=1></th>
                    <th >Total Settlement (RM)</th>
                    <th ><BreezeInput v-model="payment.total_settlement" name="total_settlement"  placeholder="" /></th>
                    </tfoot>
            </table>
            </div>
</template>



