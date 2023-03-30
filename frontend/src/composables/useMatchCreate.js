import { ref } from 'vue'

const showForm = ref(false)

function openCreateForm() {
  showForm.value = true
}
export {showForm, openCreateForm}
