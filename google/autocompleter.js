Vue.component('v-autocompleter', {

  props: ['options'],

  data: function () {
    return {
      selected_city: '',
      googleSearch: '',
      googleSearch_temp: '',
      cities_update: true,
      change_class: 0,
      cities: window.cities,
      list_counter: -1,
      foc: true,
    }
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
        this.createFilteredCities(this.cities_update);
        this.cities_update=true;
        if(this.list_counter == -1){
          this.googleSearch_temp = this.googleSearch; 
          this.createFilteredCities(true);     
        }
      }
    },

  },

  methods: {

  createFilteredCities(bool){
      if(bool){
        let result = this.cities.filter(city => city.name.includes(this.googleSearch));
        if(result.length > 10){
           this.filteredCities = result.slice(1, 11);
        }
        else{
          this.filteredCities = result;
        }
      this.list_counter = -1;
         
    }
  },

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

  enterClick: function(event) {
    alert();
    if(event){
      
      this.cities_update = true;
      this.list_counter = -1;
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
}


},

    templete:'<input @focus="foc" ref="first" v-model="googleSearch" type="text" class="search_input" v-on:keyup.down="downClick" v-on:keyup.up="upClick" v-on:keyup.enter="enterClick"/>\
                <div class="bottom_border"></div>\
                  <div class="list">\
                    <ul v-for="(city, index) in filteredCities" v-on:click="update_input(city.name)">\
                      <li :class="{grey_content: index == list_counter}">\
                        <a v-on:click="choose(index)" v-html="boldCity(city)">{{ city }}</a>\
                      </li>\
                    </ul>\
                  </div>'
  })