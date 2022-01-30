<template>
  <div>
    <div>Создатель группы:</div>
    <div class="flex">
      <span>Name</span><span>spends</span><span>comings</span>
    </div>
    <div class="flex">
      <span> {{ owner.name }} </span>|
      <span>{{ summSpends(owner.spends) }}</span
      >|
      <span>{{ summComings(owner.comings) }}</span>
    </div>
    <div>{{ owner.name }}</div>
    <div>Участники:</div>
    <div class="flex">
      <span>Name</span><span>spends</span><span>comings</span>
    </div>
    <div v-for="item in members" :key="item.id" class="flex">
      <span> {{ item.name }} </span>| <span>{{ summSpends(item.spends) }}</span
      >|
      <span>{{ summComings(item.comings) }}</span>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: ["members", "owner"],
  data() {
    return {};
  },
  methods: {
    summSpends(items) {
      let result = items.reduce(function (sum, elem) {
        return sum + elem.pay_amount;
      }, 0);
      return result;
    },
    summComings(items) {
      let result = items.reduce(function (sum, elem) {
        return sum + elem.pay_amount;
      }, 0);
      return result;
    },
  },
});
</script>
