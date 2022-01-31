<template>
  <div>
    <div class="font-bold text-base mt-6 mb-4">Expenses</div>
    <div class="sm:flex hidden">
      <div class="font-bold text-center w-[100px] py-1">Amount</div>
      <div class="font-bold text-center w-[200px] py-1">Descr</div>
      <div class="font-bold text-center w-[100px] py-1">Type</div>
      <div class="font-bold text-center w-[100px] py-1">Date</div>
      <div class="font-bold text-center w-[100px] py-1 w">User</div>
    </div>
    <ExpensesListItem
      v-for="item in expenses"
      class="px-3 py-3 sm:px-0 -mx-3 sm:mx-0"
      :class="[item.id % 2 === 0 ? 'bg-gray-100' : '']"
      :key="item.id"
      :data="item"
    />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import ExpensesListItem from "@/Jetstream/ExpensesListItem.vue";

export default defineComponent({
  components: { ExpensesListItem },
  props: ["expenses"],
  data() {
    return {};
  },
  mounted() {},
  methods: {},
});
</script>
