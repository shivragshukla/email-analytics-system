<script setup>
import { useAuthStore } from "@/stores/auth";
import { storeToRefs } from "pinia";
import { onMounted, reactive } from "vue";

const { errors } = storeToRefs(useAuthStore());
const { authenticate } = useAuthStore();

const form = reactive({
  email: "",
  password: "",
});

onMounted(() => (errors.value = {}));

</script>
<template>
  <section class="bg-[#F4F7FF] py-20 lg:py-[120px]">
    <div class="container mx-auto">
      <div class="-mx-4 flex flex-wrap">
        <div class="w-full px-4">
          <div
            class="
              relative
              mx-auto
              max-w-[525px]
              overflow-hidden
              rounded-lg
              bg-white
              py-16
              px-10
              text-center
              sm:px-12
              md:px-[60px]
            "
          >
            <div class="mb-10 text-center md:mb-16">Login</div>
            <form @submit.prevent="authenticate('login', form)">
              <div class="mb-6">
                <input
                  type="email"
                  v-model="form.email"
                  placeholder="Email"
                  class="
                    bordder-[#E9EDF4]
                    w-full
                    rounded-md
                    border
                    bg-[#FCFDFE]
                    py-3
                    px-5
                    text-base text-body-color
                    placeholder-[#ACB6BE]
                    outline-none
                    focus:border-primary
                    focus-visible:shadow-none
                  "
                />
                <div v-if="errors.email" class="flex">
                  <span class="text-red-400 text-sm m-2 p-2">{{
                    errors.email[0]
                  }}</span>
                </div>
              </div>
              <div class="mb-6">
                <input
                  type="password"
                  v-model="form.password"
                  placeholder="Password"
                  class="
                    bordder-[#E9EDF4]
                    w-full
                    rounded-md
                    border
                    bg-[#FCFDFE]
                    py-3
                    px-5
                    text-base text-body-color
                    placeholder-[#ACB6BE]
                    outline-none
                    focus:border-primary
                    focus-visible:shadow-none
                  "
                />
                <div v-if="errors.password" class="flex">
                  <span class="text-red-400 text-sm m-2 p-2">{{
                    errors.password[0]
                  }}</span>
                </div>
              </div>
              <div class="mb-10">
                <button
                  type="submit"
                  class="
                    w-full
                    px-4
                    py-3
                    bg-indigo-500
                    hover:bg-indigo-700
                    rounded-md
                    text-white
                  "
                >
                  Login
                </button>
              </div>
            </form>
            <p class="text-base text-[#adadad]">
              Not a member yet?
              <router-link :to="{ name: 'register' }" class="text-primary hover:underline">
                Sign Up
              </router-link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>