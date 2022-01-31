<template>
  <DialogModal :show="show">
    <template #title>Create Expense</template>
    <template #content>
      <ErrorInfo class="mb-3" :show="err" />

      <form>
        <div class="sm:flex mb-3">
          <label for="descr" class="min-w-[100px] text-base text-gray-400 mr-3"
            >Description</label
          >
          <textarea
            class="text-base border w-full border-gray-300 rounded-md px-3 py-2"
            v-model="descr"
            name="descr"
            id=""
          />
        </div>
        <div class="sm:flex mb-3">
          <label for="amount" class="min-w-[100px] text-base text-gray-400 mr-3"
            >Amount</label
          >
          <input
            class="text-base w-full border border-gray-300 rounded-md px-3 py-2"
            type="number"
            v-model="amount"
            name="amount"
            id=""
            step="1"
          />
        </div>
        <div class="sm:flex mb-3">
          <label
            for="options"
            class="min-w-[100px] text-base text-gray-400 mr-3"
            >Type split</label
          >
          <select
            class="text-base w-full border border-gray-300 rounded-md px-3 py-2"
            v-model="type"
            name="options"
            id=""
          >
            <option v-for="item in options" :key="item.id" v-bind:value="item">
              {{ item.name }}
            </option>
          </select>
        </div>
        <div class="sm:flex mb-3" v-if="type && type.name === 'EXACT'">
          <label for="exact" class="min-w-[100px] text-base text-gray-400 mr-3"
            >Exact user</label
          >
          <select
            class="text-base border w-full border-gray-300 rounded-md px-3 py-2"
            v-model="recipient_id"
            name="exact"
            id=""
          >
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
          <div class="sm:flex mb-3" v-for="item in otherMembers" :key="item.id">
            <label
              :for="item.name"
              class="min-w-[100px] text-base text-gray-400 mr-3"
              >{{ item.name }}</label
            >
            <div class="flex">
              <input
                class="
                  w-full
                  text-base
                  border border-gray-300
                  rounded-md
                  px-3
                  py-2
                "
                type="number"
                max="100"
                v-model="item.percent"
                @input="choisePercent(item)"
                step="1"
                :name="item.name"
                id=""
              />
              <span class="text-lg text-gray-500 ml-3">%</span>
            </div>
          </div>
        </div>
      </form>
    </template>
    <template #footer>
      <Button class="w-full sm:w-1/4 mr-3" @click.native="closeModal"
        >Close</Button
      >
      <DangerButton
        class="w-full sm:w-1/4"
        @click.native="submit"
        :disabled="!descr || !type || !amount"
        >Send</DangerButton
      >
    </template>
  </DialogModal>
</template>

<script>
import { defineComponent } from "vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import Button from "@/Jetstream/Button.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ErrorInfo from "@/Jetstream/ErrorInfo.vue";

export default defineComponent({
  props: ["show", "group_id", "currentMembers", "goupOwner"],
  components: { DangerButton, DialogModal, Button, ErrorInfo },
  data() {
    return {
      amount: null,
      descr: null,
      type: null,
      recipient_id: this.$page.props.auth.user.id,
      err: false,
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
    closeModal() {
      this.$emit("close:modal-expenses");
    },
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
          this.closeModal();
        })
        .catch((error) => {
          this.err = true;
        });
    },
  },
});
</script>
