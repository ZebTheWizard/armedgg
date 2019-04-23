<template>
  <draggable class="dragarea" tag="ul" :list="list" group="list" @change="change">
    <li v-for="el in list" :key="el.name">
      <p>{{ el.desc }}</p>
      <nested v-if="nestable" :list="el.list" />
    </li>
  </draggable>
</template>
<script>

import draggable from 'vuedraggable'

export default {
  name: "nested",
  props: {
    list: {
      required: true,
      type: Array
    },
    nestable: {
      required: false,
      type: Boolean,
      default: true
    },
    changed: {
      required: false,
      type: Function,
      default: function () {}
    }
  },
  components: {
    draggable
  },
  methods: {
    change (e) {
      // console.log(e);
      this.$emit('change', e)
    }
  }
};
</script>
<style scoped>
.dragarea {
  padding: 1rem 0;
}
.dragarea .dragarea {
  padding: 3rem 0 0rem 20px;
  margin-top: -3rem
}
.dragarea li {
  list-style: none;
}

.dragarea p {
  margin: 0.5rem 0;
  background: #262932;
  padding: 1rem;
}

/* .dragarea.hover {
  margin-bottom: 3rem;
} */
</style>