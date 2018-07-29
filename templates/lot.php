    <nav class="nav">
        <ul class="nav__list container">
            <li class="nav__item">
                <a href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Крепления</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Ботинки</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Одежда</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Инструменты</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Разное</a>
            </li>
        </ul>
    </nav>
   <?php

   function formatNumber($number) {
       $num = ceil($number);
       if ($num > 1000) {
           $num = number_format($num, 0, ".", " ");
       }

       $num . "&#8399";
       return $num;
   };

   $index = [$_GET][0]["id"];
   if($_POST) {
       $index = count($data_array["list"]);
   }
   $title = $data_array["list"][$index - 1]["name"];
   $img = $data_array["list"][$index - 1]["url"];
   $category = $data_array["list"][$index - 1]["category"];
   $desc = $data_array["list"][$index - 1]["desc"];
   $price = $data_array["list"][$index - 1]["price"];
   $price_format = formatNumber($price);
   $min_price = $price + 1;
   $min_price_format = formatNumber($min_price);

   if($index - 1 <= count($data_array["list"])) {

    print ("
   
    <section class=\"lot-item container\">
        <h2>$title</h2>
        <div class=\"lot-item__content\">
            <div class=\"lot-item__left\">
                <div class=\"lot-item__image\">
                    <img src=\"$img\" width=\"730\" height=\"548\" alt=\"Сноуборд\">
                </div>
                <p class=\"lot-item__category\">Категория: <span>$category</span></p>
                <p class=\"lot-item__description\"><!--Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                    снег
                    мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                    снаряд
                    отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                    кэмбер
                    позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                    просто
                    посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.--> $desc</p>
            </div>
            <div class=\"lot-item__right\">
            ");
   }

   if($index - 1 <= count($data_array["list"]) && $_SESSION["user"]) {

       print ("
       
                <div class=\"lot-item__state\">
                    <div class=\"lot-item__timer timer\">
                        10:54:12
                    </div>
                    <div class=\"lot-item__cost-state\">
                        <div class=\"lot-item__rate\">
                            <span class=\"lot-item__amount\">Текущая цена</span>
                            <span class=\"lot-item__cost\">$price_format</span>
                        </div>
                        <div class=\"lot-item__min-cost\">
                            Мин. ставка <span>$min_price_format</span>
                        </div>
                    </div>
                    <form class=\"lot-item__form\" action=\"https://echo.htmlacademy.ru\" method=\"post\">
                        <p class=\"lot-item__form-item\">
                            <label for=\"cost\">Ваша ставка</label>
                            <input id=\"cost\" type=\"number\" name=\"cost\" placeholder=\"$min_price_format\">
                        </p>
                        <button type=\"submit\" class=\"button\">Сделать ставку</button>
                    </form>
                </div>
                ");
       }    if($index - 1 <= count($data_array["list"])) {

       print ("  
       
                <div class=\"history\">
                    <h3>История ставок (<span>10</span>)</h3>
                    <table class=\"history__list\">
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Иван</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">5 минут назад</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Константин</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">20 минут назад</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Евгений</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">Час назад</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Игорь</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 08:21</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Енакентий</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 13:20</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Семён</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 12:20</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Илья</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 10:20</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Енакентий</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 13:20</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Семён</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 12:20</td>
                        </tr>
                        <tr class=\"history__item\">
                            <td class=\"history__name\">Илья</td>
                            <td class=\"history__price\">10 999 р</td>
                            <td class=\"history__time\">19.03.17 в 10:20</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>    
    ");} else {
        header("Location: /404.php");   // создать страницу
   }
    ?>
