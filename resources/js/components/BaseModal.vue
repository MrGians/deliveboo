<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              
            </slot>
          </div>

          <div class="modal-footer">
            <button class="button button-confirm" @click="$emit('reset')">Continua</button>
            <button class="button button-back" @click="$emit('close')">Annulla</button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
    name: 'BaseModal',
    methods: {
        
    }
}
</script>

<style scoped lang="scss">
@import './../../sass/front.scss';

.modal-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.button {
    display: inline-block;
    padding: 0.4rem 0.6rem;
    border: 2px solid $tertiary;
    background-color: $tertiary;
    color: white;
    border-radius: 30px;
    transition: all 0.35s;
    cursor: pointer;

    &:hover {
        background-color: white;
        color: $tertiary;
    }
}

.button-confirm {
    border: 2px solid $quaternary;
    background-color: $quaternary;
    &:hover {
        background-color: white;
        color: $quaternary;
    }
}

.button-back {
    border: 2px solid $tertiary;
    background-color: $tertiary;
    &:hover {
        background-color: white;
        color: $tertiary;
    }
}
</style>