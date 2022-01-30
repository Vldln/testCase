<template>
  <DialogModal :show="show">
    <template #title> Create Group </template>
    <template #content>
      <form>
        <textarea v-model="descr" name="" id="" />
        <input type="number" v-model="amount" name="" id="" />
        <select v-model="type" name="" id="">
          <option v-for="item in options" :key="item.id" v-bind:value="item">
            {{ item.name }}
          </option>
        </select>
        <div v-if="type && type.name === 'EXACT'">
          <select v-model="type" name="" id="">
            <option v-for="item in options" :key="item.id" v-bind:value="item">
              {{ item.name }}
            </option>
          </select>
        </div>
        <div v-if="type && type.name === 'PERCENT'">
          <div>
            <select v-model="type" name="" id="">
              <option
                v-for="item in options"
                :key="item.id"
                v-bind:value="item"
              >
                {{ item.name }}
              </option>
            </select>
            <input type="number" v-model="percent" name="" id="" />%
          </div>
        </div>
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
  props: ["show", "group_id", "members"],
  components: { DangerButton, DialogModal },
  data() {
    return {
      amount: null,
      descr: null,
      type: null,
      percent: null,
      recipient_id: this.$page.props.auth.user.id,
    };
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
          type: this.type.id,
          descr: this.descr,
          amount: this.amount,
          percent: this.percent,
          group_id: this.group_id,
          recipient_id: this.recipient_id,
          members: this.members,
        })
        .then((resp) => {
          this.$store.dispatch("getGroups");
        });
    },
  },
});
</script>
