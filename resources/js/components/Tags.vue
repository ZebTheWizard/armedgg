<template>
  <div class="field">
    <label :for="name" class="label">{{ label }}</label>
    <div class="control">
      <input type="hidden" :name="name" :value="getExport()" ref="output">
      <!-- <input v-if="original" type="hidden" :name="original" :value="value"> -->
      <div :class="['input', 'form-control', {'is-danger': error === '1'}, {'is-focused': focused}]" @click.stop="focus" ref="outside">
        <span style="margin-right: 0.25rem" :class="['tag', {'is-dark': value == 'valid', 'is-danger': value == 'invalid', 'is-warning': value == 'checking'}]" v-for="(value, tag) in tags">
          {{ tag }}
          <i v-if="value == 'checking'" class="fas fa-spinner fa-spin" style="margin-left: 0.25rem"></i>
          <button v-else type="button" class="delete is-small" @click="remove(tag)"></button>
        </span>
        <input :id="name"
               type="text"
               class="tag-input input form-control"
               :placeholder="placeholder"
               :value="getvalue"
               ref="input"
               @input="update">
      </div>

    </div>
    <slot v-if="hasError === '1'">

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
          name: {
            type: String,
            default: ''
          },
          label: {
            type: String,
            default: 'Label'
          }
        },
        data() {
          return {
            tags: {},
            output: undefined,
            focused: false,
            hasError: this.error,
            getvalue: this.value
          }
        },
        methods: {
          getExport() {
            return Object.keys(this.tags).filter(tag => {
              return this.tags[tag] == 'valid'
            }).join(', ')
          },
          focus () {
            this.focused = true
            this.$refs.input.focus()
          },
          remove(key) {
            delete this.tags[key]
            this.tags = Object.assign({}, this.tags)
          },
          update (e) {
            if (typeof e === 'undefined') return
            var value = this.$refs.input.value
            if (e.data === ',') {
              var tag = value.substring(0, value.length - 1)
              this.$set(this.tags, tag, 'checking')
              axios.post('/checkurl', {url: tag}).then(res => {
                this.$set(this.tags, res.data, 'valid')
              }).catch(err => {
                this.$set(this.tags, err.response.data, 'invalid')
              })
            }
          }
        },
        mounted() {
          if (this.getvalue) {
            this.getvalue.split(', ').forEach(value => {
              this.$set(this.tags, value, 'valid')
            })
            this.getvalue = ""
          }

          window.addEventListener('click', (e) => {
            this.focused = false
          })
        }
    }
</script>

<style media="screen">
  .tag-input {
    height: 100%;
    margin-left: 0.5rem;
    width: 100%;
    border: 0;
    font-size: 1rem;
    outline: none !important;
    border-color: none !important;
    box-shadow: none !important;
  }
</style>
