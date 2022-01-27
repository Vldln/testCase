<template>
  <DialogModal :show="show">
    <template #title> Create Group </template>
    <template #content>
      <form>
        <input type="email" v-model="email" name="" id="" /></form
    ></template>
    <template #footer>
      <DangerButton @click.native="submit" :disabled="!email"
        >Create</DangerButton
      >
    </template>
  </DialogModal>
</template>

<script>
import { defineComponent } from "vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";

export default defineComponent({
  props: ["show", "group_id"],
  components: { DangerButton, DialogModal },
  data() {
    return { email: null };
  },
  mounted() {},
  methods: {
    submit() {
      this.$store
        .dispatch("postInvite", { email: this.email, groups_id: this.group_id })
        .then((resp) => {
          this.$store.dispatch("getGroups");
        });
    },
  },
});
</script>
