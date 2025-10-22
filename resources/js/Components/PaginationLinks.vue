<!--eslint-disable vue/no-v-text-v-html-on-component-->
<script setup>
defineProps({
  paginator: {
    type: Object,
    required: true,
  },
});

const makeLabel = (label) => {
  if (label.includes("Previous")) {
    return "<<";
  } else if (label.includes("Next")) {
    return ">>";
  } else {
    return label;
  }
};
</script>

<template>
  <div class="flex items-start justify-between">
    <div class="flex items-center overflow-hidden rounded-md shadow-lg">
      <div v-for="link in paginator.links" :key="link.url">
        <component
          :is="link.url ? 'Link' : 'span'"
          :href="link.url"
          v-html="makeLabel(link.label)"
          class="grid w-12 h-12 bg-white border-x border-slate-50 place-items-center"
          :class="{
            ' hover:bg-slate-300': link.url,
            'text-zinc-400': !link.url,
            'font-bold text-blue-500': link.active,
          }"
        />
      </div>
    </div>

    <p class="text-sm text-slate-600">
      Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} results
    </p>
  </div>
</template>
