<template>
  <div class="p-8">
    <DangerButton @click.native="modalCreate = true">Create group</DangerButton>
    <DialogModal :show="modalCreate">
      <template #title> Create Group </template>
      <template #content> <Label>Group name</Label><Input></Input></template>

      <template #footer>
        <DangerButton @click.native="submit" :disabled="status"
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
import Input from "@/Jetstream/Input.vue";
import axios from "axios";

export default defineComponent({
  components: {
    DangerButton,
    DialogModal,
    Input,
    Label,
  },
  data() {
    return {
      modalCreate: false,
      groupName: "test",
    };
  },
  methods: {
    setName(event, props) {
      console.log(props);
      this.groupName = name[0];
    },
    submit() {
      axios.post("/api/groups", {
        name: this.groupName,
      });
    },
  },
});
</script>
