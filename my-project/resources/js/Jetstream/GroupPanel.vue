<template>
  <div class="grid grid-cols-12 md:flex gap-3 py-2">
    <Button
      @click.native="showExpense ? (showExpense = false) : (showExpense = true)"
      class="md:mr-3 col-span-6 sm:col-span-3"
      v-if="members.length"
      >Add Expense</Button
    ><Button
      class="md:mr-3 col-span-6 sm:col-span-3"
      v-if="$page.props.auth.user.id === user.id"
      @click.native="showInvite ? (showInvite = false) : (showInvite = true)"
      >Invite users</Button
    >
    <Button
      class="md:mr-3 col-span-6 sm:col-span-3"
      v-if="$page.props.auth.user.id === user.id"
      @click.native="showUpdate = true"
      >Change name group</Button
    >
    <Button
      class="md:mr-3 col-span-6 sm:col-span-3"
      v-if="$page.props.auth.user.id === user.id"
      @click.native="deleteModal = true"
      >Delete group</Button
    >
    <GroupPanelInviteForm
      :show="showInvite"
      :group_id="group_id"
      @close:modal-invite="showInvite = false"
    />
    <GroupPanelExpensesForm
      :currentMembers="currentMembers"
      :show="showExpense"
      :group_id="group_id"
      :groupOwner="user.id"
      @close:modal-expenses="showExpense = false"
    />
    <GroupPanelUpdateGroupForm
      :show="showUpdate"
      :group_id="group_id"
      @close:modal-update="showUpdate = false"
    />
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
      <template #content>
        <div class="flex justify-around">
          <DangerButton
            @click.native="deleteGroup"
            class="mr-1 sm:mr-0 w-full sm:w-1/4"
            >Delete</DangerButton
          ><Button
            @click.native="deleteModal = false"
            class="ml-1 sm:ml-0 w-full sm:w-1/4"
            >Cancel</Button
          >
        </div></template
      >
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
