<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-2
      py-1
      min-h-[42px]
      bg-gray-800
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      tracking-widest
      hover:bg-gray-700
      active:bg-gray-900
      focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300
      disabled:opacity-25
      transition
      justify-center
    "
  >
    <slot></slot>
  </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
});
</script>
