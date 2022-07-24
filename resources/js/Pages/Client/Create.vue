<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import ClientForm from '@/Components/Forms/ClientForm.vue'
import BreezeButton from '@/Components/Button'

export default {
    props: ['client', 'states'],
    components: {
        AppLayout,
        Link,
        Head,
        ClientForm,
        BreezeButton
    },
    data() {
        return {
            form: this.$inertia.form({
                MyKad_SSM: '',
                Name: '',
                Mobile_No: '',
                Phone: '',
                Off_Phone: '',
                Address: '',
                Address_2: '',
                Poscode: '',
                City: '',
                State: '',
                Country: ''
            })
        }
    },
    methods: {
        storeClient() {
            this.form.post(route('portfolio.client.store'), {
                preserveScroll: true,
                onFinish: () => {
                    this.showUpdateForm = false
                    // this.$toast.success(this.$page.props.flash.message, {
                    //     position: 'top'
                    // });
                }
            })
        }
    }
}
</script>
<template>
    <Head title="View Client" />
    <AppLayout>
        <div>
            <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
                <Link
                    class="text-primary hover:text-primary-focus"
                    href="/client"
                    >Client</Link
                >
                <span class="text-primary font-medium">/</span> Create
            </h1>
            <template>
                <button @click="deleteAllUsers" />
                <button @click="deleteAllUsersWithAsync" />
            </template>
            <form @submit.prevent="storeClient" class="form">
                <div class="menu menu-horizontal w-full justify-end mb-4">
                    <BreezeButton
                        :class="{ 'loading mr-2': form.processing }"
                        :disabled="form.processing"
                    >
                        Save
                    </BreezeButton>
                </div>
                <ClientForm
                    class="mb-12"
                    :client="form"
                    :countries="$page.props.countries"
                    :states="$page.props.states"
                />
                <div></div>
            </form>
        </div>
    </AppLayout>
</template>
