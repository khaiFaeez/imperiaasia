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
    data() {
        return {
             form: this.$inertia.form(this.client),
        };
    },methods: {
        storeClient() {
                this.form.post(route('portfolio.client.store',{"portfolio":this.$page.props.portfolio}),{
                    // errorBag: 'storeClient',
                    // preserveScroll: true,
                    //  onFinish: () => {
                        // this.showUpdateForm = false;
                        // this.$toast.success(this.$page.props.flash.message, {
                        //     position: 'top'
                        // });
                    // },
                });
            },
    }

}

</script>
<template>

        <form @submit.prevent="storeClient" class="form">
        <div class="grid grid-cols-1 gap-5 mb-12">
                <div>
                  <BreezeLabel value="ID Card"/>
                  <BreezeInput  type="text" name="MyKad_SSM" v-model="form.MyKad_SSM"  />
                </div>
                <div>
                  <BreezeLabel value="Name"/>
                  <BreezeInput  type="text" name="Name" v-model="form.Name"   />
                </div>

                <div class="grid grid-cols-3 gap-2">
                <div>
                    <BreezeLabel value="Contact No. 1"/>
                    <BreezeInput  type="text" name="Phone_1" v-model="form.Mobile_No"  />
                </div>

                <div>
                    <BreezeLabel value="Contact No. 2"/>
                    <BreezeInput  type="text" name="Phone_2" v-model="form.Phone" placeholder="" />
                </div>

                <div>
                    <BreezeLabel value="Contact No. 3"/>
                    <BreezeInput  type="text" name="Phone_3" v-model="form.Off_Phone" placeholder="" />
                </div>
                </div>

                <div>
                <BreezeLabel value="Client Occupation"/>
                          <select name="Occupation"  v-model="form.occupation" class="border-primary w-full max-w-md">
                          <option  value=''>Please select</option>
                          <option  value='A'>Gaji Bulanan</option>
                          <option  value='B'>Bekerja Sendiri/berniaga</option>
                          <option  value='C'>Suri Rumah</option>
                          <option  value='D'>Goverment Staff</option>
                          </select>
                </div>

                <div>
                  <BreezeLabel value="Address"/>
                  <BreezeInput  type="text" placeholder="" name="Address" v-model="form.Address"  />
                </div>

                <div>
                  <BreezeLabel value="Address 2"/>
                  <BreezeInput  type="text" placeholder=""  name="Address_2" v-model="form.Address_2" />
                </div>
                 <div class="grid grid-cols-4 gap-2">
                <div>
                      <BreezeLabel value="Poscode"/>
                      <BreezeInput  type="text" placeholder="" name="Poscode" v-model="form.Poscode"  />
                </div>

                <div>
                      <BreezeLabel value="City" />
                      <BreezeInput  type="text" placeholder="" name="City" v-model="form.City"  />
                </div>


                <div>
                      <BreezeLabel  value="State" />
                      <select name="State"   v-model="form.State" class="select border-primary w-full">
                                            <option  value=''>Please select state</option>
									        <option v-for="$state in states" :key="$state.id" :value="$state.id" >{{$state.Negeri}}</option>
                      </select>
                </div>

                <div>
                      <BreezeLabel value="Country"/>
                      <select name="Country"   v-model="form.Country" class="select border-primary w-full">
                        <option value='MALAYSIA'>MALAYSIA</option>
                        <option v-for="$country in countries" :key="$country" :value="$country" >{{$country}}</option>
                      </select>
                </div>
                </div>
            </div>
            <div>
                 <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </BreezeButton>
            </div>
        </form>
</template>
