<script setup lang="ts">
import PageRequestForm from "~/components/sections/PageRequestForm.vue";

const appConfig = useAppConfig()

const faqs = [
  {
    question: 'How is your pricing determined?',
    answer: [
      'Our vehicles are priced competitively based on market trends, overall condition, mileage, options, and buyer demand.',
      'Each price is established in advance to reflect a fair and accurate market value. While pricing is generally firm, we may consider reasonable conversations with qualified buyers who are prepared to move ahead.',
      'If a vehicle remains available for an extended period, pricing may be reviewed and updated across our website and in-store listings.',
    ],
  },
  {
    question: 'Are there any additional charges?',
    answer: ['Taxes, title or registration fees, delivery charges, and optional service work may be additional depending on the purchase and location.'],
  },
  {
    question: 'Do you provide shipping?',
    answer: ['Yes. We can help coordinate nationwide delivery and provide details before purchase so you know what to expect.'],
  },
  {
    question: 'Do the photos show the actual vehicle for sale?',
    answer: ['Yes. Inventory photos are intended to show the actual listed vehicle. Contact us if you need more photos or specific close-ups.'],
  },
  {
    question: 'Do your vehicles come with clean titles?',
    answer: ['Available title and ownership documentation is reviewed before listing. Ask our team for details on a specific vehicle.'],
  },
  {
    question: 'Do you sell to out-of-state buyers?',
    answer: ['Yes. We regularly work with buyers outside Wisconsin and can assist with paperwork, payment coordination, and delivery planning.'],
  },
  {
    question: 'What forms of payment do you accept?',
    answer: ['Accepted payment options may include certified funds, wire transfer, approved financing, or other verified payment methods.'],
  },
  {
    question: 'Is a warranty included?',
    answer: ['Warranty coverage depends on the vehicle and purchase terms. Review the warranty page or contact us for vehicle-specific details.'],
  },
  {
    question: 'Do you include a money-back guarantee?',
    answer: ['Eligible purchases may qualify under our money-back guarantee terms. Please review the guarantee page for current conditions.'],
  },
]

const openIndex = ref(0)

useSeoMeta({
  title: `FAQ | ${appConfig.shop.name}`,
  description: `Frequently asked questions and contact request form for ${appConfig.shop.name}.`,
})
</script>

<template>
  <section class="relative overflow-hidden bg-primary-900 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_22%_4%,rgba(255,255,255,0.12),transparent_26rem),linear-gradient(135deg,rgba(0,0,0,0.2),rgba(0,0,0,0.82))]" />
    <div class="relative mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
      <div>
        <p class="text-xs font-black uppercase tracking-[0.24em] text-white">
          {{ appConfig.shop.name }}
        </p>
        <h1 class="mt-3 text-4xl font-black uppercase tracking-tight sm:text-5xl">
          <span class="text-secondary">Frequently Asked</span> Questions
        </h1>

        <div class="mt-9 border border-white/15 bg-black/30">
          <article
            v-for="(faq, index) in faqs"
            :key="faq.question"
            class="border-b border-white/15 last:border-b-0"
          >
            <button
              type="button"
              class="flex w-full items-center justify-between px-5 py-4 text-left text-sm font-black text-white transition hover:bg-white/5"
              @click="openIndex = openIndex === index ? -1 : index"
            >
              <span :class="openIndex === index ? 'text-secondary' : 'text-white'">
                {{ faq.question }}
              </span>
              <span class="text-secondary">
                {{ openIndex === index ? '-' : '+' }}
              </span>
            </button>

            <div
              v-if="openIndex === index"
              class="space-y-4 px-5 pb-5 text-sm leading-7 text-white/75"
            >
              <p
                v-for="paragraph in faq.answer"
                :key="paragraph"
              >
                {{ paragraph }}
              </p>
            </div>
          </article>
        </div>
      </div>

      <PageRequestForm
        title="Looking for more information?"
        description="If you have any questions or need further clarification on the information above, our team would be happy to assist you."
        request-type="FAQ information"
        source-page="FAQ"
        submit-label="Submit Request"
      />
    </div>
  </section>
</template>