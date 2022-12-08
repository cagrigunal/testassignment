<template>
    <form class="container" @submit.prevent="handleSubmit">
        <h2>Add an HTML Snippet</h2>
        <div class="form-group">
            <label for="title">Title:</label>
            <input v-model="title" type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea v-model="description" class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="html">HTML Code:</label>
            <textarea v-model="html" class="form-control" id="html" name="html"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>

    <br/>
    <br/>

    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>HTML Snippet</th>
            <th>Description</th>


        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items">
            <td>{{item.title}}</td>

            <td><pre v-highlightjs>
                      <code :class="['language-html']">{{ item.html }}</code>
                    </pre></td>
            <td>{{item.description}}</td>
            <td><button class="btn btn-danger" v-on:click="deleteHTML(item.id)">Delete</button></td>
            <td><button type="button" class="btn" data-toggle="modal" data-target="#editHTMLModal" v-on:click="editHTML(item)">Edit</button></td>


        </tr>
        </tbody>
    </table>
    <!-- Modal -->
    <div v-if="itemToUpdate" class="modal fade" id="editHTMLModal" tabindex="-1" role="dialog" aria-labelledby="editHTMLModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPDFModalLabel">HTML Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input v-model="itemToUpdate.title" type="text" class="form-control" id="titleToEdit" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea v-model="itemToUpdate.description" class="form-control" id="descriptionToEdit" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="html">HTML Code:</label>
                        <textarea v-model="itemToUpdate.html" class="form-control" id="htmlToEdit" name="html"></textarea>
                    </div>
                    <button v-on:click="updateHTML" class="btn btn-primary" data-dismiss="modal" >Update</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items:[],
                title: '',
                description: '',
                html: '',
                itemToUpdate:null
            };
        },
        created() {

            this.fetchData()
        },
        methods: {
            editHTML(item){
                this.itemToUpdate={...item};
            },
            fetchData() {
                // fetch the data from the server using axios
                axios.get('htmlSnippet')
                    .then(response => {
                        // store the data in the items array
                        this.items = response.data;

                        for(let i in this.items){
                            this.items[i].copyStatus="Copy"
                        }
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });
            },
            handleSubmit() {

                // create a FormData object to store the form data
                const formData = new FormData();

                // add the form data to the FormData object
                formData.append('title', this.title);
                formData.append('description', this.description);
                formData.append('html', this.html);



                axios.post('/htmlSnippet', formData)
                    .then(response => {
                        this.fetchData()
                        this.title=''
                        this.description=''
                        this.html=''
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });            },

            updateHTML(event) {
                // create a FormData object to store the form data
                const formData = new FormData();
                const url = 'htmlSnippet/'+this.itemToUpdate.id
                // add the form data to the FormData object
                formData.append('title', this.itemToUpdate.title);
                formData.append('description', this.itemToUpdate.description);
                formData.append('html', this.itemToUpdate.html);

                const config = {
                    params: {
                        _method: 'PATCH',
                    }
                };
                axios.post(url, formData,config)
                    .then(response => {
                        this.fetchData()
                        this.itemToUpdate=null
                        this.file=null
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });
            },
            deleteHTML(id){
                const url = 'htmlSnippet/'+id
                axios.delete(url)
                    .then(response => {
                        // store the data in the items array
                        this.fetchData();
                        alert("Deleted");
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });
            },
        },
    };
</script>
