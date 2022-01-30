<template>
  <div>
    <div
      class="
        cursor-pointer
        flex
        justify-between
        datas-center
        px-8
        py-2
        border-b border-gray-300
      "
      @click="showDetails(data.id)"
    >
      <div class="text-bold text-xl">
        {{ data.name }}
      </div>
      <div class="text-bold text-gray-500 text-lg">
        {{ data.user ? data.user.name : "" }}
      </div>
    </div>

    <div
      class="px-8 py-2 border-b border-gray-300"
      v-show="openDetail === data.id"
    >
      <div class="flex">
        <GroupPanel :group_id="data.id" :members="members" :user="data.user" />
      </div>
      <UsersList
        :owner="data.user"
        :members="data.members"
        :group_id="data.id"
      />
      <ExpensesList :expenses="data.expenses" />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import GroupPanel from "@/Jetstream/GroupPanel.vue";
import UsersList from "@/Jetstream/UsersList.vue";
import ExpensesList from "@/Jetstream/ExpensesList.vue";

export default defineComponent({
  props: ["data"],
  components: { GroupPanel, UsersList, ExpensesList },
  data() {
    return {
      openDetail: null,
    };
  },
  computed: {
    members() {
      let members = [];
      this.data.members.forEach((element) => {
        members.push(element);
      });
      members.push(this.data.user);
      return members;
    },
  },
  methods: {
    showDetails(id) {
      this.openDetail ? (this.openDetail = null) : (this.openDetail = id);
    },
  },
});
</script>
