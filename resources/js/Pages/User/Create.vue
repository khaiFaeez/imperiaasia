<script>
import { ref } from 'vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'

const showingNavigationDropdown = ref(false);


export default {
    props:{
        status: String,
    },
    components:{
        Pagination,
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
            form: this.$inertia.form({
                username:"",
                name:"",
                staff_id:"",
                roles:[],
                portfolios:[],
                password:"",
                password_confirmation:""

            })
        }
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        storeUser() {
                this.form.post(route('users.store'),{
                    errorBag: 'storeUser',
                    preserveScroll: true,
                });
            },
    }
}

</script>

<template>
<Head title="Create User" />
<AppLayout>

        <div v-if="status" class="mb-4 font-medium text-sm">
            {{ status }}
        </div>

        <form @submit.prevent="storeUser" class="w-96 form mx-auto">
            <div class="mb-4">
                <BreezeLabel for="username" value="Username" />
                <BreezeInput id="username" type="text" v-model="form.username" required autocomplete="username" />
                <BreezeInputError :message="form.errors.username" />
            </div>

            <div class="mb-4">
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" v-model="form.name" required autocomplete="name" />
                <BreezeInputError :message="form.errors.name" />
            </div>


            <div class="mb-4">
                <BreezeLabel for="staff_id" value="Staff ID" />
                <BreezeInput id="staff_id" type="text" v-model="form.staff_id" required autocomplete="staff_id" />
                <BreezeInputError :message="form.errors.staff_id" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

             <div class="mb-4">
                <BreezeLabel for="roles" value="Role" />
                <select name="roles" id="roles" multiple v-model="form.roles" class="select input-bordered border-primary w-full h-52">
                <option v-for="($role, i ) in $page.props.roles" :key="i" :value="$role">{{$role}}</option>
                </select>
                <BreezeInputError :message="form.errors.roles" />
            </div>

             <div class="mb-4">
                <BreezeLabel for="portfolios" value="Portfolios" />
                <select name="portfolios" id="portfolios" multiple v-model="form.portfolios" class="select input-bordered border-primary w-full h-52">
                <option v-for="($portfolio, i ) in $page.props.portfolios" :key="i" :value="i">{{$portfolio}}</option>
                </select>
                <BreezeInputError :message="form.errors.portfolios" />
            </div>



            <div class="flex items-center justify-end mt-4">

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>
</AppLayout>

</template>
