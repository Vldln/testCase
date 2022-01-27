<template>
  <DialogModal :show="show">
    <template #title> Uodate Group </template>
    <template #content>
      <form>
        <input type="text" v-model="name" name="" id="" />
      </form>
    </template>
    <template #footer>
      <DangerButton @click.native="submit" :disabled="!name"
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
    return { name: null };
  },

  methods: {
    submit() {
      this.$store
        .dispatch("updateGroup", {
          name: this.name,
          id: this.group_id,
        })
        .then((resp) => {
          this.show = false;
          this.$store.dispatch("getGroups");
        });
    },
  },
});
</script>
