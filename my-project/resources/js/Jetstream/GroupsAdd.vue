<template>
  <div class="p-8">
    <DangerButton @click.native="modalCreate = true">Create group</DangerButton>
    <DialogModal :show="modalCreate">
      <template #title> Create Group </template>
      <template #content>
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

      <template #footer>
        <DangerButton @click.native="submit" :disabled="!name"
          >Create</DangerButton
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
import axios from "axios";

export default defineComponent({
  components: {
    DangerButton,
    DialogModal,
    Label,
  },
  data() {
    return {
      modalCreate: false,
      name: null,
    };
  },
  methods: {
    submit() {
      axios.post("/api/groups", { name: this.name }).then((resp) => {
        this.modalCreate = false;
      });
    },
  },
});
</script>
