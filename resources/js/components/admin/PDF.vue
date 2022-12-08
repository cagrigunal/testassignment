<template>
<div>
    <form class="container" @submit.prevent="saveFormData">
        <h2>Add a PDF</h2>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" v-model="title" class="form-control" />
        </div>
        <div class="form-group">
            <label for="file">File:</label>
            <input type="file" id="file" accept=".pdf" @change="handleFileChange" class="form-control-file" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <br/>
    <br/>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>File</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items">
            <td>{{ item.title }}</td>
            <td><a :href="item.filePath" target="_blank">View File</a></td>
            <td><button class="btn btn-danger" v-on:click="deletePDF(item.id)">Delete</button></td>
            <td><button type="button" class="btn" data-toggle="modal" data-target="#editPDFModal" v-on:click="editPDF(item)">Edit</button></td>
        </tr>
        </tbody>
    </table>



    <!-- Modal -->
    <div v-if="itemToUpdate" class="modal fade" id="editPDFModal" tabindex="-1" role="dialog" aria-labelledby="editPDFModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPDFModalLabel">PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="title">Title:</label>
                    <input type="text" id="titleToUpdate" v-model="itemToUpdate.title" />
                    <br/>
                    <br/>
                    <label for="file">File:</label>
                    <input type="file" id="fileToUpdate" accept=".pdf" @change="handleFileChange" />
                    <br/>
                    <br/>
                    <input class="btn btn-primary" v-on:click="updatePDF"  data-dismiss="modal" value="Save">

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
        name: 'PDF',
        data() {
            return {
                title: '',
                file: null,
                items: [],
                itemToUpdate:null
            };
        },
        created() {
           this.fetchData()
        },
        methods: {
            editPDF(item){
                this.itemToUpdate={...item};
            },
            fetchData(){
                // fetch the data from the server using axios
                axios.get('pdf')
                    .then(response => {
                        // store the data in the items array
                        this.items = response.data;
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });
            },
            saveFormData(event) {
                // create a FormData object to store the form data
                const formData = new FormData();

                // add the form data to the FormData object
                formData.append('title', this.title);
                formData.append('file', this.file);


                axios.post('/pdf', formData)
                    .then(response => {
                       this.fetchData()
                        this.title=''
                        this.file=null
                    })
                    .catch(error => {
                        // handle any errors that occurred
                    });
            },
            updatePDF(event) {
                // create a FormData object to store the form data
                const formData = new FormData();
                const url = 'pdf/'+this.itemToUpdate.id
                // add the form data to the FormData object
                formData.append('title', this.itemToUpdate.title);
                formData.append('file', this.file);

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
            deletePDF(id){
                const url = 'pdf/'+id
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

            handleFileChange(e) {
                // check if the selected file is a PDF
                if (e.target.files[0].type === 'application/pdf') {
                    // save the file to the component's data
                    this.file = e.target.files[0];
                }
            },
        },
    };
</script>

