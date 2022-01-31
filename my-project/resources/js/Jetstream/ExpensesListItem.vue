<template>
  <div>
    <div class="sm:flex">
      <div class="sm:text-center sm:w-[100px] py-1">
        <span class="font-bold sm:hidden">Amount:</span>

        {{ data.amount }}
      </div>
      <div class="sm:text-center sm:w-[200px] py-1">
        <span class="font-bold sm:hidden">Descr:</span>

        {{ data.description }}
      </div>
      <div class="sm:text-center sm:w-[100px] py-1">
        <span class="font-bold sm:hidden">Type:</span>

        {{ data.split_options.name }}
      </div>

      <div class="sm:text-center sm:w-[100px] py-1">
        <span class="font-bold sm:hidden">Date:</span>

        {{ moment(data.created_at).format("DD-MM-YYYY") }}
      </div>
      <div class="sm:text-center sm:w-[100px] py-1">
        <span class="font-bold sm:hidden">User:</span>
        {{ data.user.name }}
      </div>
    </div>
    <div
      class="
        font-bold
        text-base
        mt-2
        mb-2
        cursor-pointer
        text-center
        sm:text-left sm:px-4
      "
      @click="
        openTransacton === true
          ? (openTransacton = false)
          : (openTransacton = true)
      "
    >
      Show transactions
    </div>
    <div v-for="subitem in data.transactions" :key="subitem.id">
      <div v-show="openTransacton" class="flex px-4 py-2">
        <div class="text-gray-500 mr-2">From:</div>
        <div class="mr-2">{{ subitem.user }}</div>
        <div class="text-gray-500 mr-2">To:</div>
        <div class="mr-2">{{ subitem.recipient }}</div>
        <div class="text-gray-500 mr-2">Amount:</div>
        <div>{{ subitem.pay_amount }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import moment from "moment";

export default defineComponent({
  components: {},
  props: ["data"],
  data() {
    return { moment: moment, openTransacton: false };
  },
  mounted() {},
  methods: {},
});
</script>
