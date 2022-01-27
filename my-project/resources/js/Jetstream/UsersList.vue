<template>
  <div>
    <div>Создатель группы:</div>
    <div>{{ owner.name }}</div>
    <div>Участники:</div>
    <div v-for="item in members" :key="item.id">{{ item.name }}</div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: ["members", "owner"],
  data() {
    return {};
  },
});
</script>
