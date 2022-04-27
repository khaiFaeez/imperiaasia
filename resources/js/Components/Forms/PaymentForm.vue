<script>
import BreezeInput from '@/Components/Input.vue';
export default {
    props:['payment'],
    components:{
        BreezeInput,
    },
    data() {
        return {
            form:this.$inertia.form({
                    total_settlement:"",
                    items: Object.values(this.payment.items)
                })
        }
    },
    methods:{
    }
}
</script>
<template>
    <div class="overflow-auto">
    <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Promise To Pay (PTP)</th>
                        <th scope="col">Settlement (RM)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="line_items" v-for="($p,i) in 4" :key="i">
                        <td>
                            {{$p}}
                        </td>
                        <td>
                            <BreezeInput type="date" v-model="form.items[i].ptp" placeholder="" />
                        </td>
                        <td>
                            <BreezeInput type="text" v-model="form.items[i].settlement" placeholder="" />
                        </td>
                        <td>
                            <button type="button"><span style="font-size: 1em; color: Tomato;"><i class="fas fa-times"/></span></button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <th ></th>
                    <th >Total Settlement (RM)</th>
                    <th ><BreezeInput type="text" v-model="form.total_settlement" placeholder=""  /></th>
                </tfoot>
            </table>
        </div>
</template>
