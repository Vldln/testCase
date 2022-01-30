<template>
  <div>
    <div>Expenses</div>
    <div v-for="item in expenses" :key="item.id">
      <div class="flex">
        <div>{{ item.amount }}</div>
        <div>{{ item.description }}</div>
        <div>{{ item.split_options.name }}</div>
        <div v-if="item.split_options.name === 'PERCENT'">
          {{ item.percent }}
        </div>
        <div>{{ item.created_at }}</div>
        <div>{{ item.user.name }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  components: {},
  props: ["expenses"],
  data() {
    return {};
  },
  mounted() {},
  methods: {},
});
</script>
