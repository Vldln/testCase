<template>
  <DialogModal :show="show">
    <template #title>Invite user</template>
    <template #content>
      <ErrorInfo class="mb-3" :show="err" />

      <form class="sm:flex mb-3">
        <label for="email" class="min-w-[100px] text-base text-gray-400 mr-3"
          >Email</label
        >
        <input
          type="email"
          class="text-base border w-full border-gray-300 rounded-md px-3 py-2"
          v-model="email"
          name="email"
          id=""
        /></form
    ></template>
    <template #footer>
      <Button class="w-full sm:w-1/4 mr-3" @click.native="closeModal"
        >Close</Button
      >
      <DangerButton
        @click.native="submit"
        :disabled="!email"
        class="w-full sm:w-1/4"
        >Create</DangerButton
      >
    </template>
  </DialogModal>
</template>

<script>
import { defineComponent } from "vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import Button from "@/Jetstream/Button.vue";
import ErrorInfo from "@/Jetstream/ErrorInfo.vue";

export default defineComponent({
  props: ["show", "group_id"],
  components: { DangerButton, DialogModal, Button, ErrorInfo },
  data() {
    return { email: null, err: false };
  },
  mounted() {},
  methods: {
    closeModal() {
      this.$emit("close:modal-invite");
    },
    submit() {
      this.$store
        .dispatch("postInvite", { email: this.email, groups_id: this.group_id })
        .then((resp) => {
          this.$store.dispatch("getGroups");
          this.closeModal();
        })
        .catch((err) => {
          this.err = true;
        });
    },
  },
});
</script>
