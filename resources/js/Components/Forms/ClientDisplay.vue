<script>

import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue'


export default {
    props: ['client','countries','states'],
    components:{
        AppLayout,
        BreezeLabel,
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
    <div class="card bg-white rounded-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl">
                {{client.Name}}
                <div class="">
                    <p v-if="route().current('*.client.*')" class="text-gray-500 italic hover:underline">
                        {{client.MyKad_SSM}}</p>
                    <Link :href="route('portfolio.client.show',{'client': client.id})"
                        class="text-gray-500 italic hover:underline" v-else>{{client.MyKad_SSM}}</Link>
                </div>
            </h2>
            <div class="grid grid-cols-2">
                <div class="p-3">
                    <p> {{client.Address}}</p>
                    <p>{{client.Address_2}}</p>
                    <p>{{ client.Poscode }}</p>
                    <p>{{ client.City }}</p>
                    <p>{{activeState?.Negeri}}</p>
                    <p>{{ client.Country }}</p>
                </div>
            </div>


            <div class="card-actions justify-end">
                <div class="badge badge-outline badge-lg">{{client.Mobile_No}}</div>
                <div class="badge badge-outline badge-lg">{{client.Phone}}</div>
                <div class="badge badge-outline badge-lg">{{ client.Off_Phone }}</div>
            </div>
        </div>
    </div>


</template>
