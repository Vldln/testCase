<template>
  <button
    :type="type"
    :disabled="disabled"
    class="
      min-h-[42px]
      inline-flex
      items-center
      px-2
      py-1
      bg-red-600
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      tracking-widest
      hover:bg-red-500
      focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200
      active:bg-red-600
      disabled:opacity-25
      transition
      text-center
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
      default: "button",
    },
    disables: {
      type: Boolean,
      default: false,
    },
  },
});
</script>
