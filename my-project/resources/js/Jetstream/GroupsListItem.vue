<template>
  <div>
    <div
      class="
        cursor-pointer
        flex
        justify-between
        datas-center
        py-2
        border-b border-gray-300
      "
      @click="showDetails(data.id)"
    >
      <H3 class="text-bold text-xl">
        {{ data.name }}
      </H3>
      <div class="text-bold text-gray-500 text-lg">
        {{ data.user ? data.user.name : "" }}
      </div>
    </div>

    <div class="py-2 border-b border-gray-300" v-show="openDetail === data.id">
      <GroupPanel
        :group_id="data.id"
        :members="data.members"
        :currentMembers="currentMembers"
        :user="data.user"
      />
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
import H3 from "@/Jetstream/H3.vue";

export default defineComponent({
  props: ["data"],
  components: { GroupPanel, UsersList, ExpensesList, H3 },
  data() {
    return {
      openDetail: null,
    };
  },
  computed: {
    currentMembers() {
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
