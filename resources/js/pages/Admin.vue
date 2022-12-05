<template>
    <form>
        <label for="title">Title:</label>
        <input type="text" id="title" v-model="title" />

        <label for="file">File:</label>
        <input type="file" id="file" accept=".pdf" @change="handleFileChange" />
    </form>
</template>

<script>
    export default {
        name: 'Admin',
        data() {
            return {
                title: '',
                file: null,
            };
        },
        methods: {
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


