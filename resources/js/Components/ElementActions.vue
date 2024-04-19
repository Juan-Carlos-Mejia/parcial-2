<template>
    <div>
      <!-- Botón para agregar nuevo elemento -->
      <button @click="openCreateModal">Agregar Nuevo</button>
  
      <!-- Modal para editar elemento -->
      <div v-if="editingItem" class="modal">
        <h2>Editar Elemento</h2>
        <input v-model="editedItem.name" type="text" placeholder="Nombre">
        <input v-model="editedItem.description" type="text" placeholder="Descripción">
        <button @click="updateItem">Guardar</button>
        <button @click="closeEditModal">Cancelar</button>
      </div>
  
      <!-- Modal para agregar elemento -->
      <div v-if="showCreateModal" class="modal">
        <h2>Agregar Nuevo Elemento</h2>
        <input v-model="newItem.name" type="text" placeholder="Nombre">
        <input v-model="newItem.description" type="text" placeholder="Descripción">
        <button @click="createItem">Agregar</button>
        <button @click="closeCreateModal">Cancelar</button>
      </div>
  
      <!-- Lista de elementos -->
      <ul>
  <li v-for="(item, index) in items" :key="index">
    {{ item.name }}
    <button @click="openEditModal(item)">Editar</button>
    <button @click="deleteItem(item)">Eliminar</button>
  </li>
</ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        items: [], // Aquí se almacenan los elementos
        editingItem: null, // El elemento que se está editando actualmente
        showCreateModal: false, // Bandera para mostrar o ocultar el modal de creación
        newItem: { name: '', description: '' }, // Nuevo elemento a crear
        editedItem: { name: '', description: '' } // Elemento en proceso de edición
      };
    },
    methods: {
      openEditModal(item) {
        // Abre el modal de edición y establece el elemento a editar
        this.editingItem = item;
        this.editedItem = { ...item }; // Hace una copia profunda del elemento para evitar mutaciones inesperadas
      },
      closeEditModal() {
        // Cierra el modal de edición
        this.editingItem = null;
      },
      updateItem() {
        // Actualiza el elemento y cierra el modal de edición
        // Aquí deberías enviar una solicitud HTTP para actualizar el elemento en la base de datos
        // Una vez que la solicitud se haya completado con éxito, actualiza el estado de los elementos
        // y cierra el modal de edición.
        this.editingItem.name = this.editedItem.name;
        this.editingItem.description = this.editedItem.description;
        this.closeEditModal();
      },
      openCreateModal() {
        // Abre el modal de creación
        this.showCreateModal = true;
      },
      closeCreateModal() {
        // Cierra el modal de creación
        this.showCreateModal = false;
      },
      createItem() {
        // Crea un nuevo elemento y lo agrega a la lista
        // Aquí deberías enviar una solicitud HTTP para crear el elemento en la base de datos
        // Una vez que la solicitud se haya completado con éxito, agrega el nuevo elemento al estado
        // y cierra el modal de creación.
        this.items.push({ ...this.newItem });
        this.closeCreateModal();
      },
      deleteItem(item) {
        // Elimina el elemento de la lista
        // Aquí deberías enviar una solicitud HTTP para eliminar el elemento de la base de datos
        // Una vez que la solicitud se haya completado con éxito, elimina el elemento del estado.
        const index = this.items.indexOf(item);
        if (index !== -1) {
          this.items.splice(index, 1);
        }
      }
    }
  };
  </script>
  
  <style>
  .modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 999;
  }
  </style>
  