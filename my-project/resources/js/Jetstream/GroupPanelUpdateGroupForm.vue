<template>
  <DialogModal :show="show">
    <template #title> Uodate Group </template>
    <template #content>
      <ErrorInfo class="mb-3" :show="err" />

      <form class="sm:flex mb-3">
        <label for="name" class="min-w-[100px] text-base text-gray-400 mr-3"
          >New name</label
        >
        <input
          type="name"
          class="text-base border w-full border-gray-300 rounded-md px-3 py-2"
          v-model="name"
          name=""
          id=""
        />
      </form>
    </template>
    <template #footer>
      <Button class="w-full sm:w-1/4 mr-3" @click.native="closeModal"
        >Close</Button
      >
      <DangerButton
        @click.native="submit"
        :disabled="!name"
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
    return { name: null, err: false };
  },

  methods: {
    closeModal() {
      this.$emit("close:modal-update");
    },
    submit() {
      this.$store
        .dispatch("updateGroup", {
          name: this.name,
          id: this.group_id,
        })
        .then((resp) => {
          this.closeModal();
          this.$store.dispatch("getGroups");
        })
        .catch((err) => {
          this.err = true;
        });
    },
  },
});
</script>
