<template>
  <div>
    <div class="px-8 py-2" v-if="!items.length">Not found groups</div>
    <div v-else>
      <div v-for="item in items" :key="item.id" @click="showDetails(item.id)">
        <div
          class="
            cursor-pointer
            flex
            justify-between
            items-center
            px-8
            py-2
            border-b border-gray-300
          "
        >
          <div class="text-bold text-xl">
            {{ item.name }}
          </div>
          <div class="text-bold text-gray-500 text-lg">
            {{ item.user ? item.user.name : "" }}
          </div>
        </div>

        <div
          class="px-8 py-2 border-b border-gray-300"
          v-show="openDetail === item.id"
        >
          <div class="flex"><GroupPanel /></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import axios from "axios";
import GroupPanel from "@/Jetstream/GroupPanel.vue";
export default defineComponent({
  components: { GroupPanel },
  data() {
    return {
      items: [],
      openDetail: null,
    };
  },
  mounted() {
    axios.get("/api/groups").then((resp) => {
      this.items = resp.data.items.data;
    });
  },
  methods: {
    showDetails(id) {
      this.openDetail = id;
    },
  },
});
</script>
