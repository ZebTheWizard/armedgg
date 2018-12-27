<template>
  <div class="field">
    <label :for="name" class="label">{{ label }}</label>
    <div class="control">
      <input type="hidden" :name="name" :value="output">
      <input v-if="original" type="hidden" :name="original" :value="getvalue">
      <input :id="name"
             :class="['input', 'form-control', {'is-danger': error === '1'}]"
             :type="type"
             :placeholder="placeholder"
             :value="getvalue"
             ref="input"
             @input="update">
    </div>
    <slot v-if="error === '1'">

    </slot>
  </div>
</template>

<script>
    export default {
        props: {
          error: {
            type: String,
            default: '0'
          },
          value: {
            type: String,
            default: ''
          },
          placeholder: {
            type: String,
            default: 'Text Input'
          },
          type: {
            type: String,
            default: 'text'
          },
          name: {
            type: String,
            default: ''
          },
          label: {
            type: String,
            default: 'Label'
          },
          prepend: {
            type: String,
            required: true
          },
          append: {
            type: String,
            default: ''
          },
          original: {
            type: String,
          }
        },
        data() {
          return {
            output: undefined,
            input: undefined,
            getvalue: this.value
          }
        },
        methods: {
          update () {
            this.getvalue = this.$refs.input.value
            this.output = this.prepend + this.value + this.append
          }
        },
        mounted() {
          this.update()
        }
    }
</script>
