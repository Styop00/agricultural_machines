<template>
  <div>
    <ContentPageHero
      eyebrow="Our Team"
      title="People who understand premium vehicle buying."
      description="Introduce sales, service, transport, and support team members for your showroom."
    />
    <section class="mx-auto grid max-w-7xl gap-7 px-4 pb-16 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">
      <article
        v-for="member in teamMembers || []"
        :key="member.id"
        class="overflow-hidden border border-white/15 bg-black/35 shadow-2xl shadow-black/30 backdrop-blur transition hover:-translate-y-1 hover:border-primary/40"
      >
        <div class="aspect-[4/5] overflow-hidden bg-gradient-to-br from-slate-950 via-primary-900 to-slate-900">
          <img
            v-if="member.avatar_url"
            :src="member.avatar_url"
            :alt="member.name"
            class="size-full object-cover"
          >
        </div>
        <div class="p-4">
          <h2 class="text-sm font-black uppercase tracking-[0.12em] text-ink">
            {{ member.name }} - {{ member.role }}
          </h2>
          <p
            v-if="member.location"
            class="mt-1 text-xs font-black uppercase tracking-[0.18em] text-primary"
          >
            {{ member.location }}
          </p>
          <p class="mt-3 text-sm leading-6 text-ink/60">
            {{ member.bio }}
          </p>
        </div>
      </article>

      <EmptyState
        v-if="!teamMembers?.length"
        title="No team members yet"
        description="Seed or add team members and they will appear here."
      />
    </section>
  </div>
</template>
<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import EmptyState from "~/components/ui/EmptyState.vue";

const { loadTeamMembers } = useStorefrontData()
const { data: teamMembers } = await loadTeamMembers()
</script>