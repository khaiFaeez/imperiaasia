<script>
import moment from 'moment'
import BreezeLabel from '@/Components/Label.vue'

export default {
    props: ['payment'],
    created: function () {
        this.moment = moment
    },
    components: { BreezeLabel },
    data() {
        return {
            occupation: {
                A: 'Gaji Bulanan',
                B: 'Bekerja Sendiri/berniaga',
                C: 'Suri Rumah',
                D: 'Goverment Staff'
            }
        }
    },
    computed: {
        totalSettlement() {
            return this.payment.items.reduce((a, b) => +a + +b.settlement, 0) //this.products.items.forEach( (e) => Number(this.products.items[0].total) + Number(this.products.items[1].total) + Number(this.products.items[2].total) + Number(this.products.items[3].total )+ Number(this.products.items[4].total)
        },
        activeOccupation() {
            return this.occupation[this.payment.occupation]
        }
    }
}
</script>

<template>
    <div class="overflow-x-auto p-6 bg-base-100 ">
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
                    <td class="">{{ n }}</td>
                    <td>
                        <!-- <Datepicker v-model="payment.items[i].ptp"  :format="YYYY-MM-dd" :previewFormat="YYYY-MM-dd"  type="date"></Datepicker> -->

                        <p>
                            {{
                                    payment.items[i].ptp
                                        ? moment(payment.items[i].ptp).format(
                                            'DD/MM/YYYY'
                                        )
                                        : ''
                            }}
                        </p>
                    </td>
                    <td>
                        <p>{{ payment.items[i].settlement }}</p>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan="1"></th>
                <th>Total Settlement (RM)</th>
                <th>
                    {{
                            totalSettlement.toLocaleString('en', {
                                useGrouping: false,
                                minimumFractionDigits: 2
                            })
                    }}
                </th>
            </tfoot>
        </table>
    </div>
</template>
