<script>

import { Link,Head } from '@inertiajs/inertia-vue3'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'


export default {
    props: ['client','countries','states'],
    components:{
        BreezeLabel,
        BreezeInput,
        BreezeInputError,
        Link
    }
}

</script>
<template>
<div class="w-full grid md:grid-cols-2 gap-4">
    <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
       <BreezeLabel value="IC Number / Passport"/>
       <BreezeInput  type="text" name="MyKad_SSM" v-model="client.MyKad_SSM"  />
        <BreezeInputError :message="$page.props.errors.MyKad_SSM" />
    </div>
  </div>

  <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
      <BreezeLabel value="Name"/>
      <BreezeInput  type="text" name="Name" v-model="client.Name"   />
        <BreezeInputError :message="$page.props.errors.Name" />
    </div>
  </div>

<div class="flex flex-wrap -mx-3">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
       <BreezeLabel value="Contact No. 1"/>
        <BreezeInput  type="text" name="Phone_1" v-model="client.Mobile_No"  />
        <BreezeInputError :message="$page.props.errors.Mobile_No" />
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <BreezeLabel value="Contact No. 2"/>
        <BreezeInput  type="text" name="Phone_2" v-model="client.Phone" />
        <BreezeInputError :message="$page.props.errors.Phone" />
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
       <BreezeLabel value="Contact No. 3"/>
       <BreezeInput  type="text" name="Phone_3" v-model="client.Off_Phone" />
        <BreezeInputError :message="$page.props.errors.Off_Phone" />
    </div>
</div>

  <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Client Occupation"/>
        <select name="Occupation"  v-model="client.occupation" class="input border-primary w-full">
                <option  value=''>Please select</option>
                <option  value='A'>Gaji Bulanan</option>
                <option  value='B'>Bekerja Sendiri/berniaga</option>
                <option  value='C'>Suri Rumah</option>
                <option  value='D'>Goverment Staff</option>
                </select>
        <BreezeInputError :message="$page.props.errors.occupation" />
    </div>
  </div>

  <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Address"/>
        <BreezeInput  type="text" placeholder="" name="Address" v-model="client.Address"  />
        <BreezeInputError :message="$page.props.errors.Address" />
    </div>
  </div>

    <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Address 2"/>
        <BreezeInput  type="text" placeholder=""  name="Address_2" v-model="client.Address_2" />
        <BreezeInputError :message="$page.props.errors.Address_2" />
    </div>
  </div>


<div class="flex flex-wrap -mx-3">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <BreezeLabel value="Poscode"/>
        <BreezeInput  type="text" placeholder="" name="Poscode" v-model="client.Poscode"  />
        <BreezeInputError :message="$page.props.errors.Poscode" />
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <BreezeLabel value="City" />
        <BreezeInput  type="text" placeholder="" name="City" v-model="client.City"  />
        <BreezeInputError :message="$page.props.errors.City" />
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
       <BreezeLabel  value="State" />
       <select name="State"   v-model="client.State" class="select border-primary w-full">
                                <option  value=''>Please select state</option>
                                <option v-for="$state in states" :key="$state.id" :value="$state.id" >{{$state.Negeri}}</option>
        </select>
        <BreezeInputError :message="$page.props.errors.State" />
    </div>
</div>


    <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Country"/>
        <select name="Country"   v-model="client.Country" class="select border-primary w-full">
            <option v-for="$country in countries" :key="$country" :value="$country" selected="Malaysia">{{$country}}</option>
        </select>
        <BreezeInputError :message="$page.props.errors.Country" />
    </div>
  </div>


</div>

</template>
