<template>
  <div class="px-3 sm:px-8 pb-8">
    <H2 class="py-2">My own groups</H2>
    <div class="py-2 text-gray-400" v-if="owner && !owner.length">
      Not found groups
    </div>
    <div v-else>
      <GroupsListItem
        :members="item.members"
        v-for="item in owner"
        :key="item.id"
        :data="item"
      />
    </div>
    <H2 class="py-2 mt-6">My groups</H2>
    <div class="py-2 text-gray-400" v-if="member && !member.length">
      Not found groups
    </div>
    <div v-else>
      <GroupsListItem
        :members="item.members"
        v-for="item in member"
        :key="item.id"
        :data="item"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import GroupPanel from "@/Jetstream/GroupPanel.vue";
import H2 from "@/Jetstream/H2.vue";
import GroupsListItem from "@/Jetstream/GroupsListItem.vue";

export default defineComponent({
  components: { GroupPanel, H2, GroupsListItem },
  data() {
    return {};
  },
  computed: {
    owner() {
      return this.$store.state.groups_owner;
    },
    member() {
      return this.$store.state.groups_member;
    },
  },
  mounted() {
    this.getList();
    this.getOptions();
  },
  methods: {
    getList() {
      this.$store.dispatch("getGroups");
    },
    getOptions() {
      this.$store.dispatch("getOptions");
    },
    showDetails(id) {
      this.openDetail = id;
    },
  },
});
</script>
