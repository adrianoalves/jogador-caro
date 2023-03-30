<template>
  <q-page class="flex flex-center">
    <div class="column q-pa-lg">
      <div class="row">
        <q-card round flat bordered>
          <q-card-section class="">
            <h4 class="text-h5 text-center text-blue-7 q-my-md">Login</h4>

          </q-card-section>
          <q-card-section>
            <q-form class="q-px-sm q-pt-sm">
              <q-input
                class="q-mb-md"
                outlined
                clearable
                v-model="email"
                type="email"
                label="Email">
                <template v-slot:prepend>
                  <q-icon name="local_post_office" />
                </template>
              </q-input>

              <q-input
                outlined
                clearable
                v-model="passwd"
                type="password"
                label="Senha">

                <template v-slot:prepend>
                  <q-icon name="lock_open" />
                </template>
              </q-input>
            </q-form>
          </q-card-section>

          <q-card-actions class="q-px-lg q-pb-lg">
            <q-btn
              unelevated
              size="lg"
              color="blue-7"
              @click="submit"
              class="full-width text-white"
              label="entrar"
            />

          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import {api} from 'boot/axios';
import { useUserStore } from 'stores/UserStore'

const email = ref('fay.carley@example.org')
const passwd = ref('1234')
const userStore = useUserStore()
const router = useRouter()

const submit = () => {

  api.post('login', {
    email: email.value, passwd: passwd.value
  })
  .then( (res) => {
    userStore.token = res.data.token
    userStore.data  = res.data.user
    localStorage.setItem('tk', res.data.token)
    api.defaults.headers.common['Authorization'] = `Bearer ${res.data.token}`
    router.push({ name: 'match'})
  })
}

</script>
