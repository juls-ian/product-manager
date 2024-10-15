<script setup>
   import { computed } from "vue";
   import Checkbox from "./Checkbox.vue";

   const props = defineProps({
      rows: {
         type: Array,
         required: true,
      },
      // to allow two way binding
      modelValue: {
         type: Array,
         required: true,
      },
   });
   // we emit this if Checkbox is checked or unchecked
   const emit = defineEmits(["update:modelValue"]);

   const proxyChecked = computed({
      // checks if all item in rows are selected
      get() {
         return props.modelValue.length === props.rows.length;
      },
      // this listens for change event
      set(val) {
         const checked = [];
         if (val) {
            props.rows.forEach((row) => checked.push(row.id));
         }
         emit("update:modelValue", checked);
      },
   });
</script>

<template>
   <Checkbox v-model:checked="proxyChecked" />
</template>
