<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bank Confirmations
            </h2>
        </template>
        <div class="">
            <form @submit.prevent="submit">
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Sent:</label>
                    <datepicker v-model="form.sent" :upper-limit="upper" :lower-limit="lower" class="pr-2 pb-2 w-44 rounded-md leading-tight" label="sent"/>
                    <div v-if="errors.sent">{{ errors.sent }}</div>
                </div>
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Reminder 1:</label>
                    <datepicker v-model="form.remind_first" :upper-limit="upper" :lower-limit="lower" class="pr-2 pb-2 w-44 rounded-md leading-tight" label="remind_first"/>
                    <div v-if="errors.remind_first">{{ errors.remind_first }}</div>
                </div>
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Reminder 2:</label>
                    <datepicker v-model="form.remind_second" :upper-limit="upper" :lower-limit="lower" class="pr-2 pb-2 w-44 rounded-md leading-tight" label="remind_second"/>
                    <div v-if="errors.remind_second">{{ errors.remind_second }}</div>
                </div>
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Received:</label>
                    <datepicker v-model="form.received" :upper-limit="upper" :lower-limit="lower" class="pr-2 pb-2 w-44 rounded-md leading-tight" label="received"/>
                    <div v-if="errors.received">{{ errors.received }}</div>
                </div>
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Company:</label>
                    <input type="text" v-model="form.company_id" class="pr-2 pb-2 w-full lg:w-1/4 rounded-md leading-tight" label="company_id"/>
                    <div v-if="errors.company_id">{{ errors.company_id }}</div>
                </div>
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Bank:</label>
                    <select v-model="form.branch_id" class="pr-2 pb-2 w-full lg:w-1/4 rounded-md" label="branch_id" placeholder="Enter type">
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{branch.name}}</option>
                    </select>
                    <div v-if="errors.branch_id">{{ errors.branch_id }}</div>
                </div>
                <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
                    <label class="w-28 inline-block text-right mr-4">Year:</label>
                    <input type="text" v-model="form.year_id" class="pr-2 pb-2 w-full lg:w-1/4 rounded-md leading-tight" label="year_id"/>
                    <div v-if="errors.year_id">{{ errors.year_id }}</div>
                </div>
                <div class="px-4 py-2 bg-gray-100 border-t border-gray-200 flex justify-start items-center">
                    <button class="border bg-indigo-300 rounded-xl px-4 py-2 ml-4 mt-4" type="submit">Create Confirmation</button>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Datepicker from 'vue3-datepicker'
    import format from 'date-fns/format'

    export default {
        components: {
            AppLayout,
            Datepicker,
        },

        props: {
            errors : Object,
            branches : Object,
            year: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    sent: '',
                    remind_first: '',
                    remind_second: '',
                    received: '',
                    company_id: '',
                    branch_id: this.branches[0].id,
                    year_id:'',
                }),
                upper: new Date(this.year.end),
                lower: new Date(this.year.begin),
            }
        },

        methods: {
            submit() {
                if(this.form.sent) this.form.sent=this.doFormat(this.form.sent)
                if(this.form.remind_first) this.form.remind_first=this.doFormat(this.form.remind_first)
                if(this.form.remind_second) this.form.remind_second=this.doFormat(this.form.remind_second)
                if(this.form.received) this.form.received=this.doFormat(this.form.received)
                this.$inertia.post(route('confirmations.store'), this.form)
            },

            doFormat($item) {
                var $i = format($item,'yyyy-MM-dd')
                return $i
            },
        },
    }
</script>
