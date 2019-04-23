<template lang="html">
  <ul>
    <li v-for="category in categories">
      <radio name="category">{{ category.name }}</radio>
    </li>
  </ul>


</template>

<script>
import {Checkbox, Radio} from 'vue-checkbox-radio';

export default {
  name: 'category-picker',
  props: ['categories', 'exclude'],
  components: {
    Radio
  },
  data () {
    return {
      selected: null
    }
  }
}
</script>

<style lang="css">
</style>
