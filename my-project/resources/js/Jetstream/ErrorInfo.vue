<template>
  <div
    v-show="show"
    class="bg-red-600 rounded-lg text-white text-center px-3 py-2"
  >
    Whoops! Something went wrong. Check fields!
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  components: {},
  props: ["show"],
  data() {
    return {};
  },
  mounted() {},
  methods: {},
});
</script>
