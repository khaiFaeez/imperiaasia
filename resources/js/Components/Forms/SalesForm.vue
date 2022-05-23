<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'

export default {
    props:['consultants','sales'],
    components:{
        BreezeInput,
        BreezeLabel,
    },
    data() {
        return {
            value: null,
            options: ['list', 'of', 'options']
        }
    }
}
</script>
<template>
    <div class="grid grid-cols-1 gap-5">
                        <div>
                        <BreezeLabel value="Sales Person" />
                          <select id="Sales_Person" name="Sales_Person" class="select border-primary w-full input" v-model="sales.consultant">
                            <option  value=''>Please select consultant</option>
                            <option v-for="($consultant,i) in consultants" :key="i" :value="$consultant.id" :class="{ 'text-error': $consultant.Status != 'Active','text-success':$consultant.Status == 'Active'}" >{{$consultant.Name}} - {{$consultant.Employee_Code}}</option>
                          </select>
                        </div>


                        <div class="col-lg-3">
                          <BreezeLabel value="Sales Channel"/>
                          <select id="Channel" name="Channel" class="form-control form-control-sm input" v-model="sales.channel" >
                          <option  value=''>Please select</option>
                          <option  value='1'>ONLINE</option>
                          <option  value='2'>DISTRIBUTOR</option>
                          <option  value='4'>OFFLINE</option>
                          <option  value='3'>SPECIAL ORDER</option>
                          </select>
                        </div>

                        <div class="col-lg-3">
                          <BreezeLabel value="Closing Source"/>
                          <select id="Closing" name="Closing" class="form-control form-control-sm input" v-model="sales.closing">
                            <option  value=''>Please select</option>
                            <option  value='A'>A - CALL</option>
                            <option  value='B'>B - WHATSAPP</option>
                            <option  value='C'>C - WALKIN</option>
                            <option  value='D'>D - ROADSHOW</option>
                          </select>
                        </div>
 </div>
</template>
