<!DOCTYPE html>
<html lang="pl">

  <head>
    <meta charset="utf-8">
    <title>Szukaj w Google</title>
    <link rel="icon"  href="images_google/icon.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style_results.css">
    <script src="my_vue.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>

  <body> 
    <!--class="home" for google home page / class="results" for google results page-->
    <div id="app" :class="[change_class == 1 ? 'results' : 'home']"> 
      
    <nav class="nav_tools">
        <a href ="#">Gmail</a>
        <a href ="#">Grafika</a>
        <img src="images_google/bars.png" class="google_apps" role="button"></img>
        <button>Zaloguj się</button>
    </nav>

    <section class="search">
        <img src="images_google/google.png" class="logo">
        <form><br><br>
            <div class="search_elements">
              <div class="dropdown_content">

                <input class="search_input" 
                ref="first" 
                v-model="googleSearch" 
                type="text"  
                v-on:keyup.down="downClick" 
                v-on:keyup.up="upClick" 
                v-on:keyup.enter="enterClick"
                @input="findResultsDebounced">

                <div class="bottom_border"></div>
                <div class="list">
                  <ul v-for="(city, index) in filteredCities" :key="city.name" v-on:click="update_input(city.name)">
                    <li :class="{grey_content: index == list_counter}">
                        <a v-on:click="choose(index)" v-html="boldCity(city)">{{ city }}</a>
                    </li>
                  </ul>
                </div>

              </div>
                <img src="images_google/search_icon.png" class="search_icon"/>
                <img src="images_google/mic.png" class="search_voice"/>
                <input v-on:click="change_page" type="button" class="search_button" value="Sukaj w google"/>
                <input v-on:click="change_page" type="button" class="search_button" value="Szczęśliwy traf"/>
            </div>
        </form>
    </section>

    <footer class="home_futter">
        <h4>Polska</h4>
        <div class="links">
            <div class="link_1">
                <a href="#">O nas</a>
                <a href="#">Reklamuj się</a>
                <a href="#">Dla firm</a>
                <a href="#">Jak działa wyszukiwarka</a>
            </div>
            <div class="link_2">
                <a href="#"><img src="images_google/leaf.png" class="leaf">Nautralność węglowa od 2007 roku</a>
            </div>
            <div class="link_3">
                <a href="#">Prywatność</a>
                <a href="#">Warunki</a>
                <a href="#">Ustawienia</a>
            </div>
        </div>
    </footer>

    
    <div class="top_nav">

        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png" alt=""  v-on:click="change_page()">

        <ul class="accountOptions">
          <li><a href="#"><img src="images_google/bars.png" class="google_apps" role="button"></a></li>
          <li><button class="signIn" type="button" name="button">Zaloguj się</button></li>
        </ul>

        <div class="search_tools">

          <div class="search_elem">
            <input ref="second" type="text" v-model="googleSearch"/>
            <img src="images_google/loupe_icon.png" class="search_icon">
            <img src="images_google/mic.png" class="search_voice">
            <img src="images_google/keyboard.png" class="search_keyboard">
            <div class="line"></div>
            <img src="images_google/x.png" class="search_x">
          </div>

          <ul class="search_options">
            <li class="left active"><a href="#">Wszystko</a></li>
            <li class="left"><a href="#">Wiadomości</a></li>
            <li class="left"><a href="#">Grafika</a></li>
            <li class="left"><a href="#">Wideo</a></li>
            <li class="left"><a href="#">Mapy</a></li>
            <li class="left"><a href="#">Więcej</a></li>
            <li class="right"><a class="tools" href="#">Narzędzia</a></li>
            <li class="right"><a href="#">Ustawienia</a></li>
          </ul>
          
        </div>

    </div> 

    <div class="searchResults">

        <p class="results_number">Około 14 700 000 wyników (0,34 s)</p>

        <div class="result">
          <a class="link" href="#">support.google.com › websearch › answer</a><button>▼</button>
          <h2><a href="#">Sprawdzanie wyników wyszukiwania podróży przez Gmaila ...</a></h2>
          <p>Zobacz wyniki z innego konta Google. Uwaga: aby wykonać te czynności, musisz zalogować się na konto Google. Na telefonie lub tablecie z Androidem otwórz ...</p>
        </div>

        <div class="result">
          <a class="link" href="#">support.google.com › websearch › answer</a><button>▼</button>
          <h2><a href="#">Usunięcie informacji z Google - Wyszukiwarka Google - Pomoc</a></h2>
          <p>Aby usunąć informacje o sobie z wyników wyszukiwania Google, najlepiej jest skontaktować się z właścicielem witryny, który je opublikował. Gdy zostaną usunięte ...</p>
        </div>

        <div class="result">
          <a class="link" href="#">www.pozycjonusz.pl › rodzaje-wynikow-wyszukiwania...</a><button>▼</button>
          <h2><a href="#">Rodzaje wyników wyszukiwania Google - ponad 20 ...</a></h2> 
          <p>7) Wewnętrzna wyszukiwarka. Rodzaje wyników wyszukiwania Google wzbogacono jakiś czas temu o funkcję wewnętrznej wyszukiwarki. To rozwiązanie, bez ...</p>
        </div>

        <div class="result">
          <a class="link" href="#">widoczni.com › blog › jak-wyszukiwac-w-google</a><button>▼</button>
          <h2><a href="#">14 sposobów wyszukiwania w Google, których 95% z Was nie ...</a></h2> 
          <p>>Szukanie frazy – zastosowanie cudzysłowu. Wyniki wyszukiwania w Google konkretnych fraz mogą być bardziej trafne, gdy zastosujemy cudzysłów. Algorytmy ...</p>
        </div>

        <div class="result">
          <a class="link" href="#">www.empressia.pl › blog › 115-rozne-wyniki-wyszuki...</a><button>▼</button>
          <h2><a href="#">Wyniki wyszukiwań Google – skąd takie rozbieżności?</a></h2>
          <p><span>21 lut 2019 — </span>Otóż inaczej będą prezentować się wyniki wyszukiwania po wpisaniu tej samej frazy przez ... Google przechwytuje adres IP i za jego pomocą generuje wyniki, np. po wpisaniu frazy ... Jaki jest koszt pozycjonowania sklepu?</p>
        </div>

        <div class="result">
          <a class="link" href="#">www.telepolis.pl › wiadomosci › aplikacje › wyszukiwa...</a><button>▼</button>
          <h2><a href="#">Wyszukiwarka Google powie więcej o wynikach wyszukiwania ...</a></h2>
          <p><span>2 lut 2021 — </span>Szczegóły wyników wyszukiwania w Google. W polu z informacjami o ... co masz do Wikipedii? Jeśli widzisz jakiś błąd, to możesz go poprawić.</p>
        </div>

        <div class="result">
          <a class="link" href="#">developers.google.com › advanced › guidelines › video</a><button>▼</button>
          <h2><a href="#">Sprawdzone metody dotyczące filmów | Google Search Central</a></h2>
          <p>Wyniki wyszukiwania filmów w wyszukiwarce Google pojawiają się zarówno w ... Umieść jakiś rodzaj ekranu logowania do strony z filmem i samego filmu.</p>
        </div>

        <div class="result">
          <a class="link" href="#">www.whitepress.pl › baza-wiedzy › na-czym-polega-po...</a><button>▼</button>
          <h2><a href="#">Co to jest pozycjonowanie? Od czego zacząć? Zobacz nasz ...</a></h2>
          <p>Zobacz jaki wpływ na pozycje ma pozycjonowanie i jak je wykonać samemu. ... Z samej wyszukiwarki Google miesięcznie korzysta około 20 mln Internautów, co ... użytkownicy odnaleźli naszą witrynę internetową w wynikach wyszukiwania.</p>
        </div>

        <br>

        <div class="related_results">

          <h2>Wyszukiwania podobne do: jakiś wynik google</h2>

          <table>
            <tr>
              <td>Google Trends</td>
              <td>Oto niektóre wyniki wyszukiwania</td>
            </tr>
            <tr>
              <td>Wyniki wyszukiwania</td>
              <td>Wyszukiwanie w Internecie</td>
            </tr>
            <tr>
              <td>Wyniki wyszukiwania</td>
              <td>Bezpłatna wyszukiwarka osób</td>
            </tr>
            <tr>
              <td>Wyszukiwanie zaawansowane definicja</td>
              <td>Zasady wyszukiwania w Google</td>
            </tr>
          </table>

        </div>

        <br><br>

          <table class="pages">
            <tr>
              <td><span class="blue">G</span></td>
              <td><span class="red">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="yellow">o</span></td>
              <td><span class="blue">g</span></td>
              <td><span class="green">l</span></td>
              <td><span class="red">e</span></td>
              <td rowspan="2" style="width: 10px;"></td>
              <td><span class="blue arrow">></span></td>
            </tr>

            <tr>
              <td class="page_nr"></td>
              <td class="page_nr" style="color: black; cursor: text;">1</td>
              <td class="page_nr">2</td>
              <td class="page_nr">3</td>
              <td class="page_nr">4</td>
              <td class="page_nr">5</td>
              <td class="page_nr">6</td>
              <td class="page_nr">7</td>
              <td class="page_nr">8</td>
              <td class="page_nr">9</td>
              <td class="page_nr">10</td>
              <td colspan="3"></td>
              <td class="page_nr">Następna</td>
            </tr>

          </table>

      </div>

      <div class="footer">

        <div class="localization">
        <p>
          <a class="country">Polska</a>
          <a class="loc"><strong>Kraków</strong> - Z Twojego adresu internetowego </a>
          <a class ="loc_more">- Użyj dokładnej lokalizacji</a><a class ="loc_more"> - Dowiedz się więcej</a>
        </p>
      </div>

        <ul>
            <li><a href="#">Pomoc</a></li>
            <li><a href="#">Prześlij opinię</a></li>
            <li><a href="#">Prywatność</a></li>
            <li><a href="#">Warunki</a></li>
        </ul>
        
      </div>
    </div>
</body>
</html>