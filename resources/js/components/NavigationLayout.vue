<template>
  <div class="row">
    <div class="col-6">

      <div class="list">
        <div class="h5 mt-5 mb-0">Navigation</div>
        <nested :list="result_available"/>
      </div>

    </div>
    <div class="col-6">

      <div class="list">
        <div class="h5 mt-5 mb-0">Available</div>
        <nested :list="list_available" :nestable="false"/>
      </div>

    </div>

    <!-- <raw class="col-3" :value="list" title="List" /> -->
  </div>
</template>

<script>
import nested from "./Nested.vue";
import raw from "./RawDisplayer.vue"
import axios from "axios"

export default {
  name: "nested-example",
  display: "Nested",
  order: 15,
  components: {
    nested,
    raw
  },
  props: [ "used", "available" ],
  data() {
    return {
      list_available: this.$props.available,
      result_available: this.$props.used
    }
  },
  mounted () {
    window.used_navigation = this.result_available
    window.available_navigation = this.list_available
  }
};
</script>

<style scoped>
  .list {
    padding: 0 3rem;
border: 3px dashed white;
margin: 1rem;
border-radius: 1rem;
  }
</style>

