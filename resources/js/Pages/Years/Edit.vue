<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Update Years
      </h2>
    </template>
    <div class="max-w-7xl mx-auto pb-2">
      <div class="">
        <form @submit.prevent="submit">
          <div
            class="
              px-4
              py-2
              bg-gray-100
              border-t border-gray-200
              flex
              justify-start
              items-center
            "
          >
            <inertia-link
              class="
                border
                rounded-xl
                px-4
                py-1
                m-1
                bg-blue-400
                hover:text-white
                hover:bg-blue-600
              "
              :href="route('years')"
              >Back
            </inertia-link>
          </div>
          <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
            <label class="w-28 inline-block text-right mr-4">Begin:</label>
            <input
              v-model="form.begin"
              type="date"
              :upper-limit="upper"
              :lower-limit="lower"
              class="pr-2 pb-2 w-44 rounded-md leading-tight"
            />
            <!-- <datepicker
            v-model="form.begin"
            class="pr-2 pb-2 w-44 rounded-md leading-tight"
            label="begin"
          /> -->
            <div v-if="errors.begin">{{ errors.begin }}</div>
          </div>
          <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
            <label class="w-28 inline-block text-right mr-4">End:</label>
            <input
              v-model="form.end"
              type="date"
              :upper-limit="upper"
              :lower-limit="lower"
              class="pr-2 pb-2 w-44 rounded-md leading-tight"
            />
            <!-- <datepicker
            v-model="form.end"
            class="pr-2 pb-2 w-44 rounded-md leading-tight"
            label="end"
          /> -->
            <div v-if="errors.end">{{ errors.end }}</div>
          </div>
          <div
            class="
              px-4
              py-2
              border-t border-gray-200
              bg-gray-100
              flex
              justify-start
              items-center
            "
          >
            <button
              class="
                border
                bg-green-500
                rounded-xl
                px-4
                py-2
                ml-4
                mt-4
                hover:text-white
                hover:bg-green-600
              "
              type="submit"
            >
              Update Year
            </button>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Datepicker from "vue3-datepicker";
import format from "date-fns/format";

export default {
  components: {
    AppLayout,
    Datepicker,
  },

  props: {
    errors: Object,
    year: Object,
  },

  data() {
    return {
      form: {
        begin: this.year.begin,
        end: this.year.end,

        upper: new Date(this.year.end),
        lower: new Date(this.year.begin),
      },
    };
  },

  methods: {
    submit() {
      this.form.begin;
      this.form.end;
      this.$inertia.put(route("years.update", this.year.id), this.form);
    },
  },
};
</script>
