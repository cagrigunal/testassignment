<template>
    <table>
        <thead>
        <tr>
            <th>HTML Snippet</th>
            <th>Description</th>


        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items">
            <td><pre v-highlightjs>
                      <code :class="['language-html']">{{ item.html }}</code>
                    </pre></td>
            <td>{{item.description}}</td>

            <td><button @click="copyToClipboard(item)">{{item.copyStatus}}</button></td>
        </tr>
        </tbody>
    </table>

</template>
<script>
    export default {
        name: 'HTMLSnippetVisitor',


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
            copyToClipboard(item) {
                for(let i in this.items){
                    this.items[i].copyStatus ='Copy'
                }

                item.copyStatus="Copied!"
                // create a textarea element
                const el = document.createElement('textarea');
                // set the value of the textarea to the HTML snippet
                el.value = item.html;
                // add the textarea to the document
                document.body.appendChild(el);
                // select the text in the textarea
                el.select();
                // copy the selected text to the clipboard
                document.execCommand('copy');
                // remove the textarea from the document
                document.body.removeChild(el);
            }
        },
    };
</script>
