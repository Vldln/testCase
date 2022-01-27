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
        <GroupPanel :group_id="data.id" :user="data.user" />
      </div>
      <UsersList :members="data.members" :owner="data.user" />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import GroupPanel from "@/Jetstream/GroupPanel.vue";
import UsersList from "@/Jetstream/UsersList.vue";

export default defineComponent({
  props: ["data"],
  components: { GroupPanel, UsersList },
  data() {
    return {
      openDetail: null,
    };
  },

  methods: {
    showDetails(id) {
      this.openDetail ? (this.openDetail = null) : (this.openDetail = id);
    },
  },
});
</script>
