<template>
    <table>
        <thead>
        <tr>

            <th>File</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items">

            <td><a :href="item.filePath" target="_blank">{{ item.title }}</a></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'PDFVisitor',
        data() {
            return {
                items: [],
            };
        },
        created() {
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
    }
</script>
