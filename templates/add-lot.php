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
  <form class="form form--add-lot container <?= $data_array["form-invalid"]?>" action="../add.php"
        method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?php if($data_array["errors"]["lot-name"] != null) {
          print "form__item--invalid";
      } ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" value="<?=$_POST["lot-name"]?>" placeholder="Введите наименование лота" <!--required-->
        <span class="form__error">Введите наименование лота</span>
      </div>
      <div class="form__item <?php if($data_array["errors"]["category"] != null) {
          print "form__item--invalid";
      } ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" <!--required-->
          <option>Выберите категорию</option>
          <option>Доски и лыжи</option>
          <option>Крепления</option>
          <option>Ботинки</option>
          <option>Одежда</option>
          <option>Инструменты</option>
          <option>Разное</option>
        </select>
        <span class="form__error"><?=$errors["category"]?></span>
      </div>
    </div>
    <div class="form__item form__item--wide <?php if($data_array["errors"]["message"] != null) {
        print "form__item--invalid";
    } ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" <!--required--></textarea>
      <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" name="lot_img" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?php if($data_array["errors"]["lot-rate"] != null) {
          print "form__item--invalid";
      } ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate"" value="<?=$_POST["lot-rate"]?>" placeholder="0" <!--required-->
        <span class="form__error"><?= $errors["lot-rate"]?></span>
      </div>
      <div class="form__item form__item--small <?php if($data_array["errors"]["lot-step"] != null) {
          print "form__item--invalid";
      } ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" value="<?=$_POST["lot-step"]?>" placeholder="0" <!--required-->
        <span class="form__error"><?= $errors["lot-step"]?></span>
      </div>
      <div class="form__item <?php if($data_array["errors"]["lot-date"] != null) {
          print "form__item--invalid";
      } ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$_POST["lot-date"]?>" <!--required-->
        <span class="form__error"><?= $errors["lot-date"]?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>


