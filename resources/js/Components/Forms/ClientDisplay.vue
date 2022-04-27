<script>

import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'


export default {
    props: ['client','countries','states'],
    components:{
        AppLayout,
        BreezeLabel,
        BreezeButton,
        BreezeInput,
        BreezeInputError,
        Link,
        Head
    },
    computed: {
                activeState() {
                    let that = this;
                    // return this.states.find(( id ) => id === that.client.state);
                //    return this.states.find(key => key === that.client.state);
                    let x;
                    this.states.forEach(function(a){
                        if(a.id == that.client.State){
                            x = a;
                        }
                    })
                    return x;
                }
                }
}

</script>
<template>

        <form @submit.prevent="storeClient" class="form">
        <div class="grid grid-cols-1 gap-5 mb-12">
                <div>
                  <BreezeLabel value="ID Card"/>
                  <p>{{client.MyKad_SSM}}</p>
                </div>
                <div>
                  <BreezeLabel value="Name"/>
                  <p>{{client.Name}}</p>
                </div>

                <div class="grid grid-cols-3 gap-2">
                <div>
                    <BreezeLabel value="Contact No. 1"/>
                    <p>{{client.Mobile_No}}</p>
                </div>

                <div>
                    <BreezeLabel value="Contact No. 2"/>
                    <p>{{client.Phone}}</p>
                </div>

                <div>
                    <BreezeLabel value="Contact No. 3"/>
                    <p>{{client.Off_Phone}}</p>
                </div>
                </div>

                <div>
                <BreezeLabel value="Client Occupation"/>
                          <select name="Occupation"  v-model="client.occupation" class="border-primary w-full max-w-md">
                          <option  value=''>Please select</option>
                          <option  value='A'>Gaji Bulanan</option>
                          <option  value='B'>Bekerja Sendiri/berniaga</option>
                          <option  value='C'>Suri Rumah</option>
                          <option  value='D'>Goverment Staff</option>
                          </select>
                </div>

                <div>
                  <BreezeLabel value="Address"/>
                  <p>{{client.Address}}</p>=
                </div>

                <div>
                  <BreezeLabel value="Address 2"/>
                  <p>{{client.Address_2}}</p>
                </div>
                 <div class="grid grid-cols-4 gap-2">
                <div>
                      <BreezeLabel value="Poscode"/>
                      <p>{{client.Poscode}}</p>
                </div>

                <div>
                      <BreezeLabel value="City" />
                      <p>{{client.City}}</p>
                </div>


                <div>
                      <BreezeLabel  value="State" />
                      <p>{{activeState?.Negeri}}</p>
                </div>

                <div>
                      <BreezeLabel value="Country"/>
                      <p>{{client.Country}}</p>
                </div>
                </div>
            </div>
        </form>
</template>
