<header>
	<?php $user = unserialize($_SESSION['user']); ?>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="">Camp IS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo ($page == "index.php" ? "active" : "");?>">
              <a class="nav-link" href="index.php">Главная</a>
            </li>
			<?php if($user) : ?>
			<li class="nav-item <?php echo ($page == "info_o.php" ? "active" : "");?>">
              <a class="nav-link" href="info_o.php">Основное</a>
            </li>
			<li class="nav-item dropdown <?php echo ($page == "info_v.php" || $page == "v_select.php" ? "active" : "");?>">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Дополнительное
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item <?php echo ($page == "info_v.php" ? "active" : "");?>" href="info_v.php">Выбранное</a>
			  <a class="dropdown-item <?php echo ($page == "v_select.php" ? "active" : "");?>" href="v_select.php">Записаться</a>
			</div>
			</li>
			<?php if($user->admin > 0) : ?>
			<li class="nav-item dropdown <?php echo ($page == "p_info_v.php" || $page == "p_info_o.php" ? "active" : "");?>">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Списки и посещаемость
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item <?php echo ($page == "p_info_o.php" ? "active" : "");?>" href="p_info_o.php">Обязательные группы</a>
			  <a class="dropdown-item <?php echo ($page == "p_info_v.php" ? "active" : "");?>" href="p_info_v.php">Дополнительные занятия</a>
			</div>
			</li>
			<li class="nav-item dropdown <?php echo ($page == "rate_add.php" || $page == "rate_rem.php" || $page == "notify.php" ? "active" : "");?>">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Ребенок
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<h6 class="dropdown-header">Изменение рейтинга</h6>
			  <a class="dropdown-item <?php echo ($page == "rate_add.php" ? "active" : "");?>" href="rate_add.php">Выдача баллов</a>
			  <a class="dropdown-item <?php echo ($page == "rate_rem.php" ? "active" : "");?>" href="rate_rem.php">Снятие баллов</a>
			  <div class="dropdown-divider"></div>
			  <h6 class="dropdown-header">Прочее</h6>
			  <a class="dropdown-item <?php echo ($page == "notify.php" ? "active" : "");?>" href="notify.php">Отправить уведомление</a>
			</div>
			</li>
			<?php if($user->admin > 1) : ?>
			<li class="nav-item dropdown <?php echo ($page == "a_create_o.php" || $page == "a_list_o.php" || $page == "a_create_d.php" || $page == "a_list_d.php" || $page == "register.php" || $page == "a_list_reb.php" || $page == "a_pos_o.php" || $page == "a_pos_d.php" || $page == "a_rating.php" ? "active" : "");?>">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Админ-панель
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<h6 class="dropdown-header">Обязательные группы</h6>
			  <a class="dropdown-item <?php echo ($page == "a_create_o.php" ? "active" : "");?>" href="a_create_o.php">Создать обяз. группу</a>
			  <a class="dropdown-item <?php echo ($page == "a_list_o.php" ? "active" : "");?>" href="a_list_o.php">Список обяз. групп</a>
			  <div class="dropdown-divider"></div>
			  <h6 class="dropdown-header">Дополнительные занятия</h6>
			  <a class="dropdown-item <?php echo ($page == "a_create_d.php" ? "active" : "");?>" href="a_create_d.php">Создать доп. занятие</a>
			  <a class="dropdown-item <?php echo ($page == "a_list_d.php" ? "active" : "");?>" href="a_list_d.php">Список доп. занятий</a>
			  <div class="dropdown-divider"></div>
			  <h6 class="dropdown-header">Работа c детьми</h6>
			  <a class="dropdown-item <?php echo ($page == "register.php" ? "active" : "");?>" href="register.php">Создать пользователя</a>
			  <a class="dropdown-item <?php echo ($page == "a_list_reb.php" ? "active" : "");?>" href="a_list_reb.php">Активировать пользователя</a>
			  <a class="dropdown-item <?php echo ($page == "a_rating.php" ? "active" : "");?>" href="a_rating.php">Суммарный рейтинг</a>
			</div>
			</li>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
          </ul>
		<?php if(isset($_SESSION['logged_in'])) : ?>
			<a class="btn btn-outline-info my-2 my-sm-0" type="button" href="settings.php">Аккаунт</a>
		  	<a class="btn btn-outline-danger my-2 my-sm-0" type="button" href="logout.php">Выход</a>
		<?php else : ?>
			 <a class="btn btn-outline-success my-2 my-sm-0" type="button" href="login.php">Вход</a>
			 <a class="btn btn-outline-info my-2 my-sm-0" type="button" href="register.php">Регистрация</a>
		<?php endif; ?>
          </form>
        </div>
      </nav>
    </header>