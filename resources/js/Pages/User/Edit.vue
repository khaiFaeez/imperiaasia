<script>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
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
        Link
    },
    data() {
        return {
            form: this.$inertia.form({
                 _method: 'PUT',
                 id:this.$page.props.user.id,
                username:this.$page.props.user.username,
                name:this.$page.props.user.name,
                staff_id:this.$page.props.user.staff_id,
                roles:Object.values(this.$page.props.userRole)

            })
        }
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        updateUser(id) {

                this.form.post(route('users.update',{"user":id}),{
                    errorBag: 'updateMembershipInformation',
                    preserveScroll: true,
                });
            },
    }
}

</script>

<template>
<AppLayout>

        <div v-if="status" class="mb-4 font-medium text-sm">
            {{ status }}
        </div>

        <form @submit.prevent="updateUser($page.props.user.id)" class="w-96 form">
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

             <div class="mb-4">
                <BreezeLabel for="roles" value="Role" />
                <select name="roles" id="roles" multiple v-model="form.roles" class="select input-bordered border-primary w-full h-52">
                <option v-for="($role, i ) in $page.props.roles" :key="i" :value="$role">{{$role}}</option>
                </select>
                <BreezeInputError :message="form.errors.roles" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </BreezeButton>
            </div>
        </form>
</AppLayout>

</template>
