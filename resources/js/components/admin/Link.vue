<template>
    <div>
    <form class="container" @submit.prevent="handleSubmit">
        <h2>Add an Link Snippet</h2>
        <div class="form-group">
            <label for="title">Title:</label>
            <input v-model="title" type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="description">Link:</label>
            <input v-model="link" class="form-control" id="description" name="description">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input v-model="newTab" type="checkbox" class="custom-control-input" id="newTab">
                <label class="custom-control-label" for="newTab">Open in new tab</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" >Create</button>
    </form>

    <br/>
    <br/>

    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Link</th>



        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items">
            <td>{{item.title}}</td>


            <td>{{item.link}}</td>
            <td><button class="btn btn-danger" v-on:click="deleteLink(item.id)">Delete</button></td>
            <td><button type="button" class="btn" data-toggle="modal" data-target="#editLinkModal" v-on:click="editLink(item)">Edit</button></td>


        </tr>
        </tbody>
    </table>
    <!-- Modal -->
    <div v-if="itemToUpdate" class="modal fade" id="editLinkModal" tabindex="-1" role="dialog" aria-labelledby="editLinkModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPDFModalLabel">Link Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input v-model="itemToUpdate.title" type="text" class="form-control" id="titleToUpdate" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Link:</label>
                        <input v-model="itemToUpdate.link" class="form-control" id="linkToUpdate" name="description">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input v-model="itemToUpdate.newTab" type="checkbox" class="custom-control-input" id="newTabToUpdate">
                            <label class="custom-control-label" for="newTabToUpdate">Open in new tab</label>
                        </div>
                    </div>
                    <button  v-on:click="updateLink"  class="btn btn-primary" data-dismiss="modal" >Update</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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
                link: '',
                newTab: false,
                itemToUpdate:null
            };
        },
        created() {

            this.fetchData()
        },
        methods: {
            editLink(item){
                this.itemToUpdate={...item};
            },
            fetchData() {
                // fetch the data from the server using axios
                axios.get('link')
                    .then(response => {
                        // store the data in the items array
                        this.items = response.data;


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
                formData.append('link', this.link);
                formData.append('newTab', this.newTab);



                axios.post('/link', formData)
                    .then(response => {
                        this.fetchData()
                        this.title=''
                        this.link=''
                        this.newTab=''
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });            },

            updateLink(event) {
                // create a FormData object to store the form data
                const formData = new FormData();
                const url = 'link/'+this.itemToUpdate.id
                // add the form data to the FormData object
                formData.append('title', this.itemToUpdate.title);
                formData.append('link', this.itemToUpdate.link);
                formData.append('newTab', this.itemToUpdate.newTab);

                const config = {
                    params: {
                        _method: 'PATCH',
                    }
                };
                axios.post(url, formData,config)
                    .then(response => {
                        this.fetchData()
                        this.itemToUpdate=null
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });
            },
            deleteLink(id){
                const url = 'link/'+id
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
