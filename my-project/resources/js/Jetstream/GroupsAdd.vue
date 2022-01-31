<template>
  <div class="p-3 sm:p-8">
    <DangerButton @click.native="modalCreate = true">Create group</DangerButton>
    <DialogModal :show="modalCreate">
      <template #title> Create Group </template>
      <template #content>
        <ErrorInfo class="mb-3" :show="err" />
        <label for="name" class="text-base text-gray-400 mr-3"
          >Group name</label
        >
        <input
          type="text"
          class="text-base border border-gray-300 rounded-md px-3 py-2"
          id="name"
          v-model="name"
        />
      </template>

      <template #footer
        ><Button
          class="w-full sm:w-1/4 mr-3"
          @click.native="modalCreate = false"
          >Close</Button
        >
        <DangerButton
          @click.native="submit"
          :disabled="!name"
          class="w-full sm:w-auto"
          >Create group</DangerButton
        >
      </template>
    </DialogModal>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import Label from "@/Jetstream/Label.vue";
import Button from "@/Jetstream/Button.vue";
import ErrorInfo from "@/Jetstream/ErrorInfo.vue";

export default defineComponent({
  components: {
    DangerButton,
    DialogModal,
    Label,
    Button,
    ErrorInfo,
  },
  data() {
    return {
      modalCreate: false,
      name: null,
      err: false,
    };
  },
  methods: {
    submit() {
      this.$store
        .dispatch("postGroup", { name: this.name })
        .then((resp) => {
          this.modalCreate = false;
          this.$store.dispatch("getGroups");
        })
        .catch((err) => {
          this.err = true;
        });
    },
  },
});
</script>
