<template>
  <div class="flex">
    <Button
      @click.native="showExpense ? (showExpense = false) : (showExpense = true)"
      class="mr-3"
      v-if="members.length"
      >Add Expense</Button
    ><Button
      v-if="$page.props.auth.user.id === user.id"
      @click.native="showInvite ? (showInvite = false) : (showInvite = true)"
      >Invite users</Button
    >
    <Button
      v-if="$page.props.auth.user.id === user.id"
      @click.native="showUpdate = true"
      >Change name group</Button
    >
    <Button
      v-if="$page.props.auth.user.id === user.id"
      @click.native="deleteModal = true"
      >Delete group</Button
    >
    <GroupPanelInviteForm :show="showInvite" :group_id="group_id" />
    <GroupPanelExpensesForm
      :currentMembers="currentMembers"
      :show="showExpense"
      :group_id="group_id"
      :groupOwner="user.id"
    />
    <GroupPanelUpdateGroupForm :show="showUpdate" :group_id="group_id" />
    <DialogModal :show="show">
      <template #title> Create Group </template>
      <template #content>
        <form>
          <input type="email" v-model="email" name="" id="" /></form
      ></template>
      <template #footer>
        <DangerButton @click.native="submit" :disabled="!email"
          >Create</DangerButton
        >
      </template>
    </DialogModal>
    <DialogModal :show="deleteModal">
      <template #title> Delete Group </template>
      <template #footer>
        <DangerButton @click.native="deleteGroup">Delete</DangerButton
        ><Button @click.native="deleteModal = false">Cancel</Button>
      </template>
    </DialogModal>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import GroupPanelInviteForm from "@/Jetstream/GroupPanelInviteForm.vue";
import GroupPanelExpensesForm from "@/Jetstream/GroupPanelExpensesForm.vue";
import GroupPanelUpdateGroupForm from "@/Jetstream/GroupPanelUpdateGroupForm.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import Button from "@/Jetstream/Button.vue";

export default defineComponent({
  components: {
    GroupPanelInviteForm,
    GroupPanelExpensesForm,
    DialogModal,
    Button,
    DangerButton,
    GroupPanelUpdateGroupForm,
  },
  props: ["user", "group_id", "currentMembers", "members"],
  data() {
    return {
      showExpense: false,
      showInvite: false,
      showUpdate: false,
      deleteModal: false,
    };
  },

  methods: {
    deleteGroup() {
      this.$store
        .dispatch("deleteGroup", {
          id: this.group_id,
        })
        .then((resp) => {
          this.deleteModal = false;
          this.$store.dispatch("getGroups");
        });
    },
  },
});
</script>
