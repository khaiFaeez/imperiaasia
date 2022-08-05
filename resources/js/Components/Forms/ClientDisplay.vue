<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import BreezeLabel from '@/Components/Label.vue'
import { ref } from 'vue'

export default {
    props: ['client', 'countries', 'states'],
    components: {
        AppLayout,
        BreezeLabel,
        Link,
        Head
    },
    computed: {
        activeState() {
            let that = this
            // return this.states.find(( id ) => id === that.client.state);
            //    return this.states.find(key => key === that.client.state);
            let x
            this.states.forEach(function (a) {
                if (a.id == that.client.State) {
                    x = a
                }
            })
            return x
        }
    }
}
</script>
<template>
    <div
        class="card bg-white transition ease-in-out hover:bg-base-200 duration-300"
    >
        <div class="card-body collapse collapse-arrow p-0">
            <input type="checkbox" :checked="route().current('*.client.*')" />
            <h2 class="card-title text-lg collapse-title text-primary">
                {{ client.Name }}
                <div class="">
                    <p class="hover:underline">( {{ client.MyKad_SSM }} )</p>
                </div>
            </h2>
            <div class="collapse-content">
                <div class="grid grid-cols-2">
                    <div>
                        <p>{{ client.Address }}</p>
                        <p>{{ client.Address_2 }}</p>
                        <p>{{ client.Poscode }}</p>
                        <p>{{ client.City }}</p>
                        <p>{{ activeState?.Negeri }}</p>
                        <p>{{ client.Country }}</p>
                    </div>
                </div>

                <div class="card-actions justify-end">
                    <Link
                        v-if="route().current('*.client.*') == false"
                        :href="
                            route('portfolio.client.show', {
                                client: client.id
                            })
                        "
                        title="Open in Client"
                        class="btn btn-ghost btn-sm rounded-full"
                    >
                        <i class="bi bi-box-arrow-up-right"></i>
                    </Link>
                    <div class="badge badge-lg">
                        {{ client.Mobile_No }}
                    </div>
                    <div class="badge badge-lg">
                        {{ client.Phone }}
                    </div>
                    <div class="badge badge-lg">
                        {{ client.Off_Phone }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
