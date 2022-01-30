<template>
  <DialogModal :show="show">
    <template #title> Create Group </template>
    <template #content>
      <form>
        <textarea v-model="descr" name="" id="" />
        <input type="number" v-model="amount" name="" id="" step="1" />
        <select v-model="type" name="" id="">
          <option v-for="item in options" :key="item.id" v-bind:value="item">
            {{ item.name }}
          </option>
        </select>
        <div v-if="type && type.name === 'EXACT'">
          <select v-model="recipient_id" name="" id="">
            <option
              v-for="item in otherMembers"
              :key="item.id"
              v-bind:value="item.id"
            >
              {{ item.name }}
            </option>
          </select>
        </div>
        <div v-if="type && type.name === 'PERCENT'">
          <div class="flex" v-for="item in otherMembers" :key="item.id">
            <div>{{ item.name }}</div>
            <input
              type="number"
              max="100"
              v-model="item.percent"
              @input="choisePercent(item)"
              step="1"
              name=""
              id=""
            />%
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
  props: ["show", "group_id", "currentMembers", "goupOwner"],
  components: { DangerButton, DialogModal },
  data() {
    return {
      amount: null,
      descr: null,
      type: null,
      recipient_id: this.$page.props.auth.user.id,
    };
  },
  computed: {
    options() {
      return this.$store.state.options;
    },
    otherMembers() {
      return this.currentMembers.filter((item) => {
        return item.id !== this.$page.props.auth.user.id;
      });
    },
  },
  methods: {
    choisePercent(item) {
      let summ = this.otherMembers
        .filter((el) => el.id != item.id)
        .reduce(function (sum, elem) {
          return sum + elem.percent;
        }, 0);
      if (summ + item.percent > 100) {
        item.percent = 100 - summ;
      }
    },
    submit() {
      this.$store
        .dispatch("postExpenses", {
          type: this.type.id,
          descr: this.descr,
          amount: this.amount,
          group_id: this.group_id,
          recipient_id: this.recipient_id,
          members: this.currentMembers,
        })
        .then((resp) => {
          this.$store.dispatch("getGroups");
        });
    },
  },
});
</script>
