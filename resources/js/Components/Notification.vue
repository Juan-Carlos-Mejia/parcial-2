<template>
  <div v-if="notification" class="notification" :class="notification.type">
    {{ notification.message }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      notification: null
    };
  },
  methods: {
    showNotification(message, type = 'success') {
      this.notification = { message, type };
      setTimeout(() => {
        this.hideNotification();
      }, 3000); // Ocultar la notificación después de 3 segundos (ajustar según tus necesidades)
    },
    hideNotification() {
      this.notification = null;
    }
  }
};
</script>

<style scoped>
.notification {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 10px 20px;
  border-radius: 5px;
  color: #fff;
  z-index: 9999;
}

.success {
  background-color: green;
}

.error {
  background-color: red;
}

.warning {
  background-color: orange;
}
</style>
