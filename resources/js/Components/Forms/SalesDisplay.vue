<script>
import BreezeLabel from '@/Components/Label.vue'

export default {
    props:['consultants','sales'],
    components:{
        BreezeLabel,
    },
    data() {
        return {
            channel:{
                1:'ONLINE',
                2:'DISTRIBUTOR',
                3:'OFFLINE',
                4:'SPECIAL ORDER'
            },
            closing:{
                'A':'CALL',
                'B':'WHATSAPP',
                'C':'WALKIN',
                'D':'ROADSHOW'
            }
        }
    },
     computed: {
                activeSales() {
                    return this.channel[this.sales.channel]
                },
                activeClosing() {
                    return this.channel[this.sales.closing]
                }
  }
}
</script>
<template>
    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4">
        <div>
            <BreezeLabel value="Sales Person" />
            <p>{{sales.consultant}}</p>
        </div>


        <div class="col-lg-3">
            <BreezeLabel value="Sales Channel" />
            <p>{{activeSales}}</p>
        </div>

        <div class="col-lg-3">
            <BreezeLabel value="Closing Source" />
            <p>{{activeClosing}}</p>
        </div>
    </div>
</template>
