<template>
    <div class='row'>
        <h1>My Todo</h1>
        <h4>New Todo</h4>
        <form action="#" @submit.prevent="createTodo()">
            <div class="input-group">
                <input v-model="todo.body" type="text" name="body" class="form-control" autofocus>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Todo</button>
                </span>
            </div>
        </form>
        <h4>All Todos</h4>
        <ul class="list-group">
            <li v-if='list.length === 0'>There are no todos yet!</li>
            <li class="list-group-item" v-for="(todo, index) in list">
                 {{ todo.body }}
                 <button @click="deleteTodo(todo.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                list: [],
                todo: {
                    id: '',
                    body: ''
                }
            };
        },
        
        created() {
            this.fetchTodoList();
        },
        
        methods: {
            fetchTodoList() {
                axios.get('api/todos').then((res) => {
                    this.list = res.data;
                });
            },
 
            createTodo() {
                axios.post('api/todos', this.todo)
                    .then((res) => {
                        this.todo.body = '';
                        this.edit = false;
                        this.fetchTodoList();
                    })
                    .catch((err) => console.error(err));
            },
 
            deleteTodo(id) {
                axios.delete('api/todos/' + id)
                    .then((res) => {
                        this.fetchTodoList()
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>