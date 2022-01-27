<template>
  <DialogModal :show="show">
    <template #title> Create Group </template>
    <template #content>
      <form>
        <textarea v-model="descr" name="" id="" />
        <input type="email" v-model="amount" name="" id="" />
        <select v-model="type" name="" id="">
          <option v-for="item in options" :key="item.id" v-bind:value="item.id">
            {{ item.name }}
          </option>
        </select>
      </form>
    </template>
    <template #footer>
      <DangerButton
        @click.native="submit"
        :disabled="!descr || !type || !amount"
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
    return { amount: null, descr: null, type: null };
  },
  computed: {
    options() {
      return this.$store.state.options;
    },
  },
  methods: {
    submit() {
      this.$store
        .dispatch("postExpenses", {
          type: this.type,
          descr: this.descr,
          amount: this.amount,
          group_id: this.group_id,
          user_id: this.$page.props.auth.user.id,
        })
        .then((resp) => {
          this.show = false;
          this.$store.dispatch("getExpenses");
        });
    },
  },
});
</script>
