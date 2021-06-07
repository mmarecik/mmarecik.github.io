<!DOCTYPE html>
<html>
<head>
    <title>My first Vue app</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://unpkg.com/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <div id="app">
    {{ googleSearch }}
    <input type="text" v-model="googleSearch" @input="findResultsDebounced" />
    <div v-for="city in results" :key="city.name">
        <span class="name">{{ city.name }}</span>
    </div>
  </div>
  <script>
    var app = new Vue({
        el: '#app',
        data: {
            googleSearch: '',
            results: []
        },
        methods : {
            findResultsDebounced : Cowboy.debounce(100, function findResultsDebounced() {
                console.log('Fetch: ', this.googleSearch)
                fetch(`http://localhost/search?name=${this.googleSearch}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data: ', data);
                        this.results = data;
                    });
            })
        }
    })
  </script>
</body>
</html>