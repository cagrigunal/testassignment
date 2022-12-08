<template>

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
            <td>
                <a v-if="item.newTab==='true'" :href="item.link" target="_blank">{{item.link}}</a>
                <a v-if="item.newTab==='false'"  :href="item.link" >{{item.link}}</a>
            </td>
        </tr>
        </tbody>
    </table>


</template>

<script>
    export default {
        data() {
            return {
                items:[],
            };
        },
        created() {

            this.fetchData()
        },
        methods: {

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
            }


        },
    };
</script>
