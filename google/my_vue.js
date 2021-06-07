var app = new Vue({
    el: '#app',
    data: {
      selected_city: '',
      googleSearch: '',
      googleSearch_temp: '',
      cities_update: true,
      change_class: 0,
      filteredCities: [],
      list_counter: -1,
    },

    watch: {

      list_counter: function(){
        this.cities_update = false;
        this.googleSearch = this.filteredCities[this.list_counter].name;
      },

      googleSearch: function(){
        if(this.googleSearch.length == 0){
          this.filteredCities = '';
        }
        else{
          this.findResultsDebounced();
          this.cities_update=true;
          if(this.list_counter == -1){
            this.googleSearch_temp = this.googleSearch; 
            this.findResultsDebounced();     
          }
        }
      },

    },

    methods: {

    change_page() {
        if (this.change_class == 0){
          this.change_class = 1;
        }
        else{
          this.googleSearch = '';
          this.change_class = 0;
        }
    },

    update_input(name){
        this.googleSearch = name;
        this.change_page(); //automatyczne przekierowanie po kliknieciu
    },
        
    choose(i){
        this.googleSearch = this.filteredCities[i].name;
    },

    enterClick() {
      if(this.list_counter != -1){ 
        this.googleSearch = this.filteredCities[this.list_counter].name
        this.list_counter = -1;
        this.change_page();
        this.foc = false;
      }
      else{
        this.change_page();
      }
    },

    upClick() {
      if(this.list_counter > -1){
        this.list_counter -= 1;
      }
      else if(this.list_counter == 0){
        this.list_counter = this.filteredCities.length - 1;
      }
    },

    downClick() {
      if(this.list_counter < this.filteredCities.length - 1){
        this.list_counter += 1;
      }
      else if(this.list_counter == this.filteredCities.length - 1){
        this.list_counter = -1;
      }
    },

  boldCity(input_city){
    let regex = new RegExp(this.googleSearch_temp, "gi");
    let bold = "<b>" + 
      input_city.name.replace(regex, match =>
          {return "<span class='thin'>"+ match +"</span>";}) 
              + "</b>";
      return bold;
  },

  findResultsDebounced : Cowboy.debounce(100, function findResultsDebounced() {
    console.log('Fetch: ', this.googleSearch)
    fetch(`http://localhost/search?name=${this.googleSearch}`)
        .then(resp => {resp.json();
        console.log(resp.headers.get('Content-Type'));})
        .then(data => {
            console.log('Data: ', data);
            this.filteredCities = data;
        });
})

}

});