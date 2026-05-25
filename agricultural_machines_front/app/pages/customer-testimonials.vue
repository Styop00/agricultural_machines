<template>
  <div>
    <ContentPageHero
      eyebrow="Customer Testimonials"
      title="What customers say about working with us."
      description="Use this page to share buyer feedback, delivery experiences, and service stories in the same content-page structure as the rest of About."
    />

    <section class="mx-auto grid max-w-7xl gap-7 px-4 pb-16 sm:px-6 md:grid-cols-2 lg:px-8">
      <article
        v-for="testimonial in testimonials"
        :key="testimonial.id"
        class="overflow-hidden border border-white/15 bg-black/35 shadow-2xl shadow-black/30 backdrop-blur"
      >
        <div class="aspect-[16/9] overflow-hidden bg-gradient-to-br from-slate-950 via-primary-900 to-slate-900">
          <img
            v-if="testimonial.image_url"
            :src="testimonial.image_url"
            :alt="`${testimonial.name} testimonial`"
            class="size-full object-cover"
          >
        </div>
        <div class="p-5">
          <div class="flex items-center gap-3">
            <img
              v-if="testimonial.avatar_url"
              :src="testimonial.avatar_url"
              :alt="testimonial.name"
              class="size-12 rounded-full border border-primary/30 object-cover"
            >
            <div>
              <h2 class="text-sm font-black uppercase tracking-[0.16em] text-ink">
                {{ testimonial.name }} - {{ testimonial.location }}
              </h2>
              <p class="mt-1 text-xs font-black uppercase tracking-[0.18em] text-primary">
                {{ testimonial.context }}
              </p>
            </div>
          </div>
          <p class="mt-4 text-sm leading-6 text-ink/65">
            {{ testimonial.quote }}
          </p>
        </div>
      </article>

      <EmptyState
        v-if="!testimonials?.length"
        title="No testimonials yet"
        description="Add customer testimonials in the admin dashboard and they will appear here."
      />
    </section>
  </div>
</template>

<script setup lang="ts">
import ContentPageHero from "~/components/sections/ContentPageHero.vue";
import EmptyState from "~/components/ui/EmptyState.vue";

const { loadTestimonials } = useStorefrontData()
const { data: testimonials } = await loadTestimonials()
</script>
