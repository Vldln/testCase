<template>
  <div class="flex">
    <Button @click.native="addExpense" class="mr-3">Add Expense</Button
    ><Button @click.native="inviteUsers">Invite users</Button>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import axios from "axios";

export default defineComponent({
  components: {},
  data() {
    return {};
  },
  mounted() {
    axios.post("/api/expenses", {});
    axios.post("/api/responses", {});
  },
  methods: {},
});
</script>
