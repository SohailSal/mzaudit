<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bank Accounts
            </h2>
        </template>
        <div class="">
            <form @submit.prevent="submit">

                    <button class="border bg-indigo-300 rounded-xl px-4 py-2 m-4"  @click.prevent="addRow" >Add row</button>
                    <table class="table border">
                        <thead class="">
                            <tr>                            
                                <th>Company</th>
                                <th>Branch</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Currency</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='(account, index) in form.accounts' :key="account.id">                            
                                <td>
                                <input  v-model="account.company_id"  type="text" class="rounded-md w-36"/>
                                </td>
                                <td>
                                <select v-model="account.branch_id" class="rounded-md w-36">
                                    <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{branch.name}} - {{branch.address}}</option>
                                </select>
                                </td>
                                <td>
                                <input v-model="account.name"  type="text" class="rounded-md w-36"/>
                                </td>
                                <td>
                                <input v-model="account.type"  type="text" class="rounded-md w-36"/>
                                </td>
                                <td>
                                <input v-model="account.currency"  type="text" class="rounded-md w-36"/>
                                </td>
                                <td>
                                <button  @click.prevent="deleteRow(index)" class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" >Delete</button>
                                </td>
                            </tr>                        
                        </tbody>
                    </table>
                <div class="px-4 py-2 bg-gray-100 border-t border-gray-200 flex justify-start items-center">
                    <button class="border bg-indigo-300 rounded-xl px-4 py-2 ml-4 mt-4" type="submit">Create Accounts</button>
                </div>

            </form>
        </div>



    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },

        props: {
            errors : Object,
            branches : Object,
            banks : Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    accounts: [{
                        company_id: '',
                        branch_id: this.branches[0].id,
                        name: '',
                        type: '',
                        currency: '',
                    }],
                }),

            }
        },

        methods: {

            submit() {
            this.$inertia.post(route('accounts.store'), this.form.accounts)
            },

            addRow() {      
                this.form.accounts.push({
                    company_id: '',
                    branch_id: this.branches[0].id,
                    name: '',
                    type: '',
                    currency: '',
                    })
            },

            deleteRow(index){    
                this.form.accounts.splice(index,1);             
            },
        },
    }
</script>
