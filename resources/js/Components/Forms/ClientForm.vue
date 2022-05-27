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
<div class="w-full">
  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="IC Number / Passport"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="MyKad_SSM" v-model="client.MyKad_SSM"  />
        <BreezeInputError :message="client.errors.Name" />
    </div>
  </div>

  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Name"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Name" v-model="client.Name"   />
        <BreezeInputError :message="client.errors.Name" />
    </div>
  </div>

  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Contact No. 1"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Phone_1" v-model="client.Mobile_No"  />
        <BreezeInputError :message="client.errors.Mobile_No" />
    </div>
  </div>

  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Contact No. 2"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Phone_2" v-model="client.Phone" placeholder="" />
        <BreezeInputError :message="client.errors.Phone" />
    </div>
  </div>

  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Contact No. 3"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Phone_3" v-model="client.Off_Phone" placeholder="" />
        <BreezeInputError :message="client.errors.Off_Phone" />
    </div>
  </div>

   <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Client Occupation"/>
    </div>
    <div class="md:w-2/3">
        <select name="Occupation"  v-model="client.occupation" class="input border-primary w-full max-w-md">
            <option  value=''>Please select</option>
            <option  value='A'>Gaji Bulanan</option>
            <option  value='B'>Bekerja Sendiri/berniaga</option>
            <option  value='C'>Suri Rumah</option>
            <option  value='D'>Goverment Staff</option>
            </select>
        <BreezeInputError :message="client.errors.occupation" />
    </div>
  </div>

  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Address"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" placeholder="" name="Address" v-model="client.Address"  />
        <BreezeInputError :message="client.errors.Address" />
    </div>
  </div>


<div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Address 2"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" placeholder=""  name="Address_2" v-model="client.Address_2" />
        <BreezeInputError :message="client.errors.Address_2" />
    </div>
  </div>


<div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Poscode"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" placeholder="" name="Poscode" v-model="client.Poscode"  />
        <BreezeInputError :message="client.errors.Poscode" />
    </div>
  </div>


<div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="City" />
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" placeholder="" name="City" v-model="client.City"  />
        <BreezeInputError :message="client.errors.City" />
    </div>
  </div>


<div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel  value="State" />
    </div>
    <div class="md:w-2/3">
        <select name="State"   v-model="client.State" class="select border-primary w-full">
                                <option  value=''>Please select state</option>
                                <option v-for="$state in states" :key="$state.id" :value="$state.id" >{{$state.Negeri}}</option>
        </select>
        <BreezeInputError :message="client.errors.State" />
    </div>
  </div>

<div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Country"/>
    </div>
    <div class="md:w-2/3">
        <select name="Country"   v-model="client.Country" class="select border-primary w-full">
            <option v-for="$country in countries" :key="$country" :value="$country" >{{$country}}</option>
        </select>
        <BreezeInputError :message="client.errors.Country" />
    </div>
  </div>

</div>

</template>
