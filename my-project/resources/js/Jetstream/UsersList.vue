<template>
  <div>
    <div class="font-bold text-base mt-2 mb-4">Statistics:</div>
    <div class="flex">
      <span class="font-bold bg-gray-100 text-center min-w-[100px] py-1"
        >Name</span
      ><span class="font-bold py-1 text-center min-w-[100px]">Spends</span
      ><span class="font-bold bg-gray-100 text-center min-w-[100px] py-1"
        >Comings</span
      >
    </div>
    <div class="flex">
      <span class="bg-gray-100 text-center min-w-[100px] py-1">
        {{ owner.name }}
      </span>
      <span class="text-center min-w-[100px] py-1">{{
        summSpends(owner.spends)
      }}</span>
      <span class="bg-gray-100 text-center min-w-[100px] py-1">{{
        summComings(owner.comings)
      }}</span>
    </div>

    <div v-for="item in members" :key="item.id" class="flex">
      <span class="bg-gray-100 text-center min-w-[100px] py-1">
        {{ item.name }}
      </span>
      <span class="text-center min-w-[100px] py-1">{{
        summSpends(item.spends)
      }}</span>
      <span class="bg-gray-100 text-center min-w-[100px] py-1">{{
        summComings(item.comings)
      }}</span>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: ["members", "owner", "group_id"],
  data() {
    return {};
  },
  methods: {
    summSpends(items) {
      let result = items
        .filter((item) => item.groups_id === this.group_id)
        .reduce(function (sum, elem) {
          return sum + elem.pay_amount;
        }, 0);
      return result;
    },
    summComings(items) {
      let result = items
        .filter((item) => item.groups_id === this.group_id)
        .reduce(function (sum, elem) {
          return sum + elem.pay_amount;
        }, 0);
      return result;
    },
  },
});
</script>
